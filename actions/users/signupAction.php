<?php

require('actions/database.php');

//Validation du formulaire
if(isset($_POST['validate'])){

    //Vérifier si l'user a complété tout les champs
    if(!empty($_POST['nickname']) && !empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['password'])){

        //Les données de l'user
        $user_nickname = htmlspecialchars($_POST['nickname']);
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['password'] , PASSWORD_DEFAULT);

        //Vérifier si l'utilisateur existe déjà sur le site
        $checkIfUserAlreadyExists = $pdo->prepare('SELECT nickname FROM users WHERE nickname = ?');
        $checkIfUserAlreadyExists->execute([$user_nickname]);

        if($checkIfUserAlreadyExists->rowCount() == 0){
            
            //Insérer l'utilisateur dans la pdo
            $insertUserOnWebsite = $pdo->prepare('INSERT INTO users(nickname, lastname, firstname, pass)VALUE(?, ?, ?, ?)');
            $insertUserOnWebsite->execute([$user_nickname, $user_lastname, $user_firstname, $user_password]);

            //Récupérer les informations de l'utilisateur
            $getInfosOfThisUserReq = $pdo->prepare('SELECT id FROM users WHERE nom = ? AND prenom = ? AND nickname = ?');
            $getInfosOfThisUserReq->execute([$user_lastname, $user_firstname, $user_nickname]);

            $usersInfos = $getInfosOfThisUserReq->fetch();

            //Authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales sessions
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $usersInfos['id'];
            $_SESSION['lastname'] = $usersInfos['lastname'];
            $_SESSION['firstname'] = $usersInfos['firstname'];
            $_SESSION['nickname'] = $usersInfos['nickname'];

            //Rediriger l'utilisateur vers la page d'acceuil
            header('Location: index.php');

        }else{
            $errorMsg = "L'utilisateur existe déjà sur le site";
        }

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }

}