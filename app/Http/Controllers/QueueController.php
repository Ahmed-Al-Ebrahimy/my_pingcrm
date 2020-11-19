<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Inertia\Inertia;
use App\Models\Patient;
// use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class QueueController extends Controller
{

    public function index()
    {

        $today = Carbon::today()->toDateString();
        return Inertia::render('Queue/Index', [

            'clinic1' =>  Patient::whereHas('visits', function ($query) use($today) {
                $query->where('created_at', 'LIKE', $today .'%')->where('clinic_id', '=', 1);
            })->orderBy('created_at')->get()->map->only('name'),

            'clinic2' =>  Patient::whereHas('visits', function ($query) use($today) {
                $query->where('created_at', 'LIKE', $today .'%')->where('clinic_id', '=', 2);
            })->orderBy('created_at')->get()->map->only('name'),

            'clinic3' =>  Patient::whereHas('visits', function ($query) use($today) {
                $query->where('created_at', 'LIKE', $today.'%')->where('clinic_id', '=', 3);
            })->orderBy('created_at')->get()->map->only('name'),

            'clinic4' =>  Patient::whereHas('visits', function ($query) use($today) {
                $query->where('created_at', 'LIKE', $today .'%')->where('clinic_id', '=', 4);
            })->orderBy('created_at')->get()->map->only('name'),
        ]);
    }
}
