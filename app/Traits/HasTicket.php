<?php

namespace App\Traits;

  use App\Models\Ticket;

  trait HasTicket
  {
      public function ticktes()
      {
          return $this->morphMany(Ticket::class,'has_ticket');
      }

      public function lastTickets()
      {
          return $this->morphMany(Ticket::class,'has_ticket')->latest();
      }

      public function lastTicket()
      {
          return $this->morphMany(Ticket::class,'has_ticket')->latest()->limit(1);
      }

  }
