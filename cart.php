<?php
session_start();
include 'class_cart.php';
//if (!isset($_SESSION['cart'])) {
//    $_SESSION['cart'] = ['sum' => 0, 'items' => []];
//}
//$sum_allCart = $_SESSION['cart']['sum'];//вся сумма корзины
//$productID = $products[$_GET['products']];//id продукта
//$sum_allCart += $_GET['quantity'] * $productID['price'];//сумма товаров в корзине
$a=new Cart();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Ваша корзина</title>
</head>
<body>
<div style="color: #fc9a02">
    К оплате <?php echo $a->sum; ?><br><br>

    <form action="" method="GET">

        <select name="products">
            <option value="0">Choose your items</option>
            <?php
            foreach ($products as $key => $products) {
                echo '<option value="' . $key . '">' . $products['name'] . '</option>';
            }
            ?>
        </select><br>


        Количество:<br>
        <input name="quantity" type="text"><br>
        <input type="submit" name="submit" value="Get to cart">

    </form>


</div>

</body>
</html>
