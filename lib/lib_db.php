<?php

function getAllproducts(){
        include('db.php');
        $query = $dbh->query('SELECT * FROM product');
        $query->execute();
        $data = $query->fetchAll();
        $query = null; $dbh = null;
        return $data;
}
function getAllpics(){
        include('db.php');
        $query = $dbh->query('SELECT * FROM images');
        $query->execute();
        $data = $query->fetchAll();
        $query = null; $dbh = null;
        return $data;
}   
function getQueryProducts($name)  {  
        include('db.php');
        $query = $dbh->prepare('SELECT * FROM product
                                        WHERE name REGEXP :name');
        $query->bindParam(':name',$name);
        $query->execute();
        $data=$query->fetchAll();
        $query = null; $dbh = null;
        return $data;
}     
function getQueryPics($image_id){
        include('db.php');
        $query = $dbh->prepare('SELECT * FROM images
                                        WHERE `image_id` = :image_id');
        $query->bindParam(':image_id',$image_id);
        $query->execute();
        $data = $query->fetchAll();
        $query = null; $dbh = null;
        return $data;
} 
function getQueryColor($color_id){
        include('db.php');
        $query = $dbh->prepare('SELECT * FROM colors
                                        WHERE `color_id` = :color_id');
        $query->bindParam(':color_id',$color_id);
        $query->execute();
        $data = $query->fetchAll();
        $query = null; $dbh = null;
        return $data;
}    
function getQueryCategory($category_id){
        include('db.php');
        $query = $dbh->prepare('SELECT * FROM categories
                                        WHERE `category_id` = :category_id');
        $query->bindParam(':category_id',$category_id);
        $query->execute();
        $data = $query->fetchAll();
        $query = null; $dbh = null;
        return $data;
}

function getCostRangeProducts($max_price)  {  
        include('db.php');
        $query = $dbh->prepare('SELECT * FROM product
                                        WHERE cost <= :max_price');
        $query->bindParam(':max_price',$max_price);
        $query->execute();
        $data = $query->fetchAll();
        $query = null; $dbh = null;
        return $data;
}     
  
