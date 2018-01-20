<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $totalPage = 5;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $admins = Admin::where('deleted', 0)->orderBy('name')->paginate($this->totalPage);
        return view('admin.index')->with('admins', $admins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Novo Usuário';
        return view('admin.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $admin = new Admin();
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->password = bcrypt($request['password']);
        $admin->status = $request['status'];
        //$role = Role::where('id',$request['role_id'])->first();
        $admin->role_id = $request['role_id'];

        $this->validate($request, $admin->rules, $this->messages());

        if ($admin->save()) {
            $notification = 'Cadastro realizado com sucesso.';
            return redirect()->route('admin')->with('notification', $notification);
        } else {
            $notification = 'Falha ao cadastrar.';
            return redirect()->back()->with('notification', $notification);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $admin = Admin::where('email', $email)->first();
        return view('admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($email)
    {
        $admin = Admin::where('email', $email)->first();
        $title = 'Editar Usuário: ' . $admin->name;
        return view('admin.create-edit', compact('admin', 'title'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        //
        $admin = Admin::where('email', $email)->first();
        $admin->name = $request['name'];
        $admin->password = $request['password'] ? $request['password'] : $admin->password;
        $admin->status = $request['status'];
        $admin->role_id = $request['role_id'];

        $rules = $admin->rules;

        if (!strcmp($admin->email, $request['email'])) {
            $rules['email'] = $rules['email'] . ',id,' . $admin->id;
            $admin->email = $request['email'];
        } else {
            $admin->email = $request['email'];
        }

        $request['password'] = $request['password'] ? $request['password'] : $admin->password;

        $this->validate($request, $rules, $this->messages());

        if ($admin->save()) {
            $notification = 'Alteração realizada com sucesso.';
            return redirect()->route('admin')->with('notification', $notification);
        } else {
            $notification = 'Falha ao realizar alteração.';
            return redirect()->back()->with('notification', $notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($email)
    {
        $admin = Admin::where('email', $email)->first();
        $admin->deleted = 1;
        if ($admin->save()) {
            $notification = 'Exclusão realizada com sucesso.';
            return redirect()->route('admin')->with('notification', $notification);
        } else {
            $notification = 'Falha ao excluir.';
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'role_id.required' => 'Selecione um perfil',
            'status.required' => 'Selecione um status',
            'email.unique' => 'O e-mail já foi cadastrado'
        ];

    }
}
