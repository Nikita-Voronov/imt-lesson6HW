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
        $this->calc($this->cart);
    }

    public function delete($id)
    {
        $this->cart = $_SESSION['cart'];
        foreach ($this->cart as $key => $value) {
            if ($value['id'] == $id) {
                unset($this->cart[$key]);
            }
        }
    }


    public function calc($cart)
    {
        $this->cart['sum'] = 0;
        $this->cart['count'] = 0;
        $this->cart['discount'] = 0;

        foreach ($this->cart['items'] as $key => $value) {
            $this->cart['sum'] += $value['price'];
            $this->cart['count'] += $value['quantity'];
        }
        if ($this->cart['count'] < 10 && $this->cart['sum'] > 2000) {
            $this->cart['discount'] = $this->cart['sum'] * 0.07;
            $this->cart['sum']=$this->cart['sum']-$this->cart['discount'];
        } elseif ($this->cart['count'] > 10) {
            $this->cart['discount'] = $this->cart['sum'] * 0.1;
            $this->cart['sum']=$this->cart['sum']-$this->cart['discount'];
        }
        return $cart;
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