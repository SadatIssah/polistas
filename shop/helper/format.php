<?php
/**
 * format class
 */
class Format
{

    public function validation($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}















?>