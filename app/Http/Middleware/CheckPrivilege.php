<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $privilege
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the quiz Id
        $quizId = $request->route('quizId');

        $result = DB::table('user_quiz_rel')
            ->join('quizzes', 'user_quiz_rel.quiz', '=', 'quizzes.id')
            ->where('user_quiz_rel.user', Session::get('user')->id)
            ->where('quizzes.id', $quizId)
            ->select('user_quiz_rel.relation')
            ->first();

        if (!$result || $result->relation !== "Creator") {
            return redirect()->route('homepage');
        }

        return $next($request);
    }
}
