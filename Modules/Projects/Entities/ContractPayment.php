<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;

class ContractPayment extends ProjectsMainModel
{
    protected $fillable = [
        'contract_id',
        'amount',
        'period',
        'end_date',
    ];

    public function contract() {
        return $this->blongsTo(Contract::class);
    }
}
