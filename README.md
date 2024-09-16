# laravel-rest-api

REST API Boilerplate for Laravel made in a modular monolith architecture with CQRS.

## Features

* PHP 8.3
* Laravel 11
* CommandBus, QueryBus, EventBus, SharedEventBus, SharedQueryBus
* CQRS and Event-driven programming
* Eloquent Models supporting binary UUID
* Automatic migration generation with Doctrine Migrations
* Debugbar for Laravel like Symfony Profiler
* DTO classes support
* Repository Pattern for Eloquent
* Autowire attribute from Autowire for Laravel package
* API documentation provided by Swagger

## Examples of use

* [CarDatasetReader](./app/Module/Car/Infrastructure/Reader/CarDataset/CarDatasetReader.php)
* [CarDatasetImporter](./app/Module/Car/Application/Import/CarDatasetImporter.php)
* [ImportCarsFromCsvHandler](./app/Module/Car/Application/Interaction/Command/ImportCarsFromCsv/Handler/ImportCarsFromCsvHandler.php)
* [AskForCarsPaginatedListHandler](./app/Module/Car/Application/Interaction/Query/AskForCarsPaginatedList/Handler/AskForCarsPaginatedListHandler.php)
* [CarFilter](./app/Module/Car/Application/Filter/Car/CarFilter.php)
* [CarController](./app/Module/Car/UI/Controller/CarController.php)
* [CreateSaleOfferHandler](./app/Module/Sale/Application/Interaction/Command/CreateSaleOffer/Handler/CreateSaleOfferHandler.php)
* [AskForSaleOfferPaginatedListHandler](./app/Module/Sale/Application/Interaction/Query/AskForSaleOfferPaginatedList/Handler/AskForSaleOfferPaginatedListHandler.php)
* [SaleOfferController.php](./app/Module/Sale/UI/Controller/SaleOfferController.php)

## Copyrights

Copyright © Rafał Mikołajun 2024.
