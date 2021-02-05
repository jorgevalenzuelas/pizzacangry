<?php

//Clase controlador principal
//Se encarga de poder cargar los modelos y vistas
class Controlador
{

	//cargar modelo
	public function modelo($modelo)
	{
		//echo '../app/modelos/' . $modelo . '.php';
		require_once '../app/modelos/' . $modelo . '.php';

		//Instanciamos modelo
		return new $modelo();

	}

	//cargar vista
	public function vista($vista, $datos = [])
	{

		//Checar si el archivo vista existe
		//echo '../app/vistas/' . $vista . '.php';
		if (file_exists('../app/vistas/' . $vista . '.php'))
		{
			//En otras estructuras MVC es como hacer un render
			require_once '../app/vistas/' . $vista . '.php';
		}
		else
		{

			die('La vista no existee.');

		}

	}


}


?>