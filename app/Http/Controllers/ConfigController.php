<?php

namespace App\Http\Controllers;

use DB;
use Str;
use Auth;
use Alert;
use Session;
use App\Config;
use Illuminate\Http\Request;

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
     * ------------------------------------------------------------------------
     * Utilizado para exibir uma lista de classificações
     * ------------------------------------------------------------------------.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(Auth::user()->hasPermission('config_show'), 403);

        // Obtém todos os registros da tabela de usuários
        $config = Config::orderBy('id', 'desc')->paginate($this->nroRecordsByPage());

        //  Chama a view passando os dados retornados da tabela
        return view('config.index', ['config' => $config]);
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para exibir a view com o formulário para a inclusão de
     * um novo registro
     * ------------------------------------------------------------------------.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('config_create'), 403);

        // Chama a view com o formulário para inserir um novo registro
        return view('config.create');
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para inserir os dados do formulário na tabela
     * ------------------------------------------------------------------------.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('config_create'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'key' => 'required|string',
            'value' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Cria um novo registro
        $config = new Config();
        $config->key = $request->key;
        $config->slug_key = Str::slug($request->key, '_');
        $config->value = $request->value;
        $config->type = $request->type;
        $config->description = $request->description;

        // Salva os dados na tabela
        $config->save();
        $this->sessionUpdate();

        // Retorna para view index com uma flash message
        Alert::success('Configuração cadastrada.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('config.index');
    }

    /**
     * ------------------------------------------------------------------------
     * Exibe os dados de um determinado registro
     * ------------------------------------------------------------------------.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('config_show'), 403);

        // Localiza e retorna os dados de um registro pelo ID
        $config = Config::findOrFail($id);

        // Chama a view para exibir os dados na tela
        return view('config.show', ['config' => $config]);
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
    public function edit($id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('config_edit'), 403);

        // Localiza o registro pelo seu ID
        $config = Config::findOrFail($id);

        // Chama a view com o formulário para edição do registro
        return view('config.edit', ['config' => $config]);
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para atualizados os dados do formulário na tabela
     * ------------------------------------------------------------------------.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('config_edit'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'key' => 'required',
            'value' => 'required',
            'type' => 'required',
            'description' => 'required',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Le os dados do usuário
        $config = Config::findOrFail($id);
        $config->key = $request->key;
        $config->slug_key = Str::slug($request->key, '_');
        $config->value = $request->value;
        $config->type = $request->type;
        $config->description = $request->description;

        // Salva os dados na tabela
        $config->save();
        $this->sessionUpdate();

        // Retorna para view index com uma flash message
        Alert::success('Configuração atualizaca.', 'Sucesso', 'Success')->autoclose(1000);

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
        $this->sessionUpdate();

        // Retorna para view index com uma flash message
        Alert::success('Configuração excluída.', 'Sucesso', 'Success')
            ->html()
            ->autoclose(1000);

        return redirect()->route('config.index');
    }

    /**
     * Atualiza os valores das chaves da sessão.
     *
     * @return void
     */
    public static function sessionUpdate()
    {
        $configs = DB::table('config')->get();
        foreach ($configs as $c) {
            if (Session::has($c->slug_key)) {
                Session::forget($c->slug_key);
            }
            Session::put($c->slug_key, $c->value);
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
