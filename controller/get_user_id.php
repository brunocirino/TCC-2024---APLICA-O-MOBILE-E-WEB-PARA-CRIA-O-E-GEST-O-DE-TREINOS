<?php
session_start();

if (isset($_SESSION['id'])) {
    echo json_encode(['id' => $_SESSION['id']]);
} else {
    echo json_encode(['id' => null]);
}

?>