<?php

namespace App\Http\Controllers;

use App\Models\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;

class ProprietaireController extends Controller
{

    public function create(): View
    {
        return view('auth.loginClient');
    }

    public function store(Request $request)
    {
        $numero = $request->input('numero');
        $proprietaire = Proprietaire::login($numero);

        if ($proprietaire) {
            Session::put('id_proprietaire', $proprietaire->id_proprietaire);
            $id_proprietaire = $proprietaire->id_proprietaire;
            $proprietes = Proprietaire::findPropriete($id_proprietaire);
            // return response()->json(['message' => $proprietaire], 200);
            return view('proprietaire.index', ['proprietes' => $proprietes]);
        } else {
            // return response()->json(['message' => 'Proprietaire not found'], 404);
            return view('auth.loginClient');
        }
    }

    public function getChiffre(Request $request)
    {
        $date1 = $request->input('date1');
        $date2 = $request->input('date2');

        $id_proprietaire = Session::get('id_proprietaire'); // Correction de la récupération de l'id_proprietaire

        // Assurez-vous que la méthode getChiffre retourne un objet avec une propriété 'chiffre'
        $chiffre = Proprietaire::getChiffre($date1, $date2, $id_proprietaire);

        if ($chiffre !== null) {
            $affaire = $chiffre;

            return response()->json([
                'chiffre' => $affaire,
            ]);
        } else {
            // Gestion de cas où aucun chiffre n'est trouvé
            return response()->json([
                'error' => 'Aucun chiffre d\'affaire trouvé pour les dates spécifiées.',
            ], 404); // Exemple de réponse 404 si aucun chiffre n'est trouvé
        }
    }


    public function index(): View
    {
        return view('proprietaire.index');
    }

    public function logout()
    {
        Session::flush();

        return Redirect::route('login.client')->with('success', 'Déconnexion réussie');
    }
}
