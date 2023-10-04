<?php
namespace App\Services;
use App\Models\Broker;
use App\Models\Client;
use App\Models\Hr\Branch;
use App\Traits\AdminTrait;
use Exception;

class BrokerService extends MainService {

    public function fetchAll() {
        return Broker::get();
    }


    public function search($search)
    {
        return empty($search) ? Broker::query()
            : Broker::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('card_id', 'like', '%' . $search . '%')
                ->orWhereHas('clients', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }

    public function store(array $data) {
        try{
            $broker = Broker::create($data);
            return $broker;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($broker, array $data) {
        try {
            $broker->update($data);
            return $broker;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($broker) {
        // check if broker have clients
        if($broker->projects_count > 0) {
            return 0;
        } else {
            $broker->delete();
        }
    }
}
