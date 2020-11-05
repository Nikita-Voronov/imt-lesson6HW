<?php
session_start();
header('Location: cart.php');
include 'cart.php';
function delete($id)
{
    foreach ($a->cart as $key => $value) {
        if ($value['id'] == $id) {
            unset($this->cart[$key]);
        }
    }
}

?>