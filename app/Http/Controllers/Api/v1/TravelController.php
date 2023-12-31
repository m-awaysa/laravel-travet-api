<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index()
    {
        $travels=Travel::where('is_public', true)->paginate();//15 by default
        return TravelResource::collection($travels);
    }

}
