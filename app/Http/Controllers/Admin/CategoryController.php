<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkAdmin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories.edit', compact('category'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('error', 'Категория не найдена');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update($request->validated());
            return redirect()->route('admin.categories.index')->with('success', 'Успешно изменено');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('error', 'Категория не найдена');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Успешно удалено');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('error', 'Категория не найдена');
        }
    }
}
