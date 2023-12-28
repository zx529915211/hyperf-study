<?php
/**
 * 自定义方法
 */

if (! function_exists('convert_size')) {
    /**
     * 将字节转化为 kb mb 等单位
     * @param $size
     * @return string
     */
    function convert_size($size): string
    {
        $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];
        return @round($size / pow(1024, $i = floor(log($size, 1024))), 2) . ' ' . $unit[$i];
    }
}
