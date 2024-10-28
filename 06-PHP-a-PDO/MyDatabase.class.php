<?php
//////////////////////////////////////////////////////////////
////////////// Vlastni trida pro praci s databazi ////////////////
//////////////////////////////////////////////////////////////

/**
 * Vlastni trida spravujici databazi.
 */
class MyDatabase {
    private $pdo;

    // Konstruktor inicializuje PDO připojení
    public function __construct($host = DB_SERVER, $dbname = DB_NAME, $username = DB_USER, $password = DB_PASS) {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            // Nastavení PDO atributů, např. pro hlášení chyb
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Zpracování chyb při připojení k databázi
            die("Připojení k databázi selhalo: " . $e->getMessage());
        }
    }

    // Metoda pro provedení SQL dotazu
    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Chyba při provádění dotazu: " . $e->getMessage());
        }
    }

    // Metoda pro získání výsledku jako pole
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metoda pro získání jednoho řádku
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    // Metoda pro získání posledního vloženého ID
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    // Metoda pro zavření připojení
    public function closeConnection() {
        $this->pdo = null;
    }

    public function getAllUser(){
        $sql = "SELECT * FROM ".TABLE_UZIVATEL;
        return $this->fetchAll($sql);
    }

    public function addUser(array $userdata) {
        // Kontrola, zda je vyplněn login
        if (empty($userdata["login"])) {
            return false;
        }
    
        // SQL dotaz pro vložení uživatele
        $sql = "INSERT INTO " . TABLE_UZIVATEL . " (login, heslo, jmeno, email) 
                VALUES (:login, :heslo, :jmeno, :email)";
    
        // Příprava a provedení dotazu
        try {
            $stmt = $this->pdo->prepare($sql);
    
            // Vázání parametrů pro bezpečnost proti SQL injection
            $stmt->bindParam(':login', $userdata['login']);
            $stmt->bindParam(':heslo', password_hash($userdata['heslo'], PASSWORD_BCRYPT)); // Hashování hesla
            $stmt->bindParam(':jmeno', $userdata['jmeno']);
            $stmt->bindParam(':email', $userdata['email']);
    
            // Provedení dotazu
            return $stmt->execute();
        } catch (PDOException $e) {
            // Zpracování chyby při vkládání uživatele
            die("Chyba při přidávání uživatele: " . $e->getMessage());
        }
    }
    
}
?>
