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
        <div class="products">
            <div class="product">
                <h2 class="product_name">Product</h2>
                <div class="product_image"><img src="image.png" alt=""></div>
                <div class="product_cost">50$</div>
            </div>
            <div class="product">
                <h2 class="product_name">Product</h2>
                <div class="product_image"><img src="image.png" alt=""></div>
                <div class="product_cost">50$</div>
            </div>
            <div class="product">
                <h2 class="product_name">Product</h2>
                <div class="product_image"><img src="image.png" alt=""></div>
                <div class="product_cost">50$</div>
            </div>
            <div class="product">
                <h2 class="product_name">Product</h2>
                <div class="product_image"><img src="image.png" alt=""></div>
                <div class="product_cost">50$</div>
            </div>
        </div>
        
    </main>
    <?php
    include('footer.php');
    ?>

</body>
</html>