<?php

use Illuminate\Support\Facades\Route;


Route::get('/test', function(){
    return view('ui.test');
});

Route::get('/fleet/{id}/charter', function($id){
    return view('ui.myfleet.charter');
});

Route::get('/fleet/{id}/trend', function($id){
    return view('ui.myfleet.trend');
});

Route::get('/fleet/{id}/trend/bunker', function($id){
    return view('ui.myfleet.bunker');
});

Route::get('/myfleet', function(){
    return view('ui.myfleet');
});