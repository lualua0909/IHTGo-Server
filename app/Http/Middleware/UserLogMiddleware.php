<?php

namespace App\Http\Middleware;

use App\Repositories\Log\LogRepositoryContact;
use Closure;

class UserLogMiddleware
{
    private $log;

    public function __construct(LogRepositoryContact $repositoryContact)
    {
        $this->log = $repositoryContact;
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
        $content = [
            'time' => date('d-m-Y H:i:s'),
            'user' => $request->user()->name,
            'screen' => $request->fullUrl()
        ];
        $this->log->store(['content' => $content]);
        return $next($request);
    }
}
