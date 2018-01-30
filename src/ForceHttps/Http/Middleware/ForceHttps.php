<?php

namespace CSUNMetaLab\ForceHttps\Http\Middleware;

use Closure;

class ForceHttps
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
        // only attempt to force HTTPS if the package has been configured
        // to do so
        if(config('forcehttps.force_https')) {
            // check how the absolute URL in the request looks
            $url = strtolower(url($request->server("REQUEST_URI")));
            if(starts_with($url, 'http:')) {
                // replace the protocol and then return a redirect
                return redirect(str_replace("http:", "https:", $url));
            }
        }
        
        return $next($request);
    }
}
