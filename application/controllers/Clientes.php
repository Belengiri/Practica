<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
    public $datos = array();
    public function __construct(){
        parent :: __construct();
    }
    public function Guardar(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('nombre','Nombre', 'trim|strtolower|required|is_unique[clientes.nombre]');
        $this->form_validation->set_rules('apellido','Apellido', 'trim|strtolower|required');
        $this->form_validation->set_rules('email','Email', 'trim|valid_email|required|is_unique[clientes.email]');
        $this->form_validation->set_rules('telefono','Telefono', 'trim|required');
        
        if( $this->form_validation->run() == FALSE ){
            $this->load->view('clientes_view',$this->datos);
        }else{
            $this->load->model('clientes_model');
            $data = array(
                'nombre' => set_value("nombre"),
                'apellido' => set_value("apellido"),
                'email' =>set_value("email") ,
                'telefono' => set_value("telefono")
            );
            $this->clientes_model->nuevo($data);
            redirect("clientes/index");
        }
    }
    public function salir()
	{
        $this->session->sess_destroy();
        
		redirect('login/index');
	}
    public function eliminar($id) {
        $this->load->model('clientes_model');
        if ($this->clientes_model->eliminar($id)) {
            $this->session->set_flashdata('mensaje', 'Cliente eliminado con éxito.');
            redirect('clientes/index');
        } else {
            $this->session->set_flashdata('mensaje', 'Error al eliminar el cliente.');
            redirect('clientes/index');
        }
    }
    public function index()
	{
        $this->load->model('clientes_model');
        $data['clientes'] = $this->clientes_model->obtener_clientes(); 
        $this->load->view('clientes_view', $data); 
	}
    public function modificar($id) {
        $this->load->model('clientes_model');
    
        $cliente = $this->clientes_model->obtener_cliente($id);
        if (empty($cliente)) {
            $this->session->set_flashdata('mensaje', 'Cliente no encontrado.');
            redirect('clientes/index');
        }
        $data['cliente'] = $cliente;
        $this->load->view('modificar_view', $data);
    }
    public function guardar_modificacion($id) {
        $this->load->library('form_validation');
        $this->load->model('clientes_model');;
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->modificar($id);
        } else {
            $data = array(
                'nombre' => set_value('nombre'),
                'apellido' => set_value('apellido'),
                'email' => set_value('email'),
                'telefono' =>set_value('telefono')
            );
            if ($this->clientes_model->actualizar($id, $data)) {
                $this->session->set_flashdata('mensaje', 'Cliente actualizado con éxito.');
                redirect('clientes/index');
            } else {
                $this->session->set_flashdata('mensaje', 'Error al actualizar el cliente.');
            }
        }
    }
}
?>