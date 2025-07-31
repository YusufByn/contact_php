<?php

session_start();
// si on lis la phrase en code, Si dans le "server" ici c'est le site il y'a la requete avec la method post va me chercher name etc
// il faut mettre ?? "" car sinon ca peut planter, ca veut dire que ca crée une chaine vide genre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST["name"] ?? "";
    $formFamillyName = $_POST["famillyName"] ?? "";
    $formAge = $_POST["age"] ?? "";

    // $_SESSION["name"] = $mavariable qui a déjà cherché le $_post name
    // sinon ca aurai été session name = $_post[name] (vu que mes variale name etc sont déjà crée j'ia simplifié)
    $_SESSION["name"] = $formName;
    $_SESSION["famillyName"] = $formFamillyName;
    $_SESSION["age"] = $formAge;

    var_dump($_SESSION);
// je créer un array vide, en le rappelant dans mes conditions ca va me permettre d'écrire des phrases directement
    $errorsMessages = []; 

// Si $formName n’est pas vide ET $formFamillyName n’est pas vide ET $formAge n’est pas vide
// alors tu considères que $errorsMessages est égal à prénom formName etc
if (!empty($formName) && !empty($formFamillyName) && !empty($formAge)) {
    $errorsMessages = [
        "prénom" => $formName,
        "nom"    => $formFamillyName,
        "âge"    => $formAge
    ];
} else {
    if (empty($formName)) {
        // étant donné que dans le tableau assiocatif en haut j'ai associé prénom à formName je dois préciser en bas prénom
        $errorsMessages["prénom"] = "Le prénom est obligatoire.";
    }
    if (empty($formFamillyName)) {
        // étant donné que dans le tableau assiocatif en haut j'ai associé nom à formFamillyName je dois préciser en bas nom
        $errorsMessages["nom"] = "Le nom de famille est obligatoire.";
    }
    if (empty($formAge)) {
        // étant donné que dans le tableau assiocatif en haut j'ai associé age à formAge je dois préciser en bas age
        $errorsMessages["âge"] = "L'âge est obligatoire.";
    }
}
// // si formName (prénom) est vide, tu m'écris le message d'erreur suivant
// if (empty($formName)) {
//     $errorsMessages[] = "Vous devez nous adresser un prénom.";
// }
// // si formfamillyname est vide, tu m'écris le message d'erreur suivant
// if (empty($formFamillyName)) {
//     $errorsMessages[] = "Vous devez nous adresser un nom de famille.";
// }
// // je pourrai ne pas le faire pour l'age et le mettre en required dans le html mais si quand meme
// if (empty($formAge)) {
//     $errorsMessages[] = "Vous devez nous adresser un âge.";
// }
// // si l'age est inférieur à 18, stop, trop jeune
// if ($formAge < 18) {
//     $errorsMessages[] = "Vous êtes trop jeune pour continuer";
// }
// // si il n'y a pas d'erreurs, tu écris cela
// if (empty($errorsMessages)) {
//     echo "Bonjour " . $formName . " nous avons pris en compte vos informations !";
// }

// traitement/nettoyage de données c'est SUPER IMPORTANT de faire ca, faut tout le temps le faire
// si aucune erreurs, tu converties les charateres special cen entité HTML ET tu trim(genre ca enleve les espaces etcetc)
if (empty($errorsMessages)) {
    $formName = htmlspecialchars(trim($formAge));
    $formFamillyName = htmlspecialchars(trim($formFamillyName));
    $formAge = htmlspecialchars(trim($formAge));
} else {
    foreach ($errorsMessages as $error)
        echo "$error <br>";
}
// explication du code dessus :
// sinon, tu me fais une boucle (étant donné qu'il peut y'avoir plusieurs erreurs et que y'a plusieurs champs)
// avec pour message erreur, la variable erreur n'est pas vide étant donné qu'on lui a déjà donné du contenu au dessus
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "header.php";?>

<main> 
    <section class="formContainer">
        <form action="" method="POST">
            <h2>Contact</h2>
            <label>Votre Prénom :</label>
            <input name="name" id="name" type="text" placeholder="Entrez votre nom">

            <label>Votre nom : :</label>
            <input name="famillyName" id="famillyName" type="text" placeholder="Le sujet de votre message"> 

            <label>Veuillez indiquer votre âge</label>
            <input type="number" name="age" id="age" placeholder="Veuillez indiquer votre âge ici">

            <button type="submit">Envoyer</button>
        </form>
    </section>
</main>
<?php include "footer.php";?>

</body>
</html>