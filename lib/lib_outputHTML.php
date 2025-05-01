<?php


function productsHTML($products_query,$images){
            for($i=0; $i<sizeof($products_query); $i++){
                printf('<div class="product">
                                <h2 class="product_name">%s</h2>
                                <div class="product_image"><img src="%s" alt=""></div>
                                <div class="product_cost">%s$</div>
                </div>', $products_query[$i]['name'], 
                $images[$i]['image'],
                $products_query[$i]['cost']);      
            }
}