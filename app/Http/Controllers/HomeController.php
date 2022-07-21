<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = [
            'peran' => User::getAll(),
            'title' => 'Dasboard Siswa'
        ];
        return view('home', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $data = [
            'peran' => User::getAll(),
            'title' => 'Dasboard Admin'
        ];
        return view('adminHome', $data);
    }

    public function siswaHome()
    {
        $data = [
            'peran' => User::getAll(),
            'title' => 'Dashboard Siswa'
        ];
        return view('siswaHome', $data);
    }
}
