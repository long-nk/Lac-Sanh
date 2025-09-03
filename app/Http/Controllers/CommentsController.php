<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function filter(Request $request) {
        try {
            $filter = $request->filter;
            $hotel = $request->hotel;
            $type = $request->type;
            if($filter == 'new') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->orderBy('created_at', 'desc')->get();
            } elseif($filter == 'old') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->orderBy('created_at', 'asc')->get();
            } elseif ($filter == 'min') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->orderBy(DB::raw("CAST(rate AS DECIMAL(10, 2))"), 'asc')->get();
            } elseif ($filter == 'max') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->orderBy(DB::raw("CAST(rate AS DECIMAL(10, 2))"), 'desc')->get();
            } elseif ($filter == 'all') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->orderBy('created_at', 'desc')->get();
            } elseif ($filter == '5') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->where(DB::raw('CAST(rate AS DECIMAL(10, 2))'), '>=', 9.5)->get();
            } elseif ($filter == '4') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->where('rate', '>=', 9)->where(DB::raw("CAST(rate AS DECIMAL)"), '<', 9.5)->get();
            } elseif ($filter == '3') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->where('rate', '>=', 8)->where('rate', '<', 9)->get();
            } elseif ($filter == '2') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->where('rate', '>=', 7)->where('rate', '<', 8)->get();
            } elseif ($filter == '1') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->where('rate', '>=', 6)->where('rate', '<', 7)->get();
            }
            return view('frontend.comments.list-filter', compact('comments', 'type'));
        } catch (\Exception $e) {
            $comments = 0;
            return view('frontend.comments.list-filter', compact('comments', 'type'));
        }
    }

    public function filterComment(Request $request) {
        try {
            $filter = $request->filter;
            $hotel = $request->hotel;
            $type = $request->type;
            if($filter == 'new') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->orderBy('created_at', 'desc')->get();
            } elseif($filter == 'old') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->orderBy('created_at', 'asc')->get();
            } elseif ($filter == 'min') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->orderBy(DB::raw("CAST(rate AS DECIMAL(10, 2))"), 'asc')->get();
            } elseif ($filter == 'max') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->orderBy(DB::raw("CAST(rate AS DECIMAL(10, 2))"), 'desc')->get();
            } elseif ($filter == 'all') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->orderBy('created_at', 'desc')->get();
            } elseif ($filter == '5') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->where(DB::raw('CAST(rate AS DECIMAL(10, 2))'), '>=', 9.5)->get();
            } elseif ($filter == '4') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->where('rate', '>=', 9)->where(DB::raw("CAST(rate AS DECIMAL)"), '<', 9.5)->get();
            } elseif ($filter == '3') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->where('rate', '>=', 8)->where('rate', '<', 9)->get();
            } elseif ($filter == '2') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->where('rate', '>=', 7)->where('rate', '<', 8)->get();
            } elseif ($filter == '1') {
                $comments = Comments::where('status', 1)->where('hotel_id', $hotel)->where('rate', '>=', 6)->where('rate', '<', 7)->get();
            }
            return view('frontend.comments.list-filter-comment', compact('comments', 'type'));
        } catch (\Exception $e) {
            $comments = 0;
            return view('frontend.comments.list-filter-comment', compact('comments', 'type'));
        }
    }
}
