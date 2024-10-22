<?php 
namespace Test;

use PHPUnit\Framework\TestCase;
use Routers\Router;

class RouterTest extends TestCase {
    public function test_router() {
        $router = new Router();
        $html = $router->route( "http://localhost/orders" );
        $pos= mb_strpos($html, "Создание заказа");
        $this->assertNotFalse( $pos>=0);
    }
    public function test_router1() {
        $router = new Router();
        $html = $router->route( "http://localhost" );
        $pos= mb_strpos($html, "Приглашаем в наш онлайн магазин автозапчастей");
        $this->assertNotFalse( $pos>=0);
    }
    public function test_router2() {
        $router = new Router();
        $html = $router->route( "http://localhost/products" );
        $pos= mb_strpos($html, "уаыаыуау");
        $this->assertNotFalse( $pos>=0);
    }
}