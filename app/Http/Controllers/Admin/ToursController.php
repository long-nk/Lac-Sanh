<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comforts;
use App\Models\Contents;
use App\Models\HotelAreas;
use App\Models\HotelComforts;
use App\Models\Locations;
use App\Models\TourImages;
use App\Models\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tours::select('id', 'name', 'address', 'price', 'sale', 'sort', 'status', 'created_at')->orderBy('sort')->orderBy('created_at', 'desc')->get();
        return view('backend.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Locations::where('status', 1)->get();
        $listComfortHotel = Comforts::where('status', 1)->where('special', '!=', 1)->where('type', Comforts::TO)->whereNotNull('parent_id')->get();
        $listComfortSpecial = Comforts::where('status', 1)->where('special', 1)->get();
        return view('backend.tours.create', compact('locations', 'listComfortHotel', 'listComfortSpecial'));
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
            'location_id' => $request->location_id,
            'slug' => Str::slug($name, '-'),
            'address' => ltrim($request->address),
            'video' => $request->video,
            'price' => $request->price,
            'sale' => $request->sale,
            'description' => $request->description,
            'type' => $request->type,
            'date' => $request->date,
            'rate' => $request->rate,
            'start_time' => $request->start_time,
            'activities' => $request->activities,
            'list_comfort' => $request->list_comfort,
            'surcharge' => $request->surcharge,
            'vat' => $request->vat,
            'sort' => $request->sort ?? 100,
            'status' => $request->status
        ];

        $validator = \Validator::make($data, [
            'name' => 'required|max:255',
        ]);

        $category = '';
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('message-error', 'Xảy ra lỗi khi tạo, vui lòng tạo lại');
        } else {
            try {
                \DB::beginTransaction();

                $tour = Tours::create($data);

                $image = $request->image;
                $name = $image->getClientOriginalName();
                $images[] = $name;
                $extensionImage = $image->extension();
                $image_name = "tour_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                $image->move('images/uploads/tours/', $image_name);
                $pathImage = public_path('images/uploads/tours/' . $image_name);
                $imageNew = Image::make($pathImage);
                $imageItem = [
                    'tour_id' => $tour->id,
                    'name' => $image_name,
                    'mime' => $image->getClientMimeType(),
                    'path' => 'tours'
                ];
                $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                $widthImg = $imageNew->width();
                $heightImg = $imageNew->height();
                $wResize = Contents::WIDTH_THUMBS;
                $hResize = ($wResize * $heightImg) / $widthImg;
                $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                TourImages::create($imageItem);

                $images = array();
                if ($request->hasFile('images')) {
                    $files = $request->file('images');
                    foreach ($files as $item) {
                        $name = $item->getClientOriginalName();
                        $images[] = $name;
                        $extensionImage = $item->extension();
                        $image_name = "tour_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                        $item->move('images/uploads/tours/', $image_name);
                        $pathImage = public_path('images/uploads/tours/' . $image_name);
                        $imageNew = Image::make($pathImage);
                        $imageItem = [
                            'tour_id' => $tour->id,
                            'name' => $image_name,
                            'mime' => $image->getClientMimeType(),
                            'path' => 'tours'
                        ];
                        $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                        $widthImg = $imageNew->width();
                        $heightImg = $imageNew->height();
                        $wResize = Contents::WIDTH_THUMBS;
                        $hResize = ($wResize * $heightImg) / $widthImg;
                        $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                        TourImages::create($imageItem);
                    }
                }

//                if(!empty($list_comfort)) {
//                    foreach ($list_comfort as $item => $value) {
//                        $data = [
//                            'tour_id' => $tour->id,
//                            'comfort_id' => $value,
//                        ];
//                        $cat = HotelComforts::create($data);
//                    }
//                }
//
//                if(!empty($list_comfort_special)) {
//                    foreach ($list_comfort_special as $item => $value) {
//                        $data = [
//                            'tour_id' => $tour->id,
//                            'comfort_id' => $value,
//                        ];
//                        $cat = HotelComforts::create($data);
//                    }
//                }
//
//                if(!empty($list_area)) {
//                    foreach ($list_area as $item => $value) {
//                        $data = [
//                            'tour_id' => $tour->id,
//                            'area_id' => $value,
//                        ];
//                        HotelAreas::create($data);
//                    }
//                }


                \DB::commit();
                return redirect()->route('tours.index')->with('message-success', 'Thêm mới tour thành công!');
            } catch (\Exception $e) {
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
        $tour = Tours::with('images')->find($id);
        $locations = Locations::where('status', 1)->get();
        return view('backend.tours.edit', compact('tour', 'locations'));
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
        $tour = Tours::find($id);

        $name = $request->name;


        $data = [
            'name' => $name,
            'location_id' => $request->location_id,
            'slug' => Str::slug($name, '-'),
            'address' => ltrim($request->address),
            'video' => $request->video,
            'price' => $request->price,
            'sale' => $request->sale,
            'description' => $request->description,
            'type' => $request->type,
            'date' => $request->date,
            'rate' => $request->rate,
            'start_time' => $request->start_time,
            'activities' => $request->activities,
            'list_comfort' => $request->list_comfort,
            'surcharge' => $request->surcharge,
            'vat' => $request->vat,
            'sort' => $request->sort ?? 100,
            'status' => $request->status
        ];

        try {
            \DB::beginTransaction();
            $image = $request->image;
            $imageOld = TourImages::where('tour_id', $tour->id)->first();

            if($image && $imageOld) {
                $name = $image->getClientOriginalName();
                $images[] = $name;
                $extensionImage = $image->extension();
                $image_name = "tour_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                $pathImage = public_path('images/uploads/tours/' . $image_name);
                $imageItem = [
                    'tour_id' => $tour->id,
                    'name' => $image_name,
                    'mime' => $image->getClientMimeType(),
                    'size' => $image->getSize(),
                    'path' => 'tours'
                ];
                $image->move('images/uploads/tours/', $image_name);

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
                foreach ($files as $item) {
                    $name = $item->getClientOriginalName();
                    $images[] = $name;
                    $extensionImage = $item->extension();
                    $image_name = "tour_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                    $pathImage = public_path('images/uploads/tours/' . $image_name);
                    $imageItem = [
                        'tour_id' => $tour->id,
                        'name' => $image_name,
                        'mime' => $item->getClientMimeType(),
                        'size' => $item->getSize(),
                        'path' => 'tours'
                    ];
                    $item->move('images/uploads/tours/', $image_name);

                    //Create thumbs
                    $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                    $imageNew = Image::make($pathImage);
                    $widthImg = $imageNew->width();
                    $heightImg = $imageNew->height();
                    $wResize = Contents::WIDTH_THUMBS;
                    $hResize = ($wResize * $heightImg) / $widthImg;
                    $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                    TourImages::create($imageItem);
                }
            }

            $tour->update($data);

            \DB::commit();
            return redirect()->route('tours.index')->with('message-success', 'Cập nhật tour thành công!');
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
            $tour = Tours::find($id);
            if($tour) {
                foreach($tour->images as $image) {
                    $filePath = public_path('images/uploads/' . $image->path . '/' . $image->name);
                    $thumbPath = public_path('images/uploads/thumbs/' . $image->name);
                    if(File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    if(File::exists($thumbPath)) {
                        File::delete($thumbPath);
                    }
                }
                TourImages::where('tour_id', $id)->delete();
                $tour->delete();
                \DB::commit();
                return redirect()->back()->withInput()->with('message-success', 'Xóa thành công!');
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-error', 'Có lỗi khi xóa, vui lòng thử lại sau');
        }
    }

    public function listAll(Request $request)
    {
        $type = $request->type;
        $tours = Tours::select('id', 'name', 'address', 'price', 'sale', 'flash_sale', 'room', 'sort', 'status', 'created_at')->orderBy('sort')->orderBy('created_at', 'desc')->where('type', $request->type)->get();
        return view('backend.tours.index', compact('tours', 'type'));
    }

    public function destroyImage(Request $request)
    {
        $id = $request->id;
        $image = TourImages::find($id);
        $tour = $image->tour_id;
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
        $images = TourImages::where('tour_id', $tour)->get();
        return view('backend.tours.list_image', compact('images'));
    }


}
