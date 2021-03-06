<?php

namespace App\Http\Controllers;
use App\post;
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
        $post=post::with('user')->get();
        return view('home',compact('post'));
    }
    public function show(post $post){
        $vedios_ex=['webm','ogg','mp4','avi','wmv','mov','swf','flv','swf'];
        return view('posts.post',compact('post','vedios_ex'));
    }
}
