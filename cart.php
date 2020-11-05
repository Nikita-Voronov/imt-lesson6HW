<?php
session_start();
include 'class_cart.php';
$a = new Cart();
$iditem = $_GET['products'];
$a->add($_GET['products'], $_GET['quantity'], $products[$iditem]['price']); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Ваша корзина</title>
</head>
<body>
<div style="color: #fc9a02">
    К оплате <?php echo $a->cart['sum']; ?><br><br>
    <table>
        <?php
        foreach ($a->cart['items'] as $key => $items) {
            echo '<tr><td>' . 'id товара:' . $iditem . '</td><td>'
                . 'Наиминование товара:' . $products[$iditem]['name'] . '</td><td>' . 'Количество:' . $_GET['quantity'] . '</td><td><a href=/delete.php?id = ' . $key . '>Удалить</a></td ></tr>';
        }//var_dump($_SESSION['cart']['items']);
        ?>
    </table>

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
