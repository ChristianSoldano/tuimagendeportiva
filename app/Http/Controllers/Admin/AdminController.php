<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(){
        $notification = Article::where('status', 'IN_REVIEW')->count();
        return view('admin.index', compact('notification'));
    }
}
