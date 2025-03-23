<?php
/**
 * Classe de autenticação de usuários
 */
class Funcionarios_model extends CI_model {
    public function get_all() {
        return $this->db->get("funcionarios")->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where("funcionarios", ['id' => $id])->row_array();
    }

    public function insert($dadosFormulario) {
        $this->db->insert('funcionarios', $dadosFormulario);
    }
}