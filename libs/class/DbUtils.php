<?php

class DbUtils {

    public static function getConnection()
    {
        $conn = null;

        try {
            // read the entire parsed .ini file
            $iniArray = parse_ini_file("appsetting.ini");
            // foreach($iniArray as $k=>$v)
            // {
            //     echo "$k => $v <br/>";
            // }

            $dbType = $iniArray["db_type"];
            $host = $iniArray["db_host"];
            $dbname = $iniArray["db_name"];
            $username = $iniArray["db_username"];
            $password = $iniArray["db_password"];

            $conn = new PDO("$dbType:host=$host;dbname=$dbname", $username, $password);

        } catch (PDOException $e) {
            self::errControl(null,null,'MYSQL DATABASE CONNECTION ERROR '.$e->getMessage());
        }

        return $conn;
    }

    public static function errControl($db = '', $sql = '', $msg = '', $stmt = '') 
    {
        global $smarty;

        $errorArr = '';

        // rollback
        try {
            if (!Utils::isNull($db)) {
                $errorArr = $db->errorInfo();
                $db->rollBack();
            }
        } catch (PDOException $e) {
            // multi connection will throw exception
        }

        if (!Utils::isNull($stmt)) {
            $errorArr = $stmt->errorInfo();
        }

        // message text
        $errMsg = '';
        if (!Utils::isNull($errorArr[0])) {
            $errMsg.= 'DATABASE ERROR CODE : '.$errorArr[0].'<hr/>';
        }
        if (!Utils::isNull($errorArr[2])) {
            $errMsg.= '[MESSAGE]<br/>'.mb_convert_encoding($errorArr[2], 'UTF8').'<hr/>';
        }
        if (!Utils::isNull($errorArr[2])) {
            $errMsg.= '[QUERY]<br/>'.$sql;
        }
        if (!Utils::isNull($msg)) {
            $errMsg.= '[MESSAGE]<br/>'.mb_convert_encoding($msg, 'UTF8').'<hr/>';
        }

        // if batch process then smarty instance not create when throw error
        if (Utils::isNull($smarty)) {
            // batch process print error on console
            echo $errMsg;
        } else {
            // Web process

            // assign message text
            @$smarty->assign('errmsg', $errMsg);

            // display error
            @$smarty->display('error.tpl');
        }

        // exit program
        exit;
    }
}