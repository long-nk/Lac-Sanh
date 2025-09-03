<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApprovedProduct;
use App\Mail\UnApprovedOrder;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Customers;
use App\Models\FileItem;
use App\Models\Hotels;
use App\Models\Images;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductTypes;
use App\Models\TypeFiles;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Image;

class ProductsController extends Controller
{
    public function index()
    {
        $products = CategoryProduct::with('fileItem', 'category')
            ->orderBy('category_id')->get();
        $files = scandir(public_path('/images/uploads/products'));

        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            $exits = FileItem::where('name', $file)->exists();
            if (!$exits) {
                $filePath = public_path('images/uploads/products/' . $file);
                $thumpPath = public_path('images/uploads/thumbs/' . $file);

                if (File::exists($filePath)) {
                    unlink($filePath);
                }
                if (File::exists($thumpPath)) {
                    unlink($thumpPath);
                }
            }

        }

        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_category = Category::where('status', 1)->where('parent_id', '!=', 0)->get();
        return view('backend.products.create', compact('list_category'));
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
            'user_id' => $request->user_id,
            'slug' => str_slug($name, '-'),
            'status' => $request->status,
            'image' => $request->image,
            'intro' => $request->intro,
            'decription' => $request->decription,
            'price' => $request->price ?? 0,
            'sort' => $request->sort ?? 1,
            'link_download' => json_encode($request->link_download),
            'hot' => $request->hot,
            'check_price' => $request->check_price
        ];
        $list_cat = [];
        $list_type = [];
        $list_cat = $request->input('list_category');
        $list_type = $request->input('list_type');
        $product = Product::create($data);

        $file = $request->image;

        if (!$file) {
            return redirect()->back();
        }

        $extension = $file->extension();

        $file_name = "file_cnc3mien_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extension;

        $fileItem = [
            'product_id' => $product->id,
            'file' => $file_name,
            'mime' => $file->getClientMimeType(),
            'path' => 'products'
        ];
        $file->move('images/uploads/products/', $fileItem['file']);
        $pathImage = public_path('images/uploads/products/' . $file_name);
        $thumbsPathImage = public_path('images/uploads/thumbs/' . $file_name);
        $image = Image::make($pathImage);
        $image->insert(public_path('images/logo.png'), 'bottom-right', 15, 15);
        $image->insert(public_path('images/logo_2.png'), 'center', 0, 0);
        $image->save($pathImage);
        $widthImg = $image->width();
        $heightImg = $image->height();
        $wResize = Product::WIDTH_THUMBS;
        $hResize = ($wResize * $heightImg) / $widthImg;
        $image->resize($wResize, $hResize)->save($thumbsPathImage);
        $product->image = $fileItem['file'];
        $product->save();

        $validator = \Validator::make($data, [
            'name' => 'required|max:255',
        ]);

        $category = '';
        if ($validator->fails()) {
            return redirect('admin/products/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            try {
                \DB::beginTransaction();
                $images = array();
                if ($request->hasFile('images')) {
                    $files = $request->file('images');
                    foreach ($files as $item) {
                        $name = $item->getClientOriginalName();
                        $images[] = $name;
                        $extensionImage = $item->extension();
                        $image_name = "file_cnc3mien" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                        $item->move('images/uploads/products/', $image_name);
                        $pathImage = public_path('images/uploads/products/' . $image_name);
                        $imageNew = Image::make($pathImage);
                        $imageNew->insert(public_path('images/logo.png'), 'bottom-right', 15, 15);
                        $imageNew->insert(public_path('images/logo_2.png'), 'center', 0, 0);
                        $imageNew->save($pathImage);
                        $imageItem = [
                            'product_id' => $product->id,
                            'name' => $image_name,
                            'mime' => $item->getClientMimeType(),
                            'path' => 'products'
                        ];
                        $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                        $widthImg = $imageNew->width();
                        $heightImg = $imageNew->height();
                        $wResize = Product::WIDTH_THUMBS;
                        $hResize = ($wResize * $heightImg) / $widthImg;
                        $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                        Images::create($imageItem);
                    }
                }

                $imagePath = public_path('images/uploads/products/' . $file_name);

                //Create thumbs
                $thumbsPath = public_path('images/uploads/thumbs/' . $file_name);
                $image = Image::make($imagePath);
                $image->insert(public_path('images/logo.png'), 'bottom-right', 15, 15);
                $image->insert(public_path('images/logo_2.png'), 'center', 0, 0);
                $image->save($thumbsPath);
                $widthImg = $image->width();
                $heightImg = $image->height();
                $wResize = Product::WIDTH_THUMBS;
                $hResize = ($wResize * $heightImg) / $widthImg;
                $image->resize($wResize, $hResize)->save($thumbsPath);

                foreach ($list_cat as $item => $value) {
                    $category = Category::find($value)->parent();
                    if ($category) {
                        CategoryProduct::create([
                            'product_id' => $product->id,
                            'category_id' => $category->id,
                        ]);
                    }
                    if($category && $category->parent()) {
                        CategoryProduct::create([
                            'product_id' => $product->id,
                            'category_id' => $category->parent()->id,
                        ]);
                    }
                    $data = [
                        'product_id' => $product->id,
                        'category_id' => $value,
                    ];
                    $cat = CategoryProduct::create($data);
                    $category = Category::find($value);
                }
                if (count($list_type) > 0) {
                    foreach ($list_type as $item => $value) {
                        $data = [
                            'product_id' => $product->id,
                            'type_id' => $value,
                        ];
                        ProductTypes::create($data);
                    }
                }
                \DB::commit();
                return redirect()->route('products.list', ['slug' => $category->slug]);
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                \DB::rollback();
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::join('category_product', 'products.id', '=', 'category_product.product_id')
            ->where('category_product.product_id', $id)->first();
        $cat_pro = CategoryProduct::where('product_id', $id)->pluck('category_id')->toArray();
        $type_pro = ProductTypes::where('product_id', $id)->pluck('type_id')->toArray();
        $list_category = Category::where('status', 1)->get();
        $images = Images::where('product_id', $id)->get();
        return view('backend.products.edit', compact('product', 'cat_pro', 'list_category', 'type_pro', 'images'));
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
        if ($request->name == "") {
            $name = 'Product';
        } else {
            $name = $request->name;
        }
        $product = Product::join('category_product', 'products.id', '=', 'category_product.product_id')
            ->where('category_product.product_id', $id)->first();
        $list_cat = [];
        $list_cat = $request->input('list_category');
        $list_type = [];
        $list_type = $request->input('list_type');

        $file_item = DB::table('file_items')->where('product_id', $product->id);

//        if ($product->id) {
        $data = [
            'name' => $name,
            'user_id' => $request->user_id,
            'slug' => str_slug($name, '-'),
            'status' => $request->status,
            'image' => $request->image,
            'intro' => $request->intro ?? null,
            'decription' => $request->decription ?? null,
            'price' => $request->price ?? 0,
            'sort' => $request->sort ?? 1,
            'link_download' => json_encode($request->link_download),
            'hot' => $request->hot,
            'check_price' => $request->check_price
        ];
        $category_pro = CategoryProduct::where('product_id', $id)->pluck('category_id')->toArray();
        if ($list_cat) {
            $idDel = array_diff($category_pro, $list_cat);
            foreach ($idDel as $cat) {
                $cat = Category::find($cat);
                if ($cat->parent() && in_array($cat->parent()->id, $category_pro)) {
                    $idDel[] = array_push($idDel, $cat->parent()->id);
                }
                $catParent = Category::find($cat->parent()->id);
                if($catParent->parent()->id) {
                    $idDel[] = array_push($idDel, $catParent->parent()->id);
                }
            }
            $idAdd = array_diff($list_cat, $category_pro);
            foreach ($idAdd as $item => $value) {
                $category = Category::find($value)->parent();
                if ($category) {
                    CategoryProduct::create([
                        'product_id' => $product->id,
                        'category_id' => $category->id,
                    ]);
                }
                if ($category->parent()) {
                    CategoryProduct::create([
                        'product_id' => $product->id,
                        'category_id' => $category->parent()->id,
                    ]);
                }
                $data = [
                    'product_id' => $product->id,
                    'category_id' => $value,
                ];
                $cat = CategoryProduct::create($data);
                $category = Category::find($value);
            }
            CategoryProduct::where('product_id', $product->id)->whereIn('category_id', $idDel)->delete();
        }

        $type_pro = ProductTypes::where('product_id', $id)->pluck('type_id')->toArray();
        if ($list_type) {
            $idDel = array_diff($type_pro, $list_type);
            $idAdd = array_diff($list_type, $type_pro);
            foreach ($idAdd as $item => $value) {
                $datas = [
                    'type_id' => $value,
                    'product_id' => $id,
                ];
                ProductTypes::create($datas);
            }
            ProductTypes::where('product_id', $product->product_id)->whereIn('type_id', $idDel)->delete();
        }


        $file = $request->image;
        try {
            \DB::beginTransaction();

            if ($file) {
                //Remove old image
                if (isset($file_item->path)) {
                    $filePath = public_path('images/uploads/' . $file_item->path . '/' . $file_item->file);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    //Remove old image
                    $thumbsPath = public_path('images/uploads/thumbs/' . $file_item->file);
                    if (File::exists($thumbsPath)) {
                        File::delete($thumbsPath);
                    }
                }
                $images = array();
                if ($request->hasFile('images')) {
                    $files = $request->file('images');
                    foreach ($files as $item) {
                        $name = $item->getClientOriginalName();
                        $images[] = $name;
                        $extensionImage = $item->extension();
                        $image_name = "san_pham_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                        $pathImage = public_path('images/uploads/products/' . $image_name);
                        $imageItem = [
                            'product_id' => $product->id,
                            'name' => $image_name,
                            'mime' => $item->getClientMimeType(),
                            'size' => $item->getSize(),
                            'path' => 'products'
                        ];
                        $item->move('images/uploads/products/', $image_name);

                        //Create thumbs
                        $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                        $imageNew = Image::make($pathImage);
                        $imageNew->insert(public_path('images/logo.png'), 'bottom-right', 15, 15);
                        $imageNew->insert(public_path('images/logo_2.png'), 'center', 0, 0);
                        $imageNew->save($pathImage);
                        $widthImg = $imageNew->width();
                        $heightImg = $imageNew->height();
                        $wResize = Product::WIDTH_THUMBS;
                        $hResize = ($wResize * $heightImg) / $widthImg;
                        $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                        Images::create($imageItem);
                    }
                }

                $extension = $file->extension();
                $file_name = "san_pham_" . $product->slug . "_" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extension;

                $fileItem = [
                    'product_id' => $id,
                    'file' => $file_name,
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                    'path' => 'products'
                ];

                $file->move('images/uploads/products/', $fileItem['file']);

                $imagePath = public_path('images/uploads/products/' . $file_name);

                //Create thumbs
                $thumbsPath = public_path('images/uploads/thumbs/' . $file_name);
                $image = Image::make($imagePath);
                $image->insert(public_path('images/logo.png'), 'bottom-right', 15, 15);
                $image->insert(public_path('images/logo_2.png'), 'center', 0, 0);
                $image->save($pathImage);
                $widthImg = $image->width();
                $heightImg = $image->height();
                $wResize = Product::WIDTH_THUMBS;
                $hResize = ($wResize * $heightImg) / $widthImg;
                $image->resize($wResize, $hResize)->save($thumbsPath);

                if (isset($file_item->path)) {
                    $file = FileItem::find($file_item->id);
                    $file->file = $fileItem['file'];
                    $file->mime = $fileItem['mime'];
                    $file->size = $fileItem['size'];
                    $file->path = $fileItem['path'];
                    $file->save();
                    $product = Product::find($product->id);
                    $product->name = $data['name'];
                    $product->slug = $data['slug'];
                    $product->status = $data['status'];
                    $product->image = $file['file'];
                    $product->intro = $data['intro'];
                    $product->decription = $data['decription'];
                    $product->price = $data['price'];
                    $product->sort = $data['sort'];
                    $product->hot = $data['hot'];
                    $product->link_download = $data['link_download'];
                    $product->check_price = $data['check_price'];
                    $product->save();

                } else {
                    $file = FileItem::create($fileItem);
                    $product = Product::find($id);
                    $product->name = $data['name'];
                    $product->slug = $data['slug'];
                    $product->status = $data['status'];
                    $product->image = $fileItem['file'];
                    $product->intro = $data['intro'];
                    $product->decription = $data['decription'];
                    $product->price = $data['price'];
                    $product->sort = $data['sort'];
                    $product->link_download = $data['link_download'];
                    $product->hot = $data['hot'];
                    $product->check_price = $data['check_price'];
                    $product->save();

                }
            }
            $product = Product::find($id);
            $product->name = $data['name'];
            $product->slug = $data['slug'];
            $product->status = $data['status'];
//                $product->image = $file['file'];
            $product->intro = $data['intro'];
            $product->decription = $data['decription'];
            $product->price = $data['price'];
            $product->sort = $data['sort'];
            $product->link_download = $data['link_download'];
            $product->hot = $data['hot'];
            $product->check_price = $data['check_price'];
            $product->save();

            $images = array();
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach ($files as $item) {
                    $name = $item->getClientOriginalName();
                    $images[] = $name;
                    $extensionImage = $item->extension();
                    $image_name = "file_cnc3mien" . rand(10000, mt_getrandmax()) . '_' . rand(10000, mt_getrandmax()) . '.' . $extensionImage;
                    $item->move('images/uploads/products/', $image_name);
                    $pathImage = public_path('images/uploads/products/' . $image_name);
                    $imageNew = Image::make($pathImage);
                    $imageNew->insert(public_path('images/logo.png'), 'bottom-right', 15, 15);
                    $imageNew->insert(public_path('images/logo_2.png'), 'center', 0, 0);
                    $imageNew->save($pathImage);
                    $imageItem = [
                        'product_id' => $product->id,
                        'name' => $image_name,
                        'mime' => $item->getClientMimeType(),
                        'path' => 'products'
                    ];
                    $thumbsPathImage = public_path('images/uploads/thumbs/' . $image_name);
                    $widthImg = $imageNew->width();
                    $heightImg = $imageNew->height();
                    $wResize = Product::WIDTH_THUMBS;
                    $hResize = ($wResize * $heightImg) / $widthImg;
                    $imageNew->resize($wResize, $hResize)->save($thumbsPathImage);
                    Images::create($imageItem);
                }
            }
            $category = CategoryProduct::where('product_id', $product->id)->first();
            $category = Category::find($category->category_id);
            \DB::commit();
            return redirect()->route('products.list', ['slug' => $category->slug]);
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            \DB::rollback();
            return redirect()->back();

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
            $product = CategoryProduct::find($id);
            $category = Category::find($product->category_id);
            $products = CategoryProduct::where('product_id', $product->product_id)->get();
            Product::find($product->product_id)->delete();
            if(!empty($products)) {
                $products->each->delete();
            }
            $images = Images::where('product_id', $product->product_id)->get();
            if(!empty($images)) {
                $images->each->delete();
            }
            $productTypes = ProductTypes::where('product_id', $product->product_id)->get();
            if(!empty($productTypes)) {
                $productTypes->each->delete();
            }
            \DB::commit();
            return redirect()->route('products.list', ['slug' => $category->slug]);
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            \DB::rollback();

            return redirect()->route('dashboard');
        }
    }

    public function list_all($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = Hotels::where('type', $category->id)->get();
        if ($products) {
            return view('backend.products.products_category', compact('products', 'category'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function productPending() {
        $products = Product::whereNull('status')->orWhere('status', 2)->orderBy('status', 'desc')->get();
        return view('backend.products.products_pending', compact('products'));
    }


}
