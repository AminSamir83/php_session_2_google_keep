<?php
/**
 * Created by PhpStorm.
 * User: aymen
 * Date: 04/09/2018
 * Time: 15:30
 */
session_start();
/*
 * Si on a une session on ajoute la note
 * Sinon je créer une variable de session je la remplis de fake note et je l'affiche
 */
/*
 *
 if (!isset($_SESSION['mesNotes'])) {
    $_SESSION['mesNotes']=array(
        'Dimanche'=>'Dormir',
        'Samedi' => 'Sortir'
    );
}
*/

?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Liste des notes</title>
    </head>
<body>
    <form action="ajoutNote.php" method="post">
        <label><h2><strong>Ajouter une note</strong></h2></label><br>
        <label for="nom" style="display: block;text-align: center;">Nom</label><input name="nom" class="form-control" id="nom" style="display:block;width:40%;margin-left:auto;margin-right:auto"  type="text">
        <label for="note" style="display: block;text-align: center;"> Note</label><input name="note" class="form-control"style="display:block;width:40%;margin-left:auto;margin-right:auto" id="note" type="text">
        <input type="submit" value="Envoyer" style="display: block;margin-left: auto;margin-right:auto;" class="btn btn-primary">
    </form>
<?php
if (isset($_POST['nom'])) {
    if (isset($_SESSION['mesNotes'][$_POST['nom']])) {
        $_SESSION['error'] = "Note existante impossible de l'ajouter";
    } else {
        $_SESSION['mesNotes'][$_POST['nom']] = $_POST['note'];
        $_SESSION['succes'] = "Note " . $_SESSION['mesNotes'][$_POST['nom']] . " ajoutée avec succés";
    }
}
?>

<?php
if (!isset($_SESSION['mesNotes'])){
    ?>
<div class="alert alert-danger">Liste Vide</div>
<?php
} else {
    ?>
<?php if (isset($_SESSION['error'])){
        ?>
<div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
<?php
        unset($_SESSION['error']);
    }
    ?>

<?php if (isset($_SESSION['succes'])){
        ?>
<div class="alert alert-success"><?= $_SESSION['succes'] ?></div>
<?php
        unset($_SESSION['succes']);
    }
    ?>
<h1>Liste des notes</h1>
    <form action='ajoutNote.php' method='POST' name='formulaire'>
<div  class="card-group" style="display:flex;flex-wrap:wrap;">
    <?php foreach ($_SESSION['mesNotes'] as $titre=>$contenu)  { ?>
    <div class="list-group-item" style="width:20%">
        <div class="card">
            <div class="card-body"><?php echo $titre. ' : '. $contenu ; ?></div>
            <?php echo "<button type=\"submit\" name=$titre >Delete</button>" ?>
        </div>

    </div>
        <?php  foreach ($_SESSION['mesNotes'] as $titre=>$contenu)
        {if (isset($_POST[$titre]))
        { $todeleteelt=$titre;
        }}
        ?>
    <?php } ?>
    <?php
    if (isset($todeleteelt)){
    unset($_SESSION['mesNotes'][$todeleteelt]);
        header("location:ajoutNote.php");} ?>
</div>
    </form>
    </body>
<?php }
?>