<?php

require 'lib/TeleBot.php';
require '../vendor/autoload.php';

$variables = parse_ini_file('../.env');

$bot = new Telebot($variables['TOKEN']);

$bot->on('text', function ($data) use ($bot) {
    $chat_id = $data['chat']['id'];
    $text = $data['text'];
    if (in_array($text, require 'codes.php')){
        $bot->sendMessage(['chat_id' => $chat_id, 'text' => " کد تراکنش $text معتبر است"]);
    }else{
        $bot->sendMessage(['chat_id' => $chat_id, 'text' => "پیام نا معتبر"]);
    }

});

$bot->run();
