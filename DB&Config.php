<?php

    function DBconn()
    {
        $conn = new PDO("mysql:host=sql661.main-hosting.eu;dbname=u677624199_main", 'u677624199_root', 'Argider_12');
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }


    function hashPssw($password)
    {
        return hash('sha1', $password);
    }


?>