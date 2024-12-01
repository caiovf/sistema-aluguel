<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use NumberFormatter;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'price_contract',
        'active_contract',
        'property_id'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'price_contract' => 'decimal:2',
        'active_contract' => 'boolean',
        'property_id' => 'integer'
    ];

    public function getFormattedPriceAttribute()
    {
        $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($this->price_contract, 'BRL');
    }

    public function getContractTimeRemaing($start_date='')
    {
        if( empty($start_date) ){
            $start_date = Carbon::now();
        }
        $contract_end_date = Carbon::parse($this->end_date);
        $diff_days = $start_date->diffInDays($contract_end_date);

        if ($start_date->isBefore($contract_end_date)) {
            $diffInMonths = $start_date->diffInMonths($contract_end_date);
            
            if ($diffInMonths >= 12) {                
                $years = floor($diffInMonths / 12);
                return "$years ano" . ($years > 1 ? 's' : '')." para o fim do contrato";
            } 
            
            if ($diffInMonths < 12 && $diffInMonths > 0) {                
                return "$diffInMonths mes" . ($diffInMonths > 1 ? 'es' : '')." para o fim do contrato";
            } 
            
            if( $diffInMonths === 0 ){
                $diff_days = $start_date->diffInDays($contract_end_date);
                return "$diff_days dia" . ($diff_days > 1 ? 's' : '')." para o fim do contrato";
            }
        }
            
        return "O contrato já expirou há $diff_days dia" . ($diff_days > 1 ? 's' : '');         
    }

    public function getFormattedDate($date){
        return Carbon::parse($date)->format('d/m/Y');
    }
}
