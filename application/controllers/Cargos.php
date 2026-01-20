<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property Cargo_model $Cargo_model
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 */
class Cargos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cargo_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['cargos'] = $this->Cargo_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('cargos/index', $data);
        $this->load->view('templates/footer');
    }

    public function adicionar() {
        $this->form_validation->set_rules('nome', 'Nome do Cargo', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('cargos/form');
            $this->load->view('templates/footer');
        } else {
            $dados = array(
                'nome' => $this->input->post('nome')
            );
            $this->Cargo_model->insert($dados);
            redirect('cargos');
        }
    }

    public function editar($id) {
        $data['cargo'] = $this->Cargo_model->get_by_id($id);
        if (!$data['cargo']) {
            redirect('cargos');
        }
        $this->form_validation->set_rules('nome', 'Nome do Cargo', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('cargos/form', $data);
            $this->load->view('templates/footer');
        } else {
            $dados = array(
                'nome' => $this->input->post('nome')
            );
            $this->Cargo_model->update($id, $dados);
            redirect('cargos');
        }
    }

    public function excluir($id) {
        $this->Cargo_model->delete($id);
        redirect('cargos');
    }

    public function ocupantes($cargo_id) {
        $this->load->model('Historico_model');
        $this->load->model('Pessoa_model');
        $data['cargo'] = $this->Cargo_model->get_by_id($cargo_id);
        if (!$data['cargo']) redirect('cargos');
        $data['ocupantes'] = $this->Historico_model->get_by_cargo($cargo_id);
        $total = $this->Pessoa_model->count_all();
        $data['pessoas'] = $this->Pessoa_model->get_all($total, 0); 
        $this->load->view('templates/header');
        $this->load->view('cargos/ocupantes', $data);
        $this->load->view('templates/footer');
    }

    public function adicionar_ocupante($cargo_id) {
        $this->load->model('Historico_model');
        $this->form_validation->set_rules('pessoa_id', 'Colaborador', 'required');
        $this->form_validation->set_rules('data_inicio', 'Data de Início', 'required|callback__check_conflito');
        if ($this->form_validation->run() == FALSE) {
            $this->ocupantes($cargo_id);
        } else {
            $dados = array(
                'cargo_id' => $cargo_id,
                'pessoa_id' => $this->input->post('pessoa_id'),
                'data_inicio' => $this->input->post('data_inicio'),
                'data_fim' => $this->input->post('data_fim') ? $this->input->post('data_fim') : NULL
            );
            $this->Historico_model->insert($dados);
            $this->session->set_flashdata('sucesso', 'Colaborador vinculado ao cargo com sucesso!');
            redirect('cargos/ocupantes/'.$cargo_id);
        }
    }

    public function _check_conflito($str) {
        $this->load->model('Historico_model');
        $pessoa_id = $this->input->post('pessoa_id');
        $data_inicio = $this->input->post('data_inicio');
        $data_fim = $this->input->post('data_fim') ? $this->input->post('data_fim') : NULL;
        if(!$pessoa_id) return TRUE;
        $conflito = $this->Historico_model->verificar_conflito($pessoa_id, $data_inicio, $data_fim);
        if ($conflito) {
            $this->form_validation->set_message('_check_conflito', '<b>Conflito:</b> Esse colaborador já possui outro cargo ativo neste período.');
            return FALSE;
        }
        return TRUE;
    }
}