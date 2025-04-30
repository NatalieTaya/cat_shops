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
        error_reporting(0);
        
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
            productsHTML($products_query,$images);
        } else {
            $products_query = getAllproducts();
            $images=getAllpics();
            for($i=0; $i<sizeof($products_query); $i++){
                // поиск максимума стоимости выведенных товаров
                if ($products_query[$i]['cost'] > $max_cost) {
                    $max_cost=$products_query[$i]['cost'];
                } 
            }
        }        
        
        $costRange=$max_cost;
        printf('
            <aside>
                Расширенный поиск
                <form method="POST">
                    <label for="">Цена</label>
                    <input name="cost_range" type="range" min="0" max="%s" step="1">
                    <button  type="submit"> Искать </button>
                </form>', $max_cost);
            
        if (isset($_POST['cost_range'])) { 
            // Получаем значение из диапазона
            $costRange = $_POST['cost_range'] ?? null;
            if ($costRange !== null) {
                $i=0;
                foreach($products_query as $item) {
                    // поиск максимума стоимости выведенных товаров
                    if ($item['cost'] < $costRange) {
                        $products_filtered[$i]=$item;
                        $images_filtered[$i] = getQueryPics($item['picture'])[0];
                        $i++;
                    } 
                }
            } 
        } 
        printf('
            <label for="">Цена: %s</label>
            </aside> ', $costRange);
            
            if($products_filtered !== null) {
                productsHTML($products_filtered,$images_filtered);
            } 
    ?>
    </main>
    <?php
    include('footer.php');
    ?>

</body>
</html>