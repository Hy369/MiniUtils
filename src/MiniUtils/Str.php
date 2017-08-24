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
 * The functions of string.
 *
 * @since 1.0
 * @author Hylin Yin <hylin@iphp8.com>
 */
class Str
{
    /**
     * Converts UTF-8 to unicode.
     *
     * @param string $str The source string.
     * @param string $prefix The prefix of unicode.
     * @param string $suffix The suffix of unicode.
     * @param bool $reserveAscii Whether the asscii character is converted.
     *
     * @return string
     */
    public static function utf8ToUnicode($str, $prefix = '\\u', $suffix = '', $reserveAscii = true)
    {
        $str = str_split($str);
        $result = $temp = '';
        $step = 0;
        foreach ($str as $item) {
            if (ord($item) <= 127 && $reserveAscii) {
                $result .= $item;
                continue;
            }
            $hex = str_pad(decbin(ord($item)), 8, '0', STR_PAD_LEFT);
            $step == 0 && $step = strpos($hex, '0');
            $temp .= ($temp === '' ? substr($hex, $step) : substr($hex, 2));
            $step--;
            if ($step <= 0) {
                $result .= sprintf('%s%s%s', $prefix, str_pad(base_convert($temp, 2, 16), 4, '0', STR_PAD_LEFT), $suffix);
                $temp = '';
            }
        }
        return $result;
    }

    /**
     * Converts unicode to UTF-8.
     *
     * @param string $str The source string.
     * @param string $prefix The prefix of unicode.
     * @param string $suffix The suffix of unicode.
     *
     * @return string
     */
    public static function unicodeToUtf8($str, $prefix = '\\u', $suffix = '')
    {
        $pattern = $suffix ? '[A-Fa-f\d]+' : '[A-Fa-f\d]{1,5}';
        $pattern = sprintf('~%s(%s)%s~', addslashes($prefix), $pattern, addslashes($suffix));

        $str = preg_replace_callback($pattern, function ($item) use ($prefix) {
            $dec = $prefix === '&#' ? $item[1] : base_convert($item[1], 16, 10);
            if ($dec < 128) {
                return chr($dec);
            }

            $bin = base_convert($dec, 10, 2);
            $group = ceil(strlen($bin) / 6);
            $bin = str_pad($bin, $group * 6, '0', STR_PAD_LEFT);
            $bins = str_split($bin, 6);
            $result = '';
            foreach ($bins as $key => $val) {
                if ($key === 0) {
                    $tag = str_pad(str_repeat('1', $group), 8, '0');
                } else {
                    $tag = str_pad('1', 8, '0');
                }
                $tag = (int)base_convert($tag, 2, 10);
                $result .= chr(base_convert($val, 2, 10) | $tag);
            }
            return $result;
        }, $str);
        return $str;
    }

    /**
     * Replaces suffix with new suffix.
     *
     * @param string $str
     * @param string $suffix
     *
     * @return string
     */
    public static function replaceSuffix($str, $suffix)
    {
        $len = strlen(strrchr($str, '.'));
        $len && ($str = substr($str, 0, -$len));
        return $str . $suffix;
    }
}