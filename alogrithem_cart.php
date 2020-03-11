<?php
require "db_info.php";
require 'db_library.php';
function queryobjects(){

    $qz="SELECT * from objects";

    $array=query($db_info,$qz,array(),false);


return $array;
}


class carts
{

    function addtocart()
    {


    }

    function removefromcart()
    {


    }

    function querycart($id)
    {


    }
}


class object{
    public $id;
    public $amount=0;
    public $cost;
    public function __construct($id, $cost){
        $this->id=$id;
        $this->cost=$cost;
    }



}








?>