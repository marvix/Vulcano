<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

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
        // Obtém todos os registros da tabela de usuários
        $users = User::orderBy('id', 'asc')->paginate(5);

        // Chama a view passando os dados retornados da tabela
        return view('users.index', ['users' => $users]);
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
        // Chama a view com o formulário para inserir um novo registro
        return view('users.create');
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
        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|min:5|max:30',
            'email' => 'required|email|unique:users',
            'isadmin' => 'required',
            'active' => 'required',
            'password' => 'required|min:6',
        ];

        // Cria o array com as mensagens de erros
        $messages = [
            'name' => 'Forneça o nome do usuários.',
            'email' => 'Forneça um e-mail válido.',
            'isadmin' => 'Defina se o usuário será um administrador.',
            'active' => 'Defina se o usuário está ativo no sistema',
            'password' => 'Forneça uma senha válida para o usuário.',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules, $messages);

        // Cria um novo registro
        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->isAdmin = $request->isadmin;
        $user->active = $request->active;
        $user->password = bcrypt($request->password);

        if (isset($request->avatar)) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        // Salva os dados na tabela
        $user->save();

        // Retorna para view index com uma flash message
        return redirect()
            ->route('users.index')
            ->with('status', 'Registro criado com sucesso!');
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
        // Localiza e retorna os dados de um registro pelo ID
        $user = User::findOrFail($id);

        // Obtém o avatar
        $avatar = $user->getFirstMediaUrl('avatars');

        // Chama a view para exibir os dados na tela
        return view('users.show', ['user' => $user, 'avatar' => $avatar]);
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
        // Localiza o registro pelo seu ID
        $user = User::findOrFail($id);

        // Obtém o avatar
        $avatar = $user->getFirstMediaUrl('avatars');
        $avatar_id = null;
        if ($avatar) {
            $avatar_id = $user->getMedia('avatars')->first()->id;
        }

        // Chama a view com o formulário para edição do registro
        return view('users.edit', ['user' => $user, 'avatar' => $avatar, 'avatar_id' => $avatar_id]);
    }

    /**
     * ------------------------------------------------------------------------
     * Utilizado para atualizados os dados do formulário na tabela
     * ------------------------------------------------------------------------.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|min:5|max:30',
            'email' => 'required|email|unique:users,email,' . $id,
            'isadmin' => 'required',
            'active' => 'required',
        ];

        // Cria o array com as mensagens de erros
        $messages = [
            'name' => 'Forneça o nome do usuários.',
            'email' => 'Forneça um e-mail válido.',
            'isadmin' => 'Defina se o usuário será um administrador.',
            'active' => 'Defina se o usuário está ativo no sistema',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules, $messages);

        // Le os dados do usuário
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->isAdmin = $request->isadmin;
        $user->active = $request->active;
        $user->email = $request->email;

        // Se foi digitada uma senha ...
        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }

        if (isset($request->avatar)) {
            $user->clearMediaCollection('avatars');
            $user->addMedia($request->avatar)->toMediaCollection('avatars');
        }

        // Salva os dados na tabela
        $user->save();

        // Retorna para view index com uma flash message
        return redirect()
            ->route('users.index')
            ->with('message', 'Registro atualizado com sucesso!')
            ->with('type', 'success');
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
    public function destroy($id)
    {
        // Retorna o registro pelo ID fornecido
        $user = User::findOrFail($id);

        // Exclui o registro da tabela
        $user->clearMediaCollection('avatars');
        $user->delete();

        $message = 'Registro excluído com sucesso';
        $type = 'success';

        // Retorna para view index com uma flash message
        return redirect()->back()
            ->with('message', $message)
            ->with('type', $type);
    }

    /**
     * ------------------------------------------------------------------------
     * Muda o status do usuário para ativo
     * ------------------------------------------------------------------------.
     *
     * @param int $id
     */
    public function activeUser($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update(['active' => 1]);

        return redirect()
            ->route('users.index')
            ->with('message', 'Usuário está ATIVO no sistema.')
            ->with('type', 'success');
    }

    /**
     * ------------------------------------------------------------------------
     * Muda o status do usuário para inativo
     * ------------------------------------------------------------------------.
     *
     * @param int $id
     */
    public function desactiveUser($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update(['active' => 0]);

        return redirect()
            ->route('users.index')
            ->with('message', 'Usuário está INATIVO no sistema.')
            ->with('type', 'success');
    }

    /**
     * ------------------------------------------------------------------------
     * Edição dos dados do usuário logado.
     * ------------------------------------------------------------------------.
     */
    public function editProfile()
    {
        // Obtém os dados do usuário autenticado
        $user = auth()->user();

        // Obtém
        $avatar = auth()->user()->getFirstMediaUrl('avatars');

        $avatar_id = null;
        if ($avatar) {
            $avatar_id = auth()->user()->getMedia('avatars')->first()->id;
        }

        return view('profiles.edit', ['user' => $user, 'avatar' => $avatar, 'avatar_id' => $avatar_id]);
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
        $user = User::find($id);
        $user->clearMediaCollection('avatars');

        return redirect()
            ->back()
            ->with('message', 'Avatar excluído com sucesso!!')
            ->with('type', 'success');
    }

    /**
     * ------------------------------------------------------------------------
     * Grava os dados do usuário logado.
     * ------------------------------------------------------------------------.
     *
     * @param Request $request
     * @param int     $id
     */
    public function updateProfile(Request $request, $id)
    {
        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|string|min:5',
            'email' => 'required|email',
        ];

        // Cria o array com as mensagens de erros
        $messages = [
            'name' => 'Forneça seu nome.',
            'email' => 'Forneça um e-mail válido',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules, $messages);

        // Le os dados do usuário
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;

        // Se foi digitada uma senha ...
        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }

        if (isset($request->avatar)) {
            $user->clearMediaCollection('avatars');
            $user->addMedia($request->avatar)->toMediaCollection('avatars');
        }

        // Salva os dados na tabela
        $user->save();

        // Retorna para view index com uma flash message
        return redirect()
            ->route('profile.edit')
            ->with('message', 'Registro atualizado com sucesso!')
            ->with('type', 'success');
    }

    /**
     * ------------------------------------------------------------------------
     * Deleta o avatar do usuário armazenado na tabela media
     * ------------------------------------------------------------------------.
     */
    public function deleteAvatarProfile()
    {
        $user = auth()->user();
        $user->clearMediaCollection('avatars');

        return redirect()
            ->route('profile.edit')
            ->with('message', 'Avatar excluído com sucesso!')
            ->with('type', 'success');
    }
}
