<?php

namespace App\Http\Controllers;

use App\Mail\SendMailContact;
use App\Models\Contacts;
use App\Models\PageInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    public function index()
    {
        return view('frontend.contacts.index');
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'message' => $request->message
            ];
            $contact = Contacts::create($data);
            $pageInfo = PageInfo::first();
//            return redirect()->back()->with('message-success', "Đã gửi liên hệ thành công, chúng tôi sẽ sớm phản hồi tới quý khách!");
            if ($contact) {
                Mail::to($pageInfo->email2)->send(new SendMailContact($contact));
                return redirect()->back()->with('message-success', "Đã gửi liên hệ thành công, chúng tôi sẽ sớm phản hồi tới quý khách!");
            } else {
                $message = 'Đã có lỗi khi gửi liên hệ. Xin quý khách vui lòng thử lại';
                return view('frontend.contacts.index', compact('message'));
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-error', "Đã có lỗi khi gửi liên hệ. Xin vui lòng thử lại sau!");
        }


    }
}
