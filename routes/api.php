<?php

use App\Models\User;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('upload', function (Files $files, Request $request) {
    //return dd($request->files->get('name'));
    $file = $request->files->get('name');
    
    //return $file->getClientOriginalName();
    // return $file->getClientOriginalExtension();
    //return dd($request);
    // $fileee = $request->name->store('files');
    // return $fileee;
    //return $file;
    


    // $validator = $request->validate([
    //     'file'=>'required'
    // ]);

    //if($request->file('file')->isValid()){
        // if(o campo pasta for definido){
            //criar e salvar na pasta
        // }else{
        



        //$file = $request->file('files');


       // $fileName = $file->getClientOriginalName();
        //return $fileName;
        //$fileSize = $file->getSize();
       // $fileType = $file->getClientOriginalExtension();
        //$fileUpload = $request->name->store('files');

        //$arr = [
      //      $fileName,
      //      $fileSize,
      //      $fileType,
       //     $fileUpload
       // ];
        //return $arr;
        // }
        //retorna o caminho exato do file
        //$path = Storage::path($fileUpload);
        $files->name = $file->getClientOriginalName();
        $files->size = $file->getSize();
        $files->type = $file->getClientOriginalExtension();

        // $fileUpload = $file->store('files');
        $files->url = $request->name->store('files');
        $files->save();

        return [
            'STATUS'=>'OK'
        ];
        
    //}
    
    




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
