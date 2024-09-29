<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dependence extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dependences';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function contractors()
    {
        return $this->hasMany(Contractor::class, 'dependence_id');
    }
}
