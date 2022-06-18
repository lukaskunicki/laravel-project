<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubsControler extends Controller
{
    public function index()
    {
        $clubs = Club::with(['players', 'league', 'trainer'])->where('is_active', '=', true)->get();

        return view("clubs.index",
            [
                "clubs" => $clubs
            ]);
    }}
