<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/footer.css">

    <title>Document</title>
</head>
<body>
    <?php
        include('header.php');
    ?>
    <main>
    <aside>
        Расширенный поиск
        <form action="">
            <input type="checkbox"> <br>
            <input type="checkbox"> <br>
            <input type="checkbox"> <br>
            <input type="checkbox"> <br>
            <input type="checkbox"> <br>
            <input type="checkbox"> <br>
            <input type="checkbox"> <br>
            <input type="checkbox"> <br>
        </form>
    </aside> 
    <?php
        include('lib/lib_db.php');
        if (isset($_POST['name'])) { 
            $products_query = getQueryProducts($_POST['name']);
            //print_r( $products_query);
            //print_r( 'Форма работает');
        } else {
            print_r( 'Ничего не найдено');
        }
        $images=array();
        for($i=0; $i<sizeof($products_query); $i++){
            $images[$i] = getQueryPics($products_query[$i]['picture']);
        }
        //print_r(value: $images);

        printf('<div class="products">');
        for($i=0; $i<sizeof($products_query); $i++){
            printf('<div class="product">
                            <h2 class="product_name">%s</h2>
                            <div class="product_image"><img src="%s" alt=""></div>
                            <div class="product_cost">%s$</div>
            </div>', $products_query[$i]['name'], 
            $images[$i][0]['image'],
            $products_query[$i]['cost']);
        }
        printf('</div>');
  
    ?>
        
    </main>
    <?php
    include('footer.php');
    ?>

</body>
</html>