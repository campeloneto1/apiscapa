<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orgao extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orgaos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

     /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [];

    public function setores()
    {
        return $this->hasMany(Setor::class, 'orgao_id')->without('orgao');
    }

    public function postos()
    {
        return $this->hasMany(Posto::class, 'orgao_id')->without('orgao');
    }

    public function niveis()
    {
        return $this->hasMany(Nivel::class, 'orgao_id')->without('orgao');
    }

    
}
