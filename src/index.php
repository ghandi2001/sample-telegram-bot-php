<?php

require 'lib/TeleBot.php';
require '../vendor/autoload.php';

$variables = parse_ini_file('../.env');

$bot = new Telebot($variables['TOKEN']);

$bot->on('text', function ($data) use ($bot) {
    $chat_id = $data['chat']['id'];
    $text = $data['text'];
    $codes = require 'codes.php';
    if (array_key_exists($text, $codes)) {
        $price = number_format($codes[$text]['amount']);
        $bot->sendMessage(['chat_id' => $chat_id, 'text' =>
            <<<TXT
کد تراکنش $text معتبر است
مبلغ : {$price}
از : {$codes[$text]['src']} 
به : {$codes[$text]['dst']}
\n
TXT
        ]);
        $bot->sendMessage(['chat_id' => $chat_id, 'text' => "لطفا برای ادامه کد مورد نظر بعدی را وارد کنید !!!"]);
    } else {
        $bot->sendMessage(['chat_id' => $chat_id, 'text' => "کد تراکنش نا معتبر"]);
        $bot->sendMessage(['chat_id' => $chat_id, 'text' => "لطفا کد تراکنش مورد نظر را وارد کنید ..."]);
    }
});


/*$bot->on('*',function ($type, $data) use ($bot) {
    $chat_id = $data['chat']['id'];
    $bot->sendMessage(['chat_id' => $chat_id, 'text' => "لطفا کد تراکنش مورد نظر را وارد کنید ..."]);
});*/

$bot->run();
