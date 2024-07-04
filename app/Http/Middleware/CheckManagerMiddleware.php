<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $companyId = $request->route('companies');

        // التحقق من أن المستخدم مسجل الدخول وله دور مدير وينتمي للشركة
        if ($user->role !== 'Manager' || $user->company_id != $companyId) {
            return response()->json(['error' => 'أنت لست المدير لهذه الشركة'], 403);
        }
        else
            return $next($request);
    }
}
