<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outros_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Verifica se o usuário está logado em todas as rotas deste controller
        if (!$this->session->userdata('id')) {
            redirect(base_url('logar'));
        }
    }

    // Exibe o carrinho de compras
    public function carrinho() {
        $this->load->view('carrinho_view');
    }

    // Exibe a lista de roupas
    public function roupa_list() {
        $this->load->view('roupas_listar_view');
    }
}
