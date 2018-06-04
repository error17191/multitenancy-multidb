<?php

namespace App\Http\Middleware\Tenant;

use App\Company;
use Closure;

class SetTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tenant = $this->resolveTenant(session('tenant'));

        if (!auth()->user()->companies()->where('company_id', $tenant->id)->first()) {
            return redirect()->route('home');
        }

        return $next($request);
    }

    protected function resolveTenant($uuid)
    {
        return Company::where('uuid', $uuid)->first();
    }
}
