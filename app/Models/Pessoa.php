<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pessoas';

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
    protected $with = [ 'sexo', 'uf_rg', 'cidade'];

    
    /*public function orgao()
    {
        return $this->belongsTo(Orgao::class)->without('setores', 'niveis');
    }


    public function nivel()
    {
        return $this->belongsTo(Nivel::class)->without('orgao');
    }*/

    public function acessos()
    {
        return $this->hasMany(Acesso::class)->orderBy('id', 'desc');
    }

    public function sexo()
    {
        return $this->belongsTo(Sexo::class);
    }

    public function uf_rg()
    {
        return $this->belongsTo(Estado::class, 'uf_rg_id')->without(['pais']);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
