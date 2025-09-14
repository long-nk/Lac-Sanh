<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comforts;
use App\Models\Contents;
use App\Models\HotelAreas;
use App\Models\HotelComforts;
use App\Models\HotelImages;
use App\Models\Locations;
use App\Models\TourImages;
use App\Models\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
        $locations = Locations::where('status', 1)->orderBy('sort')->orderBy('region')->get();
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
            'status' => $request->status,
            'title_seo' => $request->title_seo,
            'slug' => $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->title_seo, '-'),
            'summary' => $request->summary,
            'user_update_id' => Auth::user()->id,
            'script' => $request->script,
            'alt' => $request->alt ?? null,
            'meta' => $request->meta ?? null,
            'hot' => $request->hot ?? null
        ];

        $request->validate([
            'name' => [
                'required',
                Rule::unique('tours', 'name'),
            ],
            'title_seo' => [
                'required',
                Rule::unique('tours', 'title_seo'),
            ],
            'slug' => [
                'required',
                Rule::unique('tours', 'slug'),
            ],
//            'faqs' => 'array',
//            'faqs.*.question' => 'required|string|max:255',
//            'faqs.*.answer' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Tên tour không được để trống.',
            'name.unique' => 'Tên tour đã tồn tại.',
            'title_seo.required' => 'Tiêu đề SEO không được để trống.',
            'title_seo.unique' => 'Tiêu đề SEO này đã tồn tại.',
            'slug.required' => 'Đường dẫn (slug) không được để trống.',
            'slug.unique' => 'Đường dẫn (slug) này đã tồn tại.',
//            'faqs.*.question.required' => 'Câu hỏi không được để trống.',
//            'faqs.*.answer.required' => 'Câu trả lời không được để trống.',
        ]);

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
                'path' => 'tours',
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
                $alts = $request->input('alts', []);
                $titles = $request->input('titles', []);
                foreach ($files as $index => $item) {
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
                        'path' => 'tours',
                        'alt' => $alts[$index] ?? null,
                        'meta' => $titles[$index] ?? null,
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
        $tour = Tours::with('images')->find($id);
        $locations = Locations::where('status', 1)->orderBy('sort')->orderBy('region')->get();
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
            'title_seo' => $request->title_seo,
            'slug' => $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->title_seo, '-'),
            'summary' => $request->summary,
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
            'status' => $request->status,
            'script' => $request->script,
            'alt' => $request->alt,
            'meta' => $request->meta,
            'hot' => $request->hot ?? null
        ];

        $request->validate([
            'name' => [
                'required',
                Rule::unique('tours', 'name')->ignore($tour->id),
            ],
            'title_seo' => [
                'required',
                Rule::unique('tours', 'title_seo')->ignore($tour->id),
            ],
            'slug' => [
                'required',
                Rule::unique('tours', 'slug')->ignore($tour->id),
            ],
        ], [
            'name.required' => 'Tên tour không được để trống.',
            'name.unique' => 'Tên tour đã tồn tại.',
            'title_seo.required' => 'Tiêu đề SEO không được để trống.',
            'title_seo.unique' => 'Tiêu đề SEO này đã tồn tại.',
            'slug.required' => 'Đường dẫn (slug) không được để trống.',
            'slug.unique' => 'Đường dẫn (slug) này đã tồn tại.',
        ]);

        try {
            \DB::beginTransaction();
            $image = $request->image;
            $imageOld = TourImages::where('tour_id', $tour->id)->first();

            if ($image && $imageOld) {
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
                    'path' => 'tours',
                    'alt' => $request->alt ?? null,
                    'meta' => $request->meta ?? null,
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
                $altsNew = $request->input('alts_new', []);
                $titlesNew = $request->input('titles_new', []);
                foreach ($files as $index => $item) {
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
                        'path' => 'tours',
                        'alt' => $altsNew[$index] ?? null,
                        'meta' => $titlesNew[$index] ?? null,
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
            } else {
                // Chỉ update alt/meta cho ảnh cũ nếu không có file mới
                foreach ($request->input('alts', []) as $id => $alt) {
                    $image = TourImages::find($id);
                    if ($image) {
                        $image->alt = $alt;
                        $image->meta = $request->input('titles.' . $id);
                        $image->save();
                    }
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
            if ($tour) {
                foreach ($tour->images as $image) {
                    $filePath = public_path('images/uploads/' . $image->path . '/' . $image->name);
                    $thumbPath = public_path('images/uploads/thumbs/' . $image->name);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    if (File::exists($thumbPath)) {
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
        try {
            $id = $request->id;
            $image = TourImages::find($id);
            $tour = $image->tour_id;
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
            $images = TourImages::where('tour_id', $tour)->get();
            return view('backend.tours.list_image', compact('images'));
        } catch(\Exception $e) {
            \Log::error('Lỗi khi xóa ảnh tour: ' . $e->getMessage());
            return redirect()->back();
        }
    }


}
