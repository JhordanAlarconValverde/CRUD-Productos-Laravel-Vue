<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public $responseMSG = ["response" => 500, "type" => "error", "title" => "Error desde el sistema", "text" => ""];

    function index()
    {
        return view('categoria.index');
    }

    public function table()
    {
        $categoria = Categoria::select()->get();
        return response()->json($categoria);
    }

    public function store(Request $request)
    {
        try {
            $categoria = new Categoria();
            $categoria->nombre = $request->nombre;
            $categoria->descripcion = $request->descripcion;
            $categoria->save();

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

            $categoria = DB::table('categoria')->where('id_categoria', $request->id_categoria)->first();
            $categoria->nombre = $request->nombre;
            $categoria->descripcion = $request->descripcion;
            $categoria->save();

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
            $categoria = DB::table('categoria')->where('id_categoria', $id)->delete();

            $this->responseMSG["response"] = 200;
            $this->responseMSG["type"] = "success";
            $this->responseMSG["title"] = "Registro eliminado correctamente";
            return response()->json($this->responseMSG, 200);
        } catch (\Throwable $th) {
            return response()->json($this->responseMSG, 200);
        }
    }
}
