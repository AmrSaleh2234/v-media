<?php

namespace App\Http\Controllers\Api\GADA;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\GADA\AgreementResource;
use App\Models\GADA\Agreement;
use Illuminate\Http\Request;

class AgreementsController extends ApiController
{
    public function __construct() {
        parent::__construct();
        $this->middleware('auth:api-client');
    }

    public function index()
    {
        return $this->successResponse(AgreementResource::collection(Agreement::active()->get()));
    }
}
