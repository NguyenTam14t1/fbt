<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Validator;
use Auth;
use Hash;

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
        View::share(compact('menuCategories', 'subCategories'));

        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
            $password = Auth::user()->password;

            return $password && \Hash::check($value, $password);
        });
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
