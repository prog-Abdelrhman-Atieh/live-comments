<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth ;
use App\Events\newPostCheck;

class userController extends Controller
{
    /////////////////////////////////////////////////////////////////////////// SHOW
    public function show(User $user){
        $posts=post::where('user_id',$user->id)->get();
        return view('user.show',compact('user','posts'));
    }
    /////////////////////////////////////////////////////////////////////////// ADDP
    public function addP(User $user){
        $post=$user->posts()->create([
            'content'=>request()->get('content'),
            ]);
        foreach(request()->get('media') as $m){
            $post->media()->create([
                'src'=>$m
            ]);
        }
        event(new newPostCheck());
        return request()->get('media');
    }
    /////////////////////////////////////////////////////////////////////////// GETNEWPOSTS
    public function getNewPosts(){
        $p=post::orderBy('id', 'DESC')->with('user','media')->get();
        $arr=[];
        for($i=0;$i<request()->get('newPostsAdded');$i++)
            $arr[]=$p[$i];
        return $arr ;
    }
    /////////////////////////////////////////////////////////////////////////// UPDATEIMAGE
    public function updateImage(User $user){
        $this->validateImage();
        return $this->saveUserImage($user);
    }
    /////////////////////////////////////////////////////////////////////////// UPLOADFILES
    public function uploadFiles(User $user){
        $this->validateFiles();
        return $this->saveFile($user);
    }
    /////////////////////////////////////////////////////////////////////////// GETMEDIA
    public function getMidea(User $user){
        return Storage::files('public/images/'.$user->id);
    }
    /////////////////////////////////////////////////////////////////////////// VALIDATEIMAGE
    private function validateImage(){
        if(request()->hasFile('img')){
            request()->validate([
                'img'=>'required|file|image|max:15000',
            ]);
        }
    }
    /////////////////////////////////////////////////////////////////////////// VALIDATEFILES
    private function validateFiles(){
        request()->validate([
            'UF'=>'required|file|mimetypes:image/*,video/*,|max:40000',
        ]);
    }
    /////////////////////////////////////////////////////////////////////////// SAVEUSERIMAGE
    private function saveUserImage($user){
        if(request()->has('img')){
            $user->update([
                'user_image'=>'storage/'.request()->img->store('images/'.$user->id,'public'),
                ]);
            return $user->user_image;
        }
    }
    /////////////////////////////////////////////////////////////////////////// SAVEFILES
    private function saveFile($user){
        $src=request()->UF->store('images/'.$user->id,'public');
        return $src;
    }
}
