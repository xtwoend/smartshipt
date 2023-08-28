<?php

namespace App\Bot;

use App\Models\Fleet;
use App\Bot\TextTable;
use Illuminate\Support\Str;
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

        $fleets = Fleet::where('active', 1)->get();
        $buttons = [];
        foreach ($fleets as $fleet) {
            $buttons[] = Button::create($fleet->name)->value($fleet->id);
        }
        $buttons[] = Button::create('KELUAR')->value('exit');

        $question = Question::create("Silahkan pilih informasi kapal yang anda inginkan")
            ->fallback('Maaf kami tidak mengetahui apa yang anda cari.')
            ->callbackId('start_menu')
            ->addButtons($buttons);
        
        // return $this->ask($question, function (Answer $answer) {
        //     if ($answer->isInteractiveMessageReply()) {
        //         switch ($answer->getValue()) {
        //             case 'fleet_information':
        //                     $this->searchFleet();
        //                 break;
        //             default:
        //                     $this->say("untuk memulai kembali ketik /start atau mulai");
        //                 break;
        //         }
        //     }
        // });

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if(\is_string($answer->getValue()) && $answer->getValue() == 'exit') {
                    $this->sayGoodby();
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

    function searchFleet() : Conversation {
        $fleets = Fleet::where('active', 1)->get();
        $buttons = [];
        foreach ($fleets as $fleet) {
            $buttons[] = Button::create($fleet->name)->value($fleet->id);
        }
        $buttons[] = Button::create('KELUAR')->value('exit');

        $question = Question::create('Ini beberapa kapal yang bisa kamu pilih')
            ->fallback('kamu tidak memilih kapal manapun.')
            ->callbackId('fleet_options')
            ->addButtons($buttons);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if(\is_string($answer->getValue()) && $answer->getValue() == 'exit') {
                    $this->sayGoodby();
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
        $question = Question::create('Ini beberapa informasi yang anda bisa pilih.')
            ->fallback('Informasi yang ada cari belum tersedia.')
            ->callbackId('select_ship')
            ->addButtons([
                Button::create('INFORMATION & SLA')->value('info'),
                Button::create('NAVIGATION & POSITION')->value('nav'),
                Button::create('MACHINERY')->value('machine'),
                Button::create('TANK')->value('tank'),
                Button::create('REPORT')->value('report'),
                Button::create('FLEET LIST')->value('fleet'),
            ]);

        return $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 'info': 
                        $text = $this->fleetInfo();
                        $this->say($text, ['parse_mode' => 'Markdown']);
                        $this->fleetMenu();
                        break;
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
                    case 'machine':
                        $this->say("Data Machinery belum tesedia");
                        $this->fleetMenu();
                        break;
                    case 'tank':
                        $this->say("Data tank belum tesedia");
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
        return "``` \n{$t->render()}```";
    }

    function fleetInfo() : string {
        $fleet = $this->fleet->toArray();
        $cargo_information = $fleet->cargo_information?->toArray();
        $bunker_information = $fleet->bunker_information?->toArray();

        $exclude = ['id', 'created_at', 'updated_at'];
        foreach($exclude as $key) {
            unset($fleet[$key]);
            unset($cargo_information[$key]);
            unset($bunker_information[$key]);
        }

        $infos = array_merge($fleetInfo, $cargo_information ?: [], $bunker_information ?: []);
        $headers = ['Name', 'Value'];
        $values = [];
        foreach($infos as $key => $val) {
            $title = Str::title(str_replace('_', ' ', $key));
            $values[] = [$title, $val];
        }
        $t = new TextTable($headers, $values);
        return "``` \n{$t->render()}```";
    }

    function sayGoodby() : void {
        $this->say("Untuk memulai ulang silahkan ketik /start atau /mulai");
    }

    function run() : void {
        $this->started();
    }
}