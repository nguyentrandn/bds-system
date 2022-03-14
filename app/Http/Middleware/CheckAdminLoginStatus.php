<?php

namespace App\Http\Middleware;

use App\AdminAccessIpSetting;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class CheckAdminLoginStatus
{

    protected $app;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $exculde_path = [
            'admin/signin',
            'admin/forgot-password',
            'admin/active-account',
            'admin/reset-password',
        ];

        /**
         * Only check if request to admin screen URL
         */
        if(!preg_match( "/^admin\/.+/i", $request->path())) {
            return $next($request);
        }

        if(!auth('admin')->check() && !in_array($request->path(), $exculde_path)) {
            return redirect()->to('/admin/signin');
        }

        return $next($request);
    }
}
