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
}