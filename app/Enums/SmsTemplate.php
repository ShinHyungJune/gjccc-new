<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 2021-01-31
 * Time: 오후 4:04
 */

namespace App\Enums;


final class SmsTemplate
{
    const VERIFY_NUMBER = "VERIFY_NUMBER"; // 인증번호 발송
    const NEW_PROFILE = "NEW_PROFILE";  // 새 프로필 도착
    const NEW_SCHEDULE = "NEW_SCHEDULE"; // 일정제안 도착
    const NEW_ADDRESS = "NEW_ADDRESS";  // 장소제안 도착
    const CHAT_OPEN = "CHAT_OPEN"; // 1:1 채팅창 오픈
    const DATE_OPEN = "DATE_OPEN"; // 실제 소개팅 당일
    const ORDER_PARTY = "ORDER_PARTY"; // 파티결제
    const ACCEPT_PARTY = "ACCEPT_PARTY"; // 파티승인
}
