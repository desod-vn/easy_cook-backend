<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
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

        if($request->input('sort') == 'oldest')
            $categoryQuery->oldest();
        else
            $categoryQuery->latest();

        $category = $categoryQuery->paginate($request->per_page);
        
        return response()->json($category);
    }

    
    public function store(CreateCategoryRequest $request)
    {
        //
        $image =  $request->file('image')->store(STORE::CATEGORY_IMAGE_FOLDER);
        $category = new Category;
        
        $category->fill($request->all());
        $category->slug = Str::slug($category->name, '-');
        $category->image = $image;
        $category->save();

        return response()->json([
            'message' => 'Created success',
            'category' => $category,
        ]);
    }

    public function show(Category $category)
    {
        //
        return response()->json([
            'message' => 'Show success',
            'category' => $category,
        ]);
    }
 
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        $category->fill($request->all());
        $category->slug = Str::slug($category->name, '-');
        if($request->hasFile('image'))
        {
            Storage::delete($category->image);
            $image =  $request->file('image')->store(STORE::CATEGORY_IMAGE_FOLDER);
        }
        $category->image = $image;
        $category->save();

        return response()->json([
            'message' => 'Updated success',
            'category' => $category,
        ]);
    }

    public function destroy(Category $category)
    {
        //
        $category->delete();

        return response()->json([
            'message' => 'Delete success',
        ]);
    }
}
