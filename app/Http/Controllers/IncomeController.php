<?php

namespace App\Http\Controllers;

use App\{Income,User,Article,IncomeDetail};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::all();
        $num = 1;
       return view('admin.incomes.index', compact('num', 'incomes'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::where('state', '=', '1')->get();
        $providers = User::where('state', '=', '1')->where('type', '=', '4')->get();
        $num = 1;
        $codigo = Income::codigo();

        return view('admin.incomes.create', compact('articles', 'providers', 'num', 'codigo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $income = new Income;
       $income->fill($request->all());

        if ($income->save()) {

            foreach ($request->article_id as $key => $a) {

                IncomeDetail::create([ 'article_id' => $a,
                 'income_id' => $income->id,
                 'quantity' => $request->quantity[$key],
                 'sale_price' => $request->sale_price[$key]
             ]);
                //sumar del stock
                $article = Article::findOrfail($a);
                $article->stock = $article->stock + $request->quantity[$key];
                $article->save();

            }

            return redirect()->route('income.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El Ingreso se hizo de manera exitosa.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        foreach ($income->productos as $key => $a) {

            //restar del stock
            $article = Article::findOrfail($a->article_id);
            $article->stock = $article->stock - $a->quantity;
            $article->save();

        }

        if ($income->delete()) {
            return redirect()->route('income.index')->with(['type' => 'warning', 'title' => 'Se Elimino Correctamente', 'msg' => 'El ingreso se ha eliminado Correctamente.']);
        }
    }

}
