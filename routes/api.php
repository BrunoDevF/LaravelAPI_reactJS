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
    // $file = $request->files->get('file');
    
    // $files->name = $file->getClientOriginalName();
    // $files->size = $file->getSize();
    // $files->type = $file->getClientOriginalExtension();
    // $files->url = $request->file->store('drop');
    // $files->save();
    
    //TESTE COM PASTAS 
    $file = $request->files->get('file');
    
    $files->name = $file->getClientOriginalName();
    $files->size = $file->getSize();
    $files->type = $file->getClientOriginalExtension();

    if(!empty($request->input('folder'))){
        $folder = $request->folder;
        //dd($pasta);
        $files->url = $request->file->store($folder);
    }else{
        $files->url = $request->file->store('drop');
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
    //foreach ($files as $key => $value) {
        //$files[$key]['url'] = asset($files['url']);
    //}
    return $files;
});
