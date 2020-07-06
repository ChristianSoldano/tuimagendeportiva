<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\Request;
use App\Category;
use App\Article;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $notification = Article::where('status', 'IN_REVIEW')->count();
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.categories.index', compact('categories','notification'));
    }


    public function create()
    {
    $notification = Article::where('status', 'IN_REVIEW')->count();
    return view('admin.categories.create', compact('notification'));
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('info', 'Categoría creada con éxito');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $notification = Article::where('status', 'IN_REVIEW')->count();
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category','notification'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);

        $category->fill($request->all())->save();

        return redirect()->route('admin.categories.index')->with('info', 'Categoría actualizada con éxito');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        Category::find($id)->delete();

        return back()->with('info', 'Se eliminó la categoría <strong>' . $category->name . '</strong> correctamente.');
    }
}
