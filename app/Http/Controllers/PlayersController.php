<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Nationality;
use App\Models\Player;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayersController extends Controller
{

    public function index()
    {
        $players = Player::with(['positions', 'club', 'nationality'])->where('is_active', '=', true)->get();

        return view("players.index",
            [
                "title" => "All players",
                "players" => $players
            ]);
    }

    public function fromClub(int $id)
    {
        $players = Player::with(['positions', 'club', 'nationality'])->where('is_active', '=', true)->where('club_id', '=', $id)->get();
        $club = Club::find($id);
        if (!(isset($club->name))) {
            return redirect("/players", 301);
        }
        return view("players.index",
            [
                "title" => "All players from " . Club::find($id)->name,
                "players" => $players
            ]);
    }


    public function edit(int $id)
    {
        $player = Player::with(['positions', 'club', 'nationality'])->find($id);
        $nationalities = Nationality::where('is_active', '=', true)->get();
        $clubs = Club::where('is_active', '=', true)->get();
        $positions = Position::where('is_active', '=', true)->get();

        return view("players.edit",
            [
                "player" => $player,
                "nationalities" => $nationalities,
                "clubs" => $clubs,
                "positions" => $positions
            ]);
    }

    public function create()
    {
        $nationalities = Nationality::where('is_active', '=', true)->get();
        $clubs = Club::where('is_active', '=', true)->get();
        $positions = Position::where('is_active', '=', true)->get();

        return view("players.create",
            [
                "nationalities" => $nationalities,
                "clubs" => $clubs,
                "positions" => $positions
            ]);
    }

    public function add(Request $request)
    {
        $player = new Player();
        $player->created_at = date('Y-m-d G:i:s');
        $positions = Position::all()->pluck('id')->toArray();
        $this->populateFields($player, $request);
        $player->save();
        $newPositions = $this->handleCheckboxes($request, $positions);
        if (count($newPositions)) {
            $player->positions()->detach();
            $player->positions()->attach($newPositions);
        }
        return redirect("/players", 301);
    }

    public function update(Request $request, int $id)
    {
        $player = Player::with(['positions', 'club', 'nationality'])->find($id);
        $this->secureUserPrivileges($player);
        $positions = Position::all()->pluck('id')->toArray();
        $this->populateFields($player, $request);
        $newPositions = $this->handleCheckboxes($request, $positions);
        if (count($newPositions)) {
            $player->positions()->detach();
            $player->positions()->attach($newPositions);
        }
        $player->save();
        return redirect("/players", 301);
    }

    public function delete($id)
    {
        $player = Player::find($id);
        $this->secureUserPrivileges($player);
        $player->is_active = false;
        $player->save();
        return redirect("/players", 301);
    }


    protected function secureUserPrivileges($player): void
    {
        $userId = Auth::id();
        $club = Club::find($player->club_id);
        if ($club->trainer_id !== $userId) redirect("/players", 301);
    }

    protected function populateFields($player, Request $request): void
    {
        $player->name = $request->input("name");
        $player->lastname = $request->input("lastname");
        $player->height = $request->input("height");
        $player->weight = $request->input("weight");
        $player->born_date = $request->input("born_date");
        $player->nationality()->associate(Nationality::find($request->input('nationality_id')));
        $player->club()->associate(Club::find($request->input('club_id')));
        $player->updated_at = date('Y-m-d G:i:s');
        $player->is_active = true;
    }

    protected function handleCheckboxes(Request $request, array $positions): array
    {
        $output = [];
        foreach ($positions as $pos) {
            if ($request->exists('position_id_' . $pos)) {
                $output[] = $pos;
            }
        }
        return $output;
    }
}
