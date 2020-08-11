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
            $https = $request->server("HTTPS");
            if(empty($https) || strtolower($https) == "off") {
                // take SSL termination behind a proxy into account
                if(!$this->startsWith($url, 'https:')) {
                    // replace the protocol and then return a redirect
                    return redirect(str_replace("http:", "https:", $url));
                }
            }
        }

        return $next($request);
    }

    /**
     * Determine if a given string starts with a given substring.
     * Taken from Laravel source
     * https://github.com/laravel/framework/blob/a81f23d0ccd2fefa7fa9b79649ab23811631d9bf/src/Illuminate/Support/Str.php#L466
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    private function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }
}
