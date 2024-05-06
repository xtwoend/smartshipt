<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // config email from db
        // $mail = Setting::where('group', 'email')->get();
        // $config = array(
        //     'host'       => $mail->smtp_host,
        //     'port'       => $mail->smtp_port,
        //     'from'       => array('address' => $mail->smtp_from_address, 'name' => $mail->smtp_from_name),
        //     'encryption' => $mail->smtp_encryption,
        //     'username'   => $mail->smtp_username,
        //     'password'   => $mail->smtp_password
        // );

        // Config::set('mail', $config);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
