<?php
/**
 * Model para gerenciamento de funcionários (CRUD)
 */
class Funcionarios_model extends CI_Model {

    /**
     * Retorna todos os funcionários ordenados por nome
     * @return array
     */
    public function get_all() {
        return $this->db
            ->order_by('nome', 'asc')
            ->get('funcionarios')
            ->result_array();
    }

    /**
     * Retorna um funcionário específico pelo ID
     * @param int $id
     * @return array|null
     */
    public function get_by_id($id) {
        return $this->db
            ->get_where('funcionarios', ['id' => (int) $id])
            ->row_array();
    }

    /**
     * Insere um novo funcionário no banco de dados
     * @param array $dadosFormulario
     * @return int ID inserido
     */
    public function insert($dadosFormulario) {
        $dadosSanitizados = $this->security->xss_clean($dadosFormulario);
        $this->db->insert('funcionarios', $dadosSanitizados);
        return $this->db->insert_id();
    }

    /**
     * Atualiza os dados de um funcionário existente
     * @param array $dadosFormulario
     * @return bool
     */
    public function update($dadosFormulario) {
        $dadosSanitizados = $this->security->xss_clean($dadosFormulario);
        $this->db->where('id', (int) $dadosSanitizados['id']);
        return $this->db->update('funcionarios', $dadosSanitizados);
    }

    /**
     * Remove um funcionário do banco de dados pelo ID
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->where('id', (int) $id);
        return $this->db->delete('funcionarios');
    }

    public function get_by_cpf($cpf) {
        return $this->db->get_where('funcionarios', ['cpf' => $cpf])->row_array();
    }

    public function get_by_email($email) {
        return $this->db->get_where('funcionarios', ['email' => $email])->row_array();
    }

}
