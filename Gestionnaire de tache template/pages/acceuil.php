
<section class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6 mb-4 mb-md-0">
                <h1 class="fw-bold mb-3">
                    Bienvenue sur <span class="text-primary">Task-Manager</span>
                </h1>
                <p class="lead text-muted mb-4">
                    Organisez vos tâches, suivez votre progression et gagnez en productivité,
                    simplement et efficacement.
                </p>
                <a href="?page=indexTaches" class="btn btn-primary btn-lg me-2">
                    Commencer
                </a>
            </div>

            <div class="col-md-6 text-center">
                <img 
                    src="<?= $dossierpublic ?>/assets/img/img_acueuil.jpg"
                    class="img-fluid rounded shadow"
                    alt="Illustration gestion des tâches"
                >
            </div>

        </div>
    </div>
</section>

<!-- Fonctionnalités -->
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Pourquoi utiliser Task-Manager ?</h2>
            <p class="text-muted">
                Tout ce dont vous avez besoin pour gérer vos tâches efficacement
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center">
                    <div class="card-body">
                        <h1>📋</h1>
                        <h5 class="card-title mt-3">Gestion simple</h5>
                        <p class="card-text text-muted">
                            Créez, modifiez et supprimez vos tâches en quelques clics.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center">
                    <div class="card-body">
                        <h1>⏱</h1>
                        <h5 class="card-title mt-3">Suivi du statut</h5>
                        <p class="card-text text-muted">
                            À faire, en cours ou terminée : suivez l’avancement de chaque tâche.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center">
                    <div class="card-body">
                        <h1>📊</h1>
                        <h5 class="card-title mt-3">Statistiques claires</h5>
                        <p class="card-text text-muted">
                            Visualisez votre productivité grâce à des statistiques simples.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- appel a l'action -->
<section class="bg-dark text-white py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">
            Prêt à mieux organiser votre travail ?
        </h2>
        <p class="mb-4">
            Commencez dès maintenant et prenez le contrôle de vos tâches.
        </p>
        <a href="?page=indexTaches" class="btn btn-primary btn-lg">
            Commencez
        </a>
    </div>
</section>