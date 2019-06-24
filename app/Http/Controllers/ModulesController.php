<?php

namespace App\Http\Controllers;

use Alert;
use Session;
use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModulesController extends Controller
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
     * ------------------------------------------------------------------------
     * Display a listing of the resource.
     * ------------------------------------------------------------------------
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('modules_show'), 403);

        // Obtém todos os registros da tabela
        $modules = Module::orderBy('id', 'asc')->paginate(Session::get('records_by_page'));

        //  Chama a view passando os dados retornados da tabela
        return view('admin.modules.index', ['modules' => $modules]);
    }

    /**
     * ------------------------------------------------------------------------
     * Show the form for creating a new resource.
     * ------------------------------------------------------------------------
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('modules_create'), 403);

        // Chama a view com o formulário para inserir um novo registro
        return view('admin.modules.create');
    }

    /**
     * ------------------------------------------------------------------------
     * Store a newly created resource in storage.
     * ------------------------------------------------------------------------
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('modules_create'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'prefix' => 'required|min:3|max:191',
            'description' => 'required|min:6|max:191',
        ];

        $acessos="";
        $acessos .= isset($request->access)? "A" : "";
        $acessos .= isset($request->create)? "C" : "";
        $acessos .= isset($request->read)? "R" : "";
        $acessos .= isset($request->edit)? "U" : "";
        $acessos .= isset($request->delete)? "D" : "";

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Cria um novo registro
        $module = new Module();
        $module->prefix = Str::slug($request->prefix,"_");
        $module->description = $request->description;
        $module->access = $acessos;
        $module->created_at = now();

        // Salva os dados na tabela
        $module->save();

        // Retorna para view index com uma flash message
        Alert::success('Módulo cadastrado.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('modules.index');
    }

    /**
     * ------------------------------------------------------------------------
     * Display the specified resource.
     * ------------------------------------------------------------------------
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('modules_show'), 403);

        // Localiza e retorna os dados de um registro pelo ID
        $module = Module::findOrFail($id);

        // Chama a view para exibir os dados na tela
        return view('admin.modules.show', ['module' => $module]);
    }

    /**
     * ------------------------------------------------------------------------
     * Show the form for editing the specified resource.
     * ------------------------------------------------------------------------
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('modules_edit'), 403);

        // Localiza o registro pelo seu ID
        $module = Module::findOrFail($id);

        // Chama a view com o formulário para edição do registro
        return view('admin.modules.edit', ['module' => $module]);
    }

    /**
     * ------------------------------------------------------------------------
     * Update the specified resource in storage.
     * ------------------------------------------------------------------------
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('modules_edit'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'prefix' => 'required|min:3|max:191',
            'description' => 'required|min:6|max:191',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        $acessos="";
        $acessos .= isset($request->access)? "A" : "";
        $acessos .= isset($request->create)? "C" : "";
        $acessos .= isset($request->read)? "R" : "";
        $acessos .= isset($request->edit)? "U" : "";
        $acessos .= isset($request->delete)? "D" : "";

        // Le os dados do papel
        $module = Module::findOrFail($id);
        $module->prefix = Str::slug($request->prefix, "_");
        $module->description = $request->description;
        $module->access = $acessos;
        $module->updated_at = now();

        // Salva os dados na tabela
        $module->save();

        // Retorna para view index com uma flash message
        Alert::success('Dados atualizados.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('modules.index');
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
        abort_unless(auth()->user()->hasPermission('modules_delete'), 403);

        // Retorna o registro pelo ID fornecido
        $module = Module::findOrFail($id);
        $module->delete();

        // Retorna para view index com uma flash message
        Alert::success("Módulo <span class='text-red text-bold'>excluído</span>.", 'Sucesso', 'Success')
            ->html()
            ->autoclose(1000);

        return redirect()->route('modules.index');
    }
}
