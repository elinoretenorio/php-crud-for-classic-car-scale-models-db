<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", ClassicCarScaleModels\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// Customers

$container->add("CustomersRepository", ClassicCarScaleModels\Customers\CustomersRepository::class)
    ->addArgument("Database");
$container->add("CustomersService", ClassicCarScaleModels\Customers\CustomersService::class)
    ->addArgument("CustomersRepository");
$container->add(ClassicCarScaleModels\Customers\CustomersController::class)
    ->addArgument("CustomersService");

// Employees

$container->add("EmployeesRepository", ClassicCarScaleModels\Employees\EmployeesRepository::class)
    ->addArgument("Database");
$container->add("EmployeesService", ClassicCarScaleModels\Employees\EmployeesService::class)
    ->addArgument("EmployeesRepository");
$container->add(ClassicCarScaleModels\Employees\EmployeesController::class)
    ->addArgument("EmployeesService");

// Offices

$container->add("OfficesRepository", ClassicCarScaleModels\Offices\OfficesRepository::class)
    ->addArgument("Database");
$container->add("OfficesService", ClassicCarScaleModels\Offices\OfficesService::class)
    ->addArgument("OfficesRepository");
$container->add(ClassicCarScaleModels\Offices\OfficesController::class)
    ->addArgument("OfficesService");

// OrderDetails

$container->add("OrderDetailsRepository", ClassicCarScaleModels\OrderDetails\OrderDetailsRepository::class)
    ->addArgument("Database");
$container->add("OrderDetailsService", ClassicCarScaleModels\OrderDetails\OrderDetailsService::class)
    ->addArgument("OrderDetailsRepository");
$container->add(ClassicCarScaleModels\OrderDetails\OrderDetailsController::class)
    ->addArgument("OrderDetailsService");

// Orders

$container->add("OrdersRepository", ClassicCarScaleModels\Orders\OrdersRepository::class)
    ->addArgument("Database");
$container->add("OrdersService", ClassicCarScaleModels\Orders\OrdersService::class)
    ->addArgument("OrdersRepository");
$container->add(ClassicCarScaleModels\Orders\OrdersController::class)
    ->addArgument("OrdersService");

// Payments

$container->add("PaymentsRepository", ClassicCarScaleModels\Payments\PaymentsRepository::class)
    ->addArgument("Database");
$container->add("PaymentsService", ClassicCarScaleModels\Payments\PaymentsService::class)
    ->addArgument("PaymentsRepository");
$container->add(ClassicCarScaleModels\Payments\PaymentsController::class)
    ->addArgument("PaymentsService");

// ProductLines

$container->add("ProductLinesRepository", ClassicCarScaleModels\ProductLines\ProductLinesRepository::class)
    ->addArgument("Database");
$container->add("ProductLinesService", ClassicCarScaleModels\ProductLines\ProductLinesService::class)
    ->addArgument("ProductLinesRepository");
$container->add(ClassicCarScaleModels\ProductLines\ProductLinesController::class)
    ->addArgument("ProductLinesService");

// Products

$container->add("ProductsRepository", ClassicCarScaleModels\Products\ProductsRepository::class)
    ->addArgument("Database");
$container->add("ProductsService", ClassicCarScaleModels\Products\ProductsService::class)
    ->addArgument("ProductsRepository");
$container->add(ClassicCarScaleModels\Products\ProductsController::class)
    ->addArgument("ProductsService");

