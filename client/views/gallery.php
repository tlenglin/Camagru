<?php

require_once(__DIR__ . '/../../lib/requireAuth.php');
requireAuth();

$page = 'gallery';

require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../../lib/imageLib.php');


global $db;
$stmt = $db->prepare('SELECT id, base_64, likes, comments_nb FROM img ORDER BY dates desc LIMIT 1');
$stmt->execute();
$results = $stmt->fetchall(PDO::FETCH_ASSOC);

require_once(__DIR__ . '/../includes/nav.php');

 $stmt = $db->prepare('SELECT COUNT(*) as nb FROM img');
 $stmt->execute();
 $nb_photos = $stmt->fetchall(PDO::FETCH_ASSOC);

 $photosParPage = 2;
 //Nous allons maintenant compter le nombre de pages.
 $nombreDePages = ceil(intval($nb_photos[0]['nb'])/ $photosParPage);

 if(isset($_GET['page']) && $_GET['page'] !== "") // Si la variable $_GET['page'] existe...
 {
      $pageActuelle=intval($_GET['page']);

      if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
      {
           $pageActuelle=$nombreDePages;
      }
 }
 else // Sinon
 {
      $pageActuelle=1; // La page actuelle est la n°1
 }

 $premiereEntree=($pageActuelle-1)*$photosParPage; // On calcul la première entrée à lire

 $stmt = $db->prepare('SELECT * FROM img ORDER BY id DESC LIMIT '.$premiereEntree.', '.$photosParPage.'');
 $stmt->execute();
 $results = $stmt->fetchall(PDO::FETCH_ASSOC);
 echo '<div><ul>';
 foreach ($results as $photo)
 {
	  $stmt = $db->prepare('SELECT login FROM users WHERE id = ?');
	  $stmt->bindParam(1, $photo['user_id']);
	  $stmt->execute();
	  $login = $stmt->fetchall(PDO::FETCH_ASSOC);
      echo '<li class=\'gallery-single\'>By : ' . $login . '<br /><img class=' . $photo['filter'] . ' src=' . $photo['base_64'] . ' /><br />
	  Likes : ' . $photo['likes'] . '<br />
	  Comments : ' . $photo['comments_nb'] . '<br />';
 }
 echo '</ul></div><script type=\'text/javascript\' src=\'./public/js/gallery.js\'></script>';
for($i=1; $i<=$nombreDePages; $i++)
 {
      if($i==$pageActuelle)
      {
          echo ' [ '.$i.' ] ';
      }
      else
      {
           echo ' <a href="gallery.php?page='.$i.'">' . $i . '</a> ';
      }
 }


 ?>
