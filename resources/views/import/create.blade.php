@extends('layouts.admin')

@section('title')
Importer des données
@endsection
@section('content')
<div class="pagetitle">
    <h1>Import</h1>
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
                    <h4 class="card-title">Importer des fichiers</h4>
                    <p>
                    <form method="POST" action="{{route('import.commission')}}" enctype="multipart/form-data">
                        @csrf
                        <h5>Import commission</h5>
                        <input type="file" name="import-commission" accept=".csv" placeholder="Commission">
                        <button type="submit">Importer</button>
                    </form>
                    </p>
                    <p>
                    <form method="POST" action="{{route('import.bien')}}" enctype="multipart/form-data">
                        @csrf
                        <h5>Import biens</h5>
                        <input type="file" name="import-bien" accept=".csv" placeholder="Biens">
                        <button type="submit">Importer</button>
                    </form>
                    </p>
                    <p>
                    <form method="POST" action="{{route('import.location')}}" enctype="multipart/form-data">
                        @csrf
                        <h5>Import location</h5>
                        <input type="file" name="import-location" accept=".csv" placeholder="Location">
                        <button type="submit">Importer</button>
                    </form>
                    </p>
                    <br>
                    <br>
                    <p>
                    <form method="GET" action="/admin/reinitialiser" enctype="multipart/form-data">
                        @csrf
                        <h5>Réinitialiser la base</h5>
                        <button type="submit">Reinitialiser</button>
                    </form>
                    </p>
                </div>
            </div>
        </div>
</section>
@endsection