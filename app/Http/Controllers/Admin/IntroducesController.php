<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\Introduces;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IntroducesController extends Controller
{
    public function index()
    {
        $content = Introduces::first();
        if(!$content) {
            return redirect()->route('introduces.create');
        }
        return view('backend.introduces.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.introduces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'title' => 'Giới thiệu',
            'content' => $request->get('content'),
            'status' => $request->get('status'),
        ];

        $validator = \Validator::make($data, [
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            try {
                \DB::beginTransaction();

                $data['slug'] = Str::slug($data['title'], '-');
                $content = Introduces::create($data);

                \DB::commit();

                return redirect()->route('introduces.index');
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                \DB::rollback();
            }
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
        $content = Introduces::find($id);
        return view('backend.introduces.edit', compact('content'));
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
        $data = [
            'title' => 'Giới thiệu',
            'content' => $request->get('content'),
            'status' => $request->get('status')
        ];

        $validator = \Validator::make($data, [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            try {
                \DB::beginTransaction();

                $content = Introduces::where('id', $id)->first();

                $content->title = $data['title'];
                $content->slug = Str::slug($data['title'], '-');
                $content->content = $data['content'];
                $content->status = $data['status'];
                $content->save();

                \DB::commit();
                return redirect()->route('introduces.index');
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                \DB::rollback();
            }
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
        $content = Introduces::find($id);

        if (empty($content)) {
            return redirect()->back();
        }
        $content->delete();
        return redirect()->back();
    }
}
