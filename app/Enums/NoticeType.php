<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 2021-01-31
 * Time: 오후 4:04
 */

namespace App\Enums;


final class NoticeType
{
    const DATING = "소개팅";
    const PARTY = "파티";
    const COMMENT = "코멘트";

    public static function getValues()
    {
        return [self::DATING, self::PARTY, self::COMMENT];
    }

    public static function options()
    {
        return [
            self::DATING => "소개팅",
            self::PARTY => "파티",
            self::COMMENT => "코멘트",
        ];
    }
}
