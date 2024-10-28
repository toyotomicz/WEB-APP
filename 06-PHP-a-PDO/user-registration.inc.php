<?php
///////////////////////////////////////////////////////////////////
////////////// Stranka pro registraci uzivatele ////////////////
///////////////////////////////////////////////////////////////////

    // nacteni souboru s funkcemi


    // nacteni hlavicky stranky
    require_once("ZakladHTML.class.php");
    ZakladHTML::createHeader("Registrace nového uživatele");

    require_once("MyDatabase.class.php");

    $db = new MyDatabase();

    if (!empty($_POST["potvrzeni"])) {
        // Validace dat z formuláře
        if (!empty($_POST["login"]) && !empty($_POST["heslo"]) && !empty($_POST["jmeno"]) && !empty($_POST["email"])) {
            // Vytvoř asociativní pole s potřebnými údaji
            $userdata = [
                'login' => htmlspecialchars(trim($_POST["login"])),   // Sanitace vstupu
                'heslo' => $_POST["heslo"],                           // Heslo bude zahashováno v metodě addUser
                'jmeno' => htmlspecialchars(trim($_POST["jmeno"])),
                'email' => filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL) // Validace emailu
            ];

            // Přidání uživatele do databáze
            if ($db->addUser($userdata)) {
                echo "Uživatel byl úspěšně přidán!";
            } else {
                echo "Chyba při přidávání uživatele.";
            }
        } else {
            echo "Vyplňte všechny povinné údaje!";
        }
    }


    // zpracovani odeslanych formularu

    ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////

?>
        <h2>Registrační formulář</h2>
        <form action="" method="POST" oninput="x.value=(pas1.value==pas2.value)?'OK':'Nestejná hesla'">
            <table>
                <tr><td>Login:</td><td><input type="text" name="login" required></td></tr>
                <tr><td>Heslo 1:</td><td><input type="password" name="heslo" id="pas1" required></td></tr>
                <tr><td>Heslo 2:</td><td><input type="password" name="heslo2" id="pas2" required></td></tr>
                <tr><td>Ověření hesla:</td><td><output name="x" for="pas1 pas2"></output></td></tr>
                <tr><td>Jméno:</td><td><input type="text" name="jmeno" required></td></tr>
                <tr><td>E-mail:</td><td><input type="email" name="email" required></td></tr>
                <tr><td>Právo:</td>
                    <td>
                        <select name="pravo">
                            <option value=''></option>
                            <?php
                                // ziskam vsechna prava

                            ?>
                        </select>
                    </td>
                </tr>
            </table>

            <input type="submit" name="potvrzeni" value="Registrovat">
        </form>
<?php
    ///////////// KONEC: PRO NEPRIHLASENE UZIVATELE ///////////////

    ///////////// PRO PRIHLASENE UZIVATELE ///////////////
?>
        <div>
            <b>Přihlášený uživatel se nemůže znovu registrovat.</b>
        </div>
<?php

    ///////////// KONEC: PRO PRIHLASENE UZIVATELE ///////////////

    // paticka
    ZakladHTML::createFooter();
?>
             