<?php
namespace App\Services;

use App\Exports\UsersExport;
use App\Models\User;

use Exception;
use Maatwebsite\Excel\Facades\Excel;

class UserService extends MainService {

    public function fetchAll() {
        return User::get();
    }


    public function search($search)
    {
        return empty($search) ? User::query()
            : User::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
//                ->orWhere('passport_id', 'like', '%' . $search . '%')
//                ->orWhereHas('broker', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }

    public function store(array $data) {
        try{
            $user = User::create($data);
            return $user;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($user, array $data) {
        try {
            $user->update($data);
            return $user;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($user) {
        if($user->projects_count > 0) {
            return 0;
        } else {
            $user->delete();
        }
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
