<?php
        /* CONEXÃO COM O HOSTINGER:
	
        $host = "mysql.hostinger.com.br";
	$usuario = "u619293682_admin";
	$senha = "doritos";
	$bd = "u619293682_sodes";

        */

        // CONEXÃO COM O XAMPP:
        $host = "localhost";
	$usuario = "root";
	$senha = "";
	$bd = "u619293682_sodes";    

	$mysqli = new mysqli($host, $usuario, $senha, $bd);

	if($mysqli->connect_errno)
		echo "Falha na conexão: (".$mysqli->connect_errno.") ".$mysqli->connect_error;

?>