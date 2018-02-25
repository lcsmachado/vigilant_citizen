<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{

    /**
     * Total items displayed per page
     * @var int
     */
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
    public function show($id)
    {
        $admin = Admin::where('id', $id)->first();
        if ($admin->deleted == 0) {
            return view('admin.show', compact('admin'));
        }
        return redirect()->route('admin');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::where('id', $id)->first();
        if ($admin->deleted == 0) {
            $title = 'Editar Usuário: ' . $admin->name;
            return view('admin.create-edit', compact('admin', 'title'));
        }
        return redirect()->route('admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        //
        $admin = Admin::where('id', $id)->first();
        $admin->name = $request['name'];
        $admin->password = $request['password'] ? bcrypt($request['password']) : $admin->password;
        $admin->status = $request['status'];
        $admin->role_id = $request['role_id'];

        $rules = $admin->rules;

        if (!strcmp($admin->email, $request['email']))
        {
            $rules['email'] = $rules['email'] . ',id,' . $admin->id;
            $admin->email = $request['email'];
        } else {
            $admin->email = $request['email'];
        }

        if($request['password'] == null)
        {
            $request['password'] = $admin->password;
            $request['password_confirmation'] =  $admin->password;
        }


        $this->validate($request, $rules, $this->messages());

        if ($admin->save())
        {
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

    public function destroy($id)
    {
        $admin = Admin::where('id', $id)->first();
        $admin->deleted = 1;
        if ($admin->save())
        {
            $notification = 'Exclusão realizada com sucesso.';
            return redirect()->route('admin')->with('notification', $notification);
        } else
            {
                 $notification = 'Falha ao excluir.';
                 return redirect()->back()->with('notification', $notification);
            }
    }


    /**
     * Displays trash with deleted users
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        $admins =  Admin::where('deleted', 1)->orderBy('name')->paginate($this->totalPage);
        return view('admin.trash',compact('admins'));
    }

    /**
     * Restores a user marked as deleted in the database
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $user = Admin::where('id',$id)->first();
        $user->deleted = 0;
        if($user->save())
        {
            $notification = 'Usuário restaurado com sucesso!';
            return redirect()->route('admin')->with('notification',$notification);
        }
        return redirect()->back();
    }

    /**
     * Array of messages to validate form data
     * @return array
     */

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres.',
            'name.max' => 'O nome deve ter no máximo 45 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.max' => 'O email deve ter no máximo 145 caracteres.',
            'email.unique' => 'O e-mail já foi cadastrado. Ou encontra-se na lixeira, para ser restaurado',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
            'password.confirmed' =>'A confirmação da senha não corresponde.',
            'role_id.required' => 'Selecione um perfil',
            'status.required' => 'Selecione um status',
        ];

    }
}
