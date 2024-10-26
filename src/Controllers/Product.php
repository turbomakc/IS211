<?php

namespace Controllers;

use Services\FileStorage;
use Templates\ProductTemplate;
use Services\ProductDBStorage;

class Product {
    public function get(int $id): string 
    {
        $objStorage = new FileStorage();
        $products = $objStorage->loadData('data.json');

        foreach ($products as $product) {
            if ($product['id'] == $id) {
                $objTemplate = new ProductTemplate();
                $template = $objTemplate->getPageTemplate( $product );
                return $template;
            }
        }

        /*$code = 404;  
        $text = 'Not Found';  
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        header($protocol . ' ' . $code . ' ' . $text);*/
        return '404';
    }
    public function getAll(): string
    {
        $objStorage = new FileStorage();
        $products = $objStorage->loadData('data.json');

        $objTemplate = new ProductTemplate();
        $template = $objTemplate->getTemplate( $products );

        return $template;

    }

}