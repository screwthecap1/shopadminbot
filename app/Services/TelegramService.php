<?php

namespace App\Services;

use Telegram\Bot\Api;

class TelegramService
{
    protected Api $telegram;
    protected string $chatId;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->telegram = new Api(config('services.telegram.bot_token'));
        $this->chatId = config('services.telegram.chat_id');
    }

    public function sendMessage(string $text): void
    {
        $this->telegram->sendMessage([
            'chat_id' => $this->chatId,
            'text' => $text,
            'parse_mode' => 'HTML'
        ]);
    }
}
