<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\ProfileController;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Customers;
use App\Models\Images;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Image;
use Mockery\Exception;

class ProductsController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('fileItem')->where('status', 1)
                ->orderBy('created_at', 'desc')->paginate(16);

//            $products = Product::where('check_logo', 1)->where('id', '!=', 73)->get();
//
//            foreach ($products as $product) {
//                foreach ($product->images as $image) {
//                    $image = $image->name;
////                    $imagePath = public_path('images/uploads/products/' . $image);
////                    $image = Image::make($imagePath);
////                    $image = $image->insert(public_path('images/logo.png'), 'bottom-right', 25, 25);
////                    $image->insert(public_path('images/logo_2.png'), 'center', 0, 0);
////                    $image->save($imagePath);
//
////                    $imagethumbsPath = public_path('images/uploads/thumbs/' . $image);
////                    $image = Image::make($imagethumbsPath);
////                    $image = $image->insert(public_path('images/logo.png'), 'bottom-right', 25, 25);
////                    $image->insert(public_path('images/logo_2.png'), 'center', 0, 0);
////                    $image->save($imagethumbsPath);
////                    $product->check_logo = 0;
////                    $product->save();
//                }
//            }

            return view('frontend.products.index', compact('products'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back();
        }

    }

 public function productHot()
    {
        try {
            $products = Product::with('fileItem')->where('status', 1)->where('hot', 1)
                ->orderBy('created_at', 'desc')->paginate(16);

//            $products = Product::where('check_logo', 1)->where('id', '!=', 73)->get();
//
//            foreach ($products as $product) {
//                foreach ($product->images as $image) {
//                    $image = $image->name;
////                    $imagePath = public_path('images/uploads/products/' . $image);
////                    $image = Image::make($imagePath);
////                    $image = $image->insert(public_path('images/logo.png'), 'bottom-right', 25, 25);
////                    $image->insert(public_path('images/logo_2.png'), 'center', 0, 0);
////                    $image->save($imagePath);
//
////                    $imagethumbsPath = public_path('images/uploads/thumbs/' . $image);
////                    $image = Image::make($imagethumbsPath);
////                    $image = $image->insert(public_path('images/logo.png'), 'bottom-right', 25, 25);
////                    $image->insert(public_path('images/logo_2.png'), 'center', 0, 0);
////                    $image->save($imagethumbsPath);
////                    $product->check_logo = 0;
////                    $product->save();
//                }
//            }

            return view('frontend.products.product_hot', compact('products'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back();
        }

    }

    public function show($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();
            $category = Category::where('slug', $slug)->first();
            $product_relations = $images = [];
            if ($product && !$category || $product && $category) {
                $product_relations = Product::with('fileItem')->orderBy('id', 'desc')->inRandomOrder()
                    ->limit(8)->get();
                $images = Images::where('product_id', $product->id)->get();
                $product->view += 1;
                $product->save();
                if(count($product->category) == 0) {
                    $list_cat = CategoryProduct::select('products.*')->join('products', 'products.id', 'category_product.product_id')
                        ->join('categories', 'categories.id', 'category_product.category_id')
                        ->where('category_product.product_id', $product->id)->distinct()->get();
                }
                return view('frontend.products.detail', compact('product', 'category', 'product_relations', 'images'));
            }
            if (!$product && $category) {
                $products = CategoryProduct::select('products.*')->join('products', 'products.id', 'category_product.product_id')
                    ->join('categories', 'categories.id', 'category_product.category_id')
                    ->where('category_product.category_id', $category->id)->orderBy('products.created_at','desc')->distinct()->paginate(16);
                return view('frontend.products.category', compact('products', 'category'));
            }
            return view('frontend.products.detail', compact('product', 'category', 'product_relations', 'images'));

        } catch (Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back();
        }


    }

    public function category($category)
    {
        try {
            $category = Category::where('slug', $category)->first();
            $products = CategoryProduct::join('products', 'products.id', 'category_product.product_id')
                ->where('category_product.category_id', $category->id)->orderBy('created_at', 'desc')->distinct()->paginate(12);
            return view('frontend.products.category', compact('products', 'category'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back();
        }


    }

    public function filter(Request $request)
    {
        $type = $request->type;
        $name = $request->name;
        $cat = $request->cat;
        if ($name == 'price' && $type == 'asc') {
            if($cat === 'all') {
                $products = CategoryProduct::select('products.*')
                    ->join('products', 'products.id', 'category_product.product_id')
                    ->orderBy('products.sale', 'asc')->distinct()
                    ->limit(12)
                    ->get();
            } else {
                $products = CategoryProduct::select('products.*')
                    ->join('products', 'products.id', 'category_product.product_id')
                    ->join('categories', 'categories.id', 'category_product.category_id')
                    ->where('categories.slug', $cat)
                    ->orderBy('products.sale', 'asc')->distinct()
                    ->limit(12)
                    ->get();
            }

        }

        if ($name == 'price' && $type == 'desc') {
            if($cat === 'all') {
                $products = CategoryProduct::select('products.*')
                    ->join('products', 'products.id', 'category_product.product_id')
                    ->orderBy('products.sale', 'desc')->distinct()
                    ->limit(12)
                    ->get();
            } else {
                $products = CategoryProduct::select('products.*')
                    ->join('products', 'products.id', 'category_product.product_id')
                    ->join('categories', 'categories.id', 'category_product.category_id')
                    ->where('categories.slug', $cat)
                    ->orderBy('products.sale', 'desc')->distinct()
                    ->limit(12)
                    ->get();
            }
        }

        if ($name == 'products' && $type == 'new') {
            if($cat === 'all') {
                $products = CategoryProduct::select('products.*')
                    ->join('products', 'products.id', 'category_product.product_id')
                    ->orderBy('products.created_at', 'desc')->distinct()
                    ->limit(12)
                    ->get();
            } else {
                $products = CategoryProduct::select('products.*')
                    ->join('products', 'products.id', 'category_product.product_id')
                    ->join('categories', 'categories.id', 'category_product.category_id')
                    ->where('categories.slug', $cat)->distinct()
                    ->orderBy('products.created_at', 'desc')
                    ->limit(12)
                    ->get();
            }
        }


        return view('frontend.products.filter', compact('products'));
    }

    public function filterProduct(Request $request)
    {
        $types = explode('-', $request->type);
        $cat = $request->cat;
        $category = Category::where('slug', $cat)->first();
        if($cat === 'all') {
            $products = CategoryProduct::select('products.*')
                ->join('products', 'products.id', 'category_product.product_id')
                ->orderBy($types[0], $types[1])->distinct()
                ->get();
        } elseif(count($types) > 1) {
            $products = CategoryProduct::select('products.*', 'categories.slug as cat')
                ->join('products', 'products.id', 'category_product.product_id')
                ->join('categories', 'categories.id', 'category_product.category_id')
                ->where('categories.slug', $cat)
                ->orderBy($types[0], $types[1])->distinct()
                ->get();
        } else {
            $products = CategoryProduct::select('products.*')
                ->join('products', 'products.id', 'category_product.product_id')
                ->join('categories', 'categories.id', 'category_product.category_id')
                ->where('categories.slug', $cat)->distinct()
                ->get();
        }

        return view('frontend.products.product-filter', compact('products', 'category'));
    }

    public function filterProductPrice(Request $request)
    {
        $cat = $request->cat;
        if ($request->download == null || $request->download == 1) {
            $download = '!=';
        } elseif ($request->download == 0) {
            $download = '=';
        }
        if ($request->price) {
            $value = $request->price;
            if ($value == '<1') {
                $value = array(0, 100000);
            } elseif ($value == '1AND2') {
                $value = array(100000, 200000);
            } elseif ($value == '2AND3') {
                $value = array(200000, 300000);
            } elseif ($value == '3AND5') {
                $value = array(300000, 500000);
            } elseif ($value == '5AND10') {
                $value = array(500000, 1000000);
            } elseif ($value == '10AND20') {
                $value = array(1000000, 2000000);
            } elseif ($value == '20AND50') {
                $value = array(2000000, 5000000);
            } elseif ($value == '50AND100') {
                $value = array(5000000, 10000000);
            } elseif ($value == '>100') {
                $value = array(10000000, 20000000);
            } else {
                $value = array(0, 20000000);
            }
            if($cat !== 'all') {
                $products = CategoryProduct::select('products.*')
                    ->join('products', 'products.id', 'category_product.product_id')
                    ->join('categories', 'categories.id', 'category_product.category_id')
                    ->whereBetween('products.price', $value)
                    ->where('products.price', $download, 0)
                    ->where('categories.slug', $cat)
                    ->distinct()
                    ->orderBy('products.created_at','desc')
                    ->paginate(12);
            } else {
                $products = CategoryProduct::select('products.*')
                    ->join('products', 'products.id', 'category_product.product_id')
                    ->whereBetween('products.price', $value)
                    ->where('products.price', $download, 0)
                    ->distinct()
                    ->orderBy('products.created_at','desc')
                    ->paginate(12);
            }

        } elseif (!$request->price) {
            if($cat !== 'all') {
                $products = CategoryProduct::select('products.*')
                    ->join('products', 'products.id', 'category_product.product_id')
                    ->join('categories', 'categories.id', 'category_product.category_id')
                    ->where('products.price', $download, 0)
                    ->where('categories.slug', $cat)
                    ->distinct()
                    ->orderBy('products.created_at','desc')
                    ->paginate(12);
            } else {
                $products = CategoryProduct::select('products.*')
                    ->join('products', 'products.id', 'category_product.product_id')
                    ->where('products.price', $download, 0)
                    ->distinct()
                    ->orderBy('products.created_at','desc')
                    ->paginate(12);
            }

        }

        $category = Category::where('slug', $cat)->first();
        return view('frontend.products.product-filter', compact('products', 'category'));
    }

    public function quickView(Request $request)
    {
        $product = Product::find($request->id);
        return view('frontend.products.quick-view', compact('product'));
    }

    public function filterByCategory(Request $request)
    {
        $category = $request->category;
        if ($category == 'tat-ca-san-pham') {
            $products = Product::where('status', 1)->where('hot', 1)->limit(12)->orderBy('sort')->get();
        } else {
            $products = CategoryProduct::select('products.*')
                ->join('products', 'products.id', 'category_product.product_id')
                ->join('categories', 'categories.id', 'category_product.category_id')
                ->where('products.hot', 1)
                ->where('categories.slug', $category)
                ->distinct()
                ->orderBy('products.created_at', 'desc')
                ->limit(12)
                ->get();
        }

        return view('frontend.products.filter_category', compact('products', 'category'));
    }

    public function downloadProduct(Request $request) {
        try {
            $customer_id = auth()->guard('customer')->user()->id;
            $customer = Customers::find($customer_id);
            $product = Product::find($request->id);
            if($customer->point >= (int)$product->price) {
                $customer->point -= (int)$product->price;
                $customer->save();
                Order::create([
                    'user_id' => $customer_id,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'link_download' => $product->link_download,
                    'status' => 1,
                    'expired_at' => Carbon::now()->addDay(2)
                ]);
            } else {
                return redirect()->with('message-error', 'Số dư không khả dụng để download file');
            }
        } catch (Exception $e) {
            \Log::error($e->getMessage());

            return redirect()->with('message-error', 'Có lỗ khi download file, vui lòng thử lại sau!');
        }

	$link = str_replace(' ', '', $product->link_download);

        return redirect()->to(json_decode($link));
    }

}

