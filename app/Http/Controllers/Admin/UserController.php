<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\SocialNetwork;
use App\User;

class UserController extends Controller
{

    protected $notification;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->notification = Article::where('status', 'IN_REVIEW')->count();
    }

    public function index(Request $request)
    {
        $search = $request->searchTerm;
        $notification = $this->notification;
        $users = User::Search($request->searchTerm)->orderBy('id', 'DESC')->paginate(20);
        
        return view('admin.users.index', compact('users','notification','search'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $notification = $this->notification;
        $user = User::find($id);
        $socialNetworks = Socialnetwork::where('user_id', $id)->get();

        return view('admin.users.show', compact('user','notification','socialNetworks'));
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->fill(['permissions' => $request->permissions])->save();
        
        return redirect()->route('admin.users.index')->with('info', 'Usuario actualizado con éxito');
    }

    public function destroy($id)
    {
        //
    }
}
