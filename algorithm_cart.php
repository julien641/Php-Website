<?php



function queryobjects(){
    global $db_info;
    require 'db_info.php';
    require 'db_library.php';

    $qz="SELECT * from objects";

    $array=query($db_info,$qz,NULL,false);

    return $array;
}


class carts
{
   static function addtocart($id)
    {
        session_start();
        $_SESSION['cart'];
    }

   static function removefromcart($id)
    {
        session_start();
       // $_SESSION['cart'].unset($id);

    }

    static function querycart($id)
    {


    }
}


class item{
    public $id;
    public $amount=0;
    public $cost;
    public function __construct($id, $cost){
        $this->id=$id;
        $this->cost=$cost;
    }



}








?>