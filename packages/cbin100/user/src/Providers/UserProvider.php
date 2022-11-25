<?php

    namespace Cbin100\User\Providers;
    use Illuminate\Support\ServiceProvider;
    class UserProvider extends ServiceProvider
    {
        public function register()
        {
            //
        }

        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot()
        {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        }
    }
