<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',

    // ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'name'=> 'boolean'
    ];

    public function store()
    {
        return $this->hasOne(Store::class);
    }
}


// 1:1 - um pra um (usuario e loja)  - aqui trabalharemos com um método hasOne e belongsTo
// 1:N - um pra muitos (loja e produto) - aqui trabalharemos com um método hasMany e belongsTo
// N:N - muito pra muitos (produtos e categorias) aqui trabalharemos com um método chamado
// belongsToMany

// Isto será representado via Model no Eloquent - 

// public function store(){
//     return $this->hasOne(Store::class);
//     // return $this->hasOne(Store::class, 'nome_diferente de user_id');
//     // este segundo parametro é para ser usado caso o nome id esteja diferente do qual o laravel
//     // tenha criado.

// }


/* complemento a ser utilizado depois* */
// public function orders()
//     {
//     	return $this->hasMany(UserOrder::class);
//     }

//     public function routeNotificationForNexmo($notification)
//     {
//     	$storeMobilePhoneNumber = trim(str_replace(['(', ')', ' ', '-'], '', $this->store->mobile_phone));
//     	return '55' . $storeMobilePhoneNumber;
//     }