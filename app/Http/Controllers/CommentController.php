<?php

namespace App\Http\Controllers;
use App\comment;
use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\addComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class CommentController extends Controller
{
    /////////////////////////////////////////////////////////////////////////// IDEX
    public function index(post $post){
        return response()->json($post->with('user')->with('comments')->get());
    }
    /////////////////////////////////////////////////////////////////////////// STORE
    public function store(Request $request,post $post){
        $comment=$post->comments()->create([
            'content'=>$request->content,
            'user_id'=>Auth::id(),
        ]);
        $comment=comment::where('id',$comment->id)->with('user')->first();
        return $comment->toJson();
    }
    ///////////////////////////////////////////////////////////////////////// SHOW
    public function show(){
        if(request()->has('user_id'))
            $db=post::where('user_id',request()->get('user_id'))->orderBy('id', 'DESC')->with('user','media')->get();
        else
            $db=post::with('user','media')->orderBy('id', 'DESC')->get();
            
        $db->each(function($p){
            $p->NOC=count(post::where('id',$p->id)->with('comments')->first()->comments);
            $p->LC=($p->NOC != 0)?
            post::where('id',$p->id)->with('comments')->first()->comments[($p->NOC == 1)?0:$p->NOC-1]:'';
        });
        return $db;
    }
    ///////////////////////////////////////////////////////////////////////// SAVE COMMENTS
    public function saveCom(){
        $data=request()->validate([
            'post_id'=>'required',
            'content'=>'required',
            'user_id'=>'required',
            'auther_name'=>'required',
        ]);
        $request=comment::create($data);
        event(new addComment($request));
        return $request;
    }
}
