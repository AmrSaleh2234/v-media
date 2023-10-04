<?php
namespace App\Services;
use App\Models\City;
use App\Models\Client;
use App\Models\Hr\Branch;
use App\Traits\AdminTrait;
use Exception;

class CityService extends MainService {

    public function fetchAll() {
        return City::get();
    }


    public function search($search)
    {
        return empty($search) ? City::query()
            : City::query()->where('name', 'like', '%' . $search . '%')
//                ->orWhere('passport_id', 'like', '%' . $search . '%')
                ->orWhereHas('state', fn($q) => $q->where('name','like', '%'.$search.'%'))
                ->orWhereHas('country', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }


    public function store(array $data) {
        try{
            $city = City::create($data);
            return $city;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($city, array $data) {
        try {
            $city->update($data);
            return $city;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($city) {
        // check if branch have managaments
        if($city->employees_count > 0) {
            return 0;
        } else {
            $city->delete();
        }
    }
}
