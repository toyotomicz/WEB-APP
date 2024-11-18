<?php
namespace App\Models;

class Session {
    
    /**
     * Při vytvoření objektu je zahájena session.
     */
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    /**
     * Funkce pro uložení hodnoty do session.
     * 
     * @param string $name Jméno atributu.
     * @param mixed $value Hodnota, která bude uložena do session.
     */
    public function addSession($name, $value) {
        $_SESSION[$name] = $value;
    }
    
    /**
     * Vrátí hodnotu dané session nebo null, pokud session není nastavena.
     * 
     * @param string $name Jméno atributu.
     * @return mixed|null Hodnota atributu nebo null, pokud není nastavena.
     */
    public function readSession($name) {
        return $this->isSessionSet($name) ? $_SESSION[$name] : null;
    }
    
    /**
     * Kontroluje, zda je session atribut nastaven.
     * 
     * @param string $name Jméno atributu.
     * @return bool True, pokud je atribut nastaven, jinak false.
     */
    public function isSessionSet($name) {
        return isset($_SESSION[$name]);
    }

    /**
     * Odstraní danou session.
     * 
     * @param string $name Jméno atributu.
     */
    public function removeSession($name) {
        unset($_SESSION[$name]);
    }

    /**
     * Odstraní všechny atributy ze session.
     */
    public function clearAllSessions() {
        session_unset(); // odstraní všechny session proměnné
    }
    
    /**
     * Ukončí session a odstraní všechny session proměnné.
     */
    public function destroySession() {
        session_unset();   // odstraní všechny session proměnné
        session_destroy(); // ukončí session
    }
}
?>
