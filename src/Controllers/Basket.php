<?php

namespace Controllers;
class Basket
{

    public function add() 
    {
    
        session_start();

        if (isset($_POST['id'])) {
            $product_id = $_POST['id'];

        if (!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = [];
        }

        if (isset($_SESSION['basket'][$product_id])) {
             $_SESSION['basket'][$product_id]['quantity']++;
        } else {
            $_SESSION['basket'][$product_id] = [
                'quantity' => 1
            ];

        }

        $_SESSION['flash'] = "Товар успешно добавлен в корзину!";
        header('Location: /products');
        return "";
    }
}
        

    public function clear()
    {
        session_start();
        $_SESSION['basket'] = [];
        header('Location: https://localhost/orders');
        return "";
    }
}







