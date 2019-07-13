<?php

namespace App\Http\Controllers\Admin;

use DB;
#use Auth;
use Alert;
use Session;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
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
        abort_unless(auth()->user()->hasPermission('config_show'), 403);

        // Obtém todos os registros
        $configs = Config::orderBy('id', 'asc')->paginate($this->nroRecordsByPage());

        //  Chama a view passando os dados retornados da tabela
        return view('admin.config.index', ['configs' => $configs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('config_create'), 403);

        // Chama a view com o formulário para inserir um novo registro
        return view( 'admin.config.create');
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
        abort_unless(auth()->user()->hasPermission('config_create'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'order' => 'required|integer',
            'key' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'dataenum' => 'nullable|string',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Cria um novo registro
        $config = new Config();
        $config->order = $request->order;
        $config->key = $request->key;
        $config->slug_key = str_slug($request->key, '_');
        $config->type = $request->type;
        $config->description = $request->description;
        $config->dataenum = $request->dataenum;
        $config->value = null;
        $config->created_at = now();

        // Salva os dados na tabela
        $config->save();

        // Retorna para view index com uma flash message
        Alert::success('Configuração cadastrada.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('config.index');
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
        abort_unless(auth()->user()->hasPermission('config_show'), 403);

        // Localiza e retorna os dados de um registro pelo ID
        $config = Config::findOrFail($id);

        // Chama a view para exibir os dados na tela
        return view( 'admin.config.show', ['config' => $config]);
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
        abort_unless(auth()->user()->hasPermission('config_edit'), 403);

        // Localiza o registro pelo seu ID
        $config = Config::findOrFail($id);

        // Chama a view com o formulário para edição do registro
        return view( 'admin.config.edit', ['config' => $config]);
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
        abort_unless(auth()->user()->hasPermission('config_edit'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'order' => 'required|integer',
            'key' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'dataenum' => 'nullable|string',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Localiza o registro
        $config = Config::findOrFail($id);

        $config->order = $request->order;
        $config->key = $request->key;
        $config->slug_key = str_slug($request->key, '_');
        $config->type = $request->type;
        $config->description = $request->description;
        $config->dataenum = $request->dataenum;
        $config->updated_at = now();

        // Salva os dados na tabela
        $config->save();

        // Retorna para view index com uma flash message
        Alert::success('Configuração salva.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('config.index');
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
        abort_unless(auth()->user()->hasPermission('config_delete'), 403);

        // Retorna o registro pelo ID fornecido
        $config = Config::findOrFail($id);
        $config->delete();

        // Retorna para view index com uma flash message
        Alert::success("Configuração <span class='text-red text-bold'>excluída</span>.", 'Sucesso', 'Success')
            ->html()
            ->autoclose(1000);

        return redirect()->route('config.index');
    }

    /**
     * ------------------------------------------------------------------------
     * Exibe um formulário com os dados de um determinado registro permitindo
     * que o usuário faça alterações
     * ------------------------------------------------------------------------.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function editvalues()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('config_edit'), 403);

        // Localiza o registro pelo seu ID
        // $config = Config::findOrFail($id);
        $config = Config::orderBy('order', 'asc')->get();

        // Chama a view com o formulário para edição do registro
        return view( 'admin.config.editvalues', ['config' => $config]);
    }

    public function savevalues(Request $request)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('config_edit'), 403);

        // Obtém todos os campos da view
        $configs = $request->all();

        // Salva os valores da view na tabela
        foreach ($configs as $key => $value) {
            // Se for o campo _token, então ignora
            if ($key == '_token') {
                continue;
            }

            // Localiza o registro da configuração
            $config = Config::where('slug_key', $key)->first();

            // Se encontrou então salva os dados na tabela
            if (! is_null($config)) {
                $config->value = $value;
                $config->save();
            }
        }

        // Atualiza os dados na sessão do usuário
        $this->sessionUpdate();

        // Retorna para view index com uma flash message
        Alert::success('Configurações atualizadas', 'Sucesso', 'Success')->autoclose(1000);

        // Retorna para o home
        return redirect()->route('home');
    }

    /**
     * Atualiza os valores das chaves da sessão.
     *
     * @return void
     */
    public static function sessionUpdate()
    {
        $configs = DB::table('config')->get();
        foreach ($configs as $config) {
            if (Session::has($config->slug_key)) {
                Session::forget($config->slug_key);
            }
            Session::put($config->slug_key, $config->value);
        }
    }

    /**
     * Define o nº de registros por página a serem exibidos.
     *
     * @return int $nroRecorByPage
     */
    public function nroRecordsByPage()
    {
        $nroRecordByPage = Session::get('records_by_page');

        if ($nroRecordByPage) {
            return $nroRecordByPage;
        } else {
            return 10;
        }
    }
}
