<?php

namespace App\Http\Controllers;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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


    public function show(Ingredient $ingredient)
    {
        return response()->json([
            'message' => 'Read success',
            'status' => true,
            'ingredient' => $ingredient,
        ]);
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


    public function score_ingredient(Request $request, Ingredient $ingredient)
    {

        $number = DB::table('ingredient_post')
                ->where([['ingredient_id', $ingredient->id]])
                ->count();

        $weight = DB::table('ingredient_post')
                ->select('quantity')
                ->where([['ingredient_id', $ingredient->id]])
                ->get();

        $avg = DB::table('ingredient_post')
                ->where([['ingredient_id', $ingredient->id]])
                ->avg('quantity');

        $total = DB::table('ingredient_user')
                ->join('ingredient_post', 'ingredient_user.post_id', '=', 'ingredient_post.post_id')
                ->where([
                    ['ingredient_user.ingredient_id', $ingredient->id],
                    ['ingredient_user.user_id', $request->user],
                    ['ingredient_post.main', 1]
                ])
                ->avg('quantity');


        $result = 0;
        for($i = 0; $i < $number; $i++)
        {
            $result += pow((int)$weight[$i]->quantity - $avg, 2);
        }

        $result = sqrt((1 / $number) * $result);

        return response()->json([
            'message' => 'Success',
            'status' => true,
            'result' => $result,
            'total' => $total,
        ]);
    }
    
}
