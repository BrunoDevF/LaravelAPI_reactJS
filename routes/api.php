<?php

use App\Models\User;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('dir', function(){
    $removeFoldersInPath = function(string $path) {
        $parts = explode("/", $path);
        return end($parts);
    };
    $directories = array_reduce(
        Storage::allDirectories('./'),
        function(array $all, string $directory) use ($removeFoldersInPath) {
            $all[$directory] = array_map(
                $removeFoldersInPath,
                Storage::allFiles($directory)
            );
            return $all;
        },
        []
    );
    return $directories;

});

Route::post('upload', function (Files $files, Request $request) {
    

    $request->validate([
        'files' => 'require|image|pdf|zip'
    ]);
    $file = $request->files->get('file');
    
    $files->name = $file->getClientOriginalName();
    $files->size = $file->getSize();
    $files->type = $file->getClientOriginalExtension();

    if(!empty($request->input('folder'))){
        $folder = $request->folder;
        //dd($pasta);
        $files->url = $request->file->storeAs($folder, $file->getClientOriginalName());
    }else{
        $files->url = $request->file->storeAs('drop', $file->getClientOriginalName());
    }
    $files->save();

    return [
        'STATUS'=>'OK'
    ];

// $validator = $request->validate([
    //     'file'=>'required'
    // ]);
    //if($request->file('file')->isValid()){
    //}
});

Route::get('list', function(Request $request, Files $files){
    $files = $files::all();

    //caso queira corrigir url da imagem 
    //pode ser rodado um foreach pegando a url no storage 
    // foreach ($files as $key => $value) {
    //     $files[$key]['url'] = asset($files['url']);
    // }
    return $files;
});

