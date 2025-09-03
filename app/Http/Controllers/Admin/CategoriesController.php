<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use App\Models\FileItem;
use File;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories_admin = Categories::where('status', 1)->orderBy('sort')->get();
//        dd($categories_admin);
        return view('backend.categories.index', compact('categories_admin'));
    }

    public function sitemap()
    {
        $categories = Categories::get();

        return view('backend.categories.sitemap', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $categories = Categories::where('status', Categories::ACTIVE)->get();
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $path = "images/uploads/categories/";
        $image = $request->image;
        if ($request->image) {
            $extension = $image->extension();
            $file_name = Str::slug($name, '-') . time() .  '.' . $extension;
            $image->move($path . '/', $file_name);
        }

        $data = [
            'name' => $name,
            'parent_id' => 0,
            'image' => $file_name,
            'intro' => $request->intro,
            'slug' => Str::slug($name, '-'),
            'status' => $request->status,
            'sort' => $request->sort,
            'svg' => $request->svg,
            'link' => $request->link,
            'check' => $request->check,
        ];

        $validator = \Validator::make($data, [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('admin/categories/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            Categories::create($data);

            $categories = Categories::where('status', 1)->get();
            Cache::put('categories', $categories, 60);

            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::where('id', $id)->first();

        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;

        $data = [
            'name' => $name,
            'parent_id' => 0,
            'intro' => $request->intro,
            'slug' => Str::slug($name, '-'),
            'status' => $request->status,
            'sort' => $request->sort,
            'svg' => $request->svg,
            'link' => $request->link,
            'check' => $request->check,
        ];

        $validator = \Validator::make($data, [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $category = Categories::where('id', $id)->first();

            $path = "images/uploads/categories/";
            $image = $request->image;
            if ($image) {
                $pathImage = $path . '/' . $category->image;
                if($category->image != "" && File::exists($pathImage)) {
                    File::delete($pathImage);
                }

                $extension = $image->extension();
                $file_name = $data['slug'] . time() . '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $category->image = $file_name;
            }

            $category->name = $data['name'];
            $category->intro = $data['intro'];
            $category->slug = $data['slug'];
            $category->status = $data['status'];
            $category->sort = $data['sort'];
            $category->svg = $data['svg'];
            $category->link = $data['link'];
            $category->check = $data['check'];
            $category->save();

            return redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::find($id)->delete();


        return redirect()->route('categories.index');
    }


}
