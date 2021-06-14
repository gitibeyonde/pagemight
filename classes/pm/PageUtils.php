<?php


class PageUtils {


    public function __construct() {
    }

    public static function getImageList($bid){
        $Im = new Images();
        return $Im->listImages($bid);
    }

    public static function getForms($user_id){
        $kb = new UserForm($user_id);
        return $kb->ls();
    }

}