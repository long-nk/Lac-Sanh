<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommentImages;
use App\Models\Comments;
use App\Models\Contents;
use App\Models\Hotels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comments::orderBy('created_at', 'desc')->get();
        return view('backend.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotels = Hotels::where('status', 1)->get();
        return view('backend.comments.create', compact('hotels'));
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
                'phone_number' => Str::slug($request->phone_number),
                'hotel_id' => $request->hotel_id,
                'title' => $request->title,
                'message' => $request->message,
                'rate' => $request->rate,
                'location' => $request->location,
                'price' => $request->price,
                'staff' => $request->staff,
                'wc' => $request->wc,
                'comfort' => $request->comfort,
                'status' => $request->status,
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
            return redirect()->route('comments.index');
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
        $comment = Comments::with('images')->find($id);
        $hotels = Hotels::where('status', 1)->get();
        return view('backend.comments.edit', compact('comment', 'hotels'));
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

            $comment = Comments::find($id);

            $images = array();
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach ($files as $item) {
                    $name = $item->getClientOriginalName();
                    $images[] = $name;
                    $extensionImage = $item->extension();
                    $image_name = "hotel_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                    $pathImage = public_path('images/uploads/comments/' . $image_name);
                    $imageItem = [
                        'comment_id' => $comment->id,
                        'name' => $image_name,
                        'mime' => $item->getClientMimeType(),
                        'size' => $item->getSize(),
                        'path' => 'comments'
                    ];
                    $item->move('images/uploads/comments/', $image_name);

                    //Create thumbs
                    $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                    $imageNew = Image::make($pathImage);
                    $widthImg = $imageNew->width();
                    $heightImg = $imageNew->height();
                    $wResize = Contents::WIDTH_THUMBS;
                    $hResize = ($wResize * $heightImg) / $widthImg;
                    $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                    CommentImages::create($imageItem);
                }
            }

            $comment->name = $request->name;
            $comment->phone_number = $request->phone_number;
            $comment->hotel_id = $request->hotel_id;
            $comment->title = $request->title;
            $comment->message = $request->message;
            $comment->rate = $request->rate;
            $comment->location = $request->location;
            $comment->price = $request->price;
            $comment->staff = $request->staff;
            $comment->wc = $request->wc;
            $comment->comfort = $request->comfort;
            $comment->status = $request->status;
            $comment->save();

            \DB::commit();
            return redirect()->route('comments.index');
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            \DB::rollback();
            return redirect()->back();
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
            $comment = Comments::with('images')->find($id);
            if($comment) {
                foreach($comment->images as $image) {
                    $filePath = public_path('images/uploads/' . $image->path . '/' . $image->name);
                    $thumbPath = public_path('images/uploads/thumbs/' . $image->name);
                    if(File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    if(File::exists($thumbPath)) {
                        File::delete($thumbPath);
                    }
                }
                CommentImages::where('comment_id', $id)->delete();
                $comment->delete();
                \DB::commit();
                return redirect()->back()->withInput()->with('message-success', 'Xóa thành công!');
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-error', 'Có lỗi khi xóa, vui lòng thử lại sau');
        }
    }

    public function destroyImage(Request $request)
    {
        $id = $request->id;
        $image = CommentImages::find($id);
        $comment = $image->comment_id;
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
        $images = CommentImages::where('comment_id', $comment)->get();
        return view('backend.hotels.list_image', compact('images'));
    }


}
