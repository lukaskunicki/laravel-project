<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NationalitiesController extends Controller
{
    public function index()
    {
        $nationalities = Nationality::with('players')->where('is_active', '=', true)->get();

        return view("nationalities.index",
            [
                "title" => "Nationalities",
                "nationalities" => $nationalities
            ]);
    }

    public function playersWithNationality(int $id)
    {
        $nationality = Nationality::find($id);
        if (!$nationality) return redirect('/nationalities');
        $players = $nationality->players()->get();
        return view("players.index",
            [
                "title" => "All ". $nationality->name . " players",
                "players" => $players
            ]);
    }


    public function edit(int $id)
    {
        $this->secureUserPrivileges();
        $nationality = Nationality::find($id);
        return view("nationalities.edit",
            [
                "nationality" => $nationality
            ]);
    }

    public function create()
    {
        return view("nationalities.create");
    }

    public function add(Request $request)
    {
        $nationality = new Nationality();
        $nationality->created_at = date('Y-m-d G:i:s');
        $this->populateFields($nationality, $request);
        $nationality->save();
        return redirect("/nationalities", 301);
    }

    public function update(Request $request, int $id)
    {
        $this->secureUserPrivileges();
        $nationality = Nationality::find($id);
        $this->populateFields($nationality, $request);
        $nationality->save();
        return redirect("/nationalities", 301);
    }

    public function delete($id)
    {
        $this->secureUserPrivileges();
        $nationality = Nationality::find($id);
        $nationality->is_active = false;
        $nationality->save();
        return redirect("/nationalities", 301);
    }


    protected function secureUserPrivileges(): void
    {
        if (!Auth::user()->is_admin) redirect("/nationalities", 301);
    }

    protected function populateFields($position, Request $request): void
    {
        $position->name = $request->input("name");
        $position->updated_at = date('Y-m-d G:i:s');
        $position->is_active = true;
    }
}
