<?php
namespace App\Http\Middleware;

use TypeRocket\Http\Middleware\Middleware;

class LoggedInUser extends Middleware
{
    public function handle()
    {
        $request = $this->request;
        $response = $this->response;

        // Do stuff before controller is called
        if ( ! is_user_logged_in() ) {

            $redirect = tr_redirect();
            $redirect->toUrl( home_url('/login/') )->now();

        }

        $this->next->handle();

        // Do stuff after controller is called
    }
}