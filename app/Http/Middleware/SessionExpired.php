<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class SessionExpired
{
    protected $session;
    protected $timeout = 1200;


    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle($request, Closure $next)
    {
        $isLoggedIn = $request->path() != 'logout';
        if (!session('lastActivityTime'))
            $this->session->put('lastActivityTime', time());
        elseif (time() - $this->session->get('lastActivityTime') > $this->timeout) {
            $this->session->forget('lastActivityTime');
            $cookie = cookie('intend', $isLoggedIn ? url()->current() : 'home');
            auth()->logout();
            return redirect('logout');
        }
        $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        return $next($request);
    }
}