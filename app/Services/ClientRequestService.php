<?php
namespace App\Services;
use App\Models\Client;
use App\Models\ClientRequest;
use App\Models\Hr\Branch;
use App\Traits\AdminTrait;
use Exception;

class ClientRequestService extends MainService {

    public function fetchAll() {
        return ClientRequest::get();
    }


    public function search($search)
    {
        return empty($search) ? ClientRequest::query()
            : ClientRequest::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('card_id', 'like', '%' . $search . '%')
                ->orWhere('register_number', 'like', '%' . $search . '%')
                ->orWhereHas('broker', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }


    public function store(array $data) {
        try{
            $clientRequest = ClientRequest::create($data);
            return $clientRequest;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($clientRequest, array $data) {
        try {
            $clientRequest->update($data);
            return $clientRequest;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($clientRequest) {
        // check if branch have managaments
        if($clientRequest->clients_count > 0) {
            return 0;
        } else {
            $clientRequest->delete();
        }
    }
}
