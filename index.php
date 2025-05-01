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
    <?php
        include('lib/lib_db.php');
        include('lib/lib_outputHTML.php');
        //error_reporting(0);
        $max_cost=0;
        if (isset($_POST['name'])) { 
            $products_query = getQueryProducts($_POST['name']);
            for($i=0; $i<sizeof($products_query); $i++){
                $images[$i] = getQueryPics($products_query[$i]['picture'])[0];
                // поиск максимума стоимости выведенных товаров
                if ($products_query[$i]['cost'] > $max_cost) {
                    $max_cost=$products_query[$i]['cost'];
                } 
            }
        } else {
            $products_query = getAllproducts();
            $images=getAllpics();
            for($i=0; $i<sizeof($products_query); $i++){
                // поиск максимума стоимости выведенных товаров
                if ($products_query[$i]['cost'] > $max_cost) {
                    $max_cost=$products_query[$i]['cost'];
                } 
            }
        }    ?>

        <div id="qproducts">
            <?php
                productsHTML($products_query,$images)
            ?>
        </div> 
        <?php

        $costRange=$max_cost;
        printf('
            <aside>
                <h2>Расширенный поиск </h2>
                <form method="POST">
                    <label >Цена</label>
                    <input name="cost_range" id ="cost" type="range" min="0" max="%s" step="1">
                    <button  type="submit"> Искать </button>
                    <div id="label_cost" >%s$</div>
                </form>
                 ', $max_cost, $costRange);
        printf(    '</aside>');
        ?>

        <script>
            window.products = <?= json_encode($products_query, JSON_UNESCAPED_UNICODE) ?>;
        </script>
        <script src="ajax_aside.js">
        </script> 

    </main>
    <?php
    include('footer.php');
    ?>

</body>
</html>