<?php

/*
Mapear la URL ingresada en el navegador
1. Controlador
2. Método
3. Parámetro
*/

class Core
{

	//Mientras no haya un controlador en la url carga $controladorActual, los mismo para metodo y parametros
	//Ejemplo: http://localhost/mvc_base/
	protected $controladorActual = 'Login';
	protected $metodoActual = 'index'; //En todo controlador debe de existir un método index
	protected $parametros = [];

	public function __construct()
	{

		//print_r($this->getUrl());
		//Instanciamos metodo
		$url = $this->getUrl();

		//Si el controlador esta vacio me lleva al index en este caso el login

		if ($url[0] == "")
		{
			require_once '../app/controladores/' . $this->controladorActual . 'Controlador.php';
			//y lo instanciamos
			$this->controladorActual = new $this->controladorActual();

			$metodoActual = $this->metodoActual;
			$this->controladorActual->$metodoActual();
		}
		else
		{
			//echo ucwords($url[0] . 'Controlador.php');
			//Buscar en controladores si el controlador existe
			if (file_exists('../app/controladores/' . ucwords($url[0] . 'Controlador.php')))
			{

				//Si existe se configura como controlador por defecto
				$this->controladorActual = ucwords($url[0]);

				//unset indice, desmontamos el controlador por si seleccionamos otro deja de ser el controlador actual
				unset($url[0]);

				//requerir controlador
				require_once '../app/controladores/' . $this->controladorActual . 'Controlador.php';

				//y lo instanciamos
				//echo $this->controladorActual;
				$this->controladorActual = new $this->controladorActual();

				//Checar la segunda parte de la url que es el método
				//Si la url tiene un metodo

				if (isset($url[1]))
				{

					if (method_exists($this->controladorActual, $url[1]))
					{
						$this->metodoActual = $url[1];
						$metodoActual = $this->metodoActual;

						unset($url[1]);
					}
					else
					{
						$metodoActual = $this->metodoActual;
					}
				}
				else
				{
					$metodoActual = $this->metodoActual;
				}
				
				//echo $this->metodoActual;


				//Nota: el unset usado tanto en el controlador como en el metodo es para restar ambos indices es el array quedando asi:
				//Antes: Array ( [0] => login [1] => actualizar [2] => param1 [3] => param2 [4] => param3 )
				//Despues: Array ( [0] => param1 [1] => param2 [2] => param3 )
				//Con el fin de que solo queden los parametros en este caso

				//Checar la tercera parte, traer los parametros
				//array_values es para que en el caso si en la variable url exista un array
				$this->parametros = $url ? array_values($url) : [];
				//print_r($this->parametros);

				//Aquí lo que hacemos es que llamamos en este caso al controladorActual y clase a la vez que ya instanciamos arriba,
				//y al método con sus argumentos en este caso parametros
				$this->controladorActual->$metodoActual($this->parametros);
			}
			else
			{
				$this->controladorActual = "ErrorPagina";

				//requerir controlador
				//echo '../app/controladores/' . $this->controladorActual . 'Controlador.php';
				require_once '../app/controladores/' . $this->controladorActual . 'Controlador.php';
				//y lo instanciamos
				$this->controladorActual = new $this->controladorActual();

				$metodoActual = $this->metodoActual;
				$this->controladorActual->$metodoActual();
			}
		}

	}

	public function getUrl()
	{

		//la variable url dentro del get es la que recibimos en el .htaccess que esta dentro de /public

		//echo $_GET['url'];

		//si esta seteada la url
		if (isset($_GET['url']))
		{
			$url = rtrim($_GET['url'], '/');//quitamos los espacios que puedan tener
			$url = filter_var($url, FILTER_SANITIZE_URL);//
			$url = explode('/', $url);

			return $url;

		}

	}

}


?>