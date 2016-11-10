<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/3
 * 时间: 12:56
 */

namespace App\Http\Middleware;
use Closure;
class AdminLogin{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!session('a_id') && !session('a_email')){
            return redirect()->action('Admin\LoginController@login');
        }
        return $next($request);
    }
}