<?php
    try {
        $host = "MariaDB-10.8";
        $db_name = "store_db";
        $charset = "utf8";
        $user= "db_user";
        $pass = "12";
        $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
        // Дополнительные опции
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        // указатель на соединение
        $dbh = new PDO($dsn, $user, $pass, $opt);
        
        //$query = $dbh->query('SELECT * FROM news');
        //$query->execute();
        //$data = $query->fetchAll();
       // print_r($data) ;

    }
    catch(PDOException $e){
        echo $e->getMessage();

    }
        
        

