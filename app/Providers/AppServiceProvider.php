<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Settings;

use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        
        try {
            $Settings = Settings::first();

            \Config::set('mail.mailers.smtp.host', $Settings->smtp_host);
            \Config::set('mail.mailers.smtp.port', $Settings->smtp_port);
            \Config::set('mail.mailers.smtp.encryption', $Settings->smtp_encryption);
            \Config::set('mail.mailers.smtp.username', $Settings->smtp_username);
            \Config::set('mail.mailers.smtp.password', $Settings->smtp_password);

            \Config::set('mail.from.address', $Settings->smtp_from_address);
            \Config::set('mail.from.name', $Settings->smtp_form_name);

            View::composer('*', function($view)
            {
                $Settings = Settings::first();

                $view->with(compact(['Settings']));
            }); 
            
        } catch (\Throwable $th) {
            //throw $th;
        }


       
    }
}
