<?php
require_once ('C:\wamp64\www\novine\process\db.php');
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 0) {
    header("Location: ../php/novine.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $queryGetApplicationData = "SELECT * FROM prijave WHERE id = $id";
    $result = mysqli_query($conn, $queryGetApplicationData);

    if ($result && mysqli_num_rows($result) == 1) {
        $applicationData = mysqli_fetch_assoc($result);

        $queryInsertCategory = "INSERT INTO category (name)
        VALUES ('{$applicationData['kategorija']}')";
        if (mysqli_query($conn, $queryInsertCategory)) {
        

            $idCategory_rez = mysqli_query($conn, "SELECT idCategory FROM category 
            WHERE name = '{$applicationData['kategorija']}'");
            $idCategoryRow = mysqli_fetch_assoc($idCategory_rez);
            $idCategory = $idCategoryRow['idCategory'];
        } else {
            echo "Greška prilikom dodavanja kategorije: " . mysqli_error($conn);

        }
          

        $queryUpdateStatus = "UPDATE prijave SET status = 'approved' WHERE id = $id";
        if (mysqli_query($conn, $queryUpdateStatus)) {

            $queryInsertUser = "INSERT INTO User (id, name, surname, password, role, categoryID)
                                VALUES ('{$applicationData['id']}', '{$applicationData['name']}',
                                        '{$applicationData['surname']}', '{$applicationData['password']}', 
                                        '{$applicationData['role']}', 
                                        '{$idCategory}')";

            if (mysqli_query($conn, $queryInsertUser)) {
                header("Location: pregled_prijava.php");
                exit;
            } else {
                echo "Greška prilikom dodavanja korisnika: " . mysqli_error($conn);
            }
        } else {
            echo "Greška prilikom odobravanja prijave: " . mysqli_error($conn);
        }
    } else {
        echo "Nepostojeća prijava.";
    }
} else {
    echo "Nedostaje ID prijave.";
}
?>
