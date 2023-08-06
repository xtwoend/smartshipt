<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Bot\FleetConversation;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;

class TelegramBotController extends Controller
{
    protected $bot;

    public function __construct()
    {
        DriverManager::loadDriver(TelegramDriver::class);
        $config = [
            "telegram" => config('botman.telegram')
        ];
        $this->bot = BotManFactory::create($config, new LaravelCache());
    }

    function __invoke() : void {
        $this->bot->hears('/start|mulai', function(BotMan $bot) {
            $user = $bot->getUser();
            $bot->reply("Hallo, {$user->getFirstName()}. \n\nSelamat datang di Smartship");
            $bot->startConversation(new FleetConversation());
        })->stopsConversation();

        $this->bot->listen();
    }
}
