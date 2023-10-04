<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Basic\BasicTable;
use Livewire\Component;

class NotificationTable extends BasicTable
{
    public function render()
    {
        $user = auth()->user();
        $unReadNotifications = $user->unReadNotifications();
        $readNotifications = $user->readNotifications();

        return view('livewire.notification-table',
            [
                'unReadNotifications' => $user->unReadNotifications()->where('data', 'like', '%' . $this->search . '%')->get(),
                'readNotifications' => $user->readNotifications()->where('data', 'like', '%' . $this->search . '%')->get()
            ]);
    }
}
