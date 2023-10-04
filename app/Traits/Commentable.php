<?php

namespace App\Traits;

  use App\Models\CMS\Comment;

  trait Commentable
  {
      public function comments()
      {
          return $this->morphMany(Comment::class,'commentable');
      }

      public function lastComments()
      {
          return $this->morphMany(Comment::class,'commentable')->latest();
      }

      public function lastComment()
      {
          return $this->morphOne(Comment::class,'commentable')->latest();
      }

  }
