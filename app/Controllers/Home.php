<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $session = session();
        log_message('info', 'Session object created');

        if ($session->has('username')) {
            $name = $session->get('username');
            log_message('info', "Name retrieved from session: $name");
            $greetings = "Selamat Datang, $name!, Di Aplikasi Perpus";
        } else {
            $greetings = "Selamat Datang Di Aplikasi Perpus !";
        }

        $data['greetings'] = $greetings;

        log_message('debug', 'Rendering dashboard view');
        return view('dashboard', $data);
    }
}