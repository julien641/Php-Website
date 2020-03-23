<?php

function queryobjects($id){
    global $db_info;
    require_once 'db_info.php';
    require_once 'db_library.php';
    $qz="SELECT * from objects";
    $array=null;

        if($id !=null){
            $qz= $qz." where Objects_ID in(?";

            $array=array();
            $array[0]="";
            foreach ($id as $x=>$value){

                $array[0]=$array[0]."i";
                $array[] =$value['objects_id']+0;

            }
         //   var_dump(count($array));
           for($i=2;$i<count($array);$i++){
               $qz=$qz.',?';
           }

            $qz=$qz.")";
       //     var_dump($qz);
        }
  //  var_dump($array);
    $objects=query($db_info,$qz,$array,false);

    return $objects;
}


    function addtocart($id)
    {

    }

    function removefromcart($id)
    {
        session_start();
       // $_SESSION['cart'].unset($id);

    }

     function querycart($id)
    {


    }










?>