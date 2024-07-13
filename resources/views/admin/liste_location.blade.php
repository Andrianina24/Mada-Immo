@extends('layouts.admin')

@section('title')
Liste locations
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <!-- Section "Liste des propriétés" -->
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-4">
                    <h5 class="card-title fw-semibold mb-0">Liste de locations</h5>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Nom</th>
                                <th>Loyer</th>
                                <th>Commission</th>
                                <th>Duree</th>
                                <th>Date debut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)
                            <tr>
                                <td><a href="/admin/liste/details?id_location={{ $location->id_location }}">{{ $location->reference }}</a></td>
                                <td>{{ $location->nom }}</td>
                                <td>{{ $location->loyer }}</td>
                                <td>{{ $location->commission }}</td>
                                <td>{{ $location->duree }}</td>
                                <td>{{ $location->date_deb }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection