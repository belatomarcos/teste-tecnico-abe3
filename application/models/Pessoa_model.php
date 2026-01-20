<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa_model extends CI_Model {
    
    public function count_all() {
        return $this->db->count_all('pessoas');
    }
    public function get_all($limit = null, $start = null) {
        $this->db->select('pessoas.*, cargos.nome as cargo_atual');
        $this->db->from('pessoas');
        $this->db->join('historico_cargos', 'historico_cargos.pessoa_id = pessoas.id AND historico_cargos.data_fim IS NULL', 'left');
        $this->db->join('cargos', 'cargos.id = historico_cargos.cargo_id', 'left');
        $this->db->order_by('pessoas.nome', 'ASC');
        if ($limit !== null && $start !== null) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('pessoas')->row();
    }

    public function insert($dados) {
        $this->db->insert('pessoas', $dados);
        return $this->db->insert_id();
    }

    public function update($id, $dados) {
        $this->db->where('id', $id);
        return $this->db->update('pessoas', $dados);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('pessoas');
    }
}