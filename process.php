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

//$products_filtered=getCostRangeProducts($sliderValue);
//формируем HTML ответ
$html = '';
foreach($products as $product) {
    if($product['cost']  <=  $sliderValue)   {
        $image = getQueryPics($product['picture']);
        $html .= '<div class="product">
                    <h2 class="product_name">'. htmlspecialchars(($product['name'])) .'</h2>
                    <div class="product_image"> <img src="'. htmlspecialchars($image[0]['image']  ). '" alt=""></div>
                    <div class="product_cost">'. htmlspecialchars(($product['cost'])) .'$ </div>
                 </div>';
    }
}
                          
// Возвращаем ответ
echo $html;
?>