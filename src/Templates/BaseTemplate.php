<?php

namespace Templates;
class BaseTemplate {  
    public function getBaseTemplate() {
        $template = <<<END
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>%s</title>
            <link rel="stylesheet" href="https://localhost/css/bootstrap.min.css">
        </head>
        <body>
              <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Быстро вкусно</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="/">Главная</a>
                        <a class="nav-link" href="/products">Каталог</a>
                        <a class="nav-link" href="/orders">Сделать заказ</a>
                        </div>
                    </div>
                </div>
            </nav>
            %s
        </div>
        <script src="https://localhost/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        END;
        return $template;
    }
}