<?php

namespace App\Http\Controllers\Writer;

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

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('writer');
    }

 public function published(Request $request)
    {
        $notification = Article::where(['user_id' => auth()->user()->id, 'status' => 'IN_REVIEW'])->count();
        $search = $request->title;
        $articles = Article::Search($request->title)->where(['user_id' => auth()->user()->id, 'status' => 'PUBLISHED'])->orderBy('id', 'DESC')->paginate(10);
        return view('writer.articles.published', compact('articles','search','notification'));
    }

    public function inReview(Request $request)
    {
        $notification = Article::where(['user_id' => auth()->user()->id, 'status' => 'IN_REVIEW'])->count();
        $search = $request->title;
        $articles = Article::Search($request->title)->where(['user_id' => auth()->user()->id, 'status' => 'IN_REVIEW'])->orderBy('id', 'DESC')->paginate(10);
        return view('writer.articles.review', compact('articles','search','notification'));
    }

    public function rejected(Request $request)
    {
        $notification = Article::where(['user_id' => auth()->user()->id, 'status' => 'IN_REVIEW'])->count();
        $search = $request->title;
        $articles = Article::Search($request->title)->where(['user_id' => auth()->user()->id, 'status' => 'REJECTED'])->paginate(10);
        return view('writer.articles.rejected', compact('articles','search','notification'));
    }


    public function create()
    {
        $notification = Article::where(['user_id' => auth()->user()->id, 'status' => 'IN_REVIEW'])->count();
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('writer.articles.create', compact('categories','notification'));
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
        $article->fill(['status' => 'IN_REVIEW'])->save();

        return redirect()->route('writer.articles.published')->with('info', 'El artículo fué enviado a revisión. Si es aceptado por el Administrador será publicado.');
    }


    public function show($id)
    {
        $notification = Article::where(['user_id' => auth()->user()->id, 'status' => 'IN_REVIEW'])->count();
        $article = Article::find($id);
        if ($article == null) {
            return redirect()->route('writer.articles.published');
        } else {
            $this->authorize('pass', $article);
            return view('writer.articles.show', compact('article','notification'));
        }
    }

    public function edit($id)
    {
        $notification = Article::where(['user_id' => auth()->user()->id, 'status' => 'IN_REVIEW'])->count();
        $article = Article::find($id);
        $this->authorize('pass', $article);
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('writer.articles.edit', compact('article', 'categories','notification'));
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        $article = Article::find($id);
        $this->authorize('pass', $article);
        if ($request->file('image')) {
            Storage::disk('public')->delete(str_replace("https://www.tuimagendeportiva.com/", "", $article->image));
        }

        $article->fill($request->all())->save();

        if ($request->file('image')) {
            $imageName = Str::random(20) . '.jpeg';
            $image = Image::make($request->file('image'))->encode('jpeg', 100);
            $image->resize(1280, 720);
            Storage::disk('public')->put("image/$imageName", $image->stream());
            $article->fill(['image' => asset("image/$imageName")])->save();
        }
        $article->fill(['status' => 'IN_REVIEW'])->save();

        return redirect()->route('writer.articles.published')->with('info', 'Artículo actualizado con éxito');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $this->authorize('pass', $article);
        Storage::disk('public')->delete(str_replace("https://www.tuimagendeportiva.com/", "", $article->image));
        $article->delete();

        return redirect()->route('writer.articles.published')->with('info', 'Se eliminó el artículo <strong>' . $article->title . '</strong> correctamente.');
    }
}
