<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Alert;
use Session;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
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
     * Edição dos dados do usuário logado.
     * ------------------------------------------------------------------------.
     */
    public function edit()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(Auth::user()->hasPermission('profile_edit'), 403);

        // Obtém os dados do usuário autenticado
        $user = Auth::user();
        $roles = Role::all();

        // Obtém o avatar do usuário
        $avatar = Auth::user()->getFirstMediaUrl('avatars');

        $avatar_id = null;
        if ($avatar) {
            $avatar_id = Auth::user()->getMedia('avatars')->first()->id;
        }

        return view('profiles.edit', ['user' => $user, 'avatar' => $avatar, 'avatar_id' => $avatar_id, 'roles' => $roles]);
    }

    /**
     * ------------------------------------------------------------------------
     * Grava os dados do usuário logado.
     * ------------------------------------------------------------------------.
     *
     * @param Request $request
     * @param int     $id
     */
    public function update(Request $request, $id)
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(Auth::user()->hasPermission('profile_edit'), 403);

        // Cria as regras de validação dos dados do formulário
        $rules = [
            'name' => 'required|string|min:5|max:191',
            'gender' => 'required',
            'email' => 'required|email|max:191',
            'skin' => 'required|string',
            'password' => 'nullable|string|min:5|max:191',
        ];

        // Primeiro, vamos validar os dados do formulário
        $request->validate($rules);

        // Le os dados do usuário
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->skin = $request->skin;

        if ($request->active) {
            $user->active = $request->active;
        }

        // Se foi digitada uma senha ...
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if (isset($request->avatar)) {
            $user->clearMediaCollection('avatars');
            $user->addMedia($request->avatar)->toMediaCollection('avatars');
        }

        // Salva os dados na tabela
        $user->save();

        // Retorna para view index com uma flash message
        Alert::success('Os seus dados foram atualizados.', 'Sucesso', 'Success')->autoclose(1000);

        Session::put('skin', $request->skin);

        return redirect()->route('home');
    }

    /**
     * ------------------------------------------------------------------------
     * Deleta o avatar do usuário armazenado na tabela media
     * ------------------------------------------------------------------------.
     */
    public function deleteAvatarProfile()
    {
        // Verifica se o usuário tem direito de acesso
        abort_unless(Auth::user()->hasPermission('profile_edit'), 403);

        $user = auth()->user();
        $user->clearMediaCollection('avatars');

        Alert::success('Avatar excluido com sucesso!!', 'Sucesso', 'Success')->autoclose(1000);

        return redirect()->route('profile.edit');
    }
}
