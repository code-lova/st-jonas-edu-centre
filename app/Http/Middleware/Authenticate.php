<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if ($request->is('admin/dashboard')) {
                return route('login'); // Redirect to /admin if unauthenticated
            } elseif ($request->is('student/dashboard')) {
                return route('student'); // Redirect to /student-portal if unauthenticated
            } elseif ($request->is('teacher/dashboard')) {
                return route('teacher'); // Redirect to /teacher-portal if unauthenticated
            }

            return route('login'); // Default fallback
        }

        return null;
    }
}
