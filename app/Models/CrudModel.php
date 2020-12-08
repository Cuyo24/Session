<?php namespace App\Models;

/**
  * 
  */
use CodeIgniter\Model;

 class CrudModel extends Model
 {
 	
 	public function listarNombres(){
 		$Nombres = $this->db->query("SELECT * From t_gastos");

 		return $Nombres->getResult();

 	}

 	public function insertar($datos){
 		$Nombres = $this->db->table('t_gastos');
 		$Nombres->insert($datos);

 		return $this->db->insertID();
 
 	}


 	public function obtenerNombre($data){
 		$Nombres = $this->db->table('t_gastos');
 		$Nombres->where($data);

 		return $Nombres->get()->getResultArray();

 	}


 	public function Actualizar($data,$idRegistro){
 		$Nombres=$this->db->table('t_gastos');
 		$Nombres->set($data);
 		$Nombres->where('id_registro',$idRegistro);
 		return $Nombres->update();



 	}


 	public function Eliminar($data){

 		$Nombres = $this->db->table('t_gastos');
 		$Nombres->where($data);
 		return $Nombres->delete();

 	}
 } 

