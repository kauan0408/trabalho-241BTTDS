<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamento_controller extends CI_Controller {

    private $db_roupas;

    public function __construct() {
        parent::__construct();

        // Carrega models
        $this->load->model('Funcionarios_model', 'funcionarios');
        $this->load->model('Roupa_model', 'roupa');

        // Conexão com banco 'roupas'
        $this->db_roupas = $this->load->database('roupas', TRUE);
    }

    public function iniciar() {
        $id = $this->session->userdata('id');
        if (!$id) return redirect('login');

        $funcionario = $this->funcionarios->get_by_id($id);

        // Verifica se os dados obrigatórios estão preenchidos
        $camposObrigatorios = ['cpf', 'telefone', 'rua', 'numero', 'bairro', 'cidade', 'estado', 'cep'];
        foreach ($camposObrigatorios as $campo) {
            if (empty($funcionario[$campo])) {
                $this->session->set_flashdata('alerta', 'Complete o cadastro para efetuar a compra!');
                return redirect('meu-perfil');
            }
        }

        $carrinho = $this->session->userdata('carrinho');
        if (empty($carrinho)) {
            $this->session->set_flashdata('alerta', 'Seu carrinho está vazio.');
            return redirect('roupas');
        }

        // Verifica estoque antes de finalizar
        foreach ($carrinho as $item) {
            $produto = $this->roupa->get_by_id($item['id']);
            if ($produto['estoque'] < $item['quantidade']) {
                $this->session->set_flashdata('alerta', "Estoque insuficiente para o item: {$produto['nome']}");
                return redirect('carrinho');
            }
        }

        // Tudo certo, registra no histórico e atualiza o estoque
        foreach ($carrinho as $item) {
            $this->db_roupas->insert('historico_compras', [
                'funcionario_id'   => $id,
                'nome_funcionario' => $funcionario['nome'], // <<< novo campo
                'roupa_id'         => $item['id'],
                'nome_roupa'       => $item['nome'],
                'preco'            => $item['preco'],
                'quantidade'       => $item['quantidade'],
                'imagem'           => $item['imagem'],
                'data_compra'      => date('Y-m-d H:i:s')
            ]);

            // Desconta do estoque
            $this->roupa->update_estoque($item['id'], -$item['quantidade']);
        }

        $this->session->unset_userdata('carrinho');
        $this->session->set_flashdata('alerta', 'Compra efetuada com sucesso!');
        return redirect('roupas');
    }

    public function historico() {
        $id = $this->session->userdata('id');
        if (!$id) return redirect('login');

        // Carrega o banco 'roupas' para o histórico
        $this->db_roupas = $this->load->database('roupas', TRUE);

        // Consulta com join na tabela 'funcionarios' do banco 'gestao'
$compras = $this->db_roupas
    ->order_by('data_compra', 'DESC')
    ->get('historico_compras')
    ->result_array();


        $this->load->view('historico_view', ['compras' => $compras]);
    }

}
