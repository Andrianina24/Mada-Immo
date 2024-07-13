@extends('layouts.admin')

@section('title')
Insertion location
@endsection

@section('content')
<div class="pagetitle">
    <h1>Index</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/index">Home</a></li>
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Blank</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Formulaire d'insertion de location</h5>
                    <form method="POST" action="/admin/insert">
                        @csrf
                        <select name="reference" id="">
                            @foreach($references as $reference)
                            <option value="{{ $reference->reference }}">{{ $reference->nom }}</option>
                            @endforeach
                        </select>
                        <br>
                        <select name="client" id="">
                            @foreach($clients as $client)
                            <option value="{{ $client->id_client }}">{{ $client->mail }}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="date" name="date" id="date2">
                        <br>
                        <input type="number" min="1" name="duree" placeholder="Durée">
                        <br>
                        <button id="submitDates">Valider et Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection