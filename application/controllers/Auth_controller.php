<?php
// Garante que o script não seja acessado diretamente
defined('BASEPATH') OR exit('No direct script access allowed');

// Início da classe de autenticação
class Auth_controller extends CI_Controller {

    // Função que carrega a página inicial (login_view)
    public function index() {
        $this->load->view("login_view");
    }

    // Função de login
    public function logar() {
        // Recebe os dados enviados via POST
        $dados = $this->input->post();
        $email = $dados['email'];
        $senha = $dados['senha'];

        // Consulta no banco o funcionário que tem o email e senha informados
        $funcionario = $this->db->get_where("funcionarios", [
            'email' => $email,
            'senha' => $senha
        ])->row_array();

        // Se encontrou o funcionário, faz login
        if ($funcionario) {
            // Salva os dados na sessão
            $this->session->set_userdata($funcionario);
            // Retorna sucesso no formato JSON
            echo json_encode(['status' => 'sucesso']);
        } else {
            // Se não encontrou, retorna erro com mensagem
            echo json_encode(['status' => 'erro', 'mensagem' => 'E-mail ou senha incorretos']);
        }
        // Encerra a execução aqui
        exit;
    }

    // Função de cadastro
    public function cadastrar() {
        // Recebe os dados enviados via POST
        $dados = $this->input->post();

        // Verifica se já existe um usuário com esse e-mail no banco
        $existe = $this->db->get_where("funcionarios", [
            'email' => $dados['email']
        ])->row_array();

        // Se já existe, retorna erro no formato JSON
        if ($existe) {
            echo json_encode([
                'status' => 'erro',
                'mensagem' => 'E-mail já está em uso.',
                'tipoErro' => 'email_duplicado' // Usado na view para identificar que é erro de e-mail duplicado
            ]);
            exit;
        }

        // Se não existe, insere o novo funcionário no banco
        $this->db->insert("funcionarios", $dados);

        // Após cadastrar, busca o usuário recém cadastrado
        $usuario = $this->db->get_where("funcionarios", [
            'email' => $dados['email']
        ])->row_array();

        // Salva os dados do usuário na sessão
        $this->session->set_userdata($usuario);

        // Retorna sucesso no formato JSON
        echo json_encode(['status' => 'sucesso']);
        exit;
    }

    // Função para deslogar o usuário
    public function deslogar() {
        // Destroi todos os dados da sessão
        $this->session->sess_destroy();
        // Redireciona para a página inicial (login)
        redirect(base_url());
    }
}
?>
