<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contractor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contractors';

    protected $fillable = [
        'nombres',
        'numero_cedula',
        'fecha_expedicion_cedula',
        'tipo_contrato',
        'tipo_documento',
        'dependence_id',
        'archivo_pdf'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function dependence()
    {
        return $this->belongsTo(Dependence::class, 'dependence_id');
    }

}
