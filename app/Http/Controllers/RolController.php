<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rols=Rol::all();
        $num=1;
        return view('admin.rols.index', compact('rols', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rols.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count=Rol::where('name', request('name'))->where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Rol::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=$slug."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug, 'description' => request('description'));
                break;
            }
        }

        $rol=Rol::create($data);

        if ($rol) {
            return redirect()->route('rol.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El Rol ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('rol.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $rol = Rol::where('slug', $slug)->firstOrFail();
        return view('admin.rols.show', compact("rol"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $rol)
    {
        $rol=Rol::where('slug', $slug)->firstOrFail();
        return view('admin.rols.edit', compact("rol"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $rol = Rol::where('slug', $slug)->firstOrFail();

        $rol->fill($request->all())->save();

        if ($rol) {
            return redirect()->route('rol.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El Rol ha sido editada exitosamente.']);
        } else {
            return redirect()->route('rol.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $rol= Rol::where('slug', $slug)->firstOrFail();
        $rol->delete();

        if ($rol) {
            return redirect()->route('rol.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El rol ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('rol.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $rol = Rol::where('slug', $slug)->firstOrFail();
        $rol->fill(['state' => "0"])->save();

        if ($rol) {
            return redirect()->route('rol.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El rol ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('rol.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $rol = Rol::where('slug', $slug)->firstOrFail();
        $rol->fill(['state' => "1"])->save();

        if ($rol) {
            return redirect()->route('rol.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El rol ha sido activado exitosamente.']);
        } else {
            return redirect()->route('rol.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
