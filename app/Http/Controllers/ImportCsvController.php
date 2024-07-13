<?php

namespace App\Http\Controllers;

use App\Models\ImportCsvBiens;
use App\Models\ImportCsvLocation;
use App\Models\ImportCsvCommission;
use Illuminate\Http\Request;

class ImportCsvController extends Controller
{

    public function convertToInt($value)
    {
        return (int)$value;
    }

    public function convertToChar($value)
    {
        return (string)$value;
    }

    public function convertToDouble($value)
    {
        return (float)$value;
    }

    public function convertToDate($value)
    {
        return \DateTime::createFromFormat('d/m/Y', $value);
    }

    public function create()
    {
        return view('import.create');
    }

    public function importBien(Request $request)
    {
        ($request->hasFile('import-bien'));
        $test = $request->file('import-bien');
        $content = file_get_contents($test->getPathname());
        $ligne = explode("\r", $content);
        $header = array_map('trim', explode(',', $ligne[0]));
        $tete = ['reference', 'nom', 'description', 'type', 'region', 'loyer mensuel', 'Proprietaire'];
        if (!empty($header) && count($header) === count($tete)) {
            $ligne = array_slice($ligne, 1);
            $ligne = array_map('trim',$ligne);
            $count = 0;
            if (!ImportCsvBiens::all()->isEmpty()) {
                ImportCsvBiens::truncate();
            }
            foreach ($ligne as $lignes) {
                $data = str_getcsv($lignes, ',');
                if (!empty($data[0])) {
                    $model = new ImportCsvBiens();
                    $model->reference = $this->convertToChar($data[0]);
                    $model->nom = $this->convertToChar($data[1]);
                    $model->description = $this->convertToChar($data[2]);
                    $model->type = $this->convertToChar($data[3]);
                    $model->region = $this->convertToChar($data[4]);
                    $model->loyer = $this->convertToInt($data[5]);
                    $model->proprietaire = $this->convertToInt($data[6]);
                    $model->save();
                }
            }
            $model = new ImportCsvBiens();
            $model->importData();
            // return response()->json(['message' => 'Import reussi!']);
            return view('import.create');
        } else {
            return response()->json(['message' => 'Import fail']);
        }
    }

    public function importLocation(Request $request)
    {
        ($request->hasFile('import-location'));
        $test = $request->file('import-location');
        $content = file_get_contents($test->getPathname());
        $ligne = explode("\r", $content);
        $header = array_map('trim', explode(',', $ligne[0]));
        $tete = ['reference', 'date debut', 'duree mois', 'client'];
        if (!empty($header) && count($header) === count($tete)) {
            $ligne = array_slice($ligne, 1);
            $ligne = array_map('trim', $ligne);
            $count = 0;
            if (!ImportCsvLocation::all()->isEmpty()) {
                ImportCsvLocation::truncate();
            }
            foreach ($ligne as $lignes) {
                $data = str_getcsv($lignes, ',');
                if (!empty($data[0])) {
                    $model = new ImportCsvLocation();
                    $model->reference = $this->convertToChar($data[0]);
                    $model->date_debut = $this->convertToDate($data[1]);
                    $model->duree_mois = $this->convertToInt($data[2]);
                    $model->client = $this->convertToChar($data[3]);
                    $model->save();
                }
            }
            $model = new ImportCsvLocation();
            $model->importData();
            // return response()->json(['message' => 'Import reussi']);
            return view('import.create');
        } else {
            return response()->json(['message' => 'Import fail']);
        }
    }

    public function importCommission(Request $request)
    {
        ($request->hasFile('import-commission'));
        $test = $request->file('import-commission');
        $content = file_get_contents($test->getPathname());
        $ligne = explode("\r", $content);
        $header = array_map('trim', explode(',', $ligne[0]));
        $tete = ['type', 'commission'];
        if (!empty($header) && count($header) === count($tete)) {
            $ligne = array_slice($ligne, 1);
            $ligne = array_map('trim', $ligne);
            $count = 0;
            if (!ImportCsvCommission::all()->isEmpty()) {
                ImportCsvCommission::truncate();
            }
            foreach ($ligne as $lignes) {
                $data = str_getcsv($lignes, ',');
                if (!empty($data[0])) {
                    $model = new ImportCsvCommission();
                    $model->type = $this->convertToChar($data[0]);
                    $model->commission = $this->convertToDouble($data[1]);
                    $model->save();
                }
            }
            $model = new ImportCsvCommission();
            $model->importData();
            // return response()->json(['message' => 'Import reussi!']);
            return view('import.create');
        } else {
            return response()->json(['message' => 'Import fail']);
        }
    }
}
