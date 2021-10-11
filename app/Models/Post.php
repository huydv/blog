<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all() {
        $files = File::files(resource_path("posts"));

        return cache()->rememberForever('posts.all', function() use ($files) {
            return collect($files)
                ->map(function($file) {
                    $document = YamlFrontMatter::parseFile($file);
                    return new Post(
                        $document->title,
                        $document->excerpt,
                        $document->date,
                        $document->body(),
                        $document->slug
                    );
                }, $files)
                ->sortByDesc('date');
        });
    }

    public static function find($slug) {
        // $path = resource_path("posts/{$slug}.html");
        // if (!file_exists($path)) {
        //     throw new ModelNotFoundException();
        // }
        // $post = cache()->remember("posts.${slug}", 5, function() use ($path) {
        //     return file_get_contents($path);
        // });

        return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug) {
        $post = static::find($slug);
        if (!$post) {
            throw new ModelNotFoundException();
        }
        return $post;
    }

}
