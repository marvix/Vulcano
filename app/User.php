<?php

namespace App;

use Spatie\MediaLibrary\File;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait, HasRoles, SoftDeletes;

    protected $table = 'users';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'gender',
        'skin',
    ];

    /**
     * ------------------------------------------------------------------------
     * The attributes that should be hidden for arrays.
     * ------------------------------------------------------------------------.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * ------------------------------------------------------------------------
     * The attributes that should be cast to native types.
     * ------------------------------------------------------------------------.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ------------------------------------------------------------------------
     * Define parâmetros do media library para os avatares dos usuários
     * ------------------------------------------------------------------------.
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatars')
            ->singleFile()
            ->acceptsFile(function (File $file) {
                return $file->mimeType === 'image/jpeg'
                    || $file->mimeType === 'image/png'
                    || $file->mimeType === 'image/jpg';
            });
    }

    /**
     * Verifica se o usuário é superadmin.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        $roles = $this->roles;

        $isSuperAdmin = false;
        foreach ($roles as $role) {
            if ($role->is_superadmin) {
                $isSuperAdmin = true;
            }
        }

        return $isSuperAdmin;
    }

    /**
     * Verifica se o usuário locado possui uma determinada permissão.
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        $permissions = $this->getPermissionsViaRoles();
        foreach ($permissions as $p) {
            if (is_array($permission) && in_array($p->name, $permission)) {
                return true;
            } elseif ($p->name == $permission) {
                return true;
            }
        }

        return false;
    }
}
