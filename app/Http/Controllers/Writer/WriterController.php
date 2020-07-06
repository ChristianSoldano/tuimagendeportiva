<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Article;

class WriterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('writer');
    }

    public function index(){
        $notification = Article::where(['user_id' => auth()->user()->id, 'status' => 'IN_REVIEW'])->count();
        return view('writer.layout','notification');
    }

    public function categories(){
        $notification = Article::where(['user_id' => auth()->user()->id, 'status' => 'IN_REVIEW'])->count();
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('writer.categories.index', compact('categories','notification'));
    }
}
