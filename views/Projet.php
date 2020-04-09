<!-- Binôme Groupe 3 : Monoy Olivier / Nollet Antoine -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Projet V'Lille</title>
    <link rel="stylesheet" type="text/css" href="style/Projet.css" />
    <script src="script/Project.js"></script>
    <script src="script/VliveImage.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" crossorigin=""></script>
  </head>
<body>
<img class ="entete" src="images/projet.jpg" alt="by olivier"></img>

<div id="formulaire">
  <form method="post" action="index.php">
    <fieldset>
      <input type="text" placeholder="Nom de Station" name="nom" autofocus/>
      <input type="text" placeholder="Nom de Commune" name="commune" />
      <br />
      <br />
      <input type="number" placeholder="Minimum de vélos disponibles" min="0" name="velos"/>
      <input type="number" placeholder="Minimum de places libres" min="0" name="bornes"/>
      <select name="service">
        <option value="">Toutes</option>
        <option value="EN SERVICE">En service</option>
        <option value="HORS SERVICE">Hors service</option>
      </select>
      <button type="submit" name="valid"><img src="images/research.png"></img></button>
    </fieldset>
  </form>
</div>

<div id="liste">
  <?php
    foreach($reponse as $station) {
      $station = $station['fields'];
      echo "<div data-geo=\"[".implode(",",$station['geo'])."]\" data-nom=\"".$station['nom']."\" data-commune=\"".$station['commune']."\" data-adresse=\"".$station['adresse']."\" data-velos=\"".$station['nbvelosdispo']."\" data-bornes=\"".$station['nbplacesdispo']."\" data-type=\"".$station['type']."\" class=\"".$station['etat']."\" >";
      echo "<p id=\"etat\"> STATION ".$station['etat']."</p>";
      echo "<p id=\"nom\"> Station <b>".$station['nom']."</b> à <b>". $station['commune']."</b></p>";
      echo "<p id=\"nbVelos\">". strval($station['nbvelosdispo']) ." vélos disponibles</p>";
      echo "<p id=\"nbBornes\">". strval($station['nbplacesdispo'])." places libres </p>";
      echo "</div>";
      echo "<br />";
    }
  ?>
</div>

<div id="carte_lille"></div>

<div id="details"> <p>Les détails ...</p> </div>

<a href="http://webtp.fil.univ-lille1.fr/~nollet/Projet_V'Lille/credit.html"> Crédits... </a>

</body>
</html>
