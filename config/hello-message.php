<?php

use Illuminate\Support\Str;

// 카카오톡 알림톡 발송 API
return [
    'key' => env('HELLO_MESSAGE_KEY', 'NCSAX8U9XFBNL2MO'),
    'secret' => env('HELLO_MESSAGE_SECRET', 'MLFILF6HRCAGYNRG2GUPSIYJYUT2SRLI'),
    // 'pf_id' => env('HELLO_MESSAGE_PF_ID', 'KA01PF220906075416189VE2ro53T2Fb'),
    'from' => env('HELLO_MESSAGE_FROM', '01066211369'),
];
