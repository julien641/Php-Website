<?php
require 'db_info.php';

$db_info = array($servername,$dbmy_user,$dbpassword1,$database);
function query($db_info, $QZ, $array, $close)
{
    $mysqli = new mysqli($db_info[0], $db_info[1], $db_info[2], $db_info[3]);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }


    // var_dump($array);
    $prepared = $mysqli->prepare($QZ) or die("Failed to prepare the statement");
    call_user_func_array(array($prepared, 'bind_param'), refValues($array));
    $prepared->execute() or die("failed to execute");


    if($close){

        $result = $mysqli->affected_rows;

    } else {

        $meta = $prepared->result_metadata();

        while ( $field = $meta->fetch_field() ) {
            $parameters[] = &$row[$field->name];
        }
        call_user_func_array(array($prepared, 'bind_result'), refValues($parameters));

        while ( $prepared->fetch() ) {

            $x = array();
            foreach( $row as $key => $val ) {
                $x[$key] = $val;
            }
            $results[] = $x;
        }

        $result = $results;
    }

    $prepared->close();
    $mysqli->close();

    return  $result;
}

function refValues($arr)
{
    if (strnatcmp(phpversion(), '5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach ($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
    /*
function mysqli_result($res,$row=0,$col=0){

    $numrows = mysqli_num_rows($res);
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){

            return $resrow[$col];
        }
    }
    return -1;
}
*/
?>