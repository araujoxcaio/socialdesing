<?php
        /* CONEXÃO COM O HOSTINGER:

        $mysqli = mysqli_connect("mysql.hostinger.com.br", "u619293682_admin", "doritos", "u619293682_sodes");

        if (mysqli_connect_errno()) {
            printf("Falha na conexão com o banco de dados: %s\n", mysqli_connect_error());
            exit();
        }

        */

        // CONEXÃO COM O XAMPP:
        $mysqli = mysqli_connect("localhost", "root", "", "u619293682_sodes");

        if (mysqli_connect_errno()) {
            printf("Falha na conexão com o banco de dados: %s\n", mysqli_connect_error());
            exit();
        }
		

?>