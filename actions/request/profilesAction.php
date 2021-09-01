<?php

require('actions/database.php');

$getAllDiscussions = $pdo->prepare('SELECT id, title, tldr FROM discussions WHERE author_id = ?');
$getAllDiscussions->execute([$_SESSION['id']]);