<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property Historico_model $Historico_model
 * @property Pessoa_model $Pessoa_model
 * @property Cargo_model $Cargo_model
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 */
class Historico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Historico_model');
        $this->load->model('Pessoa_model');
        $this->load->model('Cargo_model');
    }

    public function gerenciar($pessoa_id) {
        $data['pessoa'] = $this->Pessoa_model->get_by_id($pessoa_id);
        if (!$data['pessoa']) {
            redirect('pessoas');
        }
        $data['historico'] = $this->Historico_model->get_by_pessoa($pessoa_id);
        $data['cargos'] = $this->Cargo_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('pessoas/historico', $data);
        $this->load->view('templates/footer');
    }

    public function adicionar($pessoa_id) {
        $this->form_validation->set_rules('cargo_id', 'Cargo', 'required');
        $this->form_validation->set_rules('data_inicio', 'Data de Início', 'required');
        $this->form_validation->set_rules('data_inicio', 'Data de Início', 'trim|required|callback__check_conflito');
        if ($this->form_validation->run() == FALSE) {
            $this->gerenciar($pessoa_id);
        } else {
            $dados = array(
                'pessoa_id' => $pessoa_id,
                'cargo_id' => $this->input->post('cargo_id'),
                'data_inicio' => $this->input->post('data_inicio'),
                'data_fim' => $this->input->post('data_fim') ? $this->input->post('data_fim') : NULL
            );
            $this->Historico_model->insert($dados);
            $this->session->set_flashdata('sucesso', 'Cargo atribuído com sucesso!');
            redirect('historico/gerenciar/'.$pessoa_id);
        }
    }
    public function encerrar($historico_id, $pessoa_id) {
        $data_fim = date('Y-m-d');
        $this->Historico_model->encerrar_cargo($historico_id, $data_fim);
        $this->session->set_flashdata('sucesso', 'Cargo encerrado com sucesso!');
        redirect('historico/gerenciar/'.$pessoa_id);
    }

    public function excluir($id, $pessoa_id) {
        $this->Historico_model->delete($id);
        $this->session->set_flashdata('sucesso', 'Registro removido.');
        redirect('historico/gerenciar/'.$pessoa_id);
    }

    public function _check_conflito($str) {
        $pessoa_id = $this->input->post('pessoa_id');
        $data_inicio = $this->input->post('data_inicio');
        $data_fim = $this->input->post('data_fim') ? $this->input->post('data_fim') : NULL;
        $conflito = $this->Historico_model->verificar_conflito($pessoa_id, $data_inicio, $data_fim);
        if ($conflito) {
            $this->form_validation->set_message('_check_conflito', '<b>Erro de Data:</b> O período selecionado entra em conflito com outro cargo já existente no histórico deste colaborador.');
            return FALSE;
        }
        return TRUE;
    }

    public function editar($historico_id) {
        $historico = $this->Historico_model->get_by_id($historico_id);
        if (!$historico) {
            $this->session->set_flashdata('erro', 'Registro não encontrado.');
            redirect('pessoas');
        }
        $data['pessoa'] = $this->Pessoa_model->get_by_id($historico->pessoa_id);
        $data['cargos'] = $this->Cargo_model->get_all();
        $data['historico'] = $historico;
        $this->load->view('templates/header');
        $this->load->view('pessoas/editar_historico', $data);
        $this->load->view('templates/footer');
    }

    public function salvar_edicao($historico_id) {
        $historico = $this->Historico_model->get_by_id($historico_id);
        $this->form_validation->set_rules('cargo_id', 'Cargo', 'required');
        $this->form_validation->set_rules('data_inicio', 'Data de Início', 'required|callback__check_conflito_edicao');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($historico_id);
        } else {
            $dados = array(
                'cargo_id' => $this->input->post('cargo_id'),
                'data_inicio' => $this->input->post('data_inicio'),
                'data_fim' => $this->input->post('data_fim') ? $this->input->post('data_fim') : NULL
            );
            $this->Historico_model->update($historico_id, $dados);
            $this->session->set_flashdata('sucesso', 'Histórico atualizado com sucesso!');
            redirect('historico/gerenciar/'.$historico->pessoa_id);
        }
    }

    public function _check_conflito_edicao($str) {
        $pessoa_id = $this->input->post('pessoa_id');
        $historico_id = $this->input->post('historico_id');
        $data_inicio = $this->input->post('data_inicio');
        $data_fim = $this->input->post('data_fim') ? $this->input->post('data_fim') : NULL;
        $conflito = $this->Historico_model->verificar_conflito($pessoa_id, $data_inicio, $data_fim, $historico_id);
        if ($conflito) {
            $this->form_validation->set_message('_check_conflito_edicao', '<b>Conflito:</b> As novas datas entram em conflito com outro cargo existente.');
            return FALSE;
        }
        return TRUE;
    }
}