<?php

require('actions/database.php');

//Validation du formulaire
if(isset($_POST['validate'])){

    //Vérifier si l'user a complété tout les champs
    if(!empty($_POST['pseudo']) && !empty($_POST['password'])){

        //Les données de l'user
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_password = htmlspecialchars($_POST['password']);

        //Vérifier si l'utilisateur existe (si le pseudo est correct)
        $checkIfUserExists = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
        $checkIfUserExists->execute([$user_pseudo]);

        if($checkIfUserExists->rowCount() > 0){

            //Récupérer les données de l'utilisateur
            $usersInfos = $checkIfUserExists->fetch();

            //Vérifier si le mot de passe est correct
            if(password_verify($user_password, $usersInfos['pass'])){

                //Authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales sessions
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $usersInfos['id'];
                $_SESSION['lastname'] = $usersInfos['lastname'];
                $_SESSION['firstname'] = $usersInfos['firstname'];
                $_SESSION['pseudo'] = $usersInfos['pseudo'];

                //Redirige l'utilisateur vers la page d'acceuil
                header('Location: index.php');

            }else{
                $errorMsg = "Votre mot de passe est incorrect...";
            }

        }else{
            $errorMsg = "Votre pseudo est incorrect...";
        }

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }

}