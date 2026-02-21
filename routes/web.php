<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Customer;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Models\Product;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PagSeguroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ChartsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ChartsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
   Route::middleware(Customer::class)->group(function () {
        Route::prefix('customer')->group(function () {
            Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        });
   });

   Route::middleware(Admin::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        });

    

    });


Route::get('/', function () {
    $products = Product::all();
   return view('home', compact('products'));
})->middleware(['auth', 'verified'])->name('home');

Route::get('/produto_individual/{id}', function ($id) {
    $product = Product::findOrFail($id);
    return view('produto_individual', compact('product'));
})->middleware(['auth', 'verified'])->name('produto_individual');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/produtos', function () {
    $products = Product::all();
    return view('pagina_produtos', compact('products'));})->name('produtos');

Route::middleware(['auth'])->group(function () {
    Route::get('/productslist', [ProductsController::class, 'index'])->name('products.index');
    Route::post('/productslist', [ProductsController::class, 'store'])->name('products.store'); 
    Route::put('/productslist/{product}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/productslist/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');

    Route::get('/userlist', [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/userlist', [UserController::class, 'store'])->name('store');
    Route::put('/userlist/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/userlist/{user}', [UserController::class, 'destroy'])->name('destroy');
});



Route::get('/carrinho', function () {
    return view('carrinho', compact('carrinho'));
})->name('carrinho');

Route::get('/carrinho', [ProductsController::class, 'carrinho'])->name('carrinho');
Route::match(['get', 'post'], '/add-to-cart/{id}', [ProductsController::class, 'adicionarAoCarrinho'])->name('add_to_cart');
Route::delete('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
Route::patch('/carrinho/atualizar/{id}', [ProductsController::class, 'atualizarCarrinho'])->name('carrinho.atualizar');



Route::get('/erro-pagamento', [CarrinhoController::class, 'purchaseErro']);

Route::post('/checkout', [PagSeguroController::class, 'createCheckout']);
Route::get('/visualizar-exemplo', function () {
    return view('produto_individual');
});

Route::view('/endereco', 'modalEndereco');
Route::post('/address', [AddressController::class, 'store'])->middleware('auth')->name('address.store');
require __DIR__.'/auth.php';
