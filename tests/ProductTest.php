<?php 
namespace Test;

use PHPUnit\Framework\TestCase;
use Routers\Router;

class ProductTest extends TestCase {
    public function test_router() {
        $router = new Router();
        $html = $router->route( "http://localhost/products" );
        $pos= mb_strpos($html, "Добавить в корзину");
        $this->assertNotEquals(false, $pos);
    }
}