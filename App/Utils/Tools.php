<?php
declare(strict_types=1);

namespace App\Utils;

class Tools
{
    /**
     * 将关联数组转换成驼峰KEY
     * @param array $ary
     * @return array
     */
    public static function camelizeArrayKey(array $ary): array
    {
        if (is_array($ary) === false) return $ary;
        if (count($ary) === 0) return $ary;
        $isAssocArray = \PhpRest2\isAssocArray($ary);
        if ($isAssocArray) { $ary = [ $ary ]; }
        $tmpAry = [];
        foreach($ary as $item) {
            $tmp = [];
            foreach($item as $k => $v) {
                $k = \PhpRest2\camelize($k);
                $tmp[$k] = $v;
            }
            array_push($tmpAry, $tmp);
        }
        return $isAssocArray? $tmpAry[0] : $tmpAry;
    }

    /**
     * 将关联数组列表中条件查询
     * @param array $rows
     * @param array $filter
     * @param bool $findAll 是否查询所有
     * @return array
     */
    public static function AssocArraySearch(array $rows, array $filter, bool $findAll = false): ?array
    {
        $result = [];
        foreach($rows as $row) {
            $march = true;
            foreach($filter as $k => $v) {
                if ($row[$k] !== $v) {
                    $march = false;
                    break;
                }
            }
            if ($march === true) {
                if ($findAll === false) {
                    return $row;
                } else {
                    $result[] = $row;
                }
            }
        }
        if ($findAll === false) return null;
        return $result;
    }
}