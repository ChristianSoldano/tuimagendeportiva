<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Article;
use App\Category;
use Illuminate\Support\Str;

class RequestController extends Controller
{

    protected $notification;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->notification = Article::where('status', 'IN_REVIEW')->count();
    }

    public function index()
    {
        $notification = $this->notification;
        $articles = Article::where('status', 'IN_REVIEW')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.requests.index', compact('articles', 'notification'));
    }

    public function show($id)
    {
        $notification = $this->notification;
        $article = Article::find($id);

        return view('admin.requests.show', compact('article', 'notification'));
    }


    public function accept($id)
    {
        $article = Article::find($id);

        $article->fill(['status' => 'PUBLISHED'])->save();
        $article->fill(['observations' => null])->save();
        $article->fill(['created_at' => date('Y-m-d H:i:s')])->save();
        return redirect()->route('admin.articles.index')->with('info', 'Artículo publicado con éxito');
    }

    public function reject(Request $request, $id){
        $article = Article::find($id);
        
        $article->fill(['status' => 'REJECTED', 'observations' => $request->reason])->save();
        
        return redirect()->route('admin.articles.index')->with('info', 'Artículo rechazado con éxito');
    }

    public function edit($id)
    {
        $notification = $this->notification;
        $article = Article::find($id);
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.requests.edit', compact('article', 'categories', 'notification'));
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        $article = Article::find($id);

        if ($request->file('image')) {
            Storage::disk('public')->delete(str_replace("https://www.tuimagendeportiva.com/", "", $article->image));
        }

        $article->fill($request->except(['status']))->save();

        if($request->status != 'on'){
            $article->fill(['status' => 'IN_REVIEW'])->save();
        }

        if ($request->file('image')) {
            $imageName = Str::random(20) . '.jpeg';
            $image = Image::make($request->file('image'))->encode('jpeg', 100);
            $image->resize(1280, 720);
            Storage::disk('public')->put("image/$imageName", $image->stream());
            $article->fill(['image' => asset("image/$imageName")])->save();
        }
        return redirect()->route('admin.articles.index')->with('info', 'Artículo actualizado con éxito');
    }
}
