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
                "title" => "All Nationalities",
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
                "title" => "All " . $nationality->name . " players",
                "players" => $players
            ]);
    }


    public function edit(int $id)
    {
        $this->secureUserPrivileges();
        $nationality = Nationality::find($id);
        return view("nationalities.edit",
            [
                "title" => "Edit " . $nationality->name . " nationality",
                "nationality" => $nationality
            ]);
    }

    public function create()
    {
        return view("nationalities.create", ["title" => "Add new nationality"]);
    }

    public function add(Request $request)
    {
        $this->validateFields($request);
        $nationality = new Nationality();
        $nationality->created_at = date('Y-m-d G:i:s');
        $this->populateFields($nationality, $request);
        $nationality->save();
        return redirect("/nationalities", 301);
    }

    public function update(Request $request, int $id)
    {
        $this->validateFields($request);
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

    protected function validateFields(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);
    }

    protected function populateFields($position, Request $request): void
    {
        $position->name = $request->input("name");
        $position->updated_at = date('Y-m-d G:i:s');
        $position->is_active = true;
    }
}
