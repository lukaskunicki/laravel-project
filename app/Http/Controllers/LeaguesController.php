<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaguesController extends Controller
{
    public function index()
    {
        $leagues = League::with(['clubs'])->where('is_active', '=', true)->get();

        return view("leagues.index",
            [
                "title" => "Leagues",
                "leagues" => $leagues
            ]);
    }

    public function clubsInLeague(int $id)
    {
        $league = League::find($id);
        if (!$league) return redirect('/leagues');
        $clubs = Club::with(['players', 'league', 'trainer'])->where('league_id', '=', $league->id)->where('is_active', '=', true)->get();
        return view("clubs.index",
            [
                "clubs" => $clubs
            ]);
    }


    public function edit(int $id)
    {
        $this->secureUserPrivileges();
        $league = League::find($id);
        return view("leagues.edit",
            [
                "league" => $league
            ]);
    }

    public function create()
    {
        return view("leagues.create", []);
    }

    public function add(Request $request)
    {
        $league = new League();
        $league->created_at = date('Y-m-d G:i:s');
        $this->populateFields($league, $request);
        $league->save();
        return redirect("/leagues", 301);
    }

    public function update(Request $request, int $id)
    {
        $this->secureUserPrivileges();
        $league = League::find($id);
        $this->populateFields($league, $request);
        $league->save();
        return redirect("/leagues", 301);
    }

    public function delete($id)
    {
        $this->secureUserPrivileges();
        $league = League::find($id);
        $league->is_active = false;
        $league->save();
        return redirect("/leagues", 301);
    }


    protected function secureUserPrivileges(): void
    {
        if (!Auth::user()->is_admin) redirect("/leagues", 301);
    }

    protected function populateFields($league, Request $request): void
    {
        $league->name = $request->input("name");
        $league->start_date = $request->input("start_date");
        $league->end_date = $request->input("end_date");
        $league->updated_at = date('Y-m-d G:i:s');
        $league->is_active = true;
    }
}
