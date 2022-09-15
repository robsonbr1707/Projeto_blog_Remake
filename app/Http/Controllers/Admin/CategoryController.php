<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(6);
            return Inertia::render('Admin/Categories/Index', compact('categories'));
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        Category::create($data);
            return Redirect::route('categories.index')
            ->with('success', 'Categoria Criada com Sucesso!!');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Edit', compact('category'));
    }

    public function update($id, CategoryRequest $request)
    {
        $data = $request->all();
        $category = Category::findOrFail($id);

        $category->update($data);
            return Redirect::route('categories.index')
            ->with('success', 'Categoria Atualizada!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
            return Redirect::route('categories.index')
            ->with('success', 'Categoria Excluida!!');
    }
}
