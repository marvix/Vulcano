<?php

namespace App\Http\Controllers;

use Alert;
use App\Module;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * ------------------------------------------------------------------------
     * Somente usuários autenticados poderão acessar os métodos do
     * controller
     * ------------------------------------------------------------------------.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('roles_show'), 403);

        // Obtém todos os registros da tabela de usuários
        $roles = Role::orderBy('id', 'asc')->paginate(5);

        //  Chama a view passando os dados retornados da tabela
        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('roles_create'), 403);

        // Obtém todas os módulos do sistema
        $modules = Module::all();

        // Chama a view com o formulário para inserir um novo registro
        return view('roles.create', ['modules' => $modules]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('roles_create'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|min:3|max:191',
//            'is_superadmin' => 'required',
            'description' => 'required|min:6|max:191',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Cria um novo registro
        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->is_superadmin = ($request->is_superadmin == 'on') ? 1 : 0;
        $role->guard_name = 'web';

        // Salva os dados na tabela
        $role->save();

        $permission = [];
        for ($i = 0; $i < count($request->module); $i++) {
            if (isset($request->acessar[$i])) {
                $permission[] = $request->acessar[$i];
            }
            if (isset($request->criar[$i])) {
                $permission[] = $request->criar[$i];
            }
            if (isset($request->editar[$i])) {
                $permission[] = $request->editar[$i];
            }
            if (isset($request->visualizar[$i])) {
                $permission[] = $request->visualizar[$i];
            }
            if (isset($request->excluir[$i])) {
                $permission[] = $request->excluir[$i];
            }
        }

        $role->syncPermissions($permission);

        // Retorna para view index com uma flash message
        Alert::success('Papel cadastrado.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('roles_show'), 403);

        // Localiza e retorna os dados de um registro pelo ID
        $role = Role::findOrFail($id);

        // Obtém todas os módulos do sistema
        $modules = Module::all();

        // Obtém todas as permissões de um determinado papel
        $role_permissions = $role->permissions()->orderBy('name')->get();
        $permissions = [];
        foreach ($role_permissions as $rp) {
            $permissions[] = $rp->name;
        }

        // Chama a view para exibir os dados na tela
        return view('roles.show', ['role' => $role,'modules' => $modules, 'permissions' => $permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('roles_edit'), 403);

        // Obtém todas os módulos do sistema
        $modules = Module::all();

        // Localiza o registro pelo seu ID
        $role = Role::findOrFail($id);

        // Obtém todas as permissões de um determinado papel
        $role_permissions = $role->permissions()->get();
        $permissions = [];
        foreach ($role_permissions as $rp) {
            $permissions[] = $rp->name;
        }

        // Chama a view com o formulário para edição do registro
        return view('roles.edit', ['role' => $role, 'permissions' => $permissions, 'modules' => $modules]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('roles_edit'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|min:3|max:191',
//            'is_superadmin' => 'required',
            'description' => 'required|min:6|max:191',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Le os dados do papel
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->is_superadmin = ($request->is_superadmin == 'on') ? 1 : 0;
        $role->guard_name = 'web';

        // Salva os dados na tabela
        $role->save();

        $permission = [];
        for ($i = 0; $i < count($request->module); $i++) {
            if (isset($request->acessar[$i])) {
                $permission[] = $request->acessar[$i];
            }
            if (isset($request->criar[$i])) {
                $permission[] = $request->criar[$i];
            }
            if (isset($request->editar[$i])) {
                $permission[] = $request->editar[$i];
            }
            if (isset($request->visualizar[$i])) {
                $permission[] = $request->visualizar[$i];
            }
            if (isset($request->excluir[$i])) {
                $permission[] = $request->excluir[$i];
            }
        }

        $role->syncPermissions($permission);

        // Retorna para view index com uma flash message
        Alert::success('Dados atualizados.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('roles.index');
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para excluir um registro da tabela
     * ------------------------------------------------------------------------.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('roles_delete'), 403);

        // Retorna o registro pelo ID fornecido
        $role = Role::findOrFail($id);
        $role->delete();

        // Retorna para view index com uma flash message
        Alert::success("Papel <span class='text-red text-bold'>excluído</span>.", 'Sucesso', 'Success')
            ->html()
            ->autoclose(1000);

        return redirect()->route('roles.index');
    }
}
