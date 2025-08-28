<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reqsender', function () {
    return view('reqSender');
});



Route::get('/dumpjson', function (array $data = ['php', 'laravel', 'testes']) {
    return view('dumpjson', ['data' => $data]);
});