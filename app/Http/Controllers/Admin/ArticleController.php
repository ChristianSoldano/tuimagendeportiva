<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    protected $notification;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->notification = Article::where('status', 'IN_REVIEW')->count();
    }

    public function published(Request $request)
    {
        $search = $request->title;
        $notification = $this->notification;
        $articles = Article::Search($request->title)->where('status', 'PUBLISHED')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.articles.index', compact('articles', 'notification','search'));
    }

    public function rejected(Request $request)
    {
        $search = $request->title;
        $notification = $this->notification;
        $articles = Article::Search($request->title)->where('status', 'REJECTED')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.articles.rejected', compact('articles', 'notification','search'));
    }

    public function create()
    {
        $notification = $this->notification;
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.articles.create', compact('categories', 'notification'));
    }

    public function store(ArticleStoreRequest $request)
    {
        $article = Article::create($request->all());

        if ($request->file('image')) {
            $imageName = Str::random(20) . '.jpeg';
            $image = Image::make($request->file('image'))->encode('jpeg', 100);
            $image->resize(1280, 720);
            Storage::disk('public')->put("image/$imageName", $image->stream());
            $article->fill(['image' => asset("image/$imageName")])->save();
        }
        $article->fill(['status' => 'PUBLISHED'])->save();

        return redirect()->route('admin.articles.index')->with('info', 'Artículo creado con éxito');
    }

    public function show($id)
    {
        $notification = $this->notification;
        $article = Article::find($id);

        if ($article == null) { 
            return redirect()->route('admin.articles.index');
        } else {
            return view('admin.articles.show', compact('article', 'notification'));
        }
    }

    public function edit($id)
    {
        $notification = $this->notification;
        $article = Article::find($id);
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.articles.edit', compact('article', 'categories', 'notification'));
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        $article = Article::find($id);

        if ($request->file('image')) {
            Storage::disk('public')->delete(str_replace("https://www.tuimagendeportiva.com/", "", $article->image));
        }

        $article->fill($request->except(['status','user_id']))->save();

        if($request->status != 'on'){
            $article->fill(['status' => 'IN_REVIEW'])->save();
            $article->fill(['observations' => null])->save();
        }else{
            $article->fill(['status' => 'PUBLISHED'])->save();
            $article->fill(['observations' => null])->save();
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

    public function destroy($id)
    {
        $article = Article::find($id);
        Storage::disk('public')->delete(str_replace("https://www.tuimagendeportiva.com/", "", $article->image));
        Article::find($id)->delete();

        return redirect()->route('admin.articles.index')->with('info', 'Se eliminó el artículo <strong>' . $article->title . '</strong> correctamente.');
    }
}
