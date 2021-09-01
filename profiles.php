<?php 
    require('actions/request/profilesAction.php'); 
    require('actions/users/securityAction.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>

    <br><br>
    <div class="container">

        <?php

            while($discussions = $getAllDiscussions->fetch()){
                ?>
                <div class="card">
                    <h5 class="card-header">
                        <?= $discussions['title']; ?>
                    </h5>
                    <div class="card-body">
                        <p class="card-text">
                            <?= $discussions['tldr']; ?>
                        </p>
                        <a href="#" class="btn btn-primary">Lire la discussion</a>
                        <a href="#" class="btn btn-warning">Modifier</a>
                    </div>
                </div>
                <?php
            }

        ?>

    </div>

</body>
</html>