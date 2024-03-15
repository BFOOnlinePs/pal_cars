<?php

namespace App\Http\Controllers;

use App\Models\NotificationsModel;
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
        // $notifications = NotificationsModel::where('user_id',auth()->id())->get();
        // return redirect()->intended($this->redirectPath())->with('notifications', $notifications);
        // return view('home',['notifications'=>$notifications]);
        return view('home');
    }
}
