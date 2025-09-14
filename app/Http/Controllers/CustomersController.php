<?php

namespace App\Http\Controllers;

use App\Mail\MailRegisterSuccess;
use App\Mail\SendMail;
use App\Mail\SendMailCancelOrder;
use App\Mail\SendMailNewOrder;
use App\Models\CommentImages;
use App\Models\Comments;
use App\Models\Contents;
use App\Models\Customers;
use App\Models\Hotels;
use App\Models\Orders;
use App\Models\PageInfo;
use Illuminate\Auth\Authenticatable;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class CustomersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Authenticatable;

    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function index()
    {
        $user = \auth()->guard('customer')->user();
        $orders = Orders::where('email', $user->email)->orderBy('created_at', 'desc')->get();
        $favoristList = session('favoristList', []);
        $favoristList = Hotels::whereIn('id', $favoristList)->get();
        return view('frontend.customers.index', compact('orders', 'user', 'favoristList'));
    }

    public function cancelOrder(Request $request)
    {
        try {
            $order = Orders::find($request->order_id);
            $order->status = Orders::HUY_DON;
            $order->save();
            $pageInfo = PageInfo::first();
            Mail::to($pageInfo->email2)->send(new SendMailCancelOrder($order));
            return redirect()->back()->withInput()->with('message-success', 'Hủy đơn hàng thành công!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('message-error', 'Không thể hủy đơn hàng');
        }
    }

    public function register()
    {
        return view('frontend.accounts.register');
    }

    public function postRegister(Request $request)
    {

        try {
            $check = Customers::where('email', $request->email)->first();
            if (!$check) {
                $data = [
                    'name' => $request->username,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'password' => bcrypt($request->password),
                ];

                try {
                    Mail::to($request->email)->send(new MailRegisterSuccess($data));
                } catch (\Exception $e) {
                    return redirect()->back()->withInput()->with('message-error', 'Email không tồn tại, vui lòng nhập email chính xác!');
                }
                Customers::create($data);
                return redirect()->back()->withInput()->with('message-success', 'Đăng ký tài khoản thành công! Vui lòng kích hoạt tài khoản để đăng nhập');
            }
            return redirect()->back()->withInput()->with('message-error', 'Email đã được đăng ký!');
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('message-error', 'Xảy ra lỗi khi đăng ký, vui lòng thử lại sau!');
        }

    }

    public function login()
    {
        return view('frontend.accounts.login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->intended(url()->previous())->with('message-success', 'Đăng xuất thành công!');
    }

    public function postLogin(Request $request)
    {
        $check = Customers::where('email', $request['email'])->first();
        if (!$check) {
            $checkPhone = Customers::where('phone_number', $request['email'])->first();
            if ($checkPhone && $checkPhone->verify_email == 0) {
                return redirect()->back()->withInput()->with('message-error', 'Tài khoản chưa được kích hoạt. Hãy kiểm tra email hoặc liên hệ với quản trị viên để được hỗ trợ!');
            } elseif ($checkPhone && $checkPhone->verify_email != 0) {
                if (Auth::guard('customer')->attempt(['phone_number' => $request['email'], 'password' => $request['password']])) {
                    return redirect()->route('home')->with('message-success', 'Đăng nhập thành công!');
                }
            } else {
                return redirect()->back()->withInput()->with('message-error', 'Thông tin đăng nhập không chính xác!');
            }
        } elseif ($check && $check->verify_email == 0) {
            return redirect()->back()->withInput()->with('message-error', 'Tài khoản chưa được kích hoạt. Hãy kiểm tra email hoặc liên hệ với quản trị viên để được hỗ trợ!');
        } elseif (Auth::guard('customer')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->intended(url()->previous())->with('message-success', 'Đăng nhập thành công!');
        }
        return redirect()->back()->withInput()->with('message-error', 'Email, số điện thoại hoặc mật khẩu không chính xác. Xin vui lòng thử lại');
    }

    public function sendComment(Request $request) {
        try {
            \DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'phone_number' => Str::slug($request->phone_number),
                'hotel_id' => $request->hotel_id,
                'message' => $request->message,
                'rate' => $request->rate,
                'location' => $request->position ? $request->position * 2 : 0,
                'price' => $request->price ? $request->price * 2 : 0,
                'staff' => $request->service ? $request->service * 2 : 0,
                'wc' => $request->clean ? $request->clean * 2 : 0,
                'comfort' => $request->comfort ? $request->comfort * 2 : 0,
                'status' => 1,
            ];
            $comment = Comments::create($data);

            $images = array();
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach ($files as $item) {
                    $name = $item->getClientOriginalName();
                    $images[] = $name;
                    $extensionImage = $item->extension();
                    $image_name = "comment_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                    $item->move('images/uploads/comments/', $image_name);
                    $pathImage = public_path('images/uploads/comments/' . $image_name);
                    $imageNew = Image::make($pathImage);
                    $imageItem = [
                        'comment_id' => $comment->id,
                        'name' => $image_name,
                        'mime' => $item->getClientMimeType(),
                        'path' => 'comments'
                    ];
                    $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                    $widthImg = $imageNew->width();
                    $heightImg = $imageNew->height();
                    $wResize = Contents::WIDTH_THUMBS;
                    $hResize = ($wResize * $heightImg) / $widthImg;
                    $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                    CommentImages::create($imageItem);
                }
            }
            \DB::commit();
            return redirect()->back()->withInput()->with('message-success', 'Thêm đánh giá thành công!');
        } catch (Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-error', 'Lỗi khi thêm mới đánh giá, vui lòng thử lại sau');
        }
    }

    public function activeAccount($email)
    {
        $account = Customers::where('email', $email)->first();
        if ($account->verify_email == 0) {
            $account->verify_email = 1;
            $account->save();
            return redirect()->back()->withInput()->with('message-success', 'Kích hoạt tài khoản thành công!');
        }
        return redirect()->back()->withInput()->with('message-success', 'Tài khoản đã được kích hoạt!');

    }

    public function resetPassword(Request $request)
    {
        $customer = Customers::where('email', $request->email)->first();
        if ($customer) {
            // Tạo mật khẩu 6 ký tự ngẫu nhiên (gồm chữ + số)
            $password = Str::upper(Str::random(6));

            $customer->password = bcrypt($password);
            if ($customer->save()) {
                $data = [
                    'email' => $customer->email,
                    'password' => $password
                ];
                Mail::to($customer->email)->send(new SendMail($data));
                return redirect()->back()->withInput()->with('message-success', 'Mật khẩu mới đã được gửi đến email của bạn. Vui lòng kiểm tra hòm thư!');
            } else {
                return redirect()->back()->withInput()->with('message-error', 'Đã có lỗi khi khôi phục lại mật khẩu, xin vui lòng thử lại');
            }
        } else {
            return redirect()->back()->withInput()->with('message-error', 'Email chưa được đăng ký. Xin thử lại email khác!');
        }

    }

    public function changePassword(Request $request)
    {
        $user = \auth()->guard('customer')->user();
        $user->password = bcrypt($request->password);
        $check = $user->save();
        if ($check) {
            return redirect()->back()->withInput()->with('message-success', 'Thay đổi mật khẩu thành công!');
        }
        return redirect()->back()->withInput()->with('message-success', 'Thay đổi mật khẩu thất bại!');
    }

    public function listCustomer()
    {
        $listCustomer = Customers::where('status', 1)->where('check', 1)->paginate(16);
        return view('frontend.customers.support', compact('listCustomer'));
    }

    public function profile()
    {
        $customer = Customers::find(\auth()->guard('customer')->user()->id);
        return view('frontend.customers.profile', compact('customer'));
    }

    public function postUpdateProfile(Request $request)
    {
        try {
            $data = [
                'name' => $request->username,
                'phone_number' => $request->phone_number,
            ];
            if($request->password) {
                $data['password'] = bcrypt($request->password);
            }
//        $path = "images/customers";
//        $image = $request->avatar;
            $file_path = "";
//        if ($request->avatar) {
//            $extension = $image->extension();
//            $file_name = "customer_" . time() . '.' . $extension;
//            $file_path = $path . '/' . $file_name;
//            $image->move($path . '/', $file_name);
//            $data['image'] = $file_path;
//        }
            Customers::find(\auth()->guard('customer')->user()->id)->update($data);
            return redirect()->back()->withInput()->with('message-success', 'Cập nhật thông tin thành công!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('message-error', 'Cập nhật thông tin không thành công!');
        }


    }

    public function updateProfile()
    {
        return view('frontend.customers.update_profile');
    }

    public function products()
    {
        $products = Product::where('user_id', \auth()->guard('customer')->user()->id)->orderBy('status', 'desc')->paginate(10);
        return view('frontend.customers.products', compact('products'));
    }

    public function createProducts()
    {
        $listCategoryChild = Category::where('status', 1)->where('parent_id', '!=', 0)->get();
        return view('frontend.customers.create_products', compact('listCategoryChild'));
    }

    public function editProduct($id)
    {
        $listCategoryChild = Category::where('status', 1)->get();
        return view('frontend.customer.edit_product', compact('product'));
    }

    public function listProduct()
    {
        $orders = Order::where('user_id', \auth()->guard('customer')->user()->id)->paginate(15);
        return view('frontend.customers.list_product', compact('orders'));
    }

    public function destroyOrder(Request $request)
    {
        $order = Order::find($request->id)->delete();
        if ($order) {
            return redirect()->back()->withInput()->with('message-success', 'Xóa đơn hàng thành công!');
        } else {
            return redirect()->back()->withInput()->with('message-error', 'Xóa đơn hàng không thành công!');
        }
    }

    public function income()
    {
        $user_id = \auth()->guard('customer')->user()->id;
        $products = Order::join('products', 'products.id', 'orders.product_id')
            ->where('orders.status', 1)->where('products.user_id', $user_id)->paginate(10);
//        dd($products);
        return view('frontend.customers.income', compact('products'));
    }

    public function historyRecharge()
    {
        $user_id = \auth()->guard('customer')->user()->id;
        $orders = Histories::where('user_id', $user_id)->where('recharge', '!=', 0)->paginate(10);
        return view('frontend.customers.history_recharge', compact('orders'));
    }

    public function historyWithdraw()
    {
        $user_id = \auth()->guard('customer')->user()->id;
        $orders = Histories::where('user_id', $user_id)->where('withdraw', '!=', 0)->paginate(10);
        return view('frontend.customers.history_withdraw', compact('orders'));
    }

    public function withdraw()
    {
        $user_id = \auth()->guard('customer')->user()->id;
        $orders = Histories::where('user_id', $user_id)->where('withdraw', '!=', 0)->paginate(10);
        return view("frontend.customers.withdraw", compact('orders'));
    }

    public function postRecharge(Request $request)
    {
        $user = \auth()->guard('customer')->user();

        $data = [
            "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
            "amount" => intval($request->price),
            "buyerName" => $user->username,
            "buyerEmail" => $user->email,
            "description" => "Nạp tiền vào tài khoản",
            "returnUrl" => route('customers.recharge'),
            "cancelUrl" => route('home'),
        ];
        error_log($data['orderCode']);
        $PAYOS_CLIENT_ID = config('services.payos.PAYOS_CLIENT_ID');
        $PAYOS_API_KEY = config('services.payos.PAYOS_API_KEY');
        $PAYOS_CHECKSUM_KEY = config('services.payos.PAYOS_CHECKSUM_KEY');

        $payOS = new PayOS($PAYOS_CLIENT_ID, $PAYOS_API_KEY, $PAYOS_CHECKSUM_KEY);
        try {
            $response = $payOS->createPaymentLink($data);
            return redirect($response['checkoutUrl']);
            // $response = $payOS->getPaymentLinkInformation($data['orderCode']);
            // return $response;
        } catch (\Exception $th) {
            Log::error("Lỗi thanh toán PayOS: " . $th);
            return redirect()->back()->withInput()->with('message-error', $th->getMessage());
        }

    }

    public function recharge(Request $request)
    {
        try {
            $user_id = \auth()->guard('customer')->user()->id;
            $customer = Customers::find($user_id);
            $PAYOS_CLIENT_ID = config('services.payos.PAYOS_CLIENT_ID');
            $PAYOS_API_KEY = config('services.payos.PAYOS_API_KEY');
            $PAYOS_CHECKSUM_KEY = config('services.payos.PAYOS_CHECKSUM_KEY');
            $payOS = new PayOS($PAYOS_CLIENT_ID, $PAYOS_API_KEY, $PAYOS_CHECKSUM_KEY);
            $response = $payOS->getPaymentLinkInformation($request['orderCode']);
            if ($response) {
                $total = intval($customer->point) + intval($response['amount']);
                $data = [
                    'user_id' => $user_id,
                    'total' => $total,
                    'recharge' => intval($response['amount']),
                    'recharge_at' => now(),
                    'status' => 1
                ];

                $data = Histories::create($data);
                $customer->point = $total;
                $customer->save();
                //  Mail::to($customer->email)->send(new ApproveRecharge($data));

                return redirect()->route('customers.profile')->with('message-success', 'Nạp tiền thành công');
            }
        } catch (Exception $e) {
            Log::error("Lỗi thanh toán PayOS: " . $e);
            return redirect()->route('home')->with('message-error', 'Nạp tiền thất bại');
        }
    }

    public function postWithdraw(Request $request)
    {
        $user_id = \auth()->guard('customer')->user()->id;
        $customer = Customers::find($user_id);
        if (!$customer->qr_code || !$customer->bank || !$customer->stk || !$customer->name_account_bank) {
            return redirect()->route('customers.update.profile')->with('message-error', 'Vui lòng cập nhật QR-CODE hoặc thông tin thanh toán!');
        }
        if ((int)$customer->donate < (int)$request->withdraw) {
            return redirect()->back()->withInput()->with('message-error', 'Số dư không khả dụng');
        }
        if ((int)$request->withdraw < 50000) {
            return redirect()->back()->withInput()->with('message-error', 'Số tiền rút tổi thiểu phải là 50.000đ/Lần.');
        }
        $data = [
            'user_id' => $user_id,
            'total' => $customer->point,
            'withdraw' => $request->withdraw,
            'draw_at' => now(),
            'status' => 0,
        ];
        Histories::create($data);
        $data['withdraw'] = count(Histories::whereNotNull('withdraw')->where('status', 0)->get());
        $pageInfo = PageInfo::first();
        Mail::to($pageInfo->email2)->send(new SendApproveWithdraw($data));
        return redirect()->back()->withInput()->with('message-success', 'Yêu cầu thanh toán đã được gửi thành công');
    }

//    public function postRecharge(Request $request) {
//        $user_id = \auth()->guard('customer')->user()->id;
//        $customer = Customers::find($user_id);
//        $data = [
//            'user_id' => $user_id,
//            'total' => $customer->point,
//            'recharge' => $request->recharge,
//            'recharge_at' => now(),
//            'status' => 0,
//        ];
//        $path = "images/customers";
//        $image = $request->image_payment;
//        $file_path = "";
//        if ($request->image_payment) {
//            $extension = $image->extension();
//            $file_name = "customer_" . time() . '.' . $extension;
//            $file_path = $path . '/' . $file_name;
//            $image->move($path . '/', $file_name);
//            $data['image'] = $file_path;
//        }
//        Histories::create($data);
//        $data['recharge'] = count(Histories::whereNotNull('recharge')->where('status', 0)->get());
//        $pageInfo = PageInfo::first();
//        Mail::to($pageInfo->email2)->send(new SendApproveRecharge($data));
//
//        return redirect()->back()->withInput()->with('message-success', 'Yêu cầu nạp tiền đã được gửi thành công');
//    }

}

