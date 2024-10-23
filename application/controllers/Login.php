<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public $datos = array();
    public function __construct(){
        parent::__construct();

    }

    public function index()
	{
		$this->load->view('login_view');
	}
    
    public function login(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules('usuario','Usuario', 'trim|strtolower|required');
        $this->form_validation->set_rules('password','Contraseña','required');
        if( $this->form_validation->run() == FALSE ){
            $this->load->view('login_view',$this->datos);
        }else{
            $this->load->model('usuarios_model');
            $usuario = set_value("usuario");
            $password = set_value("password");
            if( $uid = $this->usuarios_model->check_login($usuario, $password) ){
             //   $u=$this->usuarios_model->get_by_id($uid);
               //     $this->session->set_userdata("usuario_id",$uid);
                 //   $this->session->set_userdata("nombre", $u["nombre"]);
                   // $this->session->set_userdata("rol_id", $u["rol_id"]);
                      redirect('clientes/index');
            }else{
                redirect('login/index');
            }
        }
	}
}