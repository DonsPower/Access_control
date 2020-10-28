<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['Alumnos']=alumnos::paginate(5); /**paginar la lista */
        return view('Alumnos.index',$datos);  /** para pasar la informacion */

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
         'Nombre' =>'required|string|max:40',
         'ApellidoP' =>'required|string|max:40',
         'ApellidoM' =>'required|string|max:40',
         'ProgramaAcademico' =>'required|string|max:40',
         'Boleta' =>'required|string|max:10',
         'TelefonoMovil' =>'required|string|max:10',
         'TelefonoFijo' =>'required|string|max:10',
         'TelefonoPersonal' =>'required|string|max:10',
         'Correo' =>'required|email',
         'NSS' =>'required|string|max:15',

        ];
        $Mensaje=["required" =>'El :atribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
       // $datosAlumnos=request()->all();
        $datosAlumnos=request()->except('_token');

        alumnos::insert($datosAlumnos);

       // return response()->json($datosAlumnos);
       return redirect('Alumnos')->with('Mensaje','Alumno agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function show(Alumnos $alumnos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $alumno=Alumnos::findOrFail($id);
        return view('Alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Nombre' =>'required|string|max:40',
            'ApellidoP' =>'required|string|max:40',
            'ApellidoM' =>'required|string|max:40',
            'ProgramaAcademico' =>'required|string|max:40',
            'Boleta' =>'required|string|max:10',
            'TelefonoMovil' =>'required|string|max:10',
            'TelefonoFijo' =>'required|string|max:10',
            'TelefonoPersonal' =>'required|string|max:10',
            'Correo' =>'required|email',
            'NSS' =>'required|string|max:15',
   
           ];
           $Mensaje=["required" =>'El :atribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        //
        $datosAlumnos=request()->except(['_token','_method']);
        alumnos::where('id','=',$id)->update($datosAlumnos);

        //$alumno=Alumnos::findOrFail($id);
        //return view('Alumnos.edit', compact('alumno'));
        return redirect('Alumnos')->with('Mensaje','Alumno Modificado con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
         //
       alumnos::destroy($id);
       return redirect('Alumnos')->with('Mensaje','Alumno Eliminado con exito');
    }
}
