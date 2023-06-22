<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'acessos';

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
    protected $with = ['pessoa', 'setor', 'funcionario', 'posto', 'createdby'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function posto()
    {
        return $this->belongsTo(Posto::class);
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by')->without('perfil');
    }

    
}
