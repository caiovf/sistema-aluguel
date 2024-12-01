<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\contract;

class Property extends Model
{
    use HasFactory;

    // Permitir atribuição em massa para os campos listados
    protected $fillable = [
        'name',
        'user_id'
    ];

    protected $casts = [
        'name' => 'string',
        'user_id' => 'integer',
    ];
    
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
