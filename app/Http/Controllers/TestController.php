<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function demo(){
        $tmdb_id = 436270; //Black Adam (2022) Movie TMDB ID
        $data = Http::asJson()
            ->get(config('services.tmdb.endpoint').'movie/'.$tmdb_id. '?api_key='.config('services.tmdb.api'));
       // dd($data );    
        return view('welcome',compact('data'));
    }
}
