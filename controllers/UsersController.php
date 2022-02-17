<?php


class UsersController 
{  
    public static function selectAll(){
        $user = new UsersModel();
        $user->lol();
        return $user;
    }

    public static function  find()
    {
        echo "gloss";
    }
}