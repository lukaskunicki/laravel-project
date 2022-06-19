<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\League;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubsControler extends Controller
{
    public function index()
    {
        $clubs = Club::with(['players', 'league', 'trainer'])->where('is_active', '=', true)->get();

        return view("clubs.index",
            [
                "clubs" => $clubs
            ]);
    }

    public function create()
    {
        $leagues = League::where('is_active', '=', true)->get();

        return view("clubs.create",
            [
                "leagues" => $leagues,
            ]);
    }

    public function edit(int $id)
    {
        $clubs = Club::with(['players', 'league', 'trainer'])->find($id);
        $leagues = League::where('is_active', '=', true)->get();

        return view("clubs.edit",
            [
                "club" => $clubs,
                "leagues" => $leagues,
            ]);
    }


    public function add(Request $request)
    {
        $club = new Club();
        $club->created_at = date('Y-m-d G:i:s');
        $this->populateFields($club, $request);
        $club->save();
        return redirect("/clubs", 301);
    }

    public function update(Request $request, int $id)
    {
        $club = Club::find($id);
        $this->secureUserPrivileges($club);
        $this->populateFields($club, $request);
        $club->save();
        return redirect("/clubs", 301);
    }

    public function delete($id)
    {
        $club = Club::find($id);
        $this->secureUserPrivileges($club);
        $club->is_active = false;
        $club->save();
        return redirect("/clubs", 301);
    }

    protected function secureUserPrivileges($club): void
    {
        $userId = Auth::id();
        if ($club->trainer_id !== $userId) redirect("/clubs", 301);
    }

    protected function populateFields($club, Request $request): void
    {
        $club->name = $request->input("name");
        $club->foundation_date = $request->input("foundation_date");
        $club->league()->associate(League::find($request->input('league_id')));
        $club->trainer()->associate(User::find(Auth::id()));
        $club->updated_at = date('Y-m-d G:i:s');
        $club->is_active = true;
    }

}
