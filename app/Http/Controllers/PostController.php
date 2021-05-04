<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Policies\PostPolicy;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Post\CreatePostRequest;



class PostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $per_page = 10;
        $postQuery = Post::query()->latest();

        if($request->has('search'))
        {
            $postQuery->where('name', 'like', '%' . $request->search . '%');
        }
        if($request->input('per_page'))
        {
            $per_page = $request->input('per_page');
        }

        $post = $postQuery->paginate($per_page);
        
        return response()->json($post);
    }

    public function store(CreatePostRequest $request)
    {
        //
        $post = new Post;

        $post->fill($request->all());
        $post->slug = Str::slug($post->name, '-');

        $post->save();

        return response()->json([
            'message' => 'Created success',
            'status' => true,
            'post' => $post,
        ]);
    }


    public function show(Post $post)
    {
        //
        $ingredient = DB::table('ingredient_post')->where('post_id', $post->id)->get();

        return response()->json([
            'message' => 'Read success',
            'status' => true,
            'post' => $post,
            'ingredients' => $ingredient,
        ]);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        $link = 'http://localhost:8000/';

        $image = $request->file('image')->store('images');
        
        $post->fill($request->all());
        $post->slug = Str::slug($post->name, '-');
        $post->image = $link . $image;

        $post->save();

        return response()->json([
            'message' => 'Update success',
            'status' => true,
            'post' => $post,
        ]);
    }


    public function destroy(Post $post)
    {
        //
        $post->delete();

        return response()->json([
            'message' => 'Delete success',
            'status' => true,
        ]);
    }

    public function ingredient(Request $request, Post $post)
    {
        $post->ingredients()->attach($request->ingredient, [
            'name' => $request->name,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'main' => $request->main,
        ]);

        return response()->json([
            'message' => 'Attach success',
            'status' => true,
        ]);
    }

}
