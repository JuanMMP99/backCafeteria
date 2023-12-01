<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('logout', [AuthController::class, 'endLogin']); //Cerrar sesion
 //Registar Producto
    
});


Route::controller(CategoryController::class)->group(function(){
    Route::post('nuevaCategoria', 'newCategory'); //Agregar categoria
    Route::get('categorias', 'getCategories'); //OBtener las categorias
    Route::get('categoria/{id}', 'getCategoryById'); //Friltar categorias por ID
    Route::delete('eliminarCategoria/{id}', 'deleteCategoryById'); //Elimitar categoria por ID
});

Route::controller(ProductController::class)-> group(function(){
    Route::get('productos', 'getProducts'); //OBtener todos los productos
    Route::get('products/category/{category_id}', 'productosPorCategoria'); //Producto por ID
    Route::delete('eliminarProducto/{id}', 'deleteProductById');//Eliminar producto por ID
    Route::post('add-product', [ProductController::class, 'addProduct'])->withoutMiddleware(['auth']);
    Route::post('registrarA', [ProductController::class, 'agregarAse']);
});
Route::post('login', [AuthController::class, 'startLogin']); //Iniciar sesion
Route::post('register', [AuthController::class, 'formRegister']); //Registrar usuario
