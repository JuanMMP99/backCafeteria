<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    /* public function newProduct(Request $request)
    {
        $product = product::create($request->all());
        return response($product, 200);
    } */

    public function getProducts()
    {

        return response()->json(product::all(), 200);
    }


    
    public function __construct()
    {
        // Aplicar middleware de autenticación a todas las funciones excepto 'agregarAse'
        $this->middleware('auth')->except('agregarAse');
    }

    public function agregarAse(Request $request)
    {
        // Validar que el usuario esté autenticado antes de continuar
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:products,name',
            'category_id' => 'required',
            'desc' => 'required|string|between:1,3',
            'price' => 'required|numeric',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Crear el accesorio sin verificar la autenticación
        $accesorio = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'desc' => $request->desc,
            'price' => $request->price,
        ]);

        return response()->json(['accesorio' => $accesorio], 201);
    }


 //Se muestran todos los productos por categoria   

public function productosPorCategoria($category_id) {
    $products = Product::where('category_id', $category_id)->get();

    if ($products->isEmpty()) {
        return response()->json(['message' => 'No se encontraron productos en esta categoría'], 404);
    }

    return response()->json(['products' => $products]);
}

}
