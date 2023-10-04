<?php
namespace App\Services\Attendance;
use App\Models\Client;
use App\Models\Ticket;
use App\Services\MainService;
use Exception;

class TicketService extends MainService {

    public function fetchAll() {
        return Ticket::get();
    }


    public function search($search)
    {
        return empty($search) ? Ticket::query()
            : Ticket::query()->where('title', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                ->orWhere('response', 'like', '%' . $search . '%')
                ->orWhere('note', 'like', '%' . $search . '%');
//                ->orWhereHas('owner', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }


    public function store(array $data) {
        try{
            $ticket = Ticket::create($data);
            return $ticket;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($ticket, array $data) {
        try {
            $ticket->update($data);
            return $ticket;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($ticket) {
        // check if branch have managaments
        if($ticket->resolved == 0) {
            return 0;
        } else {
            $ticket->delete();
        }
    }
}
