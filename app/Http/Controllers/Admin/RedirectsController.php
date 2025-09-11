<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redirects;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Image;
use Mockery\Exception;

class RedirectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redirectList = Redirects::orderBy('sort')->get();

        return view('backend.redirects.index', compact('redirectList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.redirects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = [
                'link' => $request->link,
                'redirect' => $request->redirect,
                'user_id' => Auth::user()->id,
                'user_update_id' => Auth::user()->id,
                'sort' => (int) ($request->get('sort') ?? 1),
                'status' => $request->status,
            ];

            Redirects::create($data);
            return redirect()->route('redirects.index')->with('message-success', 'Thêm mới thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('message-error' . $e->getMessage());
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
        $redirect = Redirects::find($id);
        return view('backend.redirects.edit', compact('redirect'));
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
        try {
            DB::beginTransaction();

            $redirect = Redirects::find($id);
            if(!isset($redirect)){
                throw new Exception("Not found!");
            }

            $redirect->link = $request->link;
            $redirect->redirect = $request->redirect;
            $redirect->user_update_id = Auth::user()->id;
            $redirect->sort = $request->sort;
            $redirect->status = $request->status;
            $redirect->save();

            DB::commit();
            return redirect()->route('redirects.index')->with('message-success', 'Cập nhật thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->withInput()->with('message-error', $e->getMessage());
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
        try {
            $redirect = Redirects::find($id);
            if (empty($redirect)) {
                return redirect()->back()->withInput()->with('message-error', 'Không tìm thấy redirect');
            }
            $redirect->delete();
            return redirect()->back()->with('message-success', 'Xóa thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi xóa redirect', $e->getMessage());
            return redirect()->back()->with('message-error', $e->getMessage());
        }
    }
}
