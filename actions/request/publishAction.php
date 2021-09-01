<?php

require('actions/database.php');

if(isset($_POST['validate'])) {

    if(!empty($_POST['title']) && !empty($_POST['tldr']) && !empty($_POST['content'])){

        $discussion_title = htmlspecialchars($_POST['title']);
        $discussion_tldr = nl2br(htmlspecialchars($_POST['tldr']));
        $discussion_content = nl2br(htmlspecialchars($_POST['content']));
        $discussion_author_id = $_SESSION['id'];
        $discussion_author_nickname = $_SESSION['nickname'];
        $discussion_date = date('Y-m-d H:i:s');

        $inserDiscussion = $pdo->prepare('INSERT INTO discussions(title, tldr, content, author_id, author_nickname, discussion_date) VALUES(?, ?, ?, ?, ?, ?)');
        $inserDiscussion->execute(
            [
                $discussion_title, 
                $discussion_tldr, 
                $discussion_content, 
                $discussion_author_id, 
                $discussion_author_nickname,
                $discussion_date
            ]
        );
        
        $successMsg = "Votre discussion a bien été publié sur le site";

    }else{
        $errorMsg = "Veuillez compléter tout les champs...";
    }

}