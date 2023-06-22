<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chave extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chaves';

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
    protected $with = ['setor', 'funcionario_entrega', 'funcionario_devolucao'];

    
    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }

    public function funcionario_entrega()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_entrega_id');
    }

    public function funcionario_devolucao()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_devolucao_id');
    }
}
