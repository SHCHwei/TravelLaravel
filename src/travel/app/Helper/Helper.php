<?php

if (! function_exists('payed')) {
    /**
     * Get php server info.
     */
    function payed($value) : string
    {
        return match ($value) {
            '1' => '已付款',
            '2' => '已退款',
            default => '未付款',
        };
    }
}

if (! function_exists('payType')) {
    /**
     * Get php server info.
     */
    function payType($value) : string
    {
        return match ($value) {
            '2' => '信用卡',
            '3' => '現金',
            default => '匯款',
        };
    }
}


if (! function_exists('orderStatus')) {
    /**
     * Get php server info.
     */
    function orderStatus($value) : string
    {
        return match ($value) {
            '1' => '訂房成功',
            '2' => '訂房失敗',
            '3' => '訂房取消',
            default => '訂房確認中',
        };
    }
}
