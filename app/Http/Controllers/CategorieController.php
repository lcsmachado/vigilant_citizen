<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    private $totalPage = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::where('deleted', 0)->orderBy('name')->paginate($this->totalPage);
        return view('categorie.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Nova Categoria';
        return view('categorie.create-edit', compact('title'));
    }
    public function trash()
    {
      $categories = Categorie::where('deleted', 1)->orderBy('name')->paginate($this->totalPage);
      return view('categorie.trash')->with('categories', $categories);
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
        $categorie = new Categorie();
        $categorie->name = $request['name'];
        $categorie->description = $request['description'];
        $categorie->status = $request['status'];
        $categorie->deleted = 0;

        $this->validate($request, $categorie->rules, $this->messages());


        if ($categorie->save()) {
            $notification = 'Cadastro realizado com sucesso.';
            return redirect()->route('categorie')->with('notification', $notification);
        } else {
            $notification = 'Falha ao cadastrar.';
            return redirect()->back()->with('notification', $notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorie = Categorie::where('id', $id)->first();
        return view('categorie.show', compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = Categorie::where('id', $id)->first();
        $title = 'Editar Categoria';
        return view('categorie.create-edit', compact('categorie', 'title'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $categorie = Categorie::where('id', $id)->first();
        $categorie->name = $request['name'];
        $categorie->description = $request['description'];
        $categorie->status = $request['status'];

        $this->validate($request, $categorie->rules, $this->messages());


        if ($categorie->save()) {
            $notification = 'Alteração realizada com sucesso.';
            return redirect()->route('categorie')->with('notification', $notification);
        } else {
            $notification = 'Falha ao realizar alteração.';
            return redirect()->back()->with('notification', $notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         $categorie = Categorie::where('id', $id)->first();
         $categorie->deleted = 1;
         if ($categorie->save()) {
             $notification = 'Exclusão realizada com sucesso.';
             return redirect()->route('categorie')->with('notification', $notification);
         } else {
             $notification = 'Falha ao excluir.';
             return redirect()->back()->with('notification', $notification);
         }
     }
     public function restore($id)
     {
         $categorie = Categorie::where('id', $id)->first();
         $categorie->deleted = 0;
         if ($categorie->save()) {
             $notification = 'Restaurado com sucesso.';
             return redirect()->route('categorie')->with('notification', $notification);
         } else {
             $notification = 'Falha ao restaurar.';
             return redirect()->back()->with('notification', $notification);
         }
     }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres.',
            'name.max' => 'O nome deve ter no máximo 45 caracteres.',
            'description.required' => 'O campo Descrição é obrigatório.',
            'description.min' => 'A Descrição deve ter no mínimo 3 caracteres.',
            'description.max' => 'A Descrição deve ter no máximo 45 caracteres.',
            'status.required' => 'O campo Status deve ser selecionado'
        ];

    }

}
