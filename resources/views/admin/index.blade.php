@extends('layouts.admin')

@section('title')
Home - admin
@endsection

@section('content')
<div class="pagetitle">
    <h1>Index</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
                    <h5 class="card-title">Chiffre total</h5>
                    <div id="c_total">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gain total</h5>
                    <div id="b_total">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Entrez vos dates</h5>
                    <input type="date" id="date1">
                    <input type="date" id="date2">
                    <button id="submitDates">Valider et Envoyer</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chiffre d'affaire mensuel</h5>
                    <div id="Chiffrechart">
                        <canvas id="mybarChart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gain mensuel</h5>
                    <div id="Gainchart">
                        <canvas id="mybarChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Inclusion de Chart.js via CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Variables pour stocker les instances des graphiques
    var mybarChart1 = null;
    var mybarChart2 = null;

    // Fonction pour valider les dates et envoyer la requête AJAX
    function validateDates() {
        var date1 = document.getElementById('date1').value;
        var date2 = document.getElementById('date2').value;

        // Validation simple : vérifie si les champs sont remplis
        if (date1 && date2) {
            // Les dates sont valides, envoyer la requête AJAX avec le jeton CSRF
            sendData(date1, date2);
        } else {
            console.error('Veuillez remplir les deux champs de date.');
        }
    }

    // Fonction pour envoyer les données via AJAX
    function sendData(date1, date2) {
        // Récupérer le jeton CSRF depuis les métadonnées de la page
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        $.ajax({
            url: '{{ route("admin.stat") }}',
            type: 'POST',
            data: {
                date1: date1,
                date2: date2,
                // Inclure le jeton CSRF dans les données de la requête
                _token: csrfToken
            },
            success: function(response) {
                console.log('Chiffre:', response.chiffre);
                console.log('Gain:', response.gain);
                console.log('Total chiffre:', response.c_total);
                console.log('Total gain:', response.b_total);
                // Traitez les données reçues ici
                updateCharts(response.chiffre, response.gain, response.c_total, response.b_total);
            },
            error: function(error) {
                console.error('Erreur AJAX:', error);
            }
        });
    }

    // Fonction pour mettre à jour les graphiques avec les données reçues
    function updateCharts(chiffreData, gainData, cTotalData, bTotalData) {
        // Extraire les labels (mois) et les données des chiffres et des gains
        var labels = chiffreData.map(item => item.month_name);
        var chiffres = chiffreData.map(item => item.chiffre);
        var gains = gainData.map(item => item.gain);

        // Vérifier et détruire les graphiques existants avant de créer de nouveaux graphiques
        if (mybarChart1) {
            mybarChart1.destroy();
        }
        if (mybarChart2) {
            mybarChart2.destroy();
        }

        // Mise à jour du premier graphique (Chiffres)
        var ctx1 = document.getElementById('mybarChart1').getContext('2d');
        mybarChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Chiffre',
                    data: chiffres,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Mise à jour du second graphique (Gains)
        var ctx2 = document.getElementById('mybarChart2').getContext('2d');
        mybarChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Gain',
                    data: gains,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Mettre à jour le contenu des divs c_total et b_total
        document.getElementById('c_total').innerText = cTotalData;
        document.getElementById('b_total').innerText = bTotalData;
    }

    // Écouteur d'événement pour le bouton ou une autre méthode de déclenchement
    $('#submitDates').click(function() {
        validateDates(); // Appel de la fonction de validation au clic du bouton
    });
</script>

@endsection