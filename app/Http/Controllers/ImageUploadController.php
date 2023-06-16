<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\TemporaryImage;
use Illuminate\Support\Facades\Auth;

class ImageUploadController extends Controller
{
    public function storeImage(Request $request)
    {
        $image = $request->file('upload');
        if (!file_exists('public/media')) {
            File::makeDirectory('public/media', 0777, true, true);
        }
        $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $path = "public/media/" . $filename;
        $image_resize->save($path, 90);
        $url = asset($path);
        return response()->json(['fileName' => $filename, 'uploaded' => 1, 'url' => $url]);
    }
    // public function storeImageTemporary(Request $request)
    // {
    //     $user = Auth::user();
    //     $image = $request->file('file');
    //     if (!file_exists('storage/app/TemporaryImage')) {
    //         File::makeDirectory('storage/app/TemporaryImage', 0777, true, true);
    //     }
    //     $filename = 'user' . $user->id . '-' . date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
    //     $image_resize = Image::make($image->getRealPath());
    //     $path = "storage/app/TemporaryImage/" . $filename;
    //     $image_resize->save($path, 90);
    //     $temp_img = new TemporaryImage();
    //     $temp_img->user_id = $user->id;
    //     $temp_img->image = $path;
    //     $temp_img->save();
    //     $url = asset($path);
    //     return response()->json(['id' => $temp_img->id, 'user_id' => $temp_img->user_id, 'url' => $url]);
    // }
    // public function deleteImageTemporary(Request $request)
    // {
    //     $user = Auth::user();
    //     $temp_image = TemporaryImage::find($request->id)->where('user_id', $user->id)->first();
    //     File::delete($temp_image->image);
    //     $temp_image->delete();
    //     return true;
    // }
}