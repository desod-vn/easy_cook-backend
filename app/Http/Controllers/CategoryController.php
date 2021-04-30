<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Policies\CategoryPolicy;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        //
        $categoryQuery = Category::query();

        if($request->has('search'))
        {
            $categoryQuery->where('name', 'like', '%' . $request->search . '%');
        }

        $category = $categoryQuery->paginate($request->per_page);
        
        return response()->json($category);
    }

    
    public function store(CreateCategoryRequest $request)
    {
        //
        $category = new Category;
        
        $category->fill($request->all());
        $category->slug = Str::slug($category->name, '-');
        $category->save();

        return response()->json([
            'message' => 'Created success',
            'status' => true,
            'category' => $category,
        ]);
    }

    public function show(Category $category)
    {
        //
        return response()->json([
            'category' => $category,
        ]);
    }
 
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        $category->fill($request->all());
        $category->slug = Str::slug($category->name, '-');
        $category->save();

        return response()->json([
            'message' => 'Updated success',
            'status' => true,
            'category' => $category,
        ]);
    }

    public function destroy(Category $category)
    {
        //
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
        ]);
    }
}
