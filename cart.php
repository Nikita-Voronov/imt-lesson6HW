<?php
session_start();
include 'class_cart.php';

$a=new Cart();
$iditem=$_GET['products'];
$a->add($_GET['products'],$_GET['quantity'],$products[$iditem]['price']);?>
<pre>
<?php var_dump($a) ?></pre>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Ваша корзина</title>
</head>
<body>
<div style="color: #fc9a02">
    К оплате <?php echo $a->cart['sum']; ?><br><br>

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
        <input type="submit" name="" value="Get to cart">

    </form>


</div>

</body>
</html>
