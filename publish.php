<?php 
require('actions/users/securityAction.php');
require('actions/request/publishAction.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <br><br>
    <form class="container" method="POST">

        <?php 

            if(isset($errorMsg)){ 
                echo '<p>'.$errorMsg.'</p>'; 
            }else if(isset($successMsg)){ 
                echo '<p>'.$successMsg.'</p>';
            }
            
            // var_dump($_SESSION)
        ?>


        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Titre de la discussion</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Descritpion</label>
            <textarea class="form-control" name="tldr"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Contenu</label>
            <textarea class="form-control" name="content"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" name="validate">Publier</button>
    </form>

</body>
</html>