<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionarios_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Funcionarios_model', 'funcionarios');
    }

    // Tela de perfil pós-login
    public function perfil_login() {
        $this->load->view('funcionarios_perfil_view');
    }


    // Lista todos os funcionários (somente para gestores)
    public function listar_funcionarios() {
        if ($this->session->userdata('tipo') !== 'gestor') {
            return redirect(base_url());
        }

        $funcionarios = $this->funcionarios->get_all();
        $this->load->view('Funcionarios_view', ['funcionarios' => $funcionarios]);
    }

    // View de teste com listagem (provavelmente temporária)
    public function listar_teste() {
        $listar = $this->funcionarios->get_all();
        $this->load->view('meu_perfil_view', ['listar' => $listar]);
    }

    // Adiciona um novo funcionário (gestor)
    public function add_funcionario() {
        if ($this->session->userdata('tipo') !== 'gestor') {
            // Só gestor pode adicionar
            echo json_encode(['status' => 'erro', 'mensagem' => 'Acesso negado']);
            exit;
        }

        $dados = $this->input->post();

        // Verifica se CPF já existe
        $cpf_existente = $this->funcionarios->get_by_cpf($dados['cpf'] ?? '');
        if ($cpf_existente) {
            echo json_encode([
                'status' => 'erro',
                'mensagem' => 'CPF já cadastrado!',
                'tipoErro' => 'cpf_duplicado'
            ]);
            exit;
        }

        // Verifica se email já existe
        $email_existente = $this->funcionarios->get_by_email($dados['email'] ?? '');
        if ($email_existente) {
            echo json_encode([
                'status' => 'erro',
                'mensagem' => 'Email já cadastrado!',
                'tipoErro' => 'email_duplicado'
            ]);
            exit;
        }

        // Insere no banco
        $insert_id = $this->funcionarios->insert($dados);

        if ($insert_id) {
            echo json_encode([
                'status' => 'sucesso',
                'mensagem' => 'Funcionário adicionado com sucesso!',
                'id' => $insert_id
            ]);
        } else {
            echo json_encode([
                'status' => 'erro',
                'mensagem' => 'Erro ao inserir funcionário. Tente novamente.'
            ]);
        }
        exit;
    }

    // Formulário de edição com dados preenchidos (gestor)
    public function formulario_editar() {
        if ($this->session->userdata('tipo') !== 'gestor') {
            return redirect(base_url());
        }

        $id = $this->input->get('id');
        $dadosFuncionario = $this->funcionarios->get_by_id($id);
        $this->load->view('Funcionarios_view', ['funcionario' => $dadosFuncionario]);
    }

    public function editar_funcionario() {
        if ($this->session->userdata('tipo') !== 'gestor') {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Acesso negado']);
            exit;
        }

        $dados = $this->input->post();
        $id = $dados['id'];

        // Verifica se CPF já existe em outro funcionário
        $cpf_existente = $this->funcionarios->get_by_cpf($dados['cpf']);
        if ($cpf_existente && $cpf_existente['id'] != $id) {
            echo json_encode([
                'status' => 'erro',
                'mensagem' => 'CPF já cadastrado!',
                'tipoErro' => 'cpf_duplicado'
            ]);
            exit;
        }

        // Verifica se email já existe em outro funcionário
        $email_existente = $this->funcionarios->get_by_email($dados['email']);
        if ($email_existente && $email_existente['id'] != $id) {
            echo json_encode([
                'status' => 'erro',
                'mensagem' => 'E-mail já cadastrado!',
                'tipoErro' => 'email_duplicado'
            ]);
            exit;
        }

        // Atualiza o funcionário
        $this->funcionarios->update($dados);

        echo json_encode([
            'status' => 'sucesso',
            'mensagem' => 'Funcionário atualizado com sucesso!'
        ]);
        exit;
    }

    // View do perfil do funcionário logado
    public function perfil_funcionario() {
        if (!$this->session->userdata('id')) {
            return redirect(base_url());
        }

        $this->load->view("funcionarios_perfil_view");
    }

    // Exibe perfil completo com dados
    public function exibir_perfil() {
        $id = $this->session->userdata('id');

        if (!$id) {
            return redirect(base_url());
        }

        $dados = $this->funcionarios->get_by_id($id);
        $this->load->view("meu_perfil_view", ['funcionario' => $dados]);
    }
    
    // Atualiza os dados do perfil logado
    public function atualizar_perfil() {
        $id = $this->session->userdata('id');

        if (!$id) {
            return redirect(base_url());
        }

        $dados = $this->input->post();
        $dados['id'] = $id;

        // Verifica duplicidade de CPF
        $cpf_existente = $this->funcionarios->get_by_cpf($dados['cpf']);
        if ($cpf_existente && $cpf_existente['id'] != $id) {
            $this->session->set_flashdata("alerta", "CPF já esta cadastrado!");
            return redirect('meu-perfil');
        }

        // Verifica duplicidade de Email
        $email_existente = $this->funcionarios->get_by_email($dados['email']);
        if ($email_existente && $email_existente['id'] != $id) {
            $this->session->set_flashdata("alerta", "Email já esta cadastrado!");
            return redirect('meu-perfil');
        }

        $this->funcionarios->update($dados);
        $this->session->set_flashdata("alerta", "Perfil atualizado com sucesso!");
        redirect('meu-perfil');
    }

    // Apagar o próprio perfil
    public function apagar_meu_perfil() {
        $id = $this->session->userdata('id');

        if (!$id) {
            return redirect(base_url());
        }

        // Remove do banco e finaliza a sessão
        $this->funcionarios->delete($id);
        $this->session->sess_destroy();
        redirect(base_url());
    }
    /**
 * Remove um funcionário pelo ID passado via GET
 */

public function deletar_funcionario() {
    // Verifica se é gestor
    if ($this->session->userdata('tipo') !== 'gestor') {
        show_error('Acesso negado.', 403);
        return;
    }

    $id = $this->input->get('id');

    if (!$id) {
        show_error('ID do funcionário não informado.', 400);
        return;
    }

    $funcionario = $this->funcionarios->get_by_id($id);

    if (!$funcionario) {
        show_error('Funcionário não encontrado.', 404);
        return;
    }

    $this->funcionarios->delete($id);

    redirect(base_url('funcionarios')); // Ajuste essa rota conforme seu sistema
}

}
