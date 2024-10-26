<?php

namespace Controllers;

use Services\FileStorage;
use Templates\OrderTemplate;
use Services\OrderDBStorage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Order {

    public function sendMail($email) {
        $mail = new PHPMailer();
        if (isset($email) && !empty($email)) {
            try {
                $mail->SMTPDebug = 2;
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom("v.milevskiy@coopteh.ru","Грилька");
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'ssl://smtp.mail.ru';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'v.milevskiy@coopteh.ru';                     //SMTP username
                $mail->Password   = 'hF8xTWxXyKcCnEg1n9Wz';
                $mail->Port       = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Subject = 'Заявка с сайта: Грилька';
                $mail->Body = 'Информационное сообщение c сайта Грилька <br><br>
                ------------------------------------------<br>
                <br>
                Спасибо!<br>
                <br>
                Ваш заказ успешно создан и передан службе доставки.<br>
                <br>
                Сообщение сгенерировано автоматически.';       
    
                if ($mail->send()) {
                    return true;
                } else {
                    throw new Exception('Ошибка с отправкой письма');
                }
            } catch (Exception $error) {
                $message =  $error->getMessage();
            }
        }    
        return false;
    }
    public function get(): string
    {
        session_start();

        if (!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = [];
        }

        $objStorage = new FileStorage();
        $products = $objStorage->loadData('data.json');

        $all_sum = 0;
        $str_list = '<h1>Создание заказа</h1><br><br>';
        foreach ($products as $product) {
            $id = $product['id'];
            if (array_key_exists($id, $_SESSION['basket'])) {
                $quantity = $_SESSION['basket'][$id]['quantity'];
                $name = $product['name'];
                $price = $product['price'];
                $sum = $price * $quantity;
                $all_sum += $sum;
                $str_list .= <<<LINE
                <div class="row"><br><br>
                    <div class="col-6">
                    <h3>{$name}<h3>
                    </div>
                    <div class="col-2">
                    <h3>{$quantity}</h3>
                    </div>
                    <div class="col-1">
                    <h3>{$sum}<h3>
                    </div>
                </div>
                LINE;
            }
        }

        $str_list .= <<<LINE
        <div>
                <div class="col-6">
                <h2>Общая стоимость: {$all_sum}<h2>
                </div>
                <form method="POST" action="/basket_clear">
                <button type="submit" class="btn btn-primary">Очистить корзину</button><br><br>
                </form>
        </div>
        LINE;

        $str_list .= <<<LINE
        <div class="row">
            <div class="col-12">
                <form action="/orders" method="POST"><br><br>
                <label for="name" id="name">Ваше Имя:</label>
                <input type="text" id="name" name="name" class="form-control form-control-lg" required>
                <label for="address" id="name">Адрес доставки:</label>
                <input type="text" id="address" name="address" class="form-control form-control-lg" required
                <label for="number" id="name">Телефон:</label><br>
                <input type="text" id="number" name="number" class="form-control form-control-lg" required>
                <label for="email">Email:</label>
                <input type="email" id="email" class="form-control" name="email" required>
                <button type="submit" class="btn btn-secondary">Создать заказ</button>
            </div>
        </div>
        LINE;

        $objTemplate = new OrderTemplate();
        $template = $objTemplate->getTemplate( $str_list );
        


        return $template;

    }

    public function create(): string {
        
        $objStorage = new FileStorage();

        $arr = [];
        $arr['name'] = urldecode( $_POST['name'] );
        $arr['address'] = urldecode( $_POST['address'] );
        $arr['number'] = $_POST['number'];
        $arr['created_at'] = date("d-m-Y H:i:s");

        $products = $objStorage->loadData('data.json');
        session_start();
        $all_sum = 0;
        $items = [];
        foreach ($products as $product) {
            $id = $product['id'];
            if (array_key_exists($id, $_SESSION['basket'])) {
                $item = [];
                $item['name'] = urldecode( $product['name'] );
                $item['quantity'] = $_SESSION['basket'][$id]['quantity'];                
                $item['price'] = $product['price'];
                $item['sum'] = $item['price'] * $item['quantity'];
                $all_sum += $item['sum'];
                array_push($items, $item);
            }
        }
        $arr['all_sum'] = $all_sum;
        $arr['products'] = $items;

        $objStorage->saveData('orders.json', $arr);
        // отправка емайл
        $this->sendMail($_POST['email']);
        
        $_SESSION['basket'] = [];
        header('Location: https://localhost/orders');

        $_SESSION['flash'] = 'Заказ успешно создан и передан в службу доставки';
        header('Location: /');
        return '';

    
    }
}