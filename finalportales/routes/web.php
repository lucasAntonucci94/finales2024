<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])->name('home.index');
Route::get('about', [\App\Http\Controllers\HomeController::class, 'about']);

// Ruteos de Autorizacion
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
Route::get('login', [\App\Http\Controllers\AuthController::class, 'loginForm'])->name('auth.login.form');
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');
Route::get('register', [\App\Http\Controllers\AuthController::class, 'registerForm'])->name('auth.register.form');

// Ruteos de Administrador
Route::prefix('admin')
    ->group(function(){
        Route::middleware(['auth'],['admin.role'])
        ->group(function(){
            Route::get('dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard']);
            Route::get('products', [\App\Http\Controllers\AdminController::class, 'getProducts'])->name('admin.products.index');
            Route::get('products/{id}', [\App\Http\Controllers\AdminController::class, 'showProduct'])->name('admin.products.show');
            Route::get('news', [\App\Http\Controllers\AdminController::class, 'getNews'])->name('admin.news.index');
            Route::get('news/{id}', [\App\Http\Controllers\AdminController::class, 'showNew'])->name('admin.news.show');
            Route::get('users', [\App\Http\Controllers\AdminController::class, 'getUsers'])->name('admin.users.index');
            Route::get('users/{id}', [\App\Http\Controllers\AdminController::class, 'showUser'])->name('admin.users.show');
            Route::get('orders', [\App\Http\Controllers\AdminController::class, 'getOrders'])->name('admin.orders.index');
            Route::get('orders/{id}', [\App\Http\Controllers\AdminController::class, 'showOrder'])->name('admin.orders.show');
            Route::get('statistics', [\App\Http\Controllers\StatisticsController::class, 'showIndex'])->name('admin.statistics.index');
            Route::post('statistics', [\App\Http\Controllers\StatisticsController::class, 'getById'])->name('admin.statistics.get');
        });
    }
);

Route::get('products/new', [\App\Http\Controllers\AdminController::class, 'formCreateProduct'])->name('create.form.product')->middleware('auth')->middleware('admin.role');
Route::prefix('products')
->group(function(){
    Route::get('/', [\App\Http\Controllers\ProductsController::class, 'getAll'])->name('products.index');
    Route::get('{id}', [\App\Http\Controllers\ProductsController::class, 'showProduct'])->name('products.show')->whereNumber('id_product');
    Route::middleware(['auth'],['admin.role'])
        ->group(function(){
            Route::delete('{id}', [\App\Http\Controllers\ProductsController::class, 'deleteProduct'])->name('products.delete');
            Route::post('new', [\App\Http\Controllers\ProductsController::class, 'createProduct'])->name('products.create');
            Route::get('{id}/edit', [\App\Http\Controllers\AdminController::class, 'formEditProduct'])->name('edit.form.product');
            Route::post('{id}/edit', [\App\Http\Controllers\ProductsController::class, 'editProduct'])->name('products.edit');
        });
    }
);

//Ruteos de Noticias
Route::get('news/new', [\App\Http\Controllers\AdminController::class, 'formCreateNew'])->middleware('auth')->name('create.form.new');
Route::prefix('news')
->group(function(){
        Route::get('/', [\App\Http\Controllers\NewsController::class, 'getAll'])->name('news.index');
        Route::get('{id}', [\App\Http\Controllers\NewsController::class, 'showNew'])->name('news.show');
        Route::middleware(['auth'],['admin.role'])
        ->group(function(){
            Route::delete('{id}', [\App\Http\Controllers\NewsController::class, 'deleteNew'])->name('news.delete');
            Route::post('new', [\App\Http\Controllers\NewsController::class, 'createNew'])->name('news.create');
            Route::post('{id}/edit', [\App\Http\Controllers\NewsController::class, 'editNew'])->name('news.edit');
            Route::get('{id}/edit', [\App\Http\Controllers\AdminController::class, 'formEditNew'])->name('edit.form.new');
        });
    }
);

//Ruteos de Usuario
Route::get('users/new', [\App\Http\Controllers\AdminController::class, 'formCreateUser'])->middleware('auth')->middleware('admin.role')->name('create.form.user');
Route::prefix('users')
->group(function(){
    Route::middleware(['auth'],['admin.role'])
    ->group(function(){
            Route::get('{id}/{backurl}/order', [\App\Http\Controllers\AdminController::class, 'showUserOrders'])->name('admin.users.show.order');
            Route::delete('{id}', [\App\Http\Controllers\UsersController::class, 'deleteUser'])->name('users.delete');
            Route::post('new', [\App\Http\Controllers\UsersController::class, 'createUser'])->name('users.create');
            Route::post('{id}/edit', [\App\Http\Controllers\UsersController::class, 'editUser'])->name('users.edit');
            Route::get('{id}/edit', [\App\Http\Controllers\AdminController::class, 'formEditUser'])->name('edit.form.user');
        });
    }
);

// Ruteos de Pedidos
Route::prefix('orders')
->group(function(){
        Route::middleware(['auth'])
        ->group(function(){
            Route::get('checkout', [\App\Http\Controllers\OrdersController::class, 'checkout'])->name('order.checkout');
            Route::post('create', [\App\Http\Controllers\OrdersController::class, 'createOrder'])->name('order.create');
            Route::get('item/{id}', [\App\Http\Controllers\ProductsController::class, 'showOrderProduct'])->name('order.products.show')->whereNumber('id_product');
            Route::delete('{id}/{backurl}', [\App\Http\Controllers\OrdersController::class, 'deleteOrder'])->name('orders.delete');
            Route::delete('item/{id}/{backurl}', [\App\Http\Controllers\OrdersController::class, 'deleteOrderItem'])->name('order.item.delete');
            Route::post('/order/item/update', [\App\Http\Controllers\OrdersController::class, 'updateQuantity'])->name('orderItem.quantity.update');
            Route::middleware(['admin.role'])
            ->group(function(){
                Route::post('{id}/edit', [\App\Http\Controllers\OrdersController::class, 'editorder'])->name('orders.edit');
                Route::get('{id}/edit', [\App\Http\Controllers\AdminController::class, 'formEditorder'])->name('edit.form.order');
            });
        });
    }
);

// Ruteos de Perfil
Route::prefix('profile')
->group(function(){
        Route::middleware(['auth'])
        ->group(function(){
            Route::get('', [\App\Http\Controllers\AuthController::class, 'getProfile'])->name('profile.index');
            Route::get('{id}/edit', [\App\Http\Controllers\UsersController::class, 'formEditProfile'])->name('edit.form.profile');
            Route::post('{id}/edit', [\App\Http\Controllers\UsersController::class, 'editProfile'])->name('profile.edit');
            Route::get('orders/{id}', [\App\Http\Controllers\OrdersController::class, 'showOrderProfile'])->name('profile.orders.show');
        });
    }
);

// Ruteos de MercadoPago
Route::prefix('mercadopago')
->group(function(){
        Route::post('update', [\App\Http\Controllers\OrdersController::class, 'updateMercadoPago'])->name('mercadopago.update');
        Route::get('success/{id}', [\App\Http\Controllers\OrdersController::class, 'successMercadoPago'])->name('mercadopago.success');
        Route::get('pending/{id}', [\App\Http\Controllers\OrdersController::class, 'pendingMercadoPago'])->name('mercadopago.pending');
        Route::get('failed/{id}', [\App\Http\Controllers\OrdersController::class, 'failedMercadoPago'])->name('mercadopago.failed');
    }
);