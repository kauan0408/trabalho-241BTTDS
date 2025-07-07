<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roupa_controller extends CI_Controller {

    // Método construtor, carregado automaticamente ao instanciar a classe
    public function __construct() {
        parent::__construct();

        // Carrega o model 'Roupa_model' com o alias 'roupa'
        $this->load->model('Roupa_model', 'roupa');

        // Inicia a sessão se ainda não foi iniciada
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Adiciona uma roupa ao carrinho.
     * Recebe o $id da roupa.
     * Se o id não for passado, redireciona para visualizar roupas.
     */
    public function adicionar($id = null) {
        if (!$id) redirect('roupa_controller/visualizar_roupas');

        // Busca a roupa pelo id usando o model
        $item = $this->roupa->get_by_id($id);

        // Verifica se a roupa existe e se há estoque disponível
        if (!$item || $item['estoque'] <= 0) {
            $this->session->set_flashdata("alerta", "Roupas esgotadas no estoque!");
            redirect('roupas');
            return;
        }

        // Pega o carrinho da sessão ou inicia um novo array
        $carrinho = isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : [];

        // Se a roupa já está no carrinho, aumenta a quantidade
        if (isset($carrinho[$id])) {
            // Verifica se ainda tem estoque para adicionar mais
            if ($carrinho[$id]['quantidade'] >= $item['estoque']) {
                $this->session->set_flashdata("alerta", "Estoque insuficiente para adicionar mais!");
                redirect('roupas');
                return;
            }

            $carrinho[$id]['quantidade'] += 1;
        } else {
            // Se não está, adiciona com quantidade 1
            $carrinho[$id] = [
                'id' => $item['id'],
                'nome' => $item['nome'],
                'preco' => $item['preco'],
                'quantidade' => 1,
                'imagem' => $item['imagem']
            ];
        }

        // Atualiza o estoque no banco de dados (reduz 1)
        $novoEstoque = $item['estoque'] - 1;
        $this->roupa->atualizar_estoque($id, $novoEstoque);

        // Atualiza o carrinho na sessão
        $_SESSION['carrinho'] = $carrinho;

        // Mensagem de sucesso
        $this->session->set_flashdata("alerta", "Roupa adicionada ao carrinho!");

        // Redireciona de volta
        redirect('roupas');
    }

    /**
     * Remove uma unidade da roupa do carrinho.
     * Se a quantidade for 1, remove o item do carrinho.
     * Se o id não for informado, redireciona para o carrinho.
     */
    public function remover($id = null) {
        if (!$id) redirect('carrinho');

        // Verifica se a roupa está no carrinho
        if (isset($_SESSION['carrinho'][$id])) {
            if ($_SESSION['carrinho'][$id]['quantidade'] > 1) {
                // Se tem mais de uma unidade, diminui a quantidade em 1
                $_SESSION['carrinho'][$id]['quantidade'] -= 1;
            } else {
                // Se tem só 1, remove o item do carrinho
                unset($_SESSION['carrinho'][$id]);
            }
        }

        // Mensagem de alerta para informar que o item foi removido
        $this->session->set_flashdata("alerta", "Item removido do carrinho!");

        // Redireciona de volta para a página do carrinho
        redirect('carrinho');
    }

    /**
     * Finaliza a compra.
     * Se o carrinho estiver vazio, informa e redireciona para o carrinho.
     * Se não, esvazia o carrinho e confirma finalização.
     */
    public function finalizar_compra() {
        if (empty($_SESSION['carrinho'])) {
            // Caso o carrinho esteja vazio, exibe alerta e volta para o carrinho
            $this->session->set_flashdata("alerta", "Seu carrinho está vazio!");
            redirect('carrinho');
            return;
        }

        // Aqui poderia ter código para salvar a compra no banco de dados, gerar pedido, etc.

        // Remove o carrinho da sessão, esvaziando-o
        unset($_SESSION['carrinho']);

        // Mensagem de confirmação da compra
        $this->session->set_flashdata("alerta", "Compra finalizada com sucesso!");

        // Redireciona para a página principal de roupas ou confirmação
        redirect('roupas');
    }

    /**
     * Exibe o carrinho de compras com cálculo de subtotal, frete e total geral.
     */
        public function ver() {
        $itens = isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : [];

        $total = 0;
        $total_frete = 0;
        $totalItensCarrinho = 0; // <-- contador de itens

        foreach ($itens as &$item) {
            $item['subtotal'] = $item['preco'] * $item['quantidade'];
            $item['frete'] = 3 * $item['quantidade'];
            $total += $item['subtotal'];
            $total_frete += $item['frete'];

            $totalItensCarrinho += $item['quantidade']; // <-- soma das quantidades
        }

        $total_geral = $total + $total_frete;

        $dados = [
            'itens' => $itens,
            'total' => $total,
            'total_frete' => $total_frete,
            'total_geral' => $total_geral,
            'totalItensCarrinho' => $totalItensCarrinho // <-- envia para a view
        ];

        $this->load->view('carrinho_view', $dados);
    }


    /**
     * Lista todas as roupas em ordem alfabética.
     * Carrega a view da coleção/vitrine para exibição ao usuário.  
     */
    public function listar_roupas() {
        // Busca todas as roupas ordenadas no model
        $roupas = $this->roupa->get_all();

        // Carrega a view 'colecao_view' passando o array de roupas
        $this->load->view('colecao_view', ['roupas' => $roupas]);
    }

    /**
     * Visualiza roupas com modos diferentes (alfabética, padrão, lista).
     * Também conta o total de itens no carrinho para mostrar no cabeçalho, por exemplo.
     */
    public function visualizar_roupas() {
        // Captura o parâmetro 'modo' da URL (?modo=alfabetica), padrão é 'padrao'
        $modo = $this->input->get('modo') ?? 'padrao';

        // Seleciona as roupas de acordo com o modo
        if ($modo === 'alfabetica') {
            $roupas = $this->roupa->get_all();
        } elseif ($modo === 'padrao' || $modo === 'lista') {
            $roupas = $this->roupa->get_all_sem_ordenacao();
        } else {
            $roupas = $this->roupa->get_all_sem_ordenacao();
            $modo = 'padrao';
        }

        // Conta o total de itens no carrinho para exibir no frontend
        $totalItensCarrinho = 0;
        if (isset($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $item) {
                $totalItensCarrinho += $item['quantidade'];
            }
        }

        // Passa as roupas, o modo e o total de itens para a view
        $this->load->view('colecao_view', [
            'roupas' => $roupas,
            'modo' => $modo,
            'totalItensCarrinho' => $totalItensCarrinho
        ]);
    }

        public function historico() {
            $historico = $this->session->userdata('historico_compras') ?? [];

            $dados = ['historico' => $historico];

            $this->load->view('historico_view', $dados);
        }

}
