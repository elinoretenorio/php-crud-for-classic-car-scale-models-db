<?php

declare(strict_types=1);

$router->get("/customers", "ClassicCarScaleModels\Customers\CustomersController::getAll");
$router->post("/customers", "ClassicCarScaleModels\Customers\CustomersController::insert");
$router->group("/customers", function ($router) {
    $router->get("/{customer_number:number}", "ClassicCarScaleModels\Customers\CustomersController::get");
    $router->post("/{customer_number:number}", "ClassicCarScaleModels\Customers\CustomersController::update");
    $router->delete("/{customer_number:number}", "ClassicCarScaleModels\Customers\CustomersController::delete");
});

$router->get("/employees", "ClassicCarScaleModels\Employees\EmployeesController::getAll");
$router->post("/employees", "ClassicCarScaleModels\Employees\EmployeesController::insert");
$router->group("/employees", function ($router) {
    $router->get("/{employee_number:number}", "ClassicCarScaleModels\Employees\EmployeesController::get");
    $router->post("/{employee_number:number}", "ClassicCarScaleModels\Employees\EmployeesController::update");
    $router->delete("/{employee_number:number}", "ClassicCarScaleModels\Employees\EmployeesController::delete");
});

$router->get("/offices", "ClassicCarScaleModels\Offices\OfficesController::getAll");
$router->post("/offices", "ClassicCarScaleModels\Offices\OfficesController::insert");
$router->group("/offices", function ($router) {
    $router->get("/{office_number:number}", "ClassicCarScaleModels\Offices\OfficesController::get");
    $router->post("/{office_number:number}", "ClassicCarScaleModels\Offices\OfficesController::update");
    $router->delete("/{office_number:number}", "ClassicCarScaleModels\Offices\OfficesController::delete");
});

$router->get("/order-details", "ClassicCarScaleModels\OrderDetails\OrderDetailsController::getAll");
$router->post("/order-details", "ClassicCarScaleModels\OrderDetails\OrderDetailsController::insert");
$router->group("/order-details", function ($router) {
    $router->get("/{order_detail_number:number}", "ClassicCarScaleModels\OrderDetails\OrderDetailsController::get");
    $router->post("/{order_detail_number:number}", "ClassicCarScaleModels\OrderDetails\OrderDetailsController::update");
    $router->delete("/{order_detail_number:number}", "ClassicCarScaleModels\OrderDetails\OrderDetailsController::delete");
});

$router->get("/orders", "ClassicCarScaleModels\Orders\OrdersController::getAll");
$router->post("/orders", "ClassicCarScaleModels\Orders\OrdersController::insert");
$router->group("/orders", function ($router) {
    $router->get("/{order_number:number}", "ClassicCarScaleModels\Orders\OrdersController::get");
    $router->post("/{order_number:number}", "ClassicCarScaleModels\Orders\OrdersController::update");
    $router->delete("/{order_number:number}", "ClassicCarScaleModels\Orders\OrdersController::delete");
});

$router->get("/payments", "ClassicCarScaleModels\Payments\PaymentsController::getAll");
$router->post("/payments", "ClassicCarScaleModels\Payments\PaymentsController::insert");
$router->group("/payments", function ($router) {
    $router->get("/{payment_number:number}", "ClassicCarScaleModels\Payments\PaymentsController::get");
    $router->post("/{payment_number:number}", "ClassicCarScaleModels\Payments\PaymentsController::update");
    $router->delete("/{payment_number:number}", "ClassicCarScaleModels\Payments\PaymentsController::delete");
});

$router->get("/product-lines", "ClassicCarScaleModels\ProductLines\ProductLinesController::getAll");
$router->post("/product-lines", "ClassicCarScaleModels\ProductLines\ProductLinesController::insert");
$router->group("/product-lines", function ($router) {
    $router->get("/{product_line_number:number}", "ClassicCarScaleModels\ProductLines\ProductLinesController::get");
    $router->post("/{product_line_number:number}", "ClassicCarScaleModels\ProductLines\ProductLinesController::update");
    $router->delete("/{product_line_number:number}", "ClassicCarScaleModels\ProductLines\ProductLinesController::delete");
});

$router->get("/products", "ClassicCarScaleModels\Products\ProductsController::getAll");
$router->post("/products", "ClassicCarScaleModels\Products\ProductsController::insert");
$router->group("/products", function ($router) {
    $router->get("/{product_number:number}", "ClassicCarScaleModels\Products\ProductsController::get");
    $router->post("/{product_number:number}", "ClassicCarScaleModels\Products\ProductsController::update");
    $router->delete("/{product_number:number}", "ClassicCarScaleModels\Products\ProductsController::delete");
});

