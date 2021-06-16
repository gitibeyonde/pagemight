<?php


class PageUtils {


    public function __construct() {
    }

    public static function getImageList($user_name){
        $Im = new Images();
        return $Im->listImages($user_name);
    }

    public static function getForms($user_name){
        $kb = new UserForm($user_name);
        return $kb->ls();
    }

}