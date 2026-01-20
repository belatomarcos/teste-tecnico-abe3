<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property Pessoa_model $Pessoa_model
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Pagination $pagination  
 * @property CI_URI $uri                 
 */
class Pessoas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pessoa_model');
    }

    public function index() {
        $this->load->library('pagination');
        $config['base_url'] = base_url('pessoas/index');
        $config['total_rows'] = $this->Pessoa_model->count_all();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $config['full_tag_open']    = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link" style="background-color: var(--brand-black); border-color: var(--brand-black); color: var(--brand-yellow);">';
        $config['cur_tag_close']    = '</span></li>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        $config['attributes'] = array('class' => 'page-link text-dark');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pessoas'] = $this->Pessoa_model->get_all($config['per_page'], $page);
        $data['paginacao'] = $this->pagination->create_links();
        $this->load->view('templates/header');
        $this->load->view('pessoas/index', $data);
        $this->load->view('templates/footer');
    }

    public function adicionar() {
        $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[pessoas.email]');
        $this->form_validation->set_message('required', 'O campo %s é obrigatório.');
        $this->form_validation->set_message('valid_email', 'Por favor, digite um e-mail válido.');
        $this->form_validation->set_message('is_unique', 'Este e-mail já está cadastrado para outro colaborador.');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('pessoas/form');
            $this->load->view('templates/footer');
        } else {
            $dados = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email')
            );
            $this->Pessoa_model->insert($dados);
            redirect('pessoas');
        }
    }

    public function editar($id) {
        $data['pessoa'] = $this->Pessoa_model->get_by_id($id);
        if (!$data['pessoa']) {
            redirect('pessoas');
        }
        $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
        if ($this->input->post('email') != $data['pessoa']->email) {
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[pessoas.email]');
        } else {
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        }
        $this->form_validation->set_message('required', 'O campo %s é obrigatório.');
        $this->form_validation->set_message('valid_email', 'Por favor, digite um e-mail válido.');
        $this->form_validation->set_message('is_unique', 'Este e-mail já pertence a outro usuário.');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('pessoas/form', $data);
            $this->load->view('templates/footer');
        } else {
            $dados = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email')
            );
            $this->Pessoa_model->update($id, $dados);
            redirect('pessoas');
        }
    }

    public function excluir($id) {
        $this->Pessoa_model->delete($id);
        redirect('pessoas');
    }
}