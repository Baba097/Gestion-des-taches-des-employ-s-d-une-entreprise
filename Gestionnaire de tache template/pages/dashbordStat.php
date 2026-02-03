<div class="container mt-5">

    <!-- Titre -->
    <h1 class="mb-4">📊 Statistiques des tâches</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="?page=dashbordTaches">Tasks</a></li>
        <li class="breadcrumb-item active">Statistics</li>
    </ol>        
    <!-- Cartes statistiques -->
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total des tâches</h6>
                    <h2 class="fw-bold"><?= $nbrTaches ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Tâches terminées</h6>
                    <h2 class="fw-bold text-success"><?= $nbrTachesTerminé ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Tâches en retard</h6>
                    <h2 class="fw-bold text-danger"><?= $nbrTachesEnRetard ?></h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Progression -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-3">📈 Avancement global</h5>

            <div class="d-flex justify-content-between mb-2">
                <span>Tâches terminées</span>
                <span><strong><?= $pourcentageTT ?>%</strong></span>
            </div>

            <div class="progress" style="height: 20px;">
                <div 
                    class="progress-bar bg-success"
                    role="progressbar"
                    style="width: <?= $pourcentageTT ?>%;"
                    aria-valuenow="60"
                    aria-valuemin="0"
                    aria-valuemax="100">
                <?= $pourcentageTT ?>%
                </div>
            </div>
        </div>
    </div>

    <!-- Répartition -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4">📌 Répartition des tâches</h5>

            <div class="row text-center">

                <div class="col-md-6 mb-3">
                    <div class="p-4 bg-success text-white rounded">
                        <h6>Tâches terminées</h6>
                        <h2><?= $nbrTachesTerminé ?></h2>
                        <small><?= $pourcentageTT ?>%</small>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="p-4 bg-secondary text-white rounded">
                        <h6>Tâches non terminées</h6>
                        <h2><?= $nbrTachesNonTerminé ?></h2>
                        <small><?= $pourcentageTNT ?>%</small>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

