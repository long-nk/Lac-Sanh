<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedbacks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mockery\Exception;

class FeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedbacks::orderBy('sort')->orderBy('created_at', 'desc')->get();
        return view('backend.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.feedbacks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'address' => $request->address,
                'title' => $request->title,
                'message' => $request->message,
                'rate' => $request->rate,
                'sort' => $request->sort ?? null,
                'status' => $request->status,
            ];
            Feedbacks::create($data);

            \DB::commit();
            return redirect()->route('feedbacks.index');
        } catch (Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-error', 'Lỗi khi thêm mới đánh giá, vui lòng thử lại sau');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feedback = Feedbacks::find($id);
        return view('backend.feedbacks.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();

            $feedback = Feedbacks::find($id);

            $feedback->name = $request->name;
            $feedback->address = $request->address;
            $feedback->title = $request->title;
            $feedback->message = $request->message;
            $feedback->rate = $request->rate;
            $feedback->sort = $request->sort ?? null;
            $feedback->status = $request->status;
            $feedback->save();

            \DB::commit();
            return redirect()->route('feedbacks.index')->with('message-success', 'Cập nhật thành công!');
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            \DB::rollback();
            return redirect()->back()->withInput()->with('message-error', 'Cập nhật thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            $feedback = Feedbacks::find($id);
            if($feedback) {
                $feedback->delete();
                \DB::commit();
                return redirect()->back()->withInput()->with('message-success', 'Xóa thành công!');
            }
        } catch (\Exception $e) {
            dd($e);
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-error', 'Có lỗi khi xóa, vui lòng thử lại sau');
        }
    }

    public function destroyImage(Request $request)
    {
        $id = $request->id;
        $image = feedbackImages::find($id);
        $feedback = $image->feedback_id;
        if (empty($image)) {
            return redirect()->back();
        }
        $filePath = public_path('images/uploads/' . $image->path . '/' . $image->name);
        $thumbPath = public_path('images/uploads/thumbs/' . $image->name);
        if(File::exists($filePath)) {
            File::delete($filePath);
        }
        if(File::exists($thumbPath)) {
            File::delete($thumbPath);
        }
        $image->delete();
        $images = feedbackImages::where('feedback_id', $feedback)->get();
        return view('backend.hotels.list_image', compact('images'));
    }


}
