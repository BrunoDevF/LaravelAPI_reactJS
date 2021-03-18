<?php

use App\Models\User;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('upload', function (Request $request) {
    $validator = $request->validate([
        'file'=>'required'
    ]);

    if($request->file('file')->isValid()){

        // if(o campo pasta for definido){
            //criar e salvar na pasta
        // }else{
        $files = new Files();
        $file = $request->file('files');
        
        $fileName = $file->originalName;
        $fileSize = $file->size;
        $fileType = $file->mimeType;
        $fileUpload = $file->store('uploads');
        // }
        //retorna o caminho exato do file
        //$path = Storage::path($fileUpload);
        $files->name = $fileName;
        $files->size = $fileSize;
        $files->type = $fileType;
        $files->url = $fileUpload;
        $files->save();

        // return [
        //     'STATUS'=>'OK'
        // ];
        
    }
    
    




});

Route::get('list', function(Request $request, Files $files){
    $files = $files::all();

    //caso queira corrigir url da imagem 
    //pode ser rodado um foreach pegando a url no storage 
    //foreach ($files as $key => $value) {
        //$files[$key]['url'] = asset($files['url']);
    //}
    return $files;
});
