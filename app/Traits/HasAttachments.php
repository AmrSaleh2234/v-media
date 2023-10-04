<?php

namespace App\Traits;

  use App\Models\Address;
  use App\Models\Attachment;

  trait HasAttachments
  {
      public function attachments()
      {
          return $this->morphMany(Attachment::class, 'attachable');
      }

      public function lastAttachments()
      {
          return $this->morphMany(Attachment::class,'attachable')->latest();
      }

      public function attachment()
      {
          return $this->morphone(Attachment::class,'attachable')->latest();
      }

  }
