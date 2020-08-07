<?php

namespace App\Http\Middleware;

use App\Category;
use App\Tag;
use Closure;

class checkcategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Category::all()->count() == 0)
        {
            session()->flash('error','there is no category yet create one before');
            return redirect(route('categories.create'));

        }
        return $next($request);
    }
}
