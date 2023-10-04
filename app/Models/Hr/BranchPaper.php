<?php

namespace App\Models\Hr;

use App\Models\MainModelSoft;
use App\Models\officialPaper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchPaper extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['official_paper_id' , 'finish_date', 'notification_date', 'attachment', 'user_id', 'branch_id'];


    public function official() {
        return $this->belongsTo(officialPaper::class,'official_paper_id','id');
    }
}
