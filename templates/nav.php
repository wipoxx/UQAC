<p>
<?php
if (isset($_SESSION['idUsager'])) { 
?>
    <a href="index.php?page=recherche">Rechercher un voyage</a>
    <a href="index.php?page=ajoutVoyage">Ajouter un voyage</a>
    <a href="index.php?page=profil">Profil personnel</a>
        
<?php
} else {
?>      
    <a href="index.php?page=inscription">Inscription</a>
    <a href="index.php">Connexion</a>
    
<?php
}
?>  
</p>