<?php

use App\Module\Car\UI\Controller\CarController;
use Illuminate\Support\Facades\Route;

Route::resource('/car', CarController::class)
    ->except(['create', 'store', 'edit', 'update', 'destroy'])
    ->names('api.car');
