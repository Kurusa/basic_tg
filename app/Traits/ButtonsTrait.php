<?php

namespace App\Traits;

use App\Utils\TelegramKeyboard;

trait ButtonsTrait
{
    public function buildListButtons($model): array
    {
        $count = $model->count();
        $offset = isset($this->update) ? $this->update->getCallbackQueryByKey('offset', 0) : 0;
        $offsetedData = $model->skip($offset)->take(10)->get();
        foreach ($offsetedData as $data) {
            TelegramKeyboard::addButton($data->title, [
                'a'       => 'info',
                'data_id' => $data->id,
            ]);
        }

        $backButton = [
            'text' => '<',
            'callback_data' => [
                'a'      => 'navigation',
                'offset' => $offset - 10,
            ],
        ];
        $nextButton = [
            'text' => '>',
            'callback_data' => [
                'a'      => 'navigation',
                'offset' => $offset + 10,
            ],
        ];
        $this->addNavigationButtons($backButton, $nextButton, $model);
        $this->addPageNumbers($count);

        return TelegramKeyboard::get();
    }

    private function addPageNumbers($count): void
    {
        $offset = isset($this->update) ? $this->update->getCallbackQueryByKey('offset', 0) : 0;

        $numberButtons = [];
        for ($i = 0; $i <= floor($count / 10); $i++) {
            $text = $i + 1;
            if ($offset / 10 === $i) {
                $text = '•' . $i + 1 . '•';
            }
            $numberButtons[] = [
                'text' => $text,
                'callback_data' => [
                    'a'      => 'navigation',
                    'offset' => $i === 0 ? 0 : $i * 10,
                ],
            ];
        }

        TelegramKeyboard::$list = $numberButtons;
        TelegramKeyboard::$columns = count($numberButtons);
        TelegramKeyboard::build();
    }

    private function addNavigationButtons(array $backButton, array $nextButton, $model): void
    {
        $offset = isset($this->update) ? $this->update->getCallbackQueryByKey('offset', 0) : 0;

        if ($offset > 0 && !empty($model->offset($offset + 10)->value('id'))) {
            TelegramKeyboard::addButtons([$backButton, $nextButton]);
        } else if (!empty($model->offset($offset + 10)->value('id'))) {
            TelegramKeyboard::addButton($nextButton['text'], $nextButton['callback_data']);
        } else if ($offset > 0) {
            TelegramKeyboard::addButton($backButton['text'], $backButton['callback_data']);
        }
    }
}
