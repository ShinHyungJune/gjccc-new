<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 2021-01-31
 * Time: 오후 4:04
 */

namespace App\Enums;


final class RefundState
{
    const SUCCESS = "환불완료";
    const DENY = "환불반려";
    const WAIT = "승인대기";

    public static function getValues()
    {
        return [self::SUCCESS, self::DENY, self::WAIT];
    }

    public static function options()
    {
        return [
            self::SUCCESS => "환불완료",
            self::DENY => "환불반려",
            self::WAIT => "승인대기",
        ];
    }
}
