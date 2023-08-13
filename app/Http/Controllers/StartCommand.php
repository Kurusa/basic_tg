<?php

namespace App\Http\Controllers;

class StartCommand extends BaseCommand
{
    public function handle()
    {
        $this->getBot()->sendText(config('texts')['main_menu']);
    }
}
