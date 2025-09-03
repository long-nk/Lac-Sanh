<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!$user) {
            return redirect()->route('login')->with('message-error', 'Vui lòng đăng nhập để tiếp tục.');
        }

        // Lấy danh sách các vai trò hợp lệ từ các hằng số trong model User
        $allowedRoles = [];
        foreach ($roles as $role) {
            if ($role == 'admin') {
                $allowedRoles[] = User::ADMIN_ROLE;
            } elseif ($role == 'staff') {
                $allowedRoles[] = User::STAFF_ROLE;
            } elseif ($role == 'user') {
                $allowedRoles[] = User::USER_ROLE;
            }
        }

        // Kiểm tra nếu vai trò của người dùng nằm trong danh sách cho phép
        if (!in_array($user->role, $allowedRoles)) {
            return abort(403, 'Bạn không có quyền truy cập chức năng này');
        }

        // Nếu hợp lệ, cho phép tiếp tục
        return $next($request);
    }
}
