<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Models\Product;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PagSeguroController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/produtos', function () {
    $products = Product::all();
    return view('pagina_produtos', compact('products'));

});

Route::middleware(['auth'])->group(function () {
    Route::get('/productslist', [ProductsController::class, 'index'])->name('products.index');
    Route::post('/productslist', [ProductsController::class, 'store'])->name('products.store'); // Agora o nome bate!
    Route::put('/productslist/{product}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/productslist/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
});

Route::get('/carrinho', function () {
    return view('carrinho', compact('carrinho'));
})->name('carrinho');

Route::get('/carrinho', [ProductsController::class, 'carrinho'])->name('carrinho');
Route::get('/add-to-cart/{id}', [ProductsController::class, 'adicionarAoCarrinho'])->name('add_to_cart');

Route::get('/', [CarrinhoController::class, 'index'])->name('home');
Route::get('/erro-pagamento', [CarrinhoController::class, 'purchaseErro']);

Route::post('/checkout', [PagSeguroController::class, 'createCheckout']);
Route::get('/visualizar-exemplo', function () {
    return view('produto_individual');
});

require __DIR__.'/auth.php';
