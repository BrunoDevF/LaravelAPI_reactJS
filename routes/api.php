<?php

use App\Models\User;
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
        $file = $request->file('file');
        $fileName = $request->input('file')->name;
        $fileUpload = $request->file('file')->store('uploads');
        // }
        //retorna o caminho exato do file
        $path = Storage::path($fileUpload);
    }
    
    




});


Route::get('list', function(Request $request, User $user){
    $user = $user::all();

    //caso queira corrigir url da imagem 
    //pode ser rodado um foreach pegando a url no storage 
    foreach ($user as  $value) {
        $user = $value;
    }
    return $user;
});
