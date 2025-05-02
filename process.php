<?php
header('Content-Type: text/html; charset=utf-8');
include('lib/lib_db.php');

// Получаем значение из AJAX-запроса
$sliderValue = $_POST['slider_value'] ?? null;
$productsJson = $_POST['products_data'] ?? '[]';
$products = json_decode($productsJson, true);
// Проверяем, что декодирование прошло успешно
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Ошибка декодирования JSON: " . json_last_error_msg());
}
$id_colors = $_POST['id_colors'] ?? '[]';
$checked_colors = $_POST['checked_colors'] ?? '[]';
$id_categories = $_POST['id_categories'] ?? '[]';
$checked_categories = $_POST['checked_categories'] ?? '[]';

$colorsArray = explode(',', $id_colors);
$colorsCheckedArray = explode(',', $checked_colors);;
$categoriesArray = explode(',', $id_categories);
$categoriesCheckedArray = explode(',', $checked_categories);;

//print_r($colorsArray);
$colores_checked=[];
for($i=0; $i<sizeof($colorsArray); $i++){
    if($colorsCheckedArray[$i]==1){
        array_push($colores_checked, $colorsArray[$i]);
    }
}
$categories_checked=[];
for($i=0; $i<sizeof($categoriesArray); $i++){
    if($categoriesCheckedArray[$i]==1){
        array_push($categories_checked, $categoriesArray[$i]);
    }
}
//формируем HTML ответ
$html = '';
foreach($products as $product) {
    if($product['cost']  <=  $sliderValue 
        and in_array($product['color'], $colores_checked)
        and in_array($product['category_id'], $categories_checked) )   
    {
        $image = getQueryPics($product['picture']);
        $html .= '<div class="product">
                    <h2 class="product_name">'. htmlspecialchars(($product['name'])) .'</h2>
                    <div class="product_image"> <img src="'. htmlspecialchars($image[0]['image']  ). '" alt=""></div>
                    <div class="product_cost">'. htmlspecialchars(($product['cost'])) .'$ </div>
                 </div>';
    }
}

echo $html;
?>