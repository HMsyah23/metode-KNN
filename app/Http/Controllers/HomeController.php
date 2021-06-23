<?php

namespace App\Http\Controllers;

use App\User,App\DataTraining,App\DataTesting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $training = DataTraining::all();
        $testing = DataTesting::all();
        return view('index',compact('training','testing'));
    }

    public function penjelasan()
    {
        return view('penjelasan');
    }
}
