<?php
session_start();

if (!isset($_SESSION["contacts"])) {
    $_SESSION["contacts"] = [];
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formName = htmlspecialchars(trim($_POST["name"] ?? ""));
    $formFamillyName = htmlspecialchars(trim($_POST["famillyName"] ?? ""));
    $formAge = htmlspecialchars(trim($_POST["age"] ?? ""));


    if (!empty($formName) && !empty($formFamillyName) && !empty($formAge)) {
        $newContacts = [
            "name" => $formName,
            "famillyName" => $formFamillyName,
            "age" => $formAge
        ];
            $_SESSION["contacts"][] = $newContacts;
            $contacts = $_SESSION["contacts"];
    }
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
        <form action="" method="post">
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
    <section class="messagesContainer">
        <article>
        <h2>Message Reçu</h2>
                 <?php 
                    if(!empty($contacts)) {
                        foreach ($contacts as $contact) {
                            echo "
                            <article>
                                <h3>$contact[name]</h3>
                                <span>le nom est: $contact[famillyName]</span>
                                <p>
                                    l'âge est $contact[age] ans.
                                </p>
                            </article>
                            ";
                        }
                        
                    }else{
                        echo "
                            <p>
                                Nous n'avons pas reçu de messages!
                            </p>
                        ";
                    }
                ?>

    </article>
    </section>
</main>
<?php include "footer.php";?>

</body>
</html>