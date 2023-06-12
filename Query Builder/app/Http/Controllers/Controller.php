<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $posts = DB::table('posts')->select('excerpt', 'description')->get();
        print_r($posts);

        $post = DB::table('posts')->where('id', 2)->first();
        echo $post->description;

        $description = DB::table('posts')->where('id', 2)->value('description');
        echo $description;

        $titles = DB::table('posts')->pluck('title');
        print_r($titles);

        $inserted = DB::table('posts')->insert([
            'title' => 'X',
            'slug' => 'X',
            'excerpt' => 'excerpt',
            'description' => 'description',
            'is_published' => true,
            'min_to_read' => 2
        ]);
        echo $inserted;

        $affected = DB::table('posts')
                      ->where('id', 2)
                      ->update(['excerpt' => 'Laravel 10', 'description' => 'Laravel 10']);
        echo $affected;

        $deleted = DB::table('posts')->where('id', 3)->delete();
        echo $deleted;

        $posts = DB::table('posts')
                 ->whereBetween('min_to_read', [1, 5])
                 ->get();
        print_r($posts);

        $affected = DB::table('posts')
                      ->where('id', 3)
                      ->increment('min_to_read');
        echo $affected;
    }
}
