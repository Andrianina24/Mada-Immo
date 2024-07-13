@extends('layouts.proprietaire')

@section('title')
Home
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <!-- Section "Liste des propriétés" -->
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-4">
                    <h5 class="card-title fw-semibold mb-0">Liste des propriétés</h5>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Région</th>
                                <th>Loyer</th>
                                <th>Disponible</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proprietes as $propriete)
                            <tr>
                                <td>{{ $propriete->reference }}</td>
                                <td>{{ $propriete->nom }}</td>
                                <td>{{ $propriete->descri }}</td>
                                <td>{{ $propriete->region }}</td>
                                <td>{{ $propriete->loyer }}</td>
                                <td>{{ $propriete->disponible }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Section "Chiffre d'affaire" -->
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-4">
                    <h5 class="card-title fw-semibold mb-0">Chiffre d'affaire</h5>
                    <div>
                        <input type="date" id="date1">
                        <input type="date" id="date2">
                        <button id="submitDates" class="btn btn-primary">Valider et Envoyer</button>
                    </div>
                    <div id="chiffre" class="mt-3"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('submitDates').addEventListener('click', function() {
        let date1 = document.getElementById('date1').value;
        let date2 = document.getElementById('date2').value;

        fetch('{{ route("proprietaire.getChiffre") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    date1: date1,
                    date2: date2
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.chiffre)
                // Assuming your JSON response has a property 'chiffre'
                document.getElementById('chiffre').innerHTML = 'Chiffre d\'affaire: ' + data.chiffre;
            })
            .catch(error => console.error('Error:', error));
    });
</script>

@endsection