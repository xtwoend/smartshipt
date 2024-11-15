<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActivityLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $user = $request->user();

        $page = $this->getPage($request);

        // activity()
        //     ->causedBy($user)
        //     ->log('Buka halaman ' . $page);


        return $next($request);
    }

    protected function getPage($request)
    {
        $pages = [
            'home' => 'beranda',
            'route' => 'rute kapal',
            'fleet' => 'detail kapal',
            'overview.index' => 'overview report',
            'profile.change-password' => 'ubah password',
            'master.fleets.index' => 'master kapal',
            'master.fleets.pic' => 'PIC master kapal',
            'master.oils.index' => 'OIL Analytic',
            'master.ports.index' => 'master port',
            'master.settings.index' => 'setting SMTP Email',
            'master.user.index' => 'master users',
            'master.activity.logs' => 'activity logs'
        ];

        $route = $request->route()->getName();

        return $pages[$route] ?? 'Beranda';
    }
}
