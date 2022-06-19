<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionsController extends Controller
{
    public function index()
    {
        $positions = Position::with('players')->where('is_active', '=', true)->get();

        return view("positions.index",
            [
                "title" => "Positions",
                "positions" => $positions
            ]);
    }

    public function playersWithPosition(int $id)
    {
        $pos = Position::find($id);
        if (!$pos) return redirect('/positions');
        $players = $pos->players()->get();
        return view("players.index",
            [
                "title" => "All ". $pos->name . " players",
                "players" => $players
            ]);
    }


    public function edit(int $id)
    {
        $this->secureUserPrivileges();
        $position = Position::find($id);
        return view("positions.edit",
            [
                "position" => $position
            ]);
    }

    public function create()
    {
        return view("positions.create");
    }

    public function add(Request $request)
    {
        $position = new Position();
        $position->created_at = date('Y-m-d G:i:s');
        $this->populateFields($position, $request);
        $position->save();
        return redirect("/positions", 301);
    }

    public function update(Request $request, int $id)
    {
        $this->secureUserPrivileges();
        $position = Position::find($id);
        $this->populateFields($position, $request);
        $position->save();
        return redirect("/positions", 301);
    }

    public function delete($id)
    {
        $this->secureUserPrivileges();
        $position = Position::find($id);
        $position->is_active = false;
        $position->save();
        return redirect("/positions", 301);
    }


    protected function secureUserPrivileges(): void
    {
        if (!Auth::user()->is_admin) redirect("/leagues", 301);
    }

    protected function populateFields($position, Request $request): void
    {
        $position->name = $request->input("name");
        $position->short_name = $request->input("short_name");
        $position->updated_at = date('Y-m-d G:i:s');
        $position->is_active = true;
    }
}
