<?php

namespace App\Http\Middleware;

use Closure;

class CheckManager
{
    public function __construct ()
    {
    }

    public function handle ( $request, Closure $next )
    {
        if ( !in_array( session()->get( 'member.iAcType' ), config( 'config.manager.actype' ) )) {
            return abort( 503 );
        }

        return $next ( $request );
    }
}
