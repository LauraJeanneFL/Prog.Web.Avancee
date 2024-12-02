<?php

class Redirect{
    public static function page($url){
        header("Location: $url");
        exit;
    }
}