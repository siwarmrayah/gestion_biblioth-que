<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
class bonjourController{
    function  bonjour(){
        return new Response("bonjour tout le monde ");
    }
}
?>