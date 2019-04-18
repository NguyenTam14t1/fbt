<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	Schema::defaultStringLength(191);
        Relation::morphMap([
            'comment' => \App\Models\Comment::class,
            'review' => \App\Models\Review::class,
            'tour' => \App\Models\Tour::class,
        ]);

        $menuCategories = Category::where('parent_id', config('setting.parent_id'))->get();
        $subCategories = Category::where('parent_id', '<>', config('setting.parent_id'))
            ->get();
            $guides = $subCategories;
            $hotels = $subCategories;
        View::share(compact('menuCategories', 'subCategories', 'guides', 'hotels'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
