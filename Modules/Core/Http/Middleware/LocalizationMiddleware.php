<?php
namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocalizationMiddleware extends LaravelLocalizationRedirectFilter
{
}
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure  $next
//      * @return mixed
//      */
//     public function handle(Request $request, Closure $next)
//     {
//         // Check if the first segment matches a language code
//         if (!array_key_exists($request->segment(1), setting('core::locales'))) {
//             // Store segments in array
//             $segments = $request->segments();

//             // Set the default language code as the first segment
//             $segments = \Arr::prepend($segments, config('app.fallback_locale'));

//             // Redirect to the correct url
//             return redirect()->to(implode('/', $segments));
//         }

//         return $next($request);
//     }
// }
