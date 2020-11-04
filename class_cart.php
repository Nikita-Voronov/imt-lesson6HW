<?php
session_start();

$products = [
    4 => ['name' => 'Книга', 'price' => 100],
    12 => ['name' => 'Диск', 'price' => 50],
    32 => ['name' => 'Флешка', 'price' => 240]
];

class Cart
{
    //атрибуты
    public $cart;
    public $items;//элементы корзины
    public $sum;//сумма элементов в корзине
    public $discount;//сумма с учетом скидки
    public $count;//количество элементов

    //метод
    public function __construct()
    {
        $this->cart = $_SESSION['cart'];
        $this->setCount();
        $this->setDiscount();
        $this->setItems();
        $this->setSum();
    }

    public function add($id, $quantity, $price)
    {
        $this->cart = $_SESSION['cart'];
        if (empty($this->cart)) {
            $this->cart['items'][] = ['id' => $id, 'quantity' => $quantity, 'price' => $price * $quantity];
        } else {
            foreach ($this->cart['items'] as $key => $value) {
                if ($value['id'] == $id) {
                    $this->cart['items'][$key]['quantity'] += $quantity;
                    $this->cart['items'][$key]['price'] *= $this->cart['items'][$key]['quantity'];
                }
            }
        }
        $this->items = $this->cart['items'];
        $this->sum = $this->cart['sum'];
        $this->count = $this->cart['count'];
        $this->discount = $this->cart['discount'];
    }

    public function delete($id)
    {
        $this->cart = $_SESSION['cart'];
        foreach ($this->cart as $key => $value) {
            if ($value['id'] == $id) {
                unset($this->cart[$key]);
            }
        }
        $array = $_SESSION['cart'];
        $array = $this->calc($array);

    }

    public function calc($array)
    {
        $array['sum'] = 0;
        $array['count'] = 0;
        $array['discount'] = 0;

        foreach ($array['items'] as $key => $value) {
            $array['sum'] += $value['price'];
            $array['count'] += $value['quantity'];
        }
        if ($array['count'] < 10 && $array['sum'] > 2000) {
            $array['discount'] = $array['sum'] * 0.93;
        } elseif ($array['count'] > 10) {
            $array['discount'] = $array['sum'] * 0.9;
        }
        return $array;
    }

    public function setSum()
    {
        $this->sum = $this->cart['sum'];
    }

    public function setItems()
    {
        $this->items = $this->cart['items'];
    }

    public function setDiscount()
    {
        $this->discount = $this->cart['discount'];
    }

    public function setCount()
    {
        $this->count = $this->cart['count'];
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getSum()
    {
        return $this->sum;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getCount()
    {
        return $this->count;
    }
}

?>