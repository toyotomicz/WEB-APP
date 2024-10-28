<?php
///////////////////////////////////////////////////////
////////////// Zakladni nastaveni webu ////////////////
///////////////////////////////////////////////////////

////// nastaveni pristupu k databazi ///////

    // prihlasovaci udaje k databazi
    define("DB_SERVER","localhost");
    define("DB_NAME","jjoska_pdo");
    define("DB_USER","root");
    define("DB_PASS","");

    // definice konkretnich nazvu tabulek
    define("TABLE_UZIVATEL","jjoska_uzivatel");
    define("TABLE_PRAVO","jjoska_pravo");


///// vsechny stranky webu ////////

    // pripona souboru
    $phpExtension = ".inc.php";

    // dostupne stranky webu
    define("WEB_PAGES", [
        'login' => "user-login".$phpExtension,
        'registrace' => "user-registration".$phpExtension,
        'uprava' => "user-update".$phpExtension,
        'management' => "user-management".$phpExtension
    ]);

    // defaultni/vychozi stranka webu
    define("WEB_PAGE_DEFAULT_KEY", 'login');

?>