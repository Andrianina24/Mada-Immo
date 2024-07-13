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
                                <th>Date</th>
                                <th>Mois</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $detail)
                            <tr>
                                <td style="color: {{ $detail->color }};">{{ $detail->reference }}</td>
                                <td style="color: {{ $detail->color }};">{{ $detail->nom }}</td>
                                <td style="color: {{ $detail->color }};">{{ $detail->loyer }}</td>
                                <td style="color: {{ $detail->color }};">{{ $detail->commission }}</td>
                                <td style="color: {{ $detail->color }};">{{ $detail->date }}</td>
                                <td style="color: {{ $detail->color }};">{{ $detail->mois }}</td>
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