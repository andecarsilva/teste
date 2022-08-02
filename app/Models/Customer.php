<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'birth_date',
        'rg',
        'cpf',
        'zip_code',
        'address',
        'number',
        'district',
        'public_place',
        'county',
        'status_cliente',
        'profile_picture'
    ];

    public static function boot()
    {
        parent::boot();
        self::created(function($customer){
        // faz a verificacao do cpf

        $verificacao = substr($customer->cpf, 0, 1);
        if($verificacao >= 0 && $verificacao <= 6){
            // ate 1950 ate 2000
                $status_cliente = true;
        }else{
            $status_cliente = false;
        }

        $customer->status_cliente = $status_cliente;
        $customer->save();
        });

    }
}