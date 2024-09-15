<?php

use App\Module\Sale\UI\Controller\SaleOfferController;
use Illuminate\Support\Facades\Route;

Route::resource('/sale-offer', SaleOfferController::class)
    ->except(['create', 'edit', 'update', 'destroy'])
    ->names('api.sale-offer');
