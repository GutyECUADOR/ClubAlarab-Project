<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nickname',
        'is_payed',
        'package_id',
        'nickname_promoter',
        'email',
        'phone',
        'password'
    ];

    public function getEstadoPagoAttribute() {
        if ($this->is_payed == 1) {
            return 'Pagado'; 
        }

        return 'Sin pagar';
    }

    public function getCantidadInvitadosPagadosAttribute () {
        $data = DB::table('users')->where([
                'nickname_promoter' => $this->nickname,
                'is_payed' => 1
        ])->get();
        
        return $data;
    }


    public function getCantidadInvesionPagadaAttribute () {
        $data = DB::table('users')
        ->select('usdt')
        ->join('packages', 'packages.id', '=', 'users.package_id')
            ->where([
                'nickname_promoter' => $this->nickname,
                'is_payed' => 1
            ])->sum('usdt');
        
        return $data;
    }

    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
