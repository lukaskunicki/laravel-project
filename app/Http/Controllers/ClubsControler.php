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
                "clubs" => $clubs,
                "title" => "All clubs"
            ]);
    }

    public function search(string $search)
    {
        $clubs = Club::with(['players', 'league', 'trainer'])
            ->where("name", "LIKE", "%{$search}%")
            ->get();

        return $clubs;
    }

    public function create()
    {
        $leagues = League::where('is_active', '=', true)->get();

        return view("clubs.create",
            [
                "leagues" => $leagues,
                "title" => "New Club"
            ]);
    }

    public function edit(int $id)
    {
        $club = Club::with(['players', 'league', 'trainer'])->find($id);
        $leagues = League::where('is_active', '=', true)->get();

        return view("clubs.edit",
            [
                "club" => $club,
                "leagues" => $leagues,
                "title" => "Edit " . $club->name ." club"
            ]);
    }


    public function add(Request $request)
    {
        $this->validateFields($request);
        $club = new Club();
        $club->created_at = date('Y-m-d G:i:s');
        $this->populateFields($club, $request);
        $club->save();
        return redirect("/clubs", 301);
    }

    public function update(Request $request, int $id)
    {
        $this->validateFields($request);
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

    protected function validateFields(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'foundation_date' => 'required|date',
            'league_id' => 'required',
        ]);
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
