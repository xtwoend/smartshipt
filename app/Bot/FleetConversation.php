<?php

namespace App\Bot;

use App\Models\Fleet;
use App\Bot\TextTable;
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
                Button::create('INFORMASI KAPAL')->value('fleet_information'),
                Button::create('KELUAR')->value('exit')
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
        $buttons[] = Button::create('MAIN MENU')->value('main_menu');

        $question = Question::create('Ini beberapa kapal yang bisa kamu pilih')
            ->fallback('kamu tidak memilih kapal manapun.')
            ->callbackId('fleet_options')
            ->addButtons($buttons);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if(\is_string($answer->getValue()) && $answer->getValue() == 'main_menu') {
                    $this->started();
                }else{
                    $this->fleet = Fleet::find($answer->getValue());
                    if($this->fleet) {
                        $this->say("Anda telah memilih armada kapal {$this->fleet->name}");
                        $this->fleetMenu();
                    }
                }
            }
        });
    }

    function fleetMenu() : Conversation {
        $question = Question::create('Informasi apa yang anda ingin lihat?')
            ->fallback('Informasi yang ada cari belum tersedia.')
            ->callbackId('select_ship')
            ->addButtons([
                Button::create('NAVIGASI')->value('nav'),
                Button::create('MAIN ENGINE')->value('me'),
                Button::create('BUNKER')->value('bunker'),
                Button::create('CARGO')->value('cargo'),
                Button::create('PUMP')->value('pump'),
                Button::create('BALAST')->value('balast'),
                Button::create('FLEET LIST')->value('fleet'),
            ]);

        return $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 'nav':
                        $text = $this->nav();
                        $this->say($text, ['parse_mode' => 'Markdown']);
                        $attachment = new Location(
                            $this->fleet->navigation?->lat,
                            $this->fleet->navigation?->lng,
                            [ 'custom_payload' => true]
                        );
                        $map = OutgoingMessage::create('coordinate')->withAttachment($attachment);
                        $this->say($map);
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

    function nav(): string {
        $nav = $this->fleet->navigation;
        $headers = ['Info', 'Value'];
        $values = [
            ['Coordinate', "{$nav->lat} {$nav->lat_dir}, {$nav->lng} {$nav->lng_dir}"],
            ['Heading', $nav->heading],
            ['COG', $nav->cog],
            ['SOG', $nav->sog],
            ['Deep', $nav->depth],
            ['Wind Speed', $nav->wind_speed],
            ['Wind Direction', $nav->wind_direction],
            ['Travel Distance', $nav->distance],
            ['Total Travel Distance', $nav->total_distance]
        ];
        $t = new TextTable($headers, $values);
        // $t->setAlgin(['L', 'R']);
        return "``` \n{$t->render()}```";
    }

    function run() : void {
        $this->started();
    }
}