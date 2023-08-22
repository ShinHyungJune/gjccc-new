<?php

namespace App\Models;

use App\Enums\SmsTemplate;
use Nurigo\Solapi\Models\Message;
use Nurigo\Solapi\Models\Request\GetGroupMessagesRequest;
use Nurigo\Solapi\Models\Request\GetGroupsRequest;
use Nurigo\Solapi\Models\Request\GetMessagesRequest;
use Nurigo\Solapi\Models\Request\GetStatisticsRequest;
use Nurigo\Solapi\Services\SolapiMessageService;

class SMS
{
    public SolapiMessageService $messageService;

    public function __construct()
    {
        $this->from = config("hello-message.from");

        $this->messageService = new SolapiMessageService(config("hello-message.key"), config("hello-message.secret"));
    }

    public function send($to, $data, $template)
    {
        try {
            $message = new Message();

            $message->setFrom($this->from)
                ->setTo($to)
                ->setSubject($this->getTemplateTitle($template))
                ->setText($this->getTemplateMessage($data, $template));

            // 혹은 메시지 객체의 배열을 넣어 여러 건을 발송할 수도 있습니다!
            $result = $this->messageService->send($message);

            return response()->json($result);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function getTemplateTitle($template)
    {
        if($template == SmsTemplate::VERIFY_NUMBER)
            return "[인증번호발송]";

        if($template == SmsTemplate::NEW_PROFILE)
            return "[프로필 도착]";

        if($template == SmsTemplate::NEW_SCHEDULE)
            return "[소개팅 일정 도착]";

        if($template == SmsTemplate::NEW_ADDRESS)
            return "[소개팅 장소 도착]";

        if($template == SmsTemplate::CHAT_OPEN)
            return "[1:1채팅창 오픈]";

        if($template == SmsTemplate::DATE_OPEN)
            return "[소개팅 일정 확정 및 안내]";

        if($template == SmsTemplate::ORDER_PARTY)
            return "[만날사람들 파티 결제완료]";

        if($template == SmsTemplate::ACCEPT_PARTY)
            return "[만날사람들 파티 승인완료]";
    }

    public function getTemplateMessage($data, $template)
    {
        if($template == SmsTemplate::VERIFY_NUMBER)
            return "본인확인 인증번호입니다.\n[{$data["verify_number"]}]";

        if($template == SmsTemplate::NEW_PROFILE)
            return "새로운 소개팅 프로필이 도착했습니다.\n확인하시겠습니까?\n\n{$data['url']}";

        if($template == SmsTemplate::NEW_SCHEDULE)
            return "상대방에게서 소개팅 일정이 도착했습니다.\n확인하시겠습니까?\n\n{$data['url']}";

        if($template == SmsTemplate::NEW_ADDRESS)
            return "상대방에게서 소개팅 장소가 도착했습니다.\n확인하시겠습니까?\n\n{$data['url']}";

        if($template == SmsTemplate::CHAT_OPEN)
            return "[1:1채팅창 오픈]
소개팅 상대와의 약속확인을 위한
1:1 채팅창이 오픈되었습니다.
확인하시겠습니까?

{$data['url']}";

        if($template == SmsTemplate::DATE_OPEN)
            return "[소개팅 일정 확정 및 안내]
일정 : {$data['scheduled_at']}
장소 : {$data['place_name']}
주소 : {$data['address_name']}
예약자 : {$data['name']}

- 주의사항
1. 최종 확정 되었으며 일정 변경 및 취소가 불가합니다.
2. 소개팅 하루 전 채팅창이 오픈됩니다. 유사시 채팅창을 통해 소통해주세요.
3. 지각 또는 비매너적인 행동으로 인한 만남 취소시, 원인 제공이 있는 당사자에게 패널티가 돌아갑니다.

▶ 만날사람들 마이페이지 바로실행 : {$data['url']}";

        if($template == SmsTemplate::ORDER_PARTY)
            return "[만날사람들 파티 결제완료]
결제가 완료되었습니다.
신원인증 후에 선착순으로 파티참석권 승인드리고 있습니다.

1. 파티 결제 후 카카오톡 플러스친구 추가해주세요.
2. 명함이나 사원증 인증해주세요.
3. 카카오톡 메세지 주세요.
4. 선착순으로 파티참석권 승인 드립니다.
5. 파티 참석 전에 환불규정 확인해주세요.";

        if($template == SmsTemplate::ACCEPT_PARTY)
            return "[만날사람들 파티 승인완료]
일정 : {$data['opened_at']}
장소 : {$data['place_name']}
주소 : {$data['address']}

- 안내 및 주의사항
1. 주류와 간단한 핑거푸드 제공합니다.
2. 설레는 파티에 어울릴 깔끔하고 매너있는 복장으로 와주세요.
3. 파티에 늦을 경우 입장에 불이익이 있어요. 파티 시작 10분 전에는 오시는 것을 추천드립니다.
4. 남녀 성비가 조율되는 파티로 늦거나 오지 않을 시 파티 진행에 차질이 생기니 꼭 미리 알려주세요.
5. 파티 참석 전 꼭 카카오톡플러스친구 추가해주세요!
파티 중간에 카톡메세지 이벤트가 있을 예정이라 서비스 이용에 제한되지 않도록 추가 부탁드립니다.";

    }

    /*
    const NEW_PROFILE = "NEW_PROFILE";  // 새 프로필 도착
    const NEW_SCHEDULE = "NEW_SCHEDULE"; // 일정제안 도착
    const NEW_ADDRESS = "NEW_ADDRESS";  // 장소제안 도착
    const CHAT_OPEN = "CHAT_OPEN"; // 1:1 채팅창 오픈
    const DATE_OPEN = "DATE_OPEN"; // 실제 소개팅 당일
    const ORDER_PARTY = "ORDER_PARTY"; // 파티결제
    const ACCEPT_PARTY = "ACCEPT_PARTY"; // 파티승인
    */
}
