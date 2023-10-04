<?php
namespace App\Services;
use App\Models\Client;
use App\Models\Hr\Branch;
use App\Traits\AdminTrait;
use Exception;

class ClientService extends MainService {

    public function fetchAll() {
        return Client::get();
    }


    public function search($search)
    {
        return empty($search) ? Client::query()
            : Client::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('card_id', 'like', '%' . $search . '%')
//                ->orWhere('passport_id', 'like', '%' . $search . '%')
                ->orWhereHas('broker', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }


    public function store(array $data) {
        try{
            $client = Client::create($data);
            return $client;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($client, array $data) {
        try {
            $client->update($data);
            return $client;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($client) {
        // check if branch have managaments
        if($client->projects_count > 0) {
            return 0;
        } else {
            $client->delete();
        }
    }
}
