<?php
/**
 * This file is part of the MiniUtils package.
 *
 * (c) www.iphp8.com
 *
 * @since 1.0
 * @author Hylin Yin <hylin@iphp8.com>
 */

namespace MiniUtils;

/**
 * The functions of array.
 *
 * @since 1.0
 * @author Hylin Yin <hylin@iphp8.com>
 */
class MuArray
{
    /**
     * Apply a user function to every member of an array key.
     *
     * If a new key has several values, the lastest value will be used.
     *
     * @param array $array
     * @param callable $callback
     */
    public static function keyMap(&$array, $callback)
    {
        $newArr = [];
        array_walk($array, function ($val, $key) use (&$newArr, $callback) {
            $newArr[$callback($val, $key)] = $val;
        });
        $array = $newArr;
    }

    /**
     * Merge one or more arrays to array1 by reference.
     *
     * @param $array1
     * @param array ...$array2
     */
    public static function merge(&$array1, ...$array2)
    {
        foreach ($array2 as $item) {
            $array1 = array_merge($array1, $item);
        }
    }

    /**
     * Sort two-dimension array by key
     *
     * @param array $array
     * @param string $key
     * @param int $order
     * @param bool $maintainIndex
     */
    public static function multiSort(&$array, $key, $order = SORT_ASC, $maintainIndex = false)
    {
        $func = $maintainIndex ? 'uasort' : 'usort';
        $func($array, function ($val1, $val2) use ($key, $order) {
            if ($val1[$key] > $val2[$key]) {
                return $order == SORT_ASC ? 1 : -1;
            } elseif ($val1[$key] < $val2[$key]) {
                return $order == SORT_ASC ? -1 : 1;
            }

            return 0;
        });
    }
}