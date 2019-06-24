<?php

namespace App\Http\Controllers;

use Alert;
use Session;
use App\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
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
        abort_unless(auth()->user()->hasPermission('permissions_show'), 403);

        // Obtém todos os registros da tabela de usuários
        $permissions = Permission::orderBy('id', 'asc')->paginate(Session::get('records_by_page'));

        //  Chama a view passando os dados retornados da tabela
        return view('permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('permissions_create'), 403);

        // Chama a view com o formulário para inserir um novo registro
        return view('permissions.create');
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
        abort_unless(auth()->user()->hasPermission('permissions_create'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|min:5|max:191',
            'description' => 'required|min:6|max:191',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Cria um novo registro
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->guard_name = 'web';
        $permission->created_at = now();

        // Salva os dados na tabela
        $permission->save();

        // Retorna para view index com uma flash message
        Alert::success('Permissão cadastrada.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('permissions.index');
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
        abort_unless(auth()->user()->hasPermission('permissions_show'), 403);

        // Localiza e retorna os dados de um registro pelo ID
        $permission = Permission::findOrFail($id);

        // Chama a view para exibir os dados na tela
        return view('permissions.show', ['permission' => $permission]);
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
        abort_unless(auth()->user()->hasPermission('permissions_edit'), 403);

        // Localiza o registro pelo seu ID
        $permission = Permission::findOrFail($id);

        // Chama a view com o formulário para edição do registro
        return view('permissions.edit', ['permission' => $permission]);
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
        abort_unless(auth()->user()->hasPermission('permissions_edit'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|min:5|max:191',
            'description' => 'required|min:6|max:191',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Le os dados do papel
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->guard_name = 'web';
        $permission->updated_at = now();

        // Salva os dados na tabela
        $permission->save();

        // Retorna para view index com uma flash message
        Alert::success('Dados atualizados.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('permissions.index');
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
        abort_unless(auth()->user()->hasPermission('permissions_delete'), 403);

        // Retorna o registro pelo ID fornecido
        $permission = Permission::findOrFail($id);
        $permission->delete();

        // Retorna para view index com uma flash message
        Alert::success("Permissão <span class='text-red text-bold'>excluída</span>.", 'Sucesso', 'Success')
            ->html()
            ->autoclose(1000);

        return redirect()->route('permissions.index');
    }
}
