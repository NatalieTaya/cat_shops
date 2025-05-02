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
        $max_cost=0;
        //вывод товаров с частью строки из инпута или всех товаров
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
            // вывод товаров 
                productsHTML($products_query,$images)
            ?>
        </div> 
        <?php
        // боковая колонка с расширенным поиском

        // поиск по цене
        $costRange=$max_cost;
        printf('
            <aside>
                <h2>Расширенный поиск </h2>
                <form id="form_extended_search" method="POST">
                    <label >Цена</label>
                    <input name="cost_range" id ="cost" type="range" min="0" max="%s" step="1"> <br>
                                        <div id="label_cost" >%s$</div><br>

                    <label >Цвет</label><br>', $max_cost, $costRange);

        // поиск по цвету товара
        $colors=array();            
        foreach($products_query as $product){
            array_push($colors, $product['color']);    
        }
        $uniqueColors = array_unique($colors);
        foreach($uniqueColors as $color){
            printf('<input name="colors"     color_id="%s"  type="checkbox" checked>
                            <label >%s</label><br>',$color,$color);
        }
        printf('<label >Категория товара</label><br>');
        // поиск по категории товара
        $categories=array();            
        foreach($products_query as $product){
            array_push($categories, $product['category_id']);    
        }
        $uniqueCategories = array_unique($categories);
        foreach($uniqueCategories as $category){
            printf('<input name="categories"  color_id="%s"  type="checkbox" checked>
                            <label >%s</label><br>',$category,$category);
        }
        printf(    '</form> </aside>');
        ?>

        <script>
            // передача данных через AJAX
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