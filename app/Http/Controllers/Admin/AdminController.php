<?php

namespace App\Http\Controllers\Admin;

use App\Mail\SendMail;
use App\Models\Contacts;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->role == User::ADMIN_ROLE || $user->role == User::STAFF_ROLE) {
            return redirect()->route('orders.index');
        } else {
            return redirect()->route('news.index');
        }

    }

    public function forgotPassword(Request $request) {
        try {
            $email = $request->email;
            $user = User::where('email', $email)->first();
            $password = uniqid();
            $user->password = bcrypt($password);
            if($user->save()) {
                $data = [
                    'user_name' => $user->user_name,
                    'email' => $user->email,
                    'password' => $password
                ];
                Mail::to($user->email)->send(new SendMail($data));
                return redirect()->back()->with('message-success', 'Mật khẩu mới đã được gửi đến email của bạn. Vui lòng kiểm tra hòm thư!');
            }  else {
                return redirect()->back()->with('message-error', 'Email không chính xác, mời nhập lại');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('message-error', 'Xảy ra lỗi, vui lòng thử lại sau!');
        }

    }

    public function upload(Request $request)
    {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('upload')->move(public_path('images'), $fileName);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('images/' . $fileName);
        $msg = 'Image uploaded successfully';
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }

}
