<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_model extends CI_Model {

    public function get_by_pessoa($pessoa_id) {
        $this->db->select('historico_cargos.*, cargos.nome as nome_cargo');
        $this->db->from('historico_cargos');
        $this->db->join('cargos', 'cargos.id = historico_cargos.cargo_id');
        $this->db->where('historico_cargos.pessoa_id', $pessoa_id);
        $this->db->order_by('historico_cargos.data_inicio', 'DESC');
        return $this->db->get()->result();
    }

    public function insert($dados) {
        $this->db->insert('historico_cargos', $dados);
        return $this->db->insert_id();
    }
    
    public function encerrar_cargo($id, $data_fim) {
        $this->db->where('id', $id);
        return $this->db->update('historico_cargos', array('data_fim' => $data_fim));
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('historico_cargos');
    }

    public function verificar_conflito($pessoa_id, $data_inicio, $data_fim, $ignorar_id = null) {
        $this->db->group_start();
            $this->db->where("'$data_inicio' BETWEEN data_inicio AND COALESCE(data_fim, '2999-12-31')", NULL, FALSE);
            if ($data_fim) {
                $this->db->or_where("'$data_fim' BETWEEN data_inicio AND COALESCE(data_fim, '2999-12-31')", NULL, FALSE);
            }
            $this->db->or_group_start();
                $this->db->where('data_inicio >=', $data_inicio);
                if ($data_fim) {
                    $this->db->where('data_inicio <=', $data_fim);
                }
            $this->db->group_end();
        $this->db->group_end();
        $this->db->where('pessoa_id', $pessoa_id);
        if ($ignorar_id) {
            $this->db->where('id !=', $ignorar_id);
        }
        $query = $this->db->get('historico_cargos');
        return $query->num_rows() > 0;
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('historico_cargos')->row();
    }
    
    public function update($id, $dados) {
        $this->db->where('id', $id);
        return $this->db->update('historico_cargos', $dados);
    }

    public function get_by_cargo($cargo_id) {
        $this->db->select('historico_cargos.*, pessoas.nome as nome_pessoa, pessoas.email');
        $this->db->from('historico_cargos');
        $this->db->join('pessoas', 'pessoas.id = historico_cargos.pessoa_id');
        $this->db->where('historico_cargos.cargo_id', $cargo_id);
        
        // Ordena: Quem entrou por último aparece primeiro
        $this->db->order_by('historico_cargos.data_inicio', 'DESC');
        
        return $this->db->get()->result();
    }
}