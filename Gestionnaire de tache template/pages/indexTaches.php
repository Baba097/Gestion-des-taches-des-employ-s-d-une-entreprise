<div class="container mt-5">
    
    <h1 class="mb-4">🗓️ Gestionnaire de Tâches</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="?page=dashbordTaches">Tasks</a></li>
            <li class="breadcrumb-item active"><a href="?page=dashbordStat">Statistics</a></li>
        </ol>
        <!-- ==== FORMULAIRE AJOUT / MODIFICATION ==== -->
        <div class="card mb-4 col-md-6 offset-3">
            <div class="card-header bg-primary text-white">
                <?= $tache_a_modifier ? "Modifier une tâche" : "Ajouter une tâche" ?>
            </div>

            <div class="card-body">
                <form method="POST" action="traitements/actions.php">

                    <input type="hidden" name="action" value="<?= $tache_a_modifier ? "modifier" : "ajouter" ?>">

                    <input type="hidden" name="id" value="<?= $tache_a_modifier['id'] ?? '' ?>">
        
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="titre" required value="<?= $tache_a_modifier['titre'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"><?= $tache_a_modifier['description'] ?? '' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Priorité</label>
                        <select class="form-select" name="priorite">
                            <option value="Basse" <?= isset($tache_a_modifier) && $tache_a_modifier['priorite'] == "Basse" ? "selected" : "" ?>>Basse</option>
                            <option value="Moyenne" <?= isset($tache_a_modifier) && $tache_a_modifier['priorite'] == "Moyenne" ? "selected" : "" ?>>Moyenne</option>
                            <option value="Haute" <?= isset($tache_a_modifier) && $tache_a_modifier['priorite'] == "Haute" ? "selected" : "" ?>>Haute</option>
                        </select>
                    </div>

                    <input type="hidden" class="form-control" name="statut"  value="à faire">

                    <div class="mb-3">
                        <label class="form-label">Date Limite</label>
                        <input type="text" class="form-control" name="date_limite" required placeholder="aaaa-mm-jj" value="<?= $tache_a_modifier['date_limite'] ?? '' ?>">
                    </div>
                    
                    <?php if(isset($_GET['admin_modif'])): ?>
                        <div class="mb-3">
                            <label class="form-label">Responsable</label>
                            <input type="text" class="form-control" name="responsable" required value="<?= $tache_a_modifier['responsable'] ?? '' ?>">
                        </div>
                    <?php else: ?>
                        <input type="hidden" class="form-control" name="responsable"  value="Oumar Wellé">
                    <?php endif;?>   

                    <input type="hidden" class="form-control" name="page" value="<?= $page ?>">

                    <button type="submit" class="btn btn-success">
                        <?= $tache_a_modifier ? "Enregistrer les modifications" : "Ajouter la tâche" ?>
                    </button>

                    <?php if ($tache_a_modifier): ?>
                        <a href="?page=indexTaches" class="btn btn-secondary">Annuler</a>
                    <?php endif; ?>

                </form>
            </div>
        </div>
        <br>

        <!-- ==== LISTE DES TÂCHES ==== -->
       
        <h2 class="text-decoration-underline mb-3" id="titre2_taches">Liste des tâches</h2>
        <br>
        <!-- Barre recherche + filtre -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <form class="row g-3 align-items-end" method="POST" action="traitements/actions.php">

                    <input type="hidden" class="form-control" name="filtrer" value="yes">
                    <!-- Recherche par titre -->
                    <div class="col-md-4">
                        <label for="search" class="form-label">🔍 Rechercher une tâche</label>
                        <input type="text" class="form-control" name="search" placeholder="Search..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                    </div>

                    <!-- Filtre par statut -->
                    <div class="col-md-3">
                        <label for="statut" class="form-label">🎯 Filtrer par statut</label>
                        <select class="form-select" name="statut">
                            <option value="">Tous les statuts</option>
                            <option value="à faire" <?= isset($_GET['statut']) && $_GET['statut'] == "à faire" ? "selected" : "" ?>>À faire</option>
                            <option value="En cours" <?= isset($_GET['statut']) && $_GET['statut'] == "En cours" ? "selected" : "" ?>>En cours</option>
                            <option value="Terminée" <?= isset($_GET['statut']) && $_GET['statut'] == "Terminée" ? "selected" : "" ?>>Terminée</option>
                        </select>
                    </div>
                    <!-- Filtre par priorite -->
                    <div class="col-md-3">
                        <label for="priorite" class="form-label">🎯 Filtrer par priorité</label>
                        <select class="form-select" name="priorite">
                            <option value="">Toutes les priorités </option>
                            <option value="Basse" <?= isset($_GET['priorite']) && $_GET['priorite'] == "Basse" ? "selected" : "" ?>>Basse</option>
                            <option value="Moyenne" <?= isset($_GET['priorite']) && $_GET['priorite'] == "Moyenne" ? "selected" : "" ?>>Moyenne</option>
                            <option value="Haute" <?= isset($_GET['priorite']) && $_GET['priorite'] == "Haute" ? "selected" : "" ?>>Haute</option>
                        </select>
                    </div>                    

                    <!-- Bouton filtrer -->
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary">
                            Filtrer
                        </button>
                    </div>

                </form>

            </div>
        </div>     
        <br>
        <!--Liste des taches  -->
        <div class="row">
            <?php foreach ( $taches_filtrer as $tache): ?>
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">

                            <?php if(verifDateLimite($tache)):?>
                                <h5 class='alert alert-danger'>Date Limite Dépassée</h5>
                                <hr>
                            <?php endif?>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary"><?= $tache['responsable'] ?></span>

                                <span class="badge bg-<?= prioriteTache($tache) ?> ms-auto">
                                    <?= $tache['priorite'] ?>
                                </span>
                            </div>

                            <hr>
                            <h5 class="card-title">
                                <?= htmlspecialchars($tache['titre']) ?>
                            </h5>

                            <p class="card-text">
                                <?= htmlspecialchars($tache['description']) ?>
                            </p>

                            <a class="badge bg-<?= statutTache($tache) ?>" title="Modifier ?" style="cursor: pointer; text-decoration:none;" 
                                href="?page=<?= $page ?>&modif_statut=<?= $tache['statut'] ?>&idstatut=<?= $tache['id'] ?>#titre2_taches">
                                <?= $tache['statut'] ?>
                            </a>

                            <span class="badge bg-info ms-2">
                                Termine le <?=$tache['date_limite'] ?>
                            </span>
                            
                            <hr>

                            <?php if(!(verifDateLimite($tache)) && $tache['statut'] != "Terminée"): ?>
                                <a href="?modifier=<?= $tache['id'] ?>&page=<?= $page ?>" class="btn btn-sm btn-primary">
                                    Modifier
                                </a>
                            <?php endif?>

                            <a href="?supprimer=<?= $tache['id'] ?>&page=<?= $page ?>#titre2_taches"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Supprimer cette tâche ?');">
                                Supprimer
                            </a>

                        </div>
                      </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>
