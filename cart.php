<?php
session_start();
include 'class_cart.php';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = ['sum' => 0, 'items' => []];
}
$sum_allCart = $_SESSION['cart']['sum'];//вся сумма корзины
$productID = $products[$_GET['products']];//id продукта
$sum_allCart += $_GET['count'] * $productID['price'];//сумма товаров в корзине

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Ваша корзина</title>
</head>
<body>
<div style="color: #adff2f">
    К оплате <?php echo $sum_allCart; ?><br><br>

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
        <input name="count" type="text"><br>
        <input type="submit" value="Buy NOW">

    </form>

</div>

</body>
</html>
