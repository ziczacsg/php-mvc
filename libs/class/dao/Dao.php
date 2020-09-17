<?php

class Dao {
    public static function getWhereClause($where, $addString) {
        $returnString = '';
        if (Utils::isNull($where)) {
            $returnString = ' WHERE '.$addString;
        } else {
            $returnString = ' AND '.$addString;
        }
        return $returnString.' ';
    }

    public static function setQuote($value, $db) {

        if (is_array($value)) {
            $arrayValue = array();
            foreach ($value as $val) {
                if ($val != '') {
                    $arrayValue[] = $db->quote((string)$val);
                }
            }
            return $arrayValue;
        } else {
            return $db->quote((string)$value);
        }
    }

    public static function getLimitClause($condValue) {
        $limitClause = '';
        if (!is_array($condValue)) {
            return '';
        }
        $limitClause = ' LIMIT '.$condValue[0].' , '.$condValue[1].' ';
        return $limitClause;
    }
}