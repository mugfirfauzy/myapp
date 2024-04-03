<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\select;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = DB::table('categories')
        ->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%'.$request->search.'%');
        })
        ->paginate(10);
        return view('pages.category.index', compact('category'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        if($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $request->image->storeAs('public/category', $filename);
        } else {
            $filename = "";
        }

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->active = $request->active;
        $category->image = $filename;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category_id)
    {
        $category = Category::findOrFail($category_id);
        return view('pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $type = $request->input("type");

        if($type == 'update') {
            if($request->hasFile('image')) {
                $filename = time().'.'.$request->image->extension();
            } else {
                $filename = $category->image;
            }

            $category->name = $request->name;
            $category->description = $request->description;
            $category->active = $request->active;
            $category->image = $filename;
            $category->update();

            return redirect()->route('category.index')->with('success', 'Category successfully edited.');
        } else if($type == 'activate') {
            if($category['active'] == 'ACTIVE') {
                $category['active'] = 'OFF';
                $category->update();
                return redirect()->route('category.index')->with('error', 'Category turned off.');
            } else {
                $category['active'] = 'ACTIVE';
                $category->update();
                return redirect()->route('category.index')->with('success', 'Category activated.');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted.');
    }
}
