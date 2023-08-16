<?php

namespace App\Listeners;

use App\Events\NewUserCreatedEvent;
use App\Utils\Api;
use Exception;

class NewUserCreatedListener
{
    /**
     * @throws Exception
     */
    public function handle(NewUserCreatedEvent $event): void
    {
        $bot = new Api(config('telegram.telegram_bot_token'));
        $bot->setChatId(config('telegram')['admin_chat_id']);
        $bot->sendText('Новий користувач: ' . $event->user->user_name);
    }
}
