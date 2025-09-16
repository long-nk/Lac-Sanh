<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comforts;
use App\Models\Hotels;
use App\Models\RoomComforts;
use App\Models\RoomImages;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Contents;

class RoomsController extends Controller
{
    public function index()
    {
        return view('backend.rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $hotel = Hotels::find($id);
        $hotels = Hotels::where('status', 1)->where('id', '!=', $hotel->id)->get();
        $listComfortRoom = Comforts::where('status', 1)->where('type', Comforts::RM)->whereNotNull('parent_id')->get();
        return view('backend.rooms.create', compact('hotel', 'hotels', 'listComfortRoom'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        if ($request->price == null) {
            $request->price = 0;
        }
        $data = [
            'name' => $name,
            'hotel_id' => $request->hotel_id,
            'slug' => Str::slug($name, '-'),
            'people' => $request->people,
            'breakfast' => $request->breakfast,
            'bed' => $request->bed,
            'price' => $request->price,
            'sale' => $request->sale,
            'detail' => $request->detail,
            'size' => $request->size,
            'view' => $request->view,
            'service' => $request->service,
            'surcharge' => $request->surcharge,
            'surcharge_check' => $request->surcharge_check,
            'surcharge_infor' => $request->surcharge_infor,
            'surcharge_adult' => $request->surcharge_adult,
            'surcharge_child' => $request->surcharge_child,
//            'surcharge_child2' => $request->surcharge_child2,
//            'surcharge_child3' => $request->surcharge_child3,
            'cancel' => $request->cancel,
            'status' => $request->status,
            'alt' => $request->alt ?? null,
            'meta' => $request->meta ?? null,
        ];
        $list_comfort = [];
        $list_comfort = $request->input('list_comfort');
        $room = Rooms::create($data);

        $validator = \Validator::make($data, [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('message-error', 'Xảy ra lỗi khi tạo, vui lòng tạo lại');
        } else {
            try {
                \DB::beginTransaction();

                $image = $request->image;
                $name = $image->getClientOriginalName();
                $images[] = $name;
                $extensionImage = $image->extension();
                $image_name = "room_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                $image->move('images/uploads/rooms/', $image_name);
                $pathImage = public_path('images/uploads/rooms/' . $image_name);
                $imageNew = Image::make($pathImage);
                $imageItem = [
                    'room_id' => $room->id,
                    'name' => $image_name,
                    'mime' => $image->getClientMimeType(),
                    'path' => 'rooms'
                ];
                $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                $widthImg = $imageNew->width();
                $heightImg = $imageNew->height();
                $wResize = Contents::WIDTH_THUMBS;
                $hResize = ($wResize * $heightImg) / $widthImg;
                $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                RoomImages::create($imageItem);

                $images = array();
                if ($request->hasFile('images')) {
                    $files = $request->file('images');
                    $alts = $request->input('alts', []);
                    $titles = $request->input('titles', []);
                    foreach ($files as $index => $item) {
                        $name = $item->getClientOriginalName();
                        $images[] = $name;
                        $extensionImage = $item->extension();
                        $image_name = "room_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                        $item->move('images/uploads/rooms/', $image_name);
                        $pathImage = public_path('images/uploads/rooms/' . $image_name);
                        $imageNew = Image::make($pathImage);
                        $imageItem = [
                            'room_id' => $room->id,
                            'name' => $image_name,
                            'mime' => $item->getClientMimeType(),
                            'path' => 'rooms',
                            'alt' => $alts[$index] ?? null,
                            'meta' => $titles[$index] ?? null,
                        ];
                        $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                        $widthImg = $imageNew->width();
                        $heightImg = $imageNew->height();
                        $wResize = Contents::WIDTH_THUMBS;
                        $hResize = ($wResize * $heightImg) / $widthImg;
                        $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                        RoomImages::create($imageItem);
                    }
                }

                foreach ($list_comfort as $item => $value) {
                    $data = [
                        'room_id' => $room->id,
                        'comfort_id' => $value,
                    ];
                    $cat = RoomComforts::create($data);
                }

                \DB::commit();
                return redirect()->route('rooms.list', ['id' => $room->hotel_id]);
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                \DB::rollback();
                return redirect()->back()->withInput()->with('message-error', 'Lỗi khi tạo, vui lòng thử lại sau!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Rooms::with('images')->find($id);
        $hotel = Hotels::find($room->hotel_id);
        $hotels = Hotels::where('status', 1)->get();
        $listComfortRoom = Comforts::where('status', 1)->where('type', Comforts::RM)->whereNotNull('parent_id')->get();
        $comfort_rooms = RoomComforts::where('room_id', $id)->pluck('comfort_id')->toArray();
        return view('backend.rooms.edit', compact('room', 'listComfortRoom', 'hotel', 'hotels', 'comfort_rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = Rooms::find($id);
        $list_comfort = [];
        $list_comfort = $request->input('list_comfort');

        $data = [
            'name' => $request->name,
            'hotel_id' => $request->hotel_id,
            'slug' => Str::slug($request->name, '-'),
            'people' => $request->people,
            'breakfast' => $request->breakfast,
            'bed' => $request->bed,
            'price' => $request->price,
            'sale' => $request->sale,
            'detail' => $request->detail,
            'size' => $request->size,
            'view' => $request->view,
            'service' => $request->service,
            'surcharge' => $request->surcharge,
            'surcharge_check' => $request->surcharge_check,
            'surcharge_infor' => $request->surcharge_infor,
            'surcharge_adult' => $request->surcharge_adult,
            'surcharge_child' => $request->surcharge_child,
//            'surcharge_child2' => $request->surcharge_child2,
//            'surcharge_child3' => $request->surcharge_child3,
            'cancel' => $request->cancel,
            'status' => $request->status,
            'alt' => $request->alt,
            'meta' => $request->meta,
        ];

        $room_comfort = RoomComforts::where('room_id', $id)->pluck('comfort_id')->toArray();

        if ($list_comfort) {
            $idDel = array_diff($room_comfort, $list_comfort);
            $idAdd = array_diff($list_comfort, $room_comfort);
            foreach ($idAdd as $item => $value) {
                $datas = [
                    'comfort_id' => $value,
                    'room_id' => $id,
                ];
                RoomComforts::create($datas);
            }
            RoomComforts::where('room_id', $room->id)->whereIn('comfort_id', $idDel)->delete();
        }


        try {
            \DB::beginTransaction();

            $image = $request->image;
            $imageOld = RoomImages::where('room_id', $room->id)->first();

            if($image && $imageOld) {
                $name = $image->getClientOriginalName();
                $images[] = $name;
                $extensionImage = $image->extension();
                $image_name = "room_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                $pathImage = public_path('images/uploads/rooms/' . $image_name);
                $imageItem = [
                    'room_id' => $room->id,
                    'name' => $image_name,
                    'mime' => $image->getClientMimeType(),
                    'size' => $image->getSize(),
                    'path' => 'rooms'
                ];
                $image->move('images/uploads/rooms/', $image_name);

                //Create thumbs
                $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                $imageNew = Image::make($pathImage);
                $widthImg = $imageNew->width();
                $heightImg = $imageNew->height();
                $wResize = Contents::WIDTH_THUMBS;
                $hResize = ($wResize * $heightImg) / $widthImg;
                $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                if (isset($imageOld->path)) {
                    $filePath = public_path('images/uploads/' . $imageOld->path . '/' . $imageOld->name);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    //Remove old image
                    $thumbsPath = public_path('images/uploads/thumbs/' . $imageOld->name);
                    if (File::exists($thumbsPath)) {
                        File::delete($thumbsPath);
                    }
                }
                $imageOld->name = $imageItem['name'];
                $imageOld->mime = $imageItem['mime'];
                $imageOld->size = $imageItem['size'];
                $imageOld->path = $imageItem['path'];
                $imageOld->save();

            }

            $images = array();
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                $altsNew = $request->input('alts_new', []);
                $titlesNew = $request->input('titles_new', []);
                foreach ($files as $index => $item) {
                    $name = $item->getClientOriginalName();
                    $images[] = $name;
                    $extensionImage = $item->extension();
                    $image_name = "room_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                    $pathImage = public_path('images/uploads/rooms/' . $image_name);
                    $imageItem = [
                        'room_id' => $room->id,
                        'name' => $image_name,
                        'mime' => $item->getClientMimeType(),
                        'size' => $item->getSize(),
                        'path' => 'rooms',
                        'alt' => $altsNew[$index] ?? null,
                        'meta' => $titlesNew[$index] ?? null,
                    ];
                    $item->move('images/uploads/rooms/', $image_name);

                    //Create thumbs
                    $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                    $imageNew = Image::make($pathImage);
                    $widthImg = $imageNew->width();
                    $heightImg = $imageNew->height();
                    $wResize = Contents::WIDTH_THUMBS;
                    $hResize = ($wResize * $heightImg) / $widthImg;
                    $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                    RoomImages::create($imageItem);
                }
            }

            $room->name = $data['name'];
            $room->hotel_id = $data['hotel_id'];
            $room->slug = $data['slug'];
            $room->people = $data['people'];
            $room->breakfast = $data['breakfast'];
            $room->bed = $data['bed'];
            $room->price = $data['price'];
            $room->sale = $data['sale'];
            $room->detail = $data['detail'];
            $room->size = $data['size'];
            $room->view = $data['view'];
            $room->service = $data['service'];
            $room->surcharge = $data['surcharge'];
            $room->surcharge_check = $data['surcharge_check'];
            $room->surcharge_infor = $data['surcharge_infor'];
            $room->surcharge_adult = $data['surcharge_adult'];
            $room->surcharge_child = $data['surcharge_child'];
//            $room->surcharge_child2 = $data['surcharge_child2'];
//            $room->surcharge_child3 = $data['surcharge_child3'];
            $room->cancel = $data['cancel'];
            $room->status = $data['status'];
            $room->save();

            \DB::commit();
            return redirect()->route('rooms.list', ['id' => $room->hotel_id]);
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            \DB::rollback();
            return redirect()->back()->withInput()->with('message-error', 'Lỗi khi cập nhật, vui lòng thử lại sau');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            $room = Rooms::find($id);
            if($room) {
                foreach($room->images as $image) {
                    $filePath = public_path('images/uploads/' . $image->path . '/' . $image->name);
                    $thumbPath = public_path('images/uploads/thumbs/' . $image->name);
                    if(File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    if(File::exists($thumbPath)) {
                        File::delete($thumbPath);
                    }
                }
                RoomImages::where('room_id', $id)->delete();
                RoomComforts::where('room_id', $id)->delete();
                $room->delete();
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
        $image = RoomImages::find($id);
        $room = $image->room_id;
        if (empty($image)) {
            return redirect()->back();
        }
        if(@$room->images) {
            foreach($room->images as $image) {
                $filePath = public_path('images/uploads/' . $image->path . '/' . $image->name);
                if(File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
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
        $images = RoomImages::where('room_id', $room)->get();
        return view('backend.rooms.list_image', compact('images'));
    }
    public function list_all($id)
    {
        try {
            $hotel = Hotels::find($id);
            $rooms = Rooms::where('hotel_id', $hotel->id)->orderBy('created_at', 'desc')->get();
            if ($rooms) {
                return view('backend.rooms.index', compact('rooms', 'hotel'));
            } else {
                return redirect()->route('dashboard')->with('message-error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            }
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('message-error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
        }

    }
}
