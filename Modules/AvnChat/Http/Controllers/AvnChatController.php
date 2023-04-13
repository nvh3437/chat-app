<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AvnChatController extends Controller
{
    public function chat()
    {
        return view('avnchat::chat');
    }
}
