<?php

function getAllproducts(){
        include('db.php');
        $query = $dbh->query('SELECT * FROM product');
        $query->execute();
        $data = $query->fetchAll();
        return $data;
}
function getAllpics(){
        include('db.php');
        $query = $dbh->query('SELECT * FROM images');
        $query->execute();
        $data = $query->fetchAll();
        return $data;
}   
function getQueryProducts($name)  {  
        include('db.php');
        $query = $dbh->prepare('SELECT * FROM product
                                        WHERE name REGEXP :name');
        $query->bindParam(':name',$name);
        $query->execute();
        return $data=$query->fetchAll();
}     
function getQueryPics($image_id){

        include('db.php');
        $query = $dbh->prepare('SELECT * FROM images
                                        WHERE `image_id` = :image_id');
        $query->bindParam(':image_id',$image_id);
        $query->execute();
        return $data=$query->fetchAll();
}        
