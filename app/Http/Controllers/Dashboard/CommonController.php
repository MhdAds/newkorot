<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller
{
    public function image_delete($id)
    {
        $Image = Image::findOrfail($id);
        if (is_file('public/images' . '/' . $Image->src)) {
            Storage::delete('public/images/' . '/' . $Image->src);
        }
        $Image->delete();
        return redirect()->back()->with('success', 'The image has been deleted successfully');
    }
}
