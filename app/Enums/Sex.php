<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 2021-01-31
 * Time: 오후 4:04
 */

namespace App\Enums;


final class Sex
{
    const MEN = "남자";
    const WOMEN = "여자";

    public static function getValues()
    {
        return [self::MEN, self::WOMEN];
    }

    public static function options()
    {
        return [
            self::MEN => "남자",
            self::WOMEN => "여자",
        ];
    }
}
