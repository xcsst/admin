<?php
function get_status(string $type = 'user', $status = null)
{
    switch ($type) {
        default:
            $arr = [
                '-1' => '禁用',
                '1' => '启用',
            ];
    }

    return $status ? \Illuminate\Support\Arr::get($arr, $status, '-') : $arr;
}

/**
 * 广告位置
 * @param null $position
 * @return array|mixed
 */
function get_position($position = null)
{
    $positionArr = [
        1 => '广告位一',
        2 => '广告位二',
    ];

    return $position !== null ? \Illuminate\Support\Arr::get($positionArr, $position, '-') : $positionArr;
}

function get_image_url($path)
{
    return '/storage/' . $path;
}