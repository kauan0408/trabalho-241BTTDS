<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_controller extends CI_Controller {
    public function index(){
        $this->load->view("login_view");
    }

    public function logar(){
        $dadosFormulario = $this->input->post();
        $email = $dadosFormulario['email'];
        $senha = $dadosFormulario['senha'];

        $funcionario = $this->db->get_where("funcionarios", ['email' => $email, 'senha' => $senha])->row_array();
        
        if ($funcionario){
            //logar ele e menda a tela de perfil
            $this->session->set_userdata($funcionario);
            header("location:perfil");
        }else{
            //volta para tela de login
            header("location: " . base_url());
        }
    }

    function deslogar(){
        $this->session->sess_destroy();
        header("location: " . base_url()); 
    }
}