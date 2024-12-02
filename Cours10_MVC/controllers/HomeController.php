<?php
class HomeController {
    public function index(){
        $data = "Hello from Controller";
        include('views/home.php');
    }

    public function about(){
        echo "page a propos de nous";
    }

}
?>