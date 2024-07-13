@extends('layouts.client')

@section('title')
Home
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Intervalle de temps</h5>
                    </div>
                    <div>
                        <input type="date" id="date1">
                        <input type="date" id="date2">
                        <button id="submitDates">Valider et Envoyer</button>
                    </div>
                </div>
                <div id="table"></div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('submitDates').addEventListener('click', function() {
        let date1 = document.getElementById('date1').value;
        let date2 = document.getElementById('date2').value;

        fetch('{{ route("client.getLoyer") }}', {
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
                if (data.error) {
                    console.error('Server error:', data.error);
                    return;
                }

                let table = document.createElement('table');
                table.className = 'table';

                // Create table header
                let thead = table.createTHead();
                let row = thead.insertRow();
                let th1 = document.createElement('th');
                th1.innerHTML = 'Mois';
                let th2 = document.createElement('th');
                th2.innerHTML = 'Année';
                let th3 = document.createElement('th');
                th3.innerHTML = 'Loyer';
                row.appendChild(th1);
                row.appendChild(th2);
                row.appendChild(th3);

                // Create table body
                let tbody = table.createTBody();
                data.loyer.forEach(item => {
                    let row = tbody.insertRow();
                    let cell1 = row.insertCell();
                    let cell2 = row.insertCell();
                    let cell3 = row.insertCell();
                    cell1.innerHTML = item.month_name;
                    cell2.innerHTML = item.month;
                    cell3.innerHTML = item.loyer;
                });

                document.getElementById('table').innerHTML = '';
                document.getElementById('table').appendChild(table);
            })
            .catch(error => console.error('Error:', error));
    });
</script>
@endsection