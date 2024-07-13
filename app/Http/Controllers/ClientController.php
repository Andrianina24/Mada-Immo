<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClientController extends Controller
{

    public function create(): View
    {
        return view('auth.loginClient');
    }

    public function store(Request $request)
    {
        $mail = $request->input('email');
        $client = Client::login($mail);

        if ($client) {
            Session::put('id_client', $client->id_client);
            // return response()->json(['message' => $client->id_client], 200);
            return view('client.index');
        } else {
            // return response()->json(['message' => 'Client not found'], 404);
            return view('auth.loginClient');
        }
    }
    public function getLoyer(Request $request)
    {
        try {
            $date1 = $request->input('date1');
            $date2 = $request->input('date2');

            $id_client = Session::get('id_client');
            $loyer = Client::getLoyerClient($id_client, $date1, $date2);

            return response()->json([
                'loyer' => $loyer,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function index(): View
    {
        return view('client.index');
    }

    public function logout()
    {
        Session::flush();

        return Redirect::route('login.client')->with('success', 'Déconnexion réussie');
    }
}
