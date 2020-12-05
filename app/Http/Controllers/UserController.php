<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    ///////////////////////////////////////CLIENTES///////////////////////////////////////////

    public function indexC()
    {
        $customers=User::where('type', 3)->orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.customers.index', compact('customers', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createC()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeC(Request $request)
    {
     $count=User::where('name', request('name'))->where('lastname', request('lastname'))->count();
     $slug=Str::slug(request('name')." ".request('lastname'), '-');
     if ($count>0) {
        $slug=$slug."-".$count;
    }

        // Validación para que no se repita el slug
    $num=0;
    while (true) {
        $count2=User::where('slug', $slug)->count();
        if ($count2>0) {
            $slug=Str::slug(request('name')." ".request('lastname'), '-')."-".$num;
            $num++;
        } else {
            $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'), 'slug' => $slug, 'email' => request('email'), 'address' => request('address'), 'dni' => request('dni'), 'type_dni' => request('type_dni'), 'type' =>  request('type') );
            break;
        }
    }

    // Mover imagen a carpeta customers y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $photo=$slug.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/admins/img/customers/', $photo);
            $data['photo']=$photo;
        }

    $admin=User::create($data);

    if ($admin) {
        return redirect()->route('customer.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El Cliente ha sido registrado exitosamente.']);
    } else {
        return redirect()->route('customer.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showC($slug) {
        $customer = User::where('slug', $slug)->firstOrFail();
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editC($slug) {
        $customer=User::where('slug', $slug)->firstOrFail();
        return view('admin.customers.edit', compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateC(Request $request, $slug)
    {
        $customer = User::where('slug', $slug)->firstOrFail();
        $customer->fill($request->all())->save();

        if ($customer) {
            return redirect()->route('customer.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cliente ha sido editado exitosamente.']);
        } else {
            return redirect()->route('customer.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyC($slug)
    {
        $customer=User::where('slug', $slug)->firstOrFail();
        $customer->delete();

        if ($customer) {
            return redirect()->route('customer.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El cliente ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('customer.index')->with(['type' => 'error', 'title' => 'Modificación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivateC(Request $request, $slug) {

        $customer = User::where('slug', $slug)->firstOrFail();
        $customer->fill(['state' => "0"])->save();

        if ($customer) {
            return redirect()->route('customer.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cliente ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('customer.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activateC(Request $request, $slug) {

        $customer = User::where('slug', $slug)->firstOrFail();
        $customer->fill(['state' => "1"])->save();

        if ($customer) {
            return redirect()->route('customer.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cliente ha sido activado exitosamente.']);
        } else {
            return redirect()->route('customer.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    ///////////////////////////////////////PROVEEDORES////////////////////////////////////////////


     public function indexP()
    {
        $provider=User::where('type', 4)->orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.providers.index', compact('provider', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createP()
    {
        return view('admin.providers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeP(Request $request)
    {
     $count=User::where('name', request('name'))->where('lastname', request('lastname'))->count();
     $slug=Str::slug(request('name')." ".request('lastname'), '-');
     if ($count>0) {
        $slug=$slug."-".$count;
    }

        // Validación para que no se repita el slug
    $num=0;
    while (true) {
        $count2=User::where('slug', $slug)->count();
        if ($count2>0) {
            $slug=Str::slug(request('name')." ".request('lastname'), '-')."-".$num;
            $num++;
        } else {
            $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'), 'slug' => $slug, 'email' => request('email'), 'address' => request('address'), 'dni' => request('dni'), 'type_dni' => request('type_dni'), 'type' => 4 );
            break;
        }
    }

     // Mover imagen a carpeta providers y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $photo=$slug.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/admins/img/providers/', $photo);
            $data['photo']=$photo;
        }


    $admin=User::create($data);

    if ($admin) {
        return redirect()->route('provider.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El Proveedor ha sido registrado exitosamente.']);
    } else {
        return redirect()->route('provider.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showP($slug) {
        $provider = User::where('slug', $slug)->firstOrFail();
        return view('admin.providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editP($slug) {
        $provider=User::where('slug', $slug)->firstOrFail();
        return view('admin.providers.edit', compact("provider"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateP(Request $request, $slug)
    {
        $provider = User::where('slug', $slug)->firstOrFail();
        $provider->fill($request->all())->save();

        if ($provider) {
            return redirect()->route('provider.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El Proveedor ha sido editado exitosamente.']);
        } else {
            return redirect()->route('provider.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyP($slug)
    {
        $provider=User::where('slug', $slug)->firstOrFail();
        $provider->delete();

        if ($provider) {
            return redirect()->route('provider.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El Proveedor ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('provider.index')->with(['type' => 'error', 'title' => 'Modificación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivateP(Request $request, $slug) {

        $provider = User::where('slug', $slug)->firstOrFail();
        $provider->fill(['state' => "0"])->save();

        if ($provider) {
            return redirect()->route('provider.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El Proveedor ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('provider.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activateP(Request $request, $slug) {

        $provider = User::where('slug', $slug)->firstOrFail();
        $provider->fill(['state' => "1"])->save();

        if ($provider) {
            return redirect()->route('provider.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El Proveedor ha sido activado exitosamente.']);
        } else {
            return redirect()->route('provider.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
