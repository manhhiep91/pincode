<?php

namespace App\Http\Middleware;

use App\Services\Admin\UserService;
use App\Services\User\ProjectService;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CheckUser
{
    private $projectService;
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
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
        if (Auth::guard('users')->check()) {
            $user = Auth::guard('users')->user();
            $listProject = $this->projectService->getData(['user_id' => $user->id]);
            View::share('listProject',$listProject);
            return $next($request);
        }
        return redirect()->route('user.login');
    }
}
