<?php

namespace App\Models\mobileBanking;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Nasabah extends Authenticatable
{
    use Notifiable;
	 protected $table = 'm_nasabah';

    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama','username', 'id_kelas', 'password_mbanking', 'pin_mbanking'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password_mbanking', 'pin_mbanking',
    ];
    	
}
