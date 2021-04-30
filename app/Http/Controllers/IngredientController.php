<?php

namespace App\Http\Controllers;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Requests\Ingredient\CreateIngredientRequest;

class IngredientController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category', ['except' => ['index', 'show']]);
    }
    
    public function index(Request $request)
    {
        //
        $ingredientQuery = Ingredient::query();

        if($request->has('search'))
        {
            $ingredientQuery->where('name', 'like', '%' . $request->search . '%');
        }

        $ingredient = $ingredientQuery->orderBy('name')->get();

        return response()->json($ingredient);

    }
 
    public function store(CreateIngredientRequest $request)
    {
        //
        $ingredient = new Ingredient;
        $ingredient->fill($request->all());

        $ingredient->save();

        return response()->json([
            'message' => 'Created success',
            'status' => true,
            'ingredient' => $ingredient,
        ]);
    }

    
    public function destroy(Ingredient $ingredient)
    {
        //
        $ingredient->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
        ]);
    }
}
