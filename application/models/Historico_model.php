<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_model extends CI_Model {

    private $db_roupas;

    public function __construct() {
        parent::__construct();
        $this->db_roupas = $this->load->database('roupas', TRUE);
    }

    public function registrar_compra($dados) {
        return $this->db_roupas->insert('historico_compras', $dados);
    }

    public function listar_por_usuario($usuario_id) {
        return $this->db_roupas
            ->where('funcionario_id', $usuario_id)
            ->order_by('data_compra', 'DESC')
            ->get('historico_compras')
            ->result_array();
    }
}
