<?php
global $db_info;
require_once 'db_info.php';
    function fileuploader($file,$dir)
    {
  //      error_reporting(E_ALL);
        header('Content-Type: text/plain; charset=utf-8');

        try {

            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($file['error']) ||
                is_array($file['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($file['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // You should also check filesize here.
            if ($file['size'] > 1000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                    $finfo->file($file['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ),
                    true
                )) {
                throw new RuntimeException('Invalid file format.');
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            $filedir= $dir.'/'.sha1_file($file['tmp_name']).'.'.$ext;
//var_dump($file['tmp_name']);
            if (!move_uploaded_file($file['tmp_name'],$filedir)) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

           // echo 'File is uploaded successfully.';
            return $filedir;
        } catch (RuntimeException $e) {

          // echo $e->getMessage();
            return NULL;

        }

//type
    //tmp_name
    //error
    //size

}

function dirmaker($dir)
{
   $dirarray= explode("/",$dir);
   $dirc="";
    foreach($dirarray as $x){

        $dirc= $dirc.$x."/";
        if (!file_exists($dirc)) {
            mkdir($dirc, 0770);
        }
    }

}

function query($db_info, $QZ, $array, $close)
{

    $mysqli = new mysqli($db_info["address"], $db_info["user"], $db_info["password"], $db_info["database"]);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }


    $prepared = $mysqli->prepare($QZ) or die($prepared->error );
//var_dump($array);
    if (!(null===$array)) {
        call_user_func_array(array($prepared, 'bind_param'), ($array));
    }
   // var_dump($prepared);
    $prepared->execute() or die("failed to execute");


    if ($close) {

        $result = $mysqli->affected_rows;

    } else {

        $meta = $prepared->result_metadata();

        while ($field = $meta->fetch_field()) {
            $parameters[] = &$row[$field->name];
        }
        call_user_func_array(array($prepared, 'bind_result'), refValues($parameters));

        while ($prepared->fetch()) {

            $x = array();
            foreach ($row as $key => $val) {
                $x[$key] = $val;
            }
            $results[] = $x;
        }

        $result = $results;
    }

    $prepared->close();
    $mysqli->close();

    return $result;
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

function strip_all($arr)
{
    $clean = array();
    foreach ($arr as $param_name => $param_val) {

        $clean["$param_name"] = test_input($param_val);
    }
    //   echo "Param: $param_name; Value: $param_val<br />\n";

    return $clean;


}

function checkarrayfilled($arr)
{
    if (is_null($arr)) {
        return false;


    }
    if (empty($arr)) {

        return false;

    }

    foreach ($arr as $param_name => $param_val) {

        if (empty($param_val)) {
            return false;
        }
    }
    return true;


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