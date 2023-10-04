<?php

namespace Modules\Projects\Entities;

use App\Models\Status;

class Contract extends ProjectsMainModel
{
    protected $fillable = [
        'title',
        'code',
        'number',
        'date',
        'second_party',
        'assigned_works',
        'definition',
        'details',
        'commitments',
        'contract_type_id',
        'client_id',
        'branch_id',
        'management_id',
        'status_id'];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class,'id','contract_id');
    }

    public function payments() {
        return $this->hasMany(ContractPayment::class,'id','contract_id');
    }

    public function client() {
        return $this->hasOne('\App\Models\Client','id','client_id');
    }

    public function branch() {
        return $this->hasOne('\App\Models\Branch','id','branch_id');
    }

    public function management() {
        return $this->hasOne('\App\Models\Management','id','management_id');
    }

    public function form () {
        return $this->belongsTo(ContractForm::class,'id','contract_form_id');
    }

    public function scopeTransferedGetContractData() {
        return $this::where('client_id','<>', null)->select('id','number','code','contract_type_id','status_id','client_id','branch_id','management_id','date')
        ->with([
            'client'=>function($query) {
                $query->select('id','name_first','name_last','name','phone');
            },
           'branch' => function($query) {
                $query->select('id','name');
           },
           'management' => function ($query) {
                $query->select('id','name','manger_name');
           },
           'items' => function ($query) {
            $query->select('id','period');
           },
           'status' => function ($query) {
            $query->select('id','name','color');
           },
           'owner' => function ($query) {
            $query->select('id','name');
           }
        ]);
    }


    public function scopeGetNewContractData() {
        return $this::where('client_id', null)->select('id','number','code','contract_form_id','status_id','branch_id','management_id','date')
        ->with([
           'branch' => function($query) {
                $query->select('id','name');
           },
           'management' => function ($query) {
                $query->select('id','name','manger_name');
           },
           'items' => function ($query) {
            $query->select('id','period');
           },
           'status' => function ($query) {
            $query->select('id','name','color');
           },
           'owner' => function ($query) {
            $query->select('id','name');
           }
        ]);
    }

    public function scopeGetTotalData() {
        return $this::select('id','number','code','contract_form_id','status_id','branch_id','management_id','client_id','date','client_id')
        ->with([
           'client' => function($query) {
                $query->select('id','name');
           },
           'branch' => function($query) {
                $query->select('id','name');
           },
           'management' => function ($query) {
                $query->select('id','name','manger_name');
           },
           'items' => function ($query) {
            $query->select('id','period');
           },
           'status' => function ($query) {
            $query->select('id','name','color');
           },
           'owner' => function ($query) {
            $query->select('id','name');
           }
        ]);
    }

}
