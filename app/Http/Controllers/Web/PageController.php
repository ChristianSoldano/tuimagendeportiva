<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Article;
use App\Category;
use App\Comment;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{


    public function __construct()
    { }

    public function index(Request $request)
    {
        $search = $request->searchTerm;
        $categories = Category::orderBy('name', 'ASC')->get();
        $articles = Article::Search($request->searchTerm)->orderBy('created_at', 'DESC')->where('status', 'PUBLISHED')->paginate(10);

        return view('home', compact('articles', 'categories','search'));
    }

    public function selectByCategory($slug)
    {
        $search = null;
        $categories = Category::orderBy('name', 'ASC')->get();
        $category = Category::where('slug', $slug)->pluck('id')->first();
        $articles = Article::where('category_id', $category)->orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(10);
        return view('home', compact('articles', 'categories','search'));
    }

    public function viewArticle($slug)
    {
        $search = null;
        $categories = Category::orderBy('name', 'ASC')->get();
        $article = Article::where('slug', $slug)->first();

        if ($article != null) {
            $comments = Comment::orderBy('created_at', 'ASC')->where('article_id', $article->id)->get();
            $replies = Reply::where('article_id', $article->id)->get();
            return view('article', compact('article', 'categories', 'comments', 'replies','search'));
        } else
            abort(404);
    }
    
        public function cookies()
    {
        $search = null;
        $categories = Category::orderBy('name', 'ASC')->get();
        
        return view('cookies', compact('categories', 'search'));
    }
    
}
