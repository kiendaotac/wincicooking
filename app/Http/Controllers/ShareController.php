<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function __invoke(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        return view('share', compact('type', 'id'));
    }
}
