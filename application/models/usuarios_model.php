<?php 
class usuarios_model extends CI_Model{
    public function get_by_id($id)
    {
        $this->db->select("usuarios.*,roles.nombre AS rol");
        $this->db->join("roles", "roles.rol_id=usuarios.rol_id", "inner");
        $this->db->from("usuarios");
        $this->db->where("usuario_id", $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function check_login($nombre, $password)
    {
        $this->db->select("id_usuario");
        $this->db->where("usuario", $nombre);
        $this->db->where("contraseña", $password);
        $query = $this->db->get("usuarios");
        if ($query->num_rows() > 0) {
            $tmp = $query->row_array();
            return $tmp["id_usuario"];
        } else {
            return false;
        }
    }
}
?>