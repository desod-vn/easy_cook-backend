<?php

namespace App\Http\Controllers;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Policies\IngredientPolicy;
use App\Http\Requests\Ingredient\IngredientRequest;

class IngredientController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Ingredient::class, 'ingredient', ['except' => ['index']]);
    }
    
    public function index(Request $request)
    {
        //
        $ingredientQuery = Ingredient::query();

        if($request->has('search'))
        {
            $ingredientQuery->where('name', 'like', '%' . $request->search . '%');
        
            $ingredient = $ingredientQuery->orderBy('name');
        }

        $ingredient = $ingredientQuery->get();

        return response()->json($ingredient);

    }
 
    public function store(IngredientRequest $request)
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

    public function update(IngredientRequest $request, Ingredient $ingredient)
    {
        //
        $ingredient->fill($request->all());
        $ingredient->save();

        return response()->json([
            'message' => 'Updated success',
            'status' => true,
            'ingredient' => $ingredient,
        ]);
    }
    
}
