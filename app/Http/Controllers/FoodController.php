<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['food'] = Food::paginate(5);
        return view('food.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        $datos = request()->except('_token');

        if ($request->hasFile('foto')) {
            $datos['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Food::insert($datos);
        // return response()->json($datos);
        return redirect('food')->with('mensaje', 'Receta agregada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show($busqueda)
    {
        $resultado = Food::where('categoria', 'like', '' . $busqueda . '%')->orWhere('nombre', 'like', '' . $busqueda . '%')->get();

        return View::share('resultado', $resultado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datos = Food::findOrFail($id);
        return view('food.edit', compact('datos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //RECIBIENDO PETICION MULTIFORM DATA
        $datos = request()->except(['_token', '_method']);
        if ($request->hasFile('foto')) {
            $busqueda = Food::findOrFail($id);
            Storage::delete('public/' . $busqueda->foto);
            $datos['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Food::where('id', '=', $id)->update($datos);

        return redirect('food')->with('mensaje', 'Receta actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $busqueda = Food::findOrFail($id);
        if (Storage::delete('public/' . $busqueda->foto))
            Food::destroy($id);



        return redirect('food')->with('mensaje', 'Receta eliminada con exito');
    }
}
