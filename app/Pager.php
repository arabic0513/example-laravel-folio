<?php

namespace App;

use Illuminate\Support\Facades\Route;

class Pager
{
    public static function route(string $path): void
    {
        $files = collect(scandir(resource_path('views/'.$path)))
            ->skip(3) // ['.', '..', '.gitkeep']
            ->filter(fn ($file) => str_ends_with($file, '.blade.php'))
            ->map(fn($file) => str_replace('.blade.php', '', $file));

        $files->each(function ($view) use($path) {
            Route::get($view, fn () => view($path.'/'.$view));
        });
    }
}
