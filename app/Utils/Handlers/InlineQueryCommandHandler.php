<?php

namespace App\Utils\Handlers;

use App\Utils\Update;

class InlineQueryCommandHandler
{
    private int $offset;
    private string $query;
    private Update $update;

    public function __construct(Update $update)
    {
        $this->update = $update;
        $this->offset = (int)$this->update->getInlineQuery()?->getOffset();
        $this->query = (string)$this->update->getInlineQuery()?->getQuery();
    }

    public function handle(): array
    {
        return [];
    }
}
