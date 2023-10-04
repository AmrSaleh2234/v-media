<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\TempFile;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function process(Request $request)
    {

        // We don't know the name of the file input, so we need to grab
        // all the files from the request and grab the first file.
        /** @var UploadedFile[] $files */
        $files = $request->allFiles();
//        return  response()->json($files ) ;
        if (empty($files)) {
            abort(422, 'No files were uploaded.');
        }

        if (count($files) > 1) {
            abort(422, 'Only 1 file can be uploaded at a time.');
        }

        // Now that we know there's only one key, we can grab it to get
        // the file from the request.
        $requestKey = array_key_first($files);

        // If we are allowing multiple files to be uploaded, the field in the
        // request will be an array with a single file rather than just a
        // single file (e.g. - `csv[]` rather than `csv`). So we need to
        // grab the first file from the array. Otherwise, we can assume
        // the uploaded file is for a single file input and we can
        // grab it directly from the request.
        $file = is_array($request->input($requestKey))
            ? $request->file($requestKey)[0]
            : $request->file($requestKey);
        if ($file){
            $fileName = $file->getClientOriginalName();
            $folder = uniqid('image-',true);
            $file->storeAs('/temp/'.$folder,$fileName);
            TempFile::create([
                'folder' => $folder ,
                'file' =>$fileName
            ]);

            return response()->json(['id'=>$folder]) ;
        }
        return  '' ;

        // Store the file in a temporary location and return the location
        // for FilePond to use.
//        return $file->store(
//            path: 'tmp/'.now()->timestamp.'-'.Str::random(20)
//        );
    }
    public function delete(Request $request )
    {
        $input = json_decode($request->getContent(),true);// folder name
//        return  $input['id'];
        $tempFile = TempFile::folder($input['id'])->first();

        if ($tempFile){
            Storage::deleteDirectory('/temp/' . $tempFile->folder);
            $tempFile->delete();
            return response()->json(true)  ;
        }
        return response()->json('not found')  ;
    }

    public function download(Request $request){
//        return  response()->download('/storage/'.$path);
            $attachment = Attachment::where('path',$request->get('path'))->first();
//         return \response()->json(public_path());
        return  response()->download(storage_path('app/public/'.$request->get('path')),$attachment->original_name ?? 'file');
    }

}
