<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Table;
use App\Http\Controllers\ReportController;
Route::get('/', function () {

    return redirect()
        ->route('dashboard');

});





Route::get('/dashboard', function () {

    $tables = Table::with([
        'orders' => function ($query) {

            $query->where('status', 'open')
                  ->latest();

        }
    ])
    ->get();


    return view(
        'dashboard',
        compact('tables')
    );

})
->middleware(['auth'])
->name('dashboard');




Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile',
        [ProfileController::class,'edit']
    )
    ->name('profile.edit');


    Route::patch('/profile',
        [ProfileController::class,'update']
    )
    ->name('profile.update');


    Route::delete('/profile',
        [ProfileController::class,'destroy']
    )
    ->name('profile.destroy');


    /*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/

Route::resource(
    'categories',
    CategoryController::class
);

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'products',
        ProductController::class
    );





    /*
    |--------------------------------------------------------------------------
    | Tables
    |--------------------------------------------------------------------------
    */


 // Захиалга эхлүүлэх
Route::get('/tables/{table}/order',
    [OrderController::class,'create']
)
->name('tables.order');


// Admin ширээ удирдах
Route::get('/tables/manage',
    [TableController::class,'manage']
)
->name('tables.manage');


// Table CRUD
Route::resource(
    'tables',
    TableController::class
);
Route::delete(
    '/tables/{table}',
    [TableController::class,'destroy']
)
->name('tables.destroy');




    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */
    Route::get('/orders/{order}',
    [OrderController::class,'show']
)
->name('orders.show');

    // Идэвхтэй захиалгууд
    Route::get('/orders',
        [OrderController::class,'index']
    )
    ->name('orders.index');
    Route::get('/orders/{order}/move',
    [OrderController::class,'move']
)
->name('orders.move');


Route::post('/orders/{order}/move',
    [OrderController::class,'updateMove']
)
->name('orders.update-move');


    // Захиалга хаах
    Route::post('/orders/{order}/close',
        [OrderController::class,'close']
    )
    ->name('orders.close');
    // Тооцоо бүрэн дуусгах
Route::post(
    '/orders/{order}/finish',
    [OrderController::class,'finish']
)
->name('orders.finish');

Route::post('/orders/{order}/cancel',
    [OrderController::class,'cancel']
)
->name('orders.cancel');

    Route::delete(
    '/order-items/{item}',
    [OrderController::class,'removeItem']
)->name('order-items.destroy');
    /*
    |--------------------------------------------------------------------------
    | Order Items
    |--------------------------------------------------------------------------
    */


    // Бараа нэмэх хуудас
    Route::get('/orders/{order}/add-product',
        [OrderController::class,'addProduct']
    )
    ->name('orders.add-product');



    // Бараа хадгалах
    Route::post('/orders/{order}/add-product',
        [OrderController::class,'storeProduct']
    )
    ->name('orders.store-product');


    // Order item quantity өөрчлөх

Route::post('/order-items/{item}/increase',
    [OrderController::class,'increaseItem']
)
->name('order-items.increase');


Route::post('/order-items/{item}/decrease',
    [OrderController::class,'decreaseItem']
)
->name('order-items.decrease');


Route::delete('/order-items/{item}',
    [OrderController::class,'removeItem']
)
->name('order-items.remove');





    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */


    Route::get('/reports/daily',
        [OrderController::class,'dailyReport']
    )
    ->name('reports.daily');


});



require __DIR__.'/auth.php';

Route::get('/reports/history',
    [ReportController::class,'history']
)
->name('reports.history');

Route::get(
    '/orders/{order}/receipt',
    [OrderController::class,'receipt']
)
->name('orders.receipt');
Route::get(
    '/orders/{order}/preview-receipt',
    [OrderController::class,'previewReceipt']
)
->name('orders.preview-receipt');
Route::get(
    '/orders/{order}/payment-receipt',
    [OrderController::class,'paymentReceipt']
)
->name('orders.payment-receipt');

Route::post('/reports/close-day', [ReportController::class, 'closeDay'])
    ->name('reports.close-day');
