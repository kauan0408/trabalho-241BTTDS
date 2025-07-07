<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roupas_admin_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Roupa_model', 'roupa');
    }

    /**
     * Lista todas as roupas para o painel de administração
     */
    public function listar_roupas() {
        $data['roupas'] = $this->roupa->get_all();
        $this->load->view('roupas_listar_view', $data);
    }

    /**
     * Exibe o formulário e processa a adição de uma nova roupa
     */
    public function adicionar() {
        if ($this->input->method() === 'post') {
            $nome     = $this->input->post('nome');
            $colecao  = $this->input->post('colecao');
            $preco    = $this->input->post('preco');
            $estoque    = $this->input->post('estoque');
            $imagem   = null;

            // Upload da imagem
            if (!empty($_FILES['imagem']['name'])) {
                $config['upload_path']   = './public/assets/imgens/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = time(); // nome único

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('imagem')) {
                    $upload_data = $this->upload->data();
                    $imagem = $upload_data['file_name'];
                } else {
                    echo $this->upload->display_errors(); // Pode melhorar futuramente
                    return;
                }
            }

            $dados = [
                'nome'    => $nome,
                'colecao' => $colecao,
                'preco'   => $preco,
                'estoque'   => $estoque,
                'imagem'  => $imagem
            ];

            $this->roupa->inserir($dados);
            $this->session->set_flashdata('sucesso', 'Roupa adicionada com sucesso!');
            redirect('roupas-admin');
        }

        $this->load->view('roupas_adicionar_view');
    }

    /**
     * Exibe o formulário de edição de uma roupa
     */
    public function formulario_editar($id) {
        $data['roupa'] = $this->roupa->get_by_id($id);

        if (empty($data['roupa'])) {
            show_404();
        }

        $this->load->view('roupas_editar_view', $data);
    }

    /**
     * Processa a edição da roupa enviada pelo formulário
     */
    public function editar($id) {
        $dados = [
            'nome'    => $this->input->post('nome'),
            'colecao' => $this->input->post('colecao'),
            'preco'   => $this->input->post('preco'),
            'estoque'   => $this->input->post('estoque'),
            'imagem'  => $this->input->post('imagem') // Pode incluir lógica para novo upload se necessário
        ];

        $this->roupa->update($id, $dados);
        $this->session->set_flashdata('sucesso', 'Roupa atualizada com sucesso!');
        redirect('roupas-admin');
    }

    /**
     * Remove a roupa do banco e exclui a imagem associada
     */
    public function excluir($id) {
        $roupa = $this->roupa->get_by_id($id);

        if (!$roupa) {
            show_404();
        }

        // Remove imagem do servidor
        $caminhoImagem = './public/assets/imgens/' . $roupa['imagem'];
        if (!empty($roupa['imagem']) && file_exists($caminhoImagem)) {
            unlink($caminhoImagem);
        }

        $this->roupa->delete($id);
        $this->session->set_flashdata('sucesso', 'Roupa excluída com sucesso!');
        redirect('roupas-admin');
    }
}
