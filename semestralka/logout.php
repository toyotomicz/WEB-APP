<?php

require_once 'Session.php'; // Načti třídu Session

// Vytvoření instance třídy
$session = new Session();

// Vymazání celé session
$session->clear();
header('Location: '."index.php");
?>