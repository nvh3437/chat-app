<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AvnChatController extends Controller
{
    public function index(Request $request)
    {
        // setcookie('Authorization', '' . Auth::user()->createToken('avnchat')->plainTextToken);
        $users = User::get();
        return view('avnchat::index', compact('users'));
    }
}