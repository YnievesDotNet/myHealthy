<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Menu;

class MenuMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Menu::make('home_menu', function($menu) {
            $menu->add(trans('menu.index'), array('route' => 'page.index'));
            $menu->add(trans('menu.about'), array('route' => 'page.about'));
            $menu->add(trans('menu.contact'), array('route' => 'page.contact'));
        });
        /*Menu::make('sidebar', function($menu) {
            $menu->add('Panel', array('action' => 'BackendController@index'))->data('role', 'all');
            $menu->add('Foro', array('route' => 'forum.index'))->data('role', 'all');
            $menu->add('Usuarios', array('action' => 'Backend\UsersController@index'))->data('role', 'admin');
            $menu->add('Roles', array('action' => 'Backend\RolesController@index'))->data('role', 'admin');
        })->filter(function($item){
            if($item->data('role') == 'all'){
                return true;
            };
            if(Auth::user()) {
                if(Auth::user()->hasRole($item->data('role'))) {
                  return true;
                }
                return false;
            } else {
                return false;
            }
        });*/
        return $next($request);
    }
}