<?php

namespace App\Http\Controllers;

// use App\CalonPenerima;
// use App\Kriteria;
use App\User;
use Illuminate\Http\Request;

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
        // $calon = CalonPenerima::all()->count();
        // $kriteria = Kriteria::all()->count();
        // $pengguna = User::all()->count();
        return view('index');
    }
}
