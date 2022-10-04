<?php

namespace App\Http\Controllers;

use App\Models\Feed;

class FeedController extends Controller
{

    /**
     * Показать все новости
     */
    public function getAll(){
        return view("feed",["posts" => Feed::orderBy('created_at', 'desc')->get()]);
    }

    /** Показать подробную новость
     * @param Feed $feed
     */
    public function show(Feed $feed)
    {
        return view('details', ['post' => $feed]);
    }
}
