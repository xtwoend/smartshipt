<?php

namespace App\Providers;

use stdClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // config email from db
        if (Schema::hasTable('settings')) {
            $all = DB::table('settings')->where('group', 'email')->get();
            if (count($all) > 0) {
                $mail = new stdClass;
                foreach ($all as $m) {
                    $mail->{$m->key} = $m->value;
                }

                $config = array(
                    'from' => array('address' => $mail->smtp_from_address, 'name' => $mail->smtp_from_name),
                    'mailers' => [
                        'smtp' => [
                            'transport' => 'smtp',
                            'host'       => $mail->smtp_host,
                            'port'       => $mail->smtp_port,
                            'encryption' => $mail->smtp_encryption ?? 'tls',
                            'username'   => $mail->smtp_username,
                            'password'   => $mail->smtp_password,
                            'timeout' => null,
                            'local_domain' => env('MAIL_EHLO_DOMAIN'),
                        ]
                    ]
                );

                Config::set('mail.mailers', $config['mailers']);
                Config::set('mail.from', $config['from']);
            }
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {}
}
