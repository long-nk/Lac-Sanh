<?php

namespace App\Http\Controllers;

use App\Mail\SendMailContact;
use App\Models\Contacts;
use App\Models\ContactPage;
use App\Models\PageInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    public function index()
    {
        $contact = ContactPage::first();
        return view('frontend.contacts.index', compact('contact'));
    }

    public function store(Request $request)
    {
        try {
            // validate dữ liệu
            $rules = [
                'name'    => 'max:255',
                'phone'   => 'max:20',
                'email'   => 'required|email|max:255',
                'message' => 'max:2000',
                'robot_check' => 'prohibited', // trường này không được có giá trị
            ];

            $messages = [
//                'name.required'    => 'Vui lòng nhập họ tên.',
//                'phone.required'   => 'Vui lòng nhập số điện thoại.',
//                'email.required'   => 'Vui lòng nhập email.',
                'email.email'      => 'Email không hợp lệ.',
//                'message.required' => 'Vui lòng nhập nội dung liên hệ.',
                'robot_check.prohibited' => 'Có lỗi xảy ra, vui lòng thử lại.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $request->only(['name', 'phone', 'email', 'message']);

            $contact = Contacts::create($data);
            $pageInfo = PageInfo::first();

            if ($contact) {
                if ($pageInfo && $pageInfo->mail_setup) {
                    Mail::to($pageInfo->mail_setup)->send(new SendMailContact($contact));
                }
                return redirect()->back()->with('message-success', "Gửi thông tin thành công!");
            } else {
                $message = 'Đã có lỗi khi gửi liên hệ. Xin quý khách vui lòng thử lại';
                return view('frontend.contacts.index', compact('message'));
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('message-error', "Đã có lỗi khi gửi liên hệ. Xin vui lòng thử lại sau!");
        }
    }
}
