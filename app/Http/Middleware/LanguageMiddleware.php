<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 6/17/18
 * Time: 16:42
 */

namespace App\Http\Middleware;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle($request, \Closure $next)
    {
        $locale = (Session::has('locale')) ? Session::get('locale', Config::get('app.locale')) : 'vn';
        App::setLocale($locale);
        return $next($request);
    }
}