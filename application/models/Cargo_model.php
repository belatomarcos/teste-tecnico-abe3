<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargo_model extends CI_Model {

    public function get_all() {
        $this->db->order_by('nome', 'ASC');
        return $this->db->get('cargos')->result();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('cargos')->row();
    }

    public function insert($dados) {
        $this->db->insert('cargos', $dados);
        return $this->db->insert_id();
    }

    public function update($id, $dados) {
        $this->db->where('id', $id);
        return $this->db->update('cargos', $dados);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('cargos');
    }
}