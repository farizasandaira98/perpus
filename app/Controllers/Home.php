<?php

namespace App\Controllers;
use App\Models\BukuModel;
use App\Models\UserModel;


class Home extends BaseController
{
    public function index(): string
    {
        $session = session();
        log_message('info', 'Session object created');

        if ($session->has('username')) {
            $name = $session->get('username');
            log_message('info', "Name retrieved from session: $name");
            $greetings = "Selamat Datang Admin Di Aplikasi Perpus !";
        } else {
            $greetings = "Selamat Datang Di Aplikasi Perpus !";
        }
        $model_buku = new BukuModel();
        $model_user = new UserModel();
        $data['buku'] = $model_buku->countAll();
        $data['user'] = $model_user->countAll();
        $data['greetings'] = $greetings;

        log_message('debug', 'Rendering dashboard view');
        return view('dashboard', $data);
    }
}