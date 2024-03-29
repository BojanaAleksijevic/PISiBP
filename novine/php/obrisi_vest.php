<?php
require_once ('C:\wamp64\www\novine\process\db.php');
session_start();

if (!isset($_SESSION['id']) || ($_SESSION['role'] != 0 && $_SESSION['role'] != 1)) {
    header("Location: ../php/pocetna.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $queryDeleteTags = "DELETE FROM tags WHERE newsID = $id";
    if (!mysqli_query($conn, $queryDeleteTags)) {
        echo "Greška prilikom brisanja tagova: " . mysqli_error($conn);
    }

    $queryDeleteImages = "DELETE FROM images WHERE newsID = $id";
    if (!mysqli_query($conn, $queryDeleteImages)) {
        echo "Greška prilikom brisanja slika: " . mysqli_error($conn);
    }

    $queryDeleteNews = "DELETE FROM news WHERE idNews = $id";
    if (mysqli_query($conn, $queryDeleteNews)) {
        if ($_SESSION['role'] == 0) {
            // Ako je korisnik admin
            header("Location: admin_odobrava_vesti.php");
        } elseif ($_SESSION['role'] == 1) {
            // Ako je korisnik urednik
            header("Location: urednik_odobrava_vesti.php");
        }
        exit;
    } else {
        echo "Greška prilikom brisanja vesti: " . mysqli_error($conn);
    }
} else {
    echo "Nedostaje ID vesti.";
}
?>
