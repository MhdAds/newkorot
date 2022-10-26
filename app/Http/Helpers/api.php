<?php
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

function res($data, $status, $messages, $code = 200)
{
    return response()->json([
        'status' => [
            'status' => $status,
            'messages' => $messages,
            'server_titm' => Carbon::now()->timestamp,
        ],
        'data' => $data,
    ], $code);
}


function save_files(object $object, array|object $files, string $type, string $directory = '')
{
    if (is_array($files)) {
        $full_urls = [];
        foreach ($files as $image) {
            $fileExt = $image->getClientOriginalExtension();
            $fileNameNew        = uniqid() . time() . '.' . $fileExt;
            $image->storeAs('public/' . $directory, $fileNameNew);

            $object->files()->create([
                'src' => $fileNameNew,
                'type' => $type
            ]);
            array_push($full_urls, asset('storage/' . $directory . '/' . $fileNameNew));
        }
        return $full_urls;

    } else {
        $fileExt = $files->getClientOriginalExtension();
        $fileNameNew        = uniqid() . time() . '.' . $fileExt;
        $files->storeAs('public/' . $directory, $fileNameNew);

        $object->files()->create([
            'src' => $fileNameNew,
            'type' => $type
        ]);
        return asset('storage/' . $directory . '/' . $fileNameNew);
    }
    return null;

}




