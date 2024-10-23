<?php 
class clientes_model extends CI_Model{
    
    public function obtener_clientes() {
        $query = $this->db->get('clientes'); 
        return $query->result_array(); 
    }
    public function nuevo($data) {
        $this->db->set('nombre', $data['nombre']);
        $this->db->set('apellido', $data['apellido']); 
        $this->db->set('email', $data['email']);
        $this->db->set('telefono', $data['telefono']);  
        $this->db->insert('clientes');
        
        return $this->db->insert_id();
    }
    public function eliminar($id){
        $this->db->where('id_cliente', $id);
        return $this->db->delete('clientes');
    }
    public function actualizar($id, $data) {
        $this->db->where('id_cliente', $id);
        return $this->db->update('clientes', $data);
    }
    public function obtener_cliente($id) {
        $this->db->where('id_cliente', $id);
        $query = $this->db->get('clientes');
        return $query->row_array(); 
    }
}
?>