<?php
class Utils {

    public static function isNull($judgValue) 
    {
        if ($judgValue == '' || is_null($judgValue)) {
            return true;
        }
        return false;
    }
}