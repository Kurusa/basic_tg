<?php

namespace App\Utils\Handlers;

use App\Traits\ButtonsTrait;
use App\Traits\InlineButtonsTrait;
use App\Traits\RecipeInfoTrait;
use TelegramBot\Api\Types\Inline\InlineQuery;

class InlineQueryCommandHandler
{
    use ButtonsTrait, InlineButtonsTrait, RecipeInfoTrait;

    public int $offset;
    public string $query;

    public function __construct(InlineQuery $inlineQuery)
    {
        $this->offset = $inlineQuery->getOffset() ? (int)$inlineQuery->getOffset() : 0;
        $this->query = $inlineQuery->getQuery();
    }

    public function handle(): array
    {
        $result = [];
        return $result;
    }
}
