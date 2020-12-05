<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index() {

        $articles = Article::where('state', '=', '1')->orderBy('id', 'DESC')->get();
        $num = 1;
        return view('admin.articles.index', compact('articles', 'num'));

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('state', '=', '1')->get();
        $providers = User::where('type', '=', '4')->where('state', '=', '1')->get();
        return view('admin.articles.create', compact('categories', 'providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count=Article::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2 = Article::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=$slug."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug, 'category_id' => request('category_id'),  'cod' => request('cod'), 'stock' => request('stock'), 'sale_price' => request('sale_price'), 'purchase_price' => request('purchase_price'), 'description' => ('description'));
                break;
            }
        }

         // Mover imagen a carpeta admins y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $photo=$slug.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/admins/img/articles/', $photo);
            $data['photo']=$photo;
        }

        $article=Article::create($data);

        if ($article) {
            return redirect()->route('article.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El articulo ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('article.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('admin.articles.show', compact("article"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $categories = Category::where('state', '=', '1')->get();
        $providers = User::where('type', '=', '4')->get();
        return view('admin.articles.edit', compact("article", "categories", "providers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $article->fill($request->all())->save();

        if ($article) {
            return redirect()->route('article.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El Artículo ha sido editado exitosamente.']);
        } else {
            return redirect()->route('article.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->delete();

        if ($article) {
            return redirect()->route('article.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El articulo ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('article.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $article = Article::where('slug', $slug)->firstOrFail();
        $article->fill(['state' => "0"])->save();

        if ($article) {
            return redirect()->route('article.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El articulo ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('article.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $article = Article::where('slug', $slug)->firstOrFail();
        $article->fill(['state' => "1"])->save();

        if ($article) {
            return redirect()->route('article.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El articulo ha sido activado exitosamente.']);
        } else {
            return redirect()->route('article.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
