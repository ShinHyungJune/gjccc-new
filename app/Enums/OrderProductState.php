<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 2021-01-31
 * Time: 오후 4:04
 */

namespace App\Enums;


final class OrderProductState
{
    const FAIL = "주문실패"; // 주문실패
    const SUCCESS = "주문성공"; // 주문접수
    const REFUND = "반품"; // 반품

    public static function getValues()
    {
        return [self::FAIL, self::SUCCESS, self::REFUND];
    }

    public static function options()
    {
        return [
            self::FAIL => "주문실패",
            self::SUCCESS => "주문성공",
            self::REFUND => "반품",
            // "배송완료" => self::DONE
        ];
    }
}
