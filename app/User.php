<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait, HasRoles;

    /**
     * ------------------------------------------------------------------------
     * The attributes that are mass assignable.
     * ------------------------------------------------------------------------
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * ------------------------------------------------------------------------
     * The attributes that should be hidden for arrays.
     * ------------------------------------------------------------------------
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * ------------------------------------------------------------------------
     * The attributes that should be cast to native types.
     * ------------------------------------------------------------------------
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ------------------------------------------------------------------------
     * Define parâmetros do media library para os avatares dos usuários
     * ------------------------------------------------------------------------
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
}
