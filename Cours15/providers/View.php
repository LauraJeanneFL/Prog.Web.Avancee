<?php
namespace App\Providers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View {
    static public function render($template, $data=[]){
        $loader = new FilesystemLoader('/../Cours15/providers/View.php');
        $twig = new Environment($loader);
        $twig->addGlobal('asset', ASSET);
        $twig->addGlobal('base', BASE);
        echo $twig->render($template.".php", $data);
    }

    static public function redirect($url){
        header('location:'.BASE.'/'.$url);
    }

    
}