<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth ;

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
        foreach(request()->get('media') as $m){
            $post->media()->create([
                'src'=>$m
            ]);
        }
        return request()->get('media');
    }
    public function updateImage(User $user){
        $this->validateImage();
        return $this->saveUserImage($user);
    }
    public function uploadFiles(User $user){
        $this->validateFiles();
        return $this->saveFile($user);
    }
    public function getMidea(User $user){
        return Storage::files('public/images/'.$user->id);
    }
    private function validateImage(){
        if(request()->hasFile('img')){
            request()->validate([
                'img'=>'required|file|image|max:15000',
            ]);
        }
    }
    private function validateFiles(){
        request()->validate([
            'UF'=>'required|file|mimetypes:image/*,video/*,|max:40000',
        ]);
    }
    private function saveUserImage($user){
        if(request()->has('img')){
            $user->update([
                'user_image'=>'storage/'.request()->img->store('images/'.$user->id,'public'),
                ]);
            return $user->user_image;
        }
    }
    private function saveFile($user){
        $src=request()->UF->store('images/'.$user->id,'public');
        return $src;
    }
}
