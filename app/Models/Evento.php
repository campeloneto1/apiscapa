<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eventos';

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
    protected $with = ['setor', 'pessoas'];

    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }

     public function pessoas()
    {
        return $this->belongsToMany(Pessoa::class, 'eventos_pessoas', 'evento_id', 'pessoa_id')->withPivot('id', 'presente')->orderBy('nome');
    }
}
