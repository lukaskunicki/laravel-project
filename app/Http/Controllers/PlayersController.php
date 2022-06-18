<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Nationality;
use App\Models\Player;
use App\Models\Position;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    //

    public function index()
    {
        $players = Player::with(['positions', 'club', 'nationality'])->get();

        return view("players.index",
            [
                "players" => $players
            ]);
    }

    public function edit(int $id)
    {
        $player = Player::with(['positions', 'club', 'nationality'])->find($id);
        $nationalities = Nationality::all();
        $clubs = Club::all();
        $positions = Position::all();

        return view("players.edit",
            [
                "player" => $player,
                "nationalities" => $nationalities,
                "clubs" => $clubs,
                "positions" => $positions
            ]);
    }
}
