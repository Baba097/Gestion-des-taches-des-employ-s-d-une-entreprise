
<div class="container-fluid px-4">
    <h1 class="mt-4">📋 Dashboard - Tasks</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="?page=dashbordStat">Statistics</a></li>
            <li class="breadcrumb-item active">Tasks</li>
        </ol>
        <br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1" id="tdt"></i>
                Tableau des taches
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Statut</th>
                            <th>Priorité</th>
                            <th>Date création</th>
                            <th>Date limite</th>
                            <th>Responsable</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($taches as $tache): ?>
                        <tr>
                            <td><?= $tache['id'] ?></td>
                            <td><?= $tache['titre'] ?></td>
                            <td><?= $tache['description'] ?></td>
                            <td>                            
                                <a class="badge bg-<?= statutTache($tache) ?>" title="Modifier ?" style="cursor: pointer; text-decoration:none;" 
                                    href="?page=<?= $page ?>&modif_statut=<?= $tache['statut'] ?>&idstatut=<?= $tache['id'] ?>#tdt">
                                <?= $tache['statut'] ?>
                                </a>
                            </td>
                            <td><span class="badge bg-<?= prioriteTache($tache)?>"><?= $tache['priorite'] ?></span></td>
                            <td><?= $tache['date_creation'] ?></td>
                            <td>
                                <?= $tache['date_limite'] ?>
                                <?php if(verifDateLimite($tache)):?>
                                    <span class="badge bg-danger">Date dépassée</span>
                                <?php endif?>                                
                            </td>
                            <td><?= $tache['responsable'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-success btn-sm"  href="<?= $tache['statut'] == 'Terminée' ? '#tdt' : ('?terminer_tache='. $tache['id'] .'&page=dashbordTaches&statut='. $tache['statut']) ?>#tdt"  title="Terminer la taches">✔</a>
                                <a class="btn btn-info btn-sm" href="<?= $tache['statut'] == 'Terminée' ? '#tdt' : ('?modifier=' . $tache['id'] . '&page=indexTaches&admin_modif=yes') ?>" title="Modifier la taches">✏</a>
                                <a class="btn btn-danger btn-sm" href="?supprimer=<?= $tache['id'] ?>&page=dashbordTaches#tdt" onclick="return confirm('Supprimer cette tâche ?');" title="Supprimer la taches">🗑</a>
                            </td>
                        </tr> 
                        <?php endforeach;?>   
                    </tbody>
                </table>
            </div>
        </div>
        <a href="?page=indexTaches" class="btn btn-primary">➕ Nouvelle tâche</a>
</div>
<br>