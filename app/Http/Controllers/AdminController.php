<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Location;
use App\Models\Loyer_mois;
use App\Models\Type_bien;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.index');
    }

    public function location(): View
    {
        $references = Bien::all();
        $clients = Client::all();
        return view('admin.location', ['references' => $references, 'clients' => $clients]);
    }

    public function liste()
    {
        $locations = Location::getLocation_Bien();
        // return response()->json(['locations' => $locations]);
        return view('admin.liste_location', ['locations' => $locations]);
    }

    public function details(Request $request)
    {
        $location = $request->input('id_location');
        $details = Loyer_mois::details($location);
        // return response()->json(['details' => $details]);
        return view('admin.details', ['details' => $details]);
    }

    public function insert(Request $request)
    {
        $reference = $request->input('reference');
        $client = $request->input('client');
        // $date1 = $request->input('date');
        $date1 = new \DateTime($request->input('date'));
        $date = $date1->format('Y-m-d');
        $duree = $request->input('duree');
        $location = new Location();
        $location->reference = $reference;
        $location->id_client = $client;
        $location->date_deb = $date;
        $location->duree = $duree;
        $location->save();
        $id_location = $location->id_location;
        Location::generer($id_location);
        $references = Bien::all();
        $clients = Client::all();
        // return response()->json(['id_location' => $date]);
        return view('admin.location', ['references' => $references, 'clients' => $clients]);
    }

    public function getStat(Request $request)
    {
        $date1 = $request->input('date1');
        $date2 = $request->input('date2');

        $chiffre = Bien::getChiffre($date1, $date2);
        $gain = Bien::getGain($date1, $date2);
        $c_total = $chiffre->sum('chiffre');
        $b_total = $gain->sum('gain');

        return response()->json([
            'chiffre' => $chiffre,
            'gain' => $gain,
            'c_total' => $c_total,
            'b_total' => $b_total,
        ]);
    }

    public function test()
    {
        $chiffre = Bien::getChiffre('2024-01-01', '2024-12-01');
        // $gain = Bien::getGain($date1, $date2);

        return response()->json([
            'chiffre' => $chiffre,
            // 'gain' => $gain,
        ]);
    }

    public function reinitialiserform()
    {
        return view('admin.reinitialiser');
    }

    public function reinitialiser()
    {
        Admin::reinitialiser();

        // return response()->json(['message' => 'reinitialisation terminee'], 200);
        return Redirect::route('admin.index')->with('success', 'Déconnexion réussie');
    }
}
