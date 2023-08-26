<?php

namespace App\Observers;

use App\Models\Travel;
use Illuminate\Support\Str;

class TravelObserver
{
 
    public function creating(Travel $travel): void
    {
        $travel->slug = str($travel->name)->slug().'-'.Str::random(8);
        while(Travel::where('slug',$travel->slug)->first() != null){
            $travel->slug = str($travel->name)->slug().'-'.Str::random(8);
        }
    }

}
