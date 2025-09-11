<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\Comforts;
use App\Models\Contents;
use App\Models\HotelAreas;
use App\Models\HotelComforts;
use App\Models\HotelImages;
use App\Models\Hotels;
use App\Models\Images;
use App\Models\LocationAreas;
use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.hotels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        $locations = Locations::where('status', 1)->get();
        $listComfortHotel = Comforts::where('status', 1)->where('special', '!=', 1)->where('type', $type)->whereNotNull('parent_id')->get();
        $listComfortSpecial = Comforts::where('status', 1)->where('special', 1)->get();
        return view('backend.hotels.create', compact('locations', 'listComfortHotel', 'listComfortSpecial', 'type'));
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

        $request->validate([
            'name' => [
                'required',
                Rule::unique('hotels', 'name'),
            ],
            'title_seo' => [
                'required',
                Rule::unique('hotels', 'title_seo'),
            ],
            'slug' => [
                'required',
                Rule::unique('hotels', 'slug'),
            ],
//            'faqs' => 'array',
//            'faqs.*.question' => 'required|string|max:255',
//            'faqs.*.answer' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Tên khách sạn không được để trống.',
            'name.unique' => 'Tên khách sạn đã tồn tại.',
            'title_seo.required' => 'Tiêu đề SEO không được để trống.',
            'title_seo.unique' => 'Tiêu đề SEO này đã tồn tại.',
            'slug.required' => 'Đường dẫn (slug) không được để trống.',
            'slug.unique' => 'Đường dẫn (slug) này đã tồn tại.',
//            'faqs.*.question.required' => 'Câu hỏi không được để trống.',
//            'faqs.*.answer.required' => 'Câu trả lời không được để trống.',
        ]);

        $data = [
            'name' => $name,
            'location_id' => $request->location_id,
            'address' => ltrim($request->address),
            'video' => $request->video,
            'price' => $request->price,
            'sale' => $request->sale,
            'flash_sale' => $request->flash_sale,
            'description' => $request->description,
            'type' => \App\Models\Comforts::KS,
            'rate' => $request->rate,
            'stores' => $request->stores,
            'notes' => $request->notes,
            'list_comfort' => $request->list_comfort_text,
            'room' => $request->room ?? 0,
            'people' => $request->people,
            'people_min' => $request->people_min,
            'bedroom' => $request->bedroom,
            'bed' => $request->bed,
            'mattress' => $request->mattress,
            'bathroom' => $request->bathroom,
            'breakfast' => $request->breakfast,
            'cancel' => $request->cancel,
            'surcharge' => $request->surcharge,
            'type_room' => $request->type_room,
            'vat' => $request->vat,
            'sort' => $request->sort ?? 100,
            'status' => $request->status,
            'title_seo' => $request->title_seo,
            'slug' => $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->title_seo, '-'),
            'summary' => $request->summary,
            'user_update_id' => Auth::user()->id,
            'script' => $request->script,
            'alt' => $request->alt ?? null,
            'meta' => $request->meta ?? null,
        ];

        $list_comfort = [];
        $list_comfort = $request->input('list_comfort');
        $list_area = [];
        $list_area = $request->input('list_area');
        $list_comfort_special = [];
        $list_comfort_special = $request->input('list_comfort_special');
        $hotel = Hotels::create($data);

        try {
            \DB::beginTransaction();
            $image = $request->image;
            $name = $image->getClientOriginalName();
            $images[] = $name;
            $extensionImage = $image->extension();
            $image_name = "hotel_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
            $image->move('images/uploads/hotels/', $image_name);
            $pathImage = public_path('images/uploads/hotels/' . $image_name);
            $imageNew = Image::make($pathImage);
            $imageItem = [
                'hotel_id' => $hotel->id,
                'name' => $image_name,
                'mime' => $image->getClientMimeType(),
                'path' => 'hotels',
            ];
            $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
            $widthImg = $imageNew->width();
            $heightImg = $imageNew->height();
            $wResize = Contents::WIDTH_THUMBS;
            $hResize = ($wResize * $heightImg) / $widthImg;
            $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
            HotelImages::create($imageItem);

            $images = array();
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                $alts = $request->input('alts', []);
                $titles = $request->input('titles', []);
                foreach ($files as $index => $item) {
                    $name = $item->getClientOriginalName();
                    $images[] = $name;
                    $extensionImage = $item->extension();
                    $image_name = "hotel_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                    $item->move('images/uploads/hotels/', $image_name);
                    $pathImage = public_path('images/uploads/hotels/' . $image_name);
                    $imageNew = Image::make($pathImage);
                    $imageItem = [
                        'hotel_id' => $hotel->id,
                        'name' => $image_name,
                        'mime' => $item->getClientMimeType(),
                        'path' => 'hotels',
                        'alt' => $alts[$index] ?? null,
                        'meta' => $titles[$index] ?? null,
                    ];
                    $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                    $widthImg = $imageNew->width();
                    $heightImg = $imageNew->height();
                    $wResize = Contents::WIDTH_THUMBS;
                    $hResize = ($wResize * $heightImg) / $widthImg;
                    $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                    HotelImages::create($imageItem);
                }
            }

            if (!empty($list_comfort)) {
                foreach ($list_comfort as $item => $value) {
                    $data = [
                        'hotel_id' => $hotel->id,
                        'comfort_id' => $value,
                    ];
                    $cat = HotelComforts::create($data);
                }
            }

            if (!empty($list_comfort_special)) {
                foreach ($list_comfort_special as $item => $value) {
                    $data = [
                        'hotel_id' => $hotel->id,
                        'comfort_id' => $value,
                    ];
                    $cat = HotelComforts::create($data);
                }
            }

            if (!empty($list_area)) {
                foreach ($list_area as $item => $value) {
                    $data = [
                        'hotel_id' => $hotel->id,
                        'area_id' => $value,
                    ];
                    HotelAreas::create($data);
                }
            }


            \DB::commit();
            return redirect()->route('hotels.listAll', ['type' => Comforts::KS])->with('message-success', 'Thêm mới khách sạn thành công!');
        } catch (\Exception $e) {
            dd($e);
            \Log::error($e->getMessage());
            \DB::rollback();
            return redirect()->back()->withInput()->with('message-error', 'Lỗi khi tạo, vui lòng thử lại sau!');
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
        $hotel = Hotels::with('images')->find($id);
        $locations = Locations::where('status', 1)->get();
        $listComfortHotel = Comforts::where('status', 1)->where('type', $hotel->type)->where('special', '!=', 1)->whereNotNull('parent_id')->get();
        $listComfortSpecial = Comforts::where('status', 1)->where('special', 1)->get();
        $comfort_hotels = HotelComforts::where('hotel_id', $id)->pluck('comfort_id')->toArray();
        $hotel_areas = HotelAreas::where('hotel_id', $hotel->id)->pluck('area_id')->toArray();
        $listArea = Areas::whereIn('id', $hotel_areas)->get();
        return view('backend.hotels.edit', compact('hotel', 'listComfortHotel', 'listComfortSpecial', 'locations', 'comfort_hotels', 'listArea'));
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
        $hotel = Hotels::find($id);
        $list_comfort = [];
        $list_comfort = $request->input('list_comfort');
        $list_comfort_special = [];
        $list_comfort_special = $request->input('list_comfort_special');
        $list_area = [];
        $list_area = $request->input('list_area');

        $data = [
            'name' => $request->name,
            'location_id' => $request->location_id,
            'title_seo' => $request->title_seo,
            'slug' => $request->slug ?  Str::slug($request->slug, '-') : Str::slug($request->title_seo, '-'),
            'summary' => $request->summary,
            'address' => ltrim($request->address),
            'video' => $request->video,
            'price' => $request->price,
            'sale' => $request->sale,
            'flash_sale' => $request->flash_sale,
            'description' => $request->description,
            'type' => \App\Models\Comforts::KS,
            'rate' => $request->rate,
            'stores' => $request->stores,
            'notes' => $request->notes,
            'list_comfort' => $request->list_comfort_text,
            'room' => $request->room ?? 0,
            'people' => $request->people,
            'people_min' => $request->people_min,
            'bedroom' => $request->bedroom,
            'bed' => $request->bed,
            'mattress' => $request->mattress,
            'bathroom' => $request->bathroom,
            'breakfast' => $request->breakfast,
            'cancel' => $request->cancel,
            'surcharge' => $request->surcharge,
            'vat' => $request->vat,
            'sort' => $request->sort ?? 100,
            'status' => $request->status,
            'script' => $request->script,
            'alt' => $request->alt,
            'meta' => $request->meta,
        ];

        $request->validate([
            'name' => [
                'required',
                Rule::unique('hotels', 'name')->ignore($hotel->id),
            ],
            'title_seo' => [
                'required',
                Rule::unique('hotels', 'title_seo')->ignore($hotel->id),
            ],
            'slug' => [
                'required',
                Rule::unique('hotels', 'slug')->ignore($hotel->id),
            ],
        ], [
            'name.required' => 'Tên khách sạn không được để trống.',
            'name.unique' => 'Tên khách sạn đã tồn tại.',
            'title_seo.required' => 'Tiêu đề SEO không được để trống.',
            'title_seo.unique' => 'Tiêu đề SEO này đã tồn tại.',
            'slug.required' => 'Đường dẫn (slug) không được để trống.',
            'slug.unique' => 'Đường dẫn (slug) này đã tồn tại.',
        ]);

        $hotel_comfort = HotelComforts::where('hotel_id', $id)->pluck('comfort_id')->toArray();
        $hotel_area = HotelAreas::where('hotel_id', $id)->pluck('area_id')->toArray();

        if ($list_comfort) {
            if (empty($list_comfort_special)) {
                $list_comfort_special = [];
            }
            $list_comfort = array_merge($list_comfort, $list_comfort_special);
            $idDel = array_diff($hotel_comfort, $list_comfort);

            $idAdd = array_diff($list_comfort, $hotel_comfort);
            foreach ($idAdd as $item => $value) {
                $datas = [
                    'comfort_id' => $value,
                    'hotel_id' => $id,
                ];
                HotelComforts::create($datas);
            }
            HotelComforts::where('hotel_id', $hotel->id)->whereIn('comfort_id', $idDel)->delete();
        }

        if (!empty($list_area)) {
            $idDel = array_diff($hotel_area, $list_area);
            $idAdd = array_diff($list_area, $hotel_area);
            foreach ($idAdd as $item => $value) {
                $datas = [
                    'area_id' => $value,
                    'hotel_id' => $id,
                ];
                HotelAreas::create($datas);
            }
            HotelAreas::where('hotel_id', $hotel->id)->whereIn('area_id', $idDel)->delete();
        } else {
            HotelAreas::where('hotel_id', $hotel->id)->delete();
        }

        try {
            \DB::beginTransaction();
            $image = $request->image;
            $imageOld = HotelImages::where('hotel_id', $hotel->id)->first();

            if ($image && $imageOld) {
                $name = $image->getClientOriginalName();
                $images[] = $name;
                $extensionImage = $image->extension();
                $image_name = "hotel_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                $pathImage = public_path('images/uploads/hotels/' . $image_name);
                $imageItem = [
                    'hotel_id' => $hotel->id,
                    'name' => $image_name,
                    'mime' => $image->getClientMimeType(),
                    'size' => $image->getSize(),
                    'path' => 'hotels'
                ];
                $image->move('images/uploads/hotels/', $image_name);

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
                    $image_name = "hotel_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                    $pathImage = public_path('images/uploads/hotels/' . $image_name);
                    $imageItem = [
                        'hotel_id' => $hotel->id,
                        'name' => $image_name,
                        'mime' => $item->getClientMimeType(),
                        'size' => $item->getSize(),
                        'path' => 'hotels',
                        'alt' => $altsNew[$index] ?? null,
                        'meta' => $titlesNew[$index] ?? null,
                    ];
                    $item->move('images/uploads/hotels/', $image_name);

                    //Create thumbs
                    $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                    $imageNew = Image::make($pathImage);
                    $widthImg = $imageNew->width();
                    $heightImg = $imageNew->height();
                    $wResize = Contents::WIDTH_THUMBS;
                    $hResize = ($wResize * $heightImg) / $widthImg;
                    $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                    HotelImages::create($imageItem);
                }
            } else {
                // Chỉ update alt/meta cho ảnh cũ nếu không có file mới
                foreach ($request->input('alts', []) as $id => $alt) {
                    $image = HotelImages::find($id);
                    if ($image) {
                        $image->alt = $alt;
                        $image->meta = $request->input('titles.' . $id);
                        $image->save();
                    }
                }
            }

            $hotel->update($data);
            $hotel->save();

            \DB::commit();
            return redirect()->route('hotels.listAll', ['type' => Comforts::KS])->with('message-success', 'Cập nhật khách sạn thành công!');
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
            $hotel = Hotels::find($id);
            if ($hotel) {
                foreach ($hotel->images as $image) {
                    $filePath = public_path('images/uploads/' . $image->path . '/' . $image->name);
                    $thumbPath = public_path('images/uploads/thumbs/' . $image->name);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    if (File::exists($thumbPath)) {
                        File::delete($thumbPath);
                    }
                }
                HotelImages::where('hotel_id', $id)->delete();
                HotelComforts::where('hotel_id', $id)->delete();
                HotelAreas::where('hotel_id', $id)->delete();
                $hotel->delete();
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
        $hotels = Hotels::select('id', 'name', 'address', 'price', 'sale', 'flash_sale', 'room', 'sort', 'status', 'created_at')->orderBy('sort')->orderBy('created_at', 'desc')->where('type', $request->type)->get();
        return view('backend.hotels.index', compact('hotels', 'type'));
    }

    public function destroyImage(Request $request)
    {
        $id = $request->id;
        $image = HotelImages::find($id);
        $hotel = $image->hotel_id;
        if (empty($image)) {
            return redirect()->back();
        }
        $filePath = public_path('images/uploads/' . $image->path . '/' . $image->name);
        $thumbPath = public_path('images/uploads/thumbs/' . $image->name);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        if (File::exists($thumbPath)) {
            File::delete($thumbPath);
        }
        $image->delete();
        $images = HotelImages::where('hotel_id', $hotel)->get();
        return view('backend.hotels.list_image', compact('images'));
    }


}
