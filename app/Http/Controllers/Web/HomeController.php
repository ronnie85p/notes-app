<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $items = [
        [
            'id' => 1,
            'user_id' => 1,
            'content' => 'Note #1',
            'created_at' => null,
            'updated_at' => null
        ],

        [
            'id' => 2,
            'user_id' => 1,
            'content' => 'Note #2',
            'created_at' => null,
            'updated_at' => null
        ],

        [
            'id' => 3,
            'user_id' => 1,
            'content' => 'Note #3',
            'created_at' => null,
            'updated_at' => null
        ],
    ];

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home', [
            'items' => $this->items
        ]);
    }
}
