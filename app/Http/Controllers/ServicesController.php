<?php

namespace App\Http\Controllers;

use App\Models\Content;

class ServicesController extends Controller
{
    public function index()
    {
        $contents = Content::with('fileItem')->where('content_div', 2)->paginate(12);

        return view('frontend.services.index', compact('contents'));
    }
}
