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
 * The functions of date.
 *
 * @since 1.0
 * @author Hylin Yin <hylin@iphp8.com>
 */
class MuDate
{
    /**
     * Converts a timestamp to UTC.
     *
     * @param int $timestamp
     * @param bool|int $minTime Allowable minmum timestamp to convert.
     * The $minTime will be disabled when false is given.
     * Emtpty string will be given when $timestamp less than $minTime.
     *
     * @return string
     */
    public static function timestampToUtc($timestamp, $minTime = false)
    {
        if (!is_numeric($timestamp)) {
            return '';
        }

        $timestamp = (int)$timestamp;
        if (false !== $minTime && (int)$timestamp < $minTime) {
            return '';
        }

        return gmdate('Y-m-d\TH:i:s\Z', $timestamp);
    }
}