<?php

use App\Http\Controllers\StartCommand;

return [
    'telegram_bot_token' => env('TELEGRAM_BOT_TOKEN'),
    'admin_chat_id' => env('ADMIN_CHAT_ID'),

    'handlers' => [
        'callback' => [
        ],

        'status' => [
        ],

        'reg_exp' => [
        ],

        'keyboard' => [
        ],

        'slash' => [
            '/start' => StartCommand::class,
        ],
    ],
];
