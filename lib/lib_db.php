<?php
        include('db.php');

        $query = $dbh->query('SELECT * FROM product');
        $query->execute();
        $data = $query->fetchAll();
        print_r($data);
        
        ?>