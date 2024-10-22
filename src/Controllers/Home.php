<?php

namespace Controllers;

use Templates\HomeTemplate;
class Home {
    public function get(): string 
        {
            $objTemplate = new HomeTemplate();
            $template = $objTemplate->getHomeTemplate();
            return $template;
        }
    }