<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\post;

class userController extends Controller
{
    public function show(User $user){
        $posts=post::where('user_id',$user->id)->get();
        return view('user.show',compact('user','posts'));
    }
    public function addP(User $user){
        $post=$user->posts()->create([
            'content'=>request()->get('content'),
            ]);
        return $post;
    }
    public function updateImage(User $user){
        $this->validateImage();
        $this->saveFile($user);
        return back();
    }
    private function validateImage(){
        if(request()->hasFile('image')){
            request()->validate([
                'image'=>'required|file|image|max:15000'
            ]);
        }
    }
    private function saveFile($user){
        if(request()->has('image')){
            $user->update([
                'user_image'=>'storage/'.request()->image->store('images/'.$user->id,'public'),
                ]);
        }
    }
}
