<?php namespace App\Controllers;

use App\Models\Usuarios;
use App\Models\CrudModel;
class Sesion extends BaseController
{
	public function index()
	{
		$mensaje = session('mensaje');
		return view('login',["mensaje" => $mensaje]);
	}

	public function inicio(){

		return view('inicio');
	}

	public function login(){
		$Usuarios = new Usuarios();
		$usuario = $this->request->getPost('usuario');
		$password = $this->request->getPost('password');

		$datosUsuario = $Usuarios ->obtenerUsuario(['usuario' => $usuario]);
		
		if(count($datosUsuario) > 0  && 
			password_verify($password, $datosUsuario[0]['password'])){

			$data = [
						"usuario"	=> $datosUsuario[0]['usuario'],
						"tipo"		=> $datosUsuario[0]['tipo']
					];
			$session = session();
			$session->set($data); 
			return redirect()->to(base_url('/inicio'))->with('mensaje', '1');

		}else{	
			return redirect()->to(base_url('/'))->with('mensaje', '0');

		}	
	}

	public function salir(){
			$session = session();
			$session->destroy();
			return redirect()->to(base_url('/'));
	}

	

	//-------------------------- Crud------------------------------------------
	public function listado()
	{
		$Crud = new CrudModel();

		$datos=$Crud->listarNombres();

		$mensaje = session('mensaje');

		$data=[
			"datos"=>$datos,
			"mensaje"=>$mensaje
		];

		return view('listado',$data);
	}

	public function Crear(){

		$datos = [
			"Concepto_gastos" => $_POST['Concepto_gastos'],
			"Monto_gastos" => $_POST['Monto_gastos'],
			"Fecha" => $_POST['Fecha']
		];

		$Crud = new CrudModel();
		$respuesta = $Crud->insertar($datos);

		if ($respuesta>0) {
			return redirect()->to(base_url().'/listado')->with('mensaje','1');
		}
		else
		{
		return redirect()->to(base_url().'/listado')->with('mensaje','0');
		}


	}

	public function Actualizar(){

		$datos = [

			"Concepto_gastos" => $_POST['Concepto_gastos'],
			"Monto_gastos" => $_POST['Monto_gastos'],
			"Fecha" => $_POST['Fecha']
		];
		
		$idRegistro= $_POST['idRegistro'];

		$Crud=new CrudModel();
		$respuesta=$Crud->Actualizar($datos, $idRegistro);

		if ($respuesta) {
			return redirect()->to(base_url().'/listado')->with('mensaje','2');
		}
		else
		{
		return redirect()->to(base_url().'/listado')->with('mensaje','3');
		}

	}

	public function obtenerNombre($idRegistro){

		$data = ["id_registro" => $idRegistro];
		$Crud=new CrudModel();

		$respuesta=$Crud->obtenerNombre($data);

		$datos=["datos"=>$respuesta];


		return view('Actualizar',$datos);
		
	}

	public function Eliminar($idRegistro){
		$Crud=new CrudModel();
		$data = ["id_registro" => $idRegistro];

		$respuesta = $Crud->Eliminar($data);

		if ($respuesta) {
			return redirect()->to(base_url().'/listado')->with('mensaje','4');
		}
		else
		{
		return redirect()->to(base_url().'/listado')->with('mensaje','5');
		}
	}



}
