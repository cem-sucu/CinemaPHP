<?php

namespace Controller;

use Model\Connect;

class ActionController {
    public function ajouterFilm(){
        ob_start();
        require "view/ajouterFilm.php";
        $contenu = ob_get_clean();
        return $contenu;
        }
    
    }




?>