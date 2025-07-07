<?php
/**
 * Model responsável pelas operações com a tabela 'roupa'
 * utilizando um banco de dados separado chamado 'roupas'
 */
class Roupa_model extends CI_Model {

    private $db_roupas;

    /**
     * Construtor: carrega a conexão com o banco 'roupas'
     */
    public function __construct() {
        parent::__construct();
        $this->db_roupas = $this->load->database('roupas', TRUE); // Banco alternativo
    }

    /**
     * Retorna todas as roupas ordenadas pelo nome (A-Z)
     * @return array
     */
    public function get_all() {
        return $this->db_roupas
            ->order_by('nome', 'asc')
            ->get('roupa')
            ->result_array();
    }

    /**
     * Retorna todas as roupas sem ordenação
     * @return array
     */
    public function get_all_sem_ordenacao() {
        return $this->db_roupas
            ->get('roupa')
            ->result_array();
    }

    /**
     * Busca uma roupa específica pelo ID
     * @param int $id
     * @return array|null
     */
    public function get_by_id($id) {
        return $this->db_roupas
            ->get_where('roupa', ['id' => (int) $id])
            ->row_array();
    }

    /**
     * Insere uma nova roupa na tabela
     * @param array $dados
     * @return bool
     */
    public function inserir($dados) {
        $dadosSanitizados = $this->security->xss_clean($dados);
        return $this->db_roupas->insert('roupa', $dadosSanitizados);
    }

    /**
     * Atualiza uma roupa existente
     * @param int $id
     * @param array $dados
     * @return bool
     */
    // Atualiza uma roupa com dados gerais (nome, preço, etc)
    public function update($id, $dados) {
        $dadosSanitizados = $this->security->xss_clean($dados);
        $this->db_roupas->where('id', (int) $id);
        return $this->db_roupas->update('roupa', $dadosSanitizados);
    }

    // Atualiza apenas o estoque (quantidade), somando ou subtraindo a quantidade passada
    public function update_estoque($id, $quantidade_alteracao) {
        $roupa = $this->get_by_id($id);
        if (!$roupa) return false;

        $nova_quantidade = $roupa['quantidade'] + $quantidade_alteracao;
        if ($nova_quantidade < 0) return false;

        $this->db_roupas->where('id', $id);
        return $this->db_roupas->update('roupa', ['quantidade' => $nova_quantidade]);
    }
    /**
     * Exclui uma roupa da tabela pelo ID
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        return $this->db_roupas->delete('roupa', ['id' => (int) $id]);
    }

    // Atualiza apenas o estoque
    public function atualizar_estoque($id, $novoEstoque) {
        return $this->db_roupas
            ->where('id', (int) $id)
            ->update('roupa', ['estoque' => (int) $novoEstoque]);
    }
}
