<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $image = $request->file('image')->store('images');
        $link = 'http://localhost:8000/';

        $post = new Post;

        $post->fill($request->all());
        $post->image = $link . $image;
        $post->slug = Str::slug($post->name, '-');

        $post->save();

        return response()->json([
            'message' => 'Created success',
            'status' => true,
            'post' => $post,
        ]);
    }


    public function show(Request $request, Post $post)
    {
        //
        $ingredient = DB::table('ingredient_post')
            ->select('ingredients.name', 'ingredients.unit', 'quantity', 'main', 'ingredient_id')
            ->join('ingredients', 'ingredients.id', 'ingredient_post.ingredient_id')
            ->where('post_id', $post->id)
            ->get();

        $like = DB::table('ingredient_user')
            ->where([['post_id', $post->id], ['user_id', $request->user]])
            ->first();

        $comment = DB::table('comments')
            ->select('comments.id', 'content', 'users.name', 'users.image', 'comments.created_at')
            ->join('users', 'comments.user_id', 'users.id')
            ->where([['post_id', $post->id]])
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Read success',
            'status' => true,
            'post' => $post,
            'like' => $like,
            'ingredients' => $ingredient,
            'comment' => $comment,
        ]);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        $link = 'http://localhost:8000/';

        $post->fill($request->all());

        if($request->has('image'))
        {
            $image = $request->file('image')->store('images');
            Storage::delete(substr($post->image, strlen($link)));
            $post->image = $link . $image;
        }

        $post->slug = Str::slug($post->name, '-');


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
            'quantity' => $request->quantity,
            'main' => $request->main,
        ]);

        return response()->json([
            'message' => 'Attach success',
            'status' => true,
        ]);
    }

    public function remove_ingredient(Post $post)
    {
        $post->ingredients()->detach();

        return response()->json([
            'message' => 'Detach success',
            'status' => true,
        ]);
    }

}
