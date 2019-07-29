<?php
defined('_JEXEC') or die();

class ModC2cstatHelper
{

    public static function getRelations($params){
        $relations = $params->get('relations');
        return $relations;
    }
}