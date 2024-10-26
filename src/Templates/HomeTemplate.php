<?php

namespace Templates;
class HomeTemplate extends BaseTemplate {
    public function getHomeTemplate(): string 
    {
        $template = parent::getBaseTemplate();
        $str= '';
        session_start();
        if (isset($_SESSION['flash'])) {
            $str .= <<<END
                <div id="liveAlertBtn" class="alert alert-success alert-dismissible" role="alert">
                    <div>{$_SESSION['flash']}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                    onclick="this.parentNode.style.display='none';"></button>
                    <script>
                    setTimeout(
                        function() {
                          var elem = document.getElementById("liveAlertBtn");
                          elem.style.display = "none";
                        }, 3000
                      );
                    </script>
                </div>
                
            END;
            unset($_SESSION['flash']);
        }

        $str .= <<<END
        <div class="h-50 w-50 mx-auto">
        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="./img/BORSH1.jpg" class="d-block w-100 h-100" alt="1">
            </div>
            <div class="carousel-item">
              <img src="./img/buter.jpg" class="d-block w-100 h-100" alt="3">
            </div>
            <div class="carousel-item">
              <img src="./img/salat.jpg" class="d-block w-100 h-100" alt="2">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        </div>
    
    
        <div class="row mt-5">
            <p>
                Приглашаем в наше онлайн-кафе быстрого питания "Быстро вкусно"!
            </p>
            <p>
                Листайте каталог и добавляйте товар в корзину, нажимая кнопку "Купить".
                Нажмите "Сделать заказ", чтобы окончательно оформить заказ:
            </p>
            <div class="ml-10">
                <ul>
                     <li>узнать итоговую сумму заказа</li>
                    <li>ввести данные для доставки</li>
                    <li>подтвердить заказ</li>
                </ul>
            </div>
        </div>   
        END;
        $resultTemplate =  sprintf($template, 'Главная страница', $str);
        return $resultTemplate;
    }
}