<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Customer;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PagSeguroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\ReportController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::all();
    return view('home', compact('products'));
})->name('home');

Route::get('/produtos', [ProductsController::class, 'pagina_produtos'])->name('produtos');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [ChartsController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/produto_individual/{id}', function ($id) {
        $product = Product::findOrFail($id);
        return view('produto_individual', compact('product'));
    })->name('produto_individual');

    Route::get('/carrinho', [ProductsController::class, 'carrinho'])->name('carrinho');
    Route::match(['get', 'post'], '/add-to-cart/{id}', [ProductsController::class, 'adicionarAoCarrinho'])->name('add_to_cart');
    Route::delete('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
    Route::patch('/carrinho/atualizar/{id}', [ProductsController::class, 'atualizarCarrinho'])->name('carrinho.atualizar');
    
    Route::post('/checkout', [PagSeguroController::class, 'createCheckout']);
    Route::get('/erro-pagamento', [CarrinhoController::class, 'purchaseErro']);
    Route::post('/address', [AddressController::class, 'store'])->name('address.store');

    Route::get('/historico', [ReportController::class, 'index'])->name('historico.index');
    Route::get('/historico/pdf', [ReportController::class, 'baixarPdf'])->name('historico.pdf');

    Route::get('/productslist', [ProductsController::class, 'index'])->name('products.index');
    Route::post('/productslist', [ProductsController::class, 'store'])->name('products.store'); 
    Route::put('/productslist/{product}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/productslist/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');

    Route::get('/userlist', [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/userlist', [UserController::class, 'store'])->name('store');
    Route::put('/userlist/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/userlist/{user}', [UserController::class, 'destroy'])->name('destroy');

    Route::middleware(Admin::class)->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        Route::post('/enviar-email/{user}', [UserController::class, 'enviarEmail'])->name('admin.enviar_email');
        Route::get('/historico/excel', [ReportController::class, 'baixarExcel'])->name('historico.excel');
    });

});

require __DIR__.'/auth.php';