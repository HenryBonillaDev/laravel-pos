<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return 'health';
});
