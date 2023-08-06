<?php

namespace App\Bot;

use App\Models\Fleet;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Attachments\Location;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Conversations\Conversation;


class FleetConversation extends Conversation
{
    protected $fleet;
    protected $user;

    function started() : Conversation{
        $question = Question::create("Silahkan pilih menu yang anda inginkan.")
            ->fallback('Maaf kami tidak mengetahui apa yang anda cari.')
            ->callbackId('start_menu')
            ->addButtons([
                Button::create('Informasi Kapal')->value('fleet_information'),
                Button::create('Keluar')->value('exit')
            ]);
        
        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 'fleet_information':
                            $this->searchFleet();
                        break;
                    default:
                            $this->say("untuk memulai kembali ketik /start atau mulai");
                        break;
                }
            }
        });
    }

    function searchFleet() : Conversation {
        $fleets = Fleet::where('active', 1)->get();
        $buttons = [];
        foreach ($fleets as $fleet) {
            $buttons[] = Button::create($fleet->name)->value($fleet->id);
        }

        $question = Question::create('Ini beberapa kapal yang bisa kamu pilih')
            ->fallback('kamu tidak memilih kapal manapun.')
            ->callbackId('fleet_options')
            ->addButtons($buttons);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->fleet = Fleet::find($answer->getValue());
                if($this->fleet) {
                    $this->say("Anda telah memilih armada kapal {$this->fleet->name}");
                    $this->fleetMenu();
                }
            }
        });
    }

    function fleetMenu() : Conversation {
        $question = Question::create('Informasi apa yang anda ingin lihat?')
            ->fallback('Informasi yang ada cari belum tersedia.')
            ->callbackId('select_ship')
            ->addButtons([
                Button::create('Navigasi')->value('nav'),
                Button::create('Main Engine')->value('me'),
                Button::create('Bunker')->value('bunker'),
                Button::create('Cargo')->value('cargo'),
                Button::create('Pump')->value('pump'),
                Button::create('Balast')->value('balast'),
                Button::create('Kembali')->value('fleet'),
            ]);

        return $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 'nav':
                        $this->say("Data navigasi belum tesedia");
                        $this->fleetMenu();
                        break;
                    case 'me':
                        $this->say("Data main engine belum tesedia");
                        $this->fleetMenu();
                        break;
                    case 'bunker':
                        $this->say("Data bunker belum tesedia");
                        $this->fleetMenu();
                        break;
                    case 'cargo':
                        $this->say("Data cagro belum tesedia");
                        $this->fleetMenu();
                        break;
                    case 'pump':
                        $this->say("Data Pump belum tesedia");
                        $this->fleetMenu();
                        break;
                    case 'balast':
                        $this->say("Data Balast belum tesedia");
                        $this->fleetMenu();
                        break;
                    case 'fleet':
                        $this->searchFleet();
                        break;
                    default:
                        $this->say("untuk kembali ketik /start");
                        break;
                }
            }
        });
    }

    function run() : void {
        $this->started();
    }
}