<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Alert;
use Session;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Datatables;
use App\Http\Controllers\Controller;

class UsersController extends Controller
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
        abort_unless(Auth::user()->hasPermission('users_access'), 403);

        if (request()->ajax()) {
            $query = User::select(['id', 'name', 'email', 'active']);
            $datatable = Datatables::of($query);
                // ->addIndexColumn()
                // ->addColumn('action', 'action_button')
                // ->rawColumns(['action'])
                // ->make();
                // ->toJson();
            return $datatable->blacklist(['action'])->make(true);
            // return $users;
        }

        return view('admin.users.index2');

        // Obtém todos os registros da tabela de usuários
        // $users = User::orderBy('id', 'desc')->paginate($this->nroRecordsByPage());

        // dd($users,$users->hasAnyRole(Role::all()))  ;

        //  Chama a view passando os dados retornados da tabela
        // return view('admin.users.index', ['users' => $users]);
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
        abort_unless(auth()->user()->hasPermission('users_create'), 403);

        // Obtém a lista de papéis
        $roles = Role::where('name', '!=', 'Super Admin')->get();

        // Chama a view com o formulário para inserir um novo registro
        return view('admin.users.create', ['roles' => $roles]);
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
        abort_unless(auth()->user()->hasPermission('users_create'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:191|unique:users',
            'active' => 'required',
            'skin' => 'required|string',
            'password' => 'required|min:6|max:191',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Cria um novo registro
        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->active = ($request->active == 'on') ? 1 : 0;
        $user->password = Hash::make($request->password);
        $user->skin = $request->skin;

        if (isset($request->avatar)) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        // Salva os dados na tabela
        $user->save();

        // Atribui o papel para o usuário
        $user->syncRoles($request->role);

        // Retorna para view index com uma flash message
        Alert::success('Usuário cadastrado.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('users.index');
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
        abort_unless(auth()->user()->hasPermission('users_show'), 403);

        // Localiza e retorna os dados de um registro pelo ID
        $user = User::findOrFail($id);

        // Obtém o avatar
        $avatar = $user->getFirstMediaUrl('avatars');

        // Chama a view para exibir os dados na tela
        return view('admin.users.show', ['user' => $user, 'avatar' => $avatar]);
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
        abort_unless(auth()->user()->hasPermission('users_edit'), 403);

        // Localiza o registro pelo seu ID
        $user = User::findOrFail($id);
        $roles = Role::all();

        // Obtém o avatar
        $avatar = $user->getFirstMediaUrl('avatars');
        $avatar_id = null;
        if ($avatar) {
            $avatar_id = $user->getMedia('avatars')->first()->id;
        }

        // Chama a view com o formulário para edição do registro
        return view('admin.users.edit', ['user' => $user, 'avatar' => $avatar, 'avatar_id' => $avatar_id, 'roles' => $roles]);
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
        abort_unless(auth()->user()->hasPermission('users_edit'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:191|unique:users,email,'.$id,
            'gender' => 'required',
            'role' => 'required',
            'active' => 'nullable',
            'skin' => 'required|string',
            'password' => 'nullable|string|min:6|max:191',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Le os dados do usuário
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->active = $request->active;
        $user->email = $request->email;
        $user->skin = $request->skin;
        $user->active = ($request->active == 'on') ? 1 : 0;

        // Se foi digitada uma senha ...
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if (isset($request->avatar)) {
            $user->clearMediaCollection('avatars');
            $user->addMedia($request->avatar)->toMediaCollection('avatars');
        }

        // Se o papel do usuário foi alterado, então atualiza o registro
        if (count($user->roles) == 0) {
            $user->syncRoles($request->role);
        } else {
            if ($user->roles[0] != $request->role) {
                $user->syncRoles($request->role);
            }
        }

        // Salva os dados na tabela
        $user->save();

        // Retorna para view index com uma flash message
        Alert::success('Dados atualizados.', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('users.index');
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
        abort_unless(auth()->user()->hasPermission('users_delete'), 403);

        // Retorna o registro pelo ID fornecido
        $user = User::findOrFail($id);

        // Exclui o registro da tabela
        $user->clearMediaCollection('avatars');
        $user->delete();

        // Retorna para view index com uma flash message
        Alert::success("Usuário <span class='text-red text-bold'>excluído</span>.", 'Sucesso', 'Success')
            ->html()
            ->autoclose(1000);

        return redirect()->route('users.index');
    }

    /**
     * ------------------------------------------------------------------------
     * Deleta o avatar de um determinado usuário.
     * ------------------------------------------------------------------------.
     *
     * @param int $id
     */
    public function deleteAvatarUser($id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(auth()->user()->hasPermission('users_edit'), 403);

        $user = User::find($id);
        $user->clearMediaCollection('avatars');

        Alert::success("O <span class='text-green text-bold'>avatar</span> deste usuário foi <span class='text-red text-bold'>excluído</span>.", 'Sucesso', 'Success')
            ->html()
            ->autoclose(1000);

        return redirect()->back();
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
