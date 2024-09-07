<?php
include '../connexion/connexion.php';
require_once('../models/select/select-mouve.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Caisse</title>
    <?php require_once('style.php') ?>

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <?php require_once('navbar.php') ?>
            <div class="main-sidebar sidebar-style-2">
                <?php require_once('aside.php') ?>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-white">Les mouvements des caisses</h4>
                    </div>
                    <!-- pour afficher les massage  -->
                    <?php
                    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                        <div class="col-xl-12 mt-3">
                            <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                        </div>
                    <?php }
                    #Cette ligne permet de vider la valeur qui se trouve dans la session message
                    unset($_SESSION['msg']);
                    ?>
                    <!-- Le form qui enregistrer les données  -->
                    <?php
                    if (isset($_GET['AjoutDon']) && isset($_GET['IdCategorie'])) {
                        $categorie = $_GET['IdCategorie'];
                        if ($categorie == 1) {
                    ?>
                            <div class="col-xl-12 ">
                                <h4 class="text-center"><?= $title ?></h4>
                                <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">Description <span class="text-danger">*</span></label>
                                            <input required type="text" name="description" class="form-control" placeholder="Entrez le nom" <?php if (isset($_GET['idEnfant'])) { ?>
                                                value=<?php echo $tab['nom']; ?> <?php } ?>>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">Montant <span class="text-danger">*</span></label>
                                            <input required type="text" name="montant" class="form-control" placeholder="Entrez le nom" <?php if (isset($_GET['idEnfant'])) { ?>
                                                value=<?php echo $tab['nom']; ?> <?php } ?>>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">Devise <span class="text-danger">*</span></label>
                                            <select required id="" name="devise" class="form-control select2">
                                                <?php if (isset($_GET['idEnfant'])) {
                                                    $genre = $tab['genre'];
                                                ?>
                                                    <option value="Masculin">Masculin</option>
                                                    <option <?php if ($genre == "Feminin") { ?> Selected <?php } ?>value="Feminin">Feminin</option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option desabled>Choisir une devise</option>
                                                    <option value="CDF">CDF</option>
                                                    <option value="Dollards">Dollards</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                            <input type="submit" name="<?= $btn ?>" class="btn btn-success w-100" value="Enregister">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-xl-12 ">
                                <h4 class="text-center"><?= $title ?></h4>
                                <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">Description <span class="text-danger">*</span></label>
                                            <input required type="text" name="description" class="form-control" placeholder="Entrez la description" <?php if (isset($_GET['idEnfant'])) { ?>
                                                value=<?php echo $tab['nom']; ?> <?php } ?>>
                                        </div>                                        
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">Montant <span class="text-danger">*</span></label>
                                            <input required type="text" name="montant" class="form-control" placeholder="Entrez le montant" <?php if (isset($_GET['idEnfant'])) { ?>
                                                value=<?php echo $tab['prenom']; ?> <?php } ?>>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">Devise <span class="text-danger">*</span></label>
                                            <select required id="" name="devise" class="form-control select2">
                                                <?php if (isset($_GET['idEnfant'])) {
                                                    $genre = $tab['genre'];
                                                ?>
                                                    <option value="Masculin">Masculin</option>
                                                    <option <?php if ($genre == "Feminin") { ?> Selected <?php } ?>value="Feminin">Feminin</option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option desabled>Choisir une devise</option>
                                                    <option value="CDF">CDF</option>
                                                    <option value="Dollards">Dollards</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                            <input type="submit" name="<?= $btn ?>" class="btn btn-success w-100" value="Enregistrer">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php
                        }
                    } else {
                        if (isset($_GET['AjoutDon'])) {
                        ?>
                            <div class="col-xl-12 pt-3">
                                <div class="card pt-4 shadow">
                                    <h4 class="text-center">Les types des mouvemlents</h4>
                                    <div class="card-header">
                                        <h4 class="text-center" hidden>Les categoriede dons</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary" href="#"><i class="fas fa-minus">Choisir</i></a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="mycard-collapse">
                                        <div class="card-body text-center">
                                            <a href="movementCaisse.php?AjoutDon&IdCategorie=1" class="btn btn-success">Enregistrer une entree en caisse</a>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="movementCaisse.php?AjoutDon&IdCategorie=2" class="btn btn-success">Enregistrer une sortie en caisse</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-xl-12 mb-3 mt-3 ">
                                <a href="movementCaisse.php?AjoutDon" class="btn btn-success w-100">Enregistrer un mouvement</a>
                            </div>
                    <?php
                        }
                    }


                    ?>
                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h3 class="text-center pt-3">Les mouvements de la caisse</h3>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Entree</th>
                                    <th>Sortie</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idDonNat = $getData->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td><?= $idDonNat["date"] ?></td>
                                        <td><?= $idDonNat["description"] ?></td>
                                        <td>
                                            <?php
                                            $entree="Entree";
                                            if($idDonNat["type"]==$entree){
                                                echo $idDonNat["Montant"];
                                            }else{
                                                echo "---";
                                            }                                            
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $sortie="Sortie";
                                            if($idDonNat["type"]==$sortie){
                                                echo $idDonNat["Montant"];
                                            }else{
                                                echo "---";
                                            }                                            
                                            ?>
                                        </td>
                                        <td>
                                            <a href="Enfant.php?AjoutBien&idDonNat=<?= $idDonNat['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-enfant-post.php?idSupEnf=<?= $idDonNat['id'] ?>" class="btn btn-danger btn-sm mt-1">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
            <?php require_once('footer.php') ?>
        </div>
    </div>

    <?php require_once('script.php') ?>
</body>

</html>