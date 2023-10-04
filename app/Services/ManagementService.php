<?php

namespace App\Services;

use App\Models\Hr\Management;
use Exception;

class ManagementService extends MainService {

    public function fetchAll() {
        return Management::get();
    }

    public function store(array $data) {
        try{
            $Management = Management::create($data);
            return $Management;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($Management, array $data) {
        try {
            $Management->update($data);
            return $Management;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($Management) {
        // check if Management have managaments
        if($Management->branches) {
            return 0;
        } else {
            $Management->delete();
        }
    }
}

?>
