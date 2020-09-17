<?php
require_once('Dao.php');

class CompanyDao extends Dao {

    private static $_db;
    private static $_table = "company";

    function __construct($db) {
        self::$_db = $db;
    }

    public static function get($id) {
        $resultData = array();

        $sql = '';
        $sql.= ' SELECT ';
        $sql.= '    * ';
        $sql.= ' FROM ';
        $sql.=  self::$_table ;
        $sql.= ' WHERE ';
        $sql.= '  id = '. self::setQuote($id, self::$_db);

        // excute
        $rs = self::$_db->query($sql);
        if ($rs === false) {
            // display error
            DbUtils::errControl(self::$_db, $sql);
        } else {
            while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
                $entity = array();
                // get data
                foreach ($row as $key => $val){
                    $entity[$key] = $val;
                }
                $resultData = $entity;
                break;
            }
        }
        
        unset($rs);
        
        return $resultData;
    }

    public static function insert($param) {
        $resultData = array();

        // Sql script
        $sql = '';
        $sql.= ' INSERT INTO ';
        $sql.= self::$_table ;
        $sql.= ' ( ';
        $sql.= '    id ';
        $sql.= '  , name ';
        $sql.= '  , address ';
        $sql.= '  , service ';
        $sql.= ' ) ';
        $sql.= ' VALUES ( ';
        $sql.= '   ? ';
        $sql.= '  ,? ';
        $sql.= '  ,? ';
        $sql.= '  ,? ';
        $sql.= ' ) ';

        $paramArray = array(
            $param['id'],
            $param['name'],
            $param['address'],
            $param['service'],
        );
        // excute
        $stmt = self::$_db->prepare($sql);
        if (!$stmt) {
            // display error
            DbUtils::errControl(self::$_db, $sql);
        }
        $result = $stmt->execute($paramArray);
        // rollback and display error
        $errorMsg = $stmt->errorInfo();
        if (!Utils::isNull($errorMsg[2])) {
            // display error
            DbUtils::errControl(self::$_db, $sql, '', $stmt);
        }
        
        return $result;
    }

    public static function update($param, $id) {
        $resultData = array();
        $paramArray = array();

        // SQL script
        $sql = '';
        $sql.= ' UPDATE ';
        $sql.= self::$_table;
        $sql.= ' SET ';

        $sql.= '    name = ? ';
        $paramArray[] = $param['name'];

        if (!Utils::isNull($param['address'])) {
            $sql.= '  , address = ? ';
            $paramArray[] = $param['address'];
        }
        if (!Utils::isNull($param['service'])) {
            $sql.= '  , service = ? ';
            $paramArray[] = $param['service'];
        }

        $sql.= ' WHERE ';
        $sql.= '  id = '.self::setQuote($id, self::$_db);

        // excute
        $stmt = self::$_db->prepare($sql);
        if (!$stmt) {
            // display error
            DbUtils::errControl(self::$_db, $sql);
        }
        $result = $stmt->execute($paramArray);
        // rollback and display error
        $errorMsg = $stmt->errorInfo();
        if (!Utils::isNull($errorMsg[2])) {
            // display error
            DbUtils::errControl(self::$_db, $sql, '', $stmt);
        }
        
        return $result;
    }

    public static function delete($id) {
        $resultData = array();

        // sql script
        $sql = '';
        $sql.= ' DELETE ';
        $sql.= ' FROM ';
        $sql.= self::$_table;
        $sql.= ' WHERE ';
        $sql.= '  id = '.self::setQuote($id, self::$_db);
        // excute
        $rs = self::$_db->exec($sql);
        if ($rs === false) {
            // display error
            DbUtils::errControl(self::$_db, $sql);
        }
        
        return $rs;
    }

    public static function getLastInsertedId()
    {
        $resultData = array();

        // sql script
        $sql = '';
        $sql.= ' SELECT ';
        $sql.= '    * ';
        $sql.= ' FROM ';
        $sql.=  self::$_table ;
        $sql.= ' ORDER BY ';
        $sql.= '  id DESC ';
        $sql.= '  LIMIT 1 ';

        // 
        // $sql = 'SELECT LAST_INSERT_ID()';

        // excute
        $rs = self::$_db->query($sql);
        if ($rs === false) {
            // display error
            DbUtils::errControl(self::$_db, $sql);
        } else {
            while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
                $entity = array();
                // get data
                foreach ($row as $key => $val){
                    $entity[$key] = $val;
                }
                $resultData = $entity;
                break;
            }
        }
        
        unset($rs);
        
        return $resultData;
    }
}