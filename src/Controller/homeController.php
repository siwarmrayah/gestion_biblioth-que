<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;

class homeController
{
    
    
   public function  index():Response
   {

        return new Response($this->twig->render('pages/home.html.twig'));
    }
}
?>
