<?php

use Illuminate\Support\Facades\Route;

Route::view('/{page}', 'app')->where('page', '.*');
