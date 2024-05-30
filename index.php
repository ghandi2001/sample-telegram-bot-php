<?php

if (!file_exists("telebot.php")) {
	copy("https://raw.githubusercontent.com/hctilg/telebot/v2.0/index.php", "telebot.php");
}


require('telebot.php');

$bot = new Telebot('TOKEN');

