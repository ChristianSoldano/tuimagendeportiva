<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\User;
use App\SocialNetwork;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\SocialNetworkStoreRequest;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except('profile');
    }

    public function profile($name)
    {
        $search = null;
        $categories = Category::orderBy('name', 'ASC')->get();
        $user = User::where(['username' => $name])->first();
        
        if ($user != null) {
            $comments = Comment::where('user_id', $user->id)->count();
            $socialNetworks = SocialNetwork::where('user_id', $user->id)->get();

            if ($user->permissions != 'USER') {
                $posts = Article::where(['status' => 'PUBLISHED', 'user_id' => $user->id])->count();
            }


            return view('user.index', compact('user', 'posts', 'socialNetworks', 'categories','comments','search'));
        } else
            abort(404);
    }
    
        public function edit($username)
    {
        $search = null;
        $categories = Category::orderBy('name', 'ASC')->get();
        $user = User::where(['username' => $username])->first();

        if ($user != null && $user->id == auth()->user()->id) {
            $userSN = SocialNetwork::where('user_id', auth()->user()->id)->get();
            $availableSN = [
                "DEFAULT" => "Seleccionar Red Social",
                "FACEBOOK" => "Facebook",
                "INSTAGRAM" => "Instagram",
                "TWITTER" => "Twitter",
            ];;

            foreach ($userSN as $sn) {
                if ($sn->name == "FACEBOOK")
                    unset($availableSN['FACEBOOK']);
                if ($sn->name == 'INSTAGRAM')
                    unset($availableSN['INSTAGRAM']);
                if ($sn->name == 'TWITTER')
                    unset($availableSN['TWITTER']);
            }

            return view('user.edit', compact('user', 'categories', 'availableSN', 'search'));
        } else {
            abort(403);
        }
    }

    public function update_profile(UserUpdateRequest $request)
    {
        $user = Auth::user();

        $user->fill(['name' => ucwords(strtolower($request['name'])), 'lastname' => ucwords(strtolower($request['lastname']))])->save();

        if ($request->file('avatar')) {
            $actualImage = str_replace("https://www.tuimagendeportiva.com/", "", $user->avatar);

            if ($actualImage != 'avatars/default-avatar.jpg') {
                Storage::disk('public')->delete($actualImage);
            }

            $imageName = Str::random(20) . '.jpg';
            $image = Image::make($request->file('avatar'))->encode('jpg', 100);
            $image->resize(800, 800);
            Storage::disk('public')->put("avatars/$imageName", $image->stream());
            $user->fill(['avatar' => asset("avatars/$imageName")])->save();
        }

        return redirect()->route('user.profile', $user->username);
    }

    public function socialnetwork(SocialNetworkStoreRequest $request)
    {
        $user = Auth::user();
        $url = $request['url'];
        $url = explode("/", $url);
        $url = array_filter($url, "strlen");
      
        if ($request['name'] == 'FACEBOOK')
            $url = 'https://www.facebook.com/' . end($url);
        if ($request['name'] == 'TWITTER')
            $url = 'https://twitter.com/' . end($url);
        if ($request['name'] == 'INSTAGRAM')
            $url = 'https://www.instagram.com/' . end($url);

        $request['url'] = $url;

        SocialNetwork::create($request->all());

        return redirect()->route('user.profile', $user->username);
    }
}
