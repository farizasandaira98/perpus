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
        $greetings = "";
        if ($session->has('username')) {
            if ($session->get('id_role') == 1) {
                $greetings = "Selamat Datang Admin Di Aplikasi Perpus";
            }
            else if ($session->get('id_role') == 2) {
                $greetings = "Selamat Datang Di Aplikasi Perpus";
            }
        } else {
            $greetings = "Selamat Datang Di Aplikasi Perpus, Silahkan Login Atau Registrasi Terlebih Dahulu";
        }
        $model_buku = new BukuModel();
        $model_user = new UserModel();
        $data['buku'] = $model_buku->countAll();
        $data['user'] = $model_user->countAll();
        $data['chart_buku'] = $model_buku->orderBy('search_count', 'DESC')->limit(5)->findAll();
        $data['greetings'] = $greetings;

        log_message('debug', 'Rendering dashboard view');
        return view('dashboard', $data);
    }

    public function profile(): string
    {
        return view('profile');
    }
}