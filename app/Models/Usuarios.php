<?php namespace App\Models;
	use CodeIgniter\Model;
	/**
	 * 
	 */
	class Usuarios extends Model{
		
		public function obtenerUsuario($data){
			$Usuarios = $this->db->table('t_usuarios');
			$Usuarios->where($data);
			return $Usuarios->get()->getResultArray();
		}

		
	}