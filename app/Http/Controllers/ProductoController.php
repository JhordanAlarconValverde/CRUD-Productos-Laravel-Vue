<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public $responseMSG = ["response" => 500, "type" => "error", "title" => "Error desde el sistema", "text" => ""];
    
    function index()
    {
        $categorias = Categoria::get();
        return view('producto.index', compact('categorias'));
    }

    public function table()
    {
        $producto = Producto::select()->get();
        return response()->json($producto);
    }

    public function store(Request $request)
    {
        try {
            $producto = new Producto();
            $producto->nombre = $request->nombre;
            $producto->precio = $request->precio;
            $producto->stock = $request->stock;
            $producto->id_categoria = $request->id_categoria;
            $producto->save();

            $this->responseMSG["response"] = 200;
            $this->responseMSG["type"] = "success";
            $this->responseMSG["title"] = "Registro creado correctamente";
            return response()->json($this->responseMSG, 200);
        } catch (\Throwable $th) {
            return response()->json($this->responseMSG, 200);
        }
    }

    public function update(Request $request)
    {
        try {

            $producto = DB::table('d')->where('id_producto', $request->id_producto)->first();
            $producto->nombre = $request->nombre;
            $producto->precio = $request->precio;
            $producto->stock = $request->stock;
            $producto->id_categoria = $request->id_categoria;
            $producto->save();

            $this->responseMSG["response"] = 200;
            $this->responseMSG["type"] = "success";
            $this->responseMSG["title"] = "Registro actualizado correctamente";
            return response()->json($this->responseMSG, 200);
        } catch (\Throwable $th) {
            return response()->json($this->responseMSG, 200);
        }
    }

    public function delete($id)
    {
        try {
            $producto = DB::table('producto')->where('id_producto', $id)->delete();

            $this->responseMSG["response"] = 200;
            $this->responseMSG["type"] = "success";
            $this->responseMSG["title"] = "Registro eliminado correctamente";
            return response()->json($this->responseMSG, 200);
        } catch (\Throwable $th) {
            return response()->json($this->responseMSG, 200);
        }
    }
}
