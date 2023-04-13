<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AvnChatController extends Controller
{
    public function chat(Request $request)
    {
        setcookie('Authorization','' .Auth::user()->createToken('avnchat')->plainTextToken);
        return view('avnchat::chat');
    }
}
