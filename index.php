<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/index_modal_window.css">
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
        //поиск товаров с частью строки из инпута или поиск всех товаров
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
        
        
        <div id="products_show">
            <div id="qproducts">
                <?php
                // здесь динамически создается вывод товаров 
                ?>
            </div>
            <div id="pagination">
                <?php
                // пагинация
                ?>
            </div>  
        </div>

        <?php
                //Модальное окошко для вывода информации о товаре
                printf('<div id="product-modal" class="modal">
                                    <h2 id="modal-product-name"></h2>
                                    <div class="modal-content">
                                        <div id="modal-product-image"></div>
                                        <p id="modal-product-description"></p>
                                        <div id="modal-product-cost"></div>
                                        <button id="add-to-cart">Добавить в корзину</button>
                                        <span class="close" onclick="closeModal()">&times;</span>
                                    </div>
                                </div>')
            ?>
        <?php
        // боковая колонка с расширенным поиском
        // поиск по цене
        $costRange=$max_cost;
        printf('
            <aside>
                <h2>Расширенный поиск </h2>
                <form id="form_extended_search" method="POST">
                    <label class="label_search">Цена</label>
                    <input name="cost_range" id ="cost" type="range" min="0" max="%s" step="1" value="%s"> <br>
                                        <div id="label_cost" >до %s$</div><br>

                    <label class="label_search">Цвет</label><br>', $max_cost,$max_cost, $costRange);

        // поиск по цвету товара
        $colors_id=array(); 
        $colors_names=array(); 
        foreach($products_query as $product){
            $color_fromDB = getQueryColor($product['color_id']);
            array_push($colors_id, $product['color_id']);    
            array_push($colors_names, $color_fromDB[0]['color_name']);    
        }          
        $uniqueColors_id = array_unique($colors_id);
        $uniqueColors_names = array_unique($colors_names);
        $result_colors = array_map(function($uniqueColors_id, $uniqueColors_names) {
            return '<input name="colors"  color_id="'.$uniqueColors_id.'"  type="checkbox" checked>
                            <label >'.$uniqueColors_names.'</label><br>'  ;
        }, $uniqueColors_id, $uniqueColors_names);
        foreach($result_colors as $entry){
            printf($entry);
        }
        printf('<label class="label_search">Категория товара</label><br>');



        // поиск по категории товара
        $categories_id=array(); 
        $categories_names=array();                       
        foreach($products_query as $product){
            $category_fromDB = getQueryCategory($product['category_id']);
            array_push($categories_id, $product['category_id']);    
            array_push($categories_names, $category_fromDB[0]['category_name']);    
        }
        $uniqueCategories_id = array_unique($categories_id);
        $uniqueCategories_names = array_unique($categories_names);
        $result = array_map(function($uniqueCategories_id, $uniqueCategories_names) {
            return '<input name="categories"  categorie_id="'.$uniqueCategories_id.'"  type="checkbox" checked>
                            <label >'.$uniqueCategories_names.'</label><br>'  ;
        }, $uniqueCategories_id, $uniqueCategories_names);
        foreach($result as $entry){
            printf($entry);
        }
        printf(    '</form> </aside>');
        ?>
        
        <script> 
        
        </script> 

        <script>
            // передача данных через AJAX
            window.products = <?= json_encode($products_query, JSON_UNESCAPED_UNICODE) ?>;
        </script>
        <script src="ajax_aside.js">
        </script> 
        <script src="chooseProduct.js">
        </script> 
    </main>
    <?php
    include('footer.php');
    ?>

</body>
</html>