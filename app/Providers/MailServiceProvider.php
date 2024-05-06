<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use stdClass;

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
        $all = DB::table('settings')->where('group', 'email')->get();
        if($all) {
            $mail = new stdClass;
            foreach($all as $m) {
                $mail->{$m->key} = $m->value;
            }
            
            $config = array(
                'host'       => $mail->smtp_host,
                'port'       => $mail->smtp_port,
                'from'       => array('address' => $mail->smtp_from_address, 'name' => $mail->smtp_from_name),
                'encryption' => $mail->smtp_encryption ?? 'tls',
                'username'   => $mail->smtp_username,
                'password'   => $mail->smtp_password
            );

            Config::set('mail', $config);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
