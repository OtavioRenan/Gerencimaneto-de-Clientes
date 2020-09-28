<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'id', 'nome', 'cpf', 'rg', 'uf', 'telefone', 'created_at',
        'nascimento', 'id_user_create', 'id_user_update', 'updated_at',
    ];

    protected $appends = ['data_convertida', 'user_create', 'user_update', 'data_criacao', 'data_atualizacao'];

    public function getDataConvertidaAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['nascimento']));
    }

    public function getDataCriacaoAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['created_at']));
    }

    public function getDataAtualizacaoAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['updated_at']));
    }

    public function getUserCreateAttribute()
    {
        $user = User::find($this->attributes['id_user_create']);
        return $user->name;
    }

    public function getUserUpdateAttribute()
    {
        $user = User::find($this->attributes['id_user_update']);
        return $user->name;
    }
}