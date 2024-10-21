<?php

class Session {
    // Konstruktor zahájí session, pokud není již zahájená
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Nastaví hodnotu v session pro zadaný klíč
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    // Získá hodnotu z session podle zadaného klíče
    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Zkontroluje, zda je hodnota pro daný klíč v session nastavena
    public function has($key) {
        return isset($_SESSION[$key]);
    }

    // Odstraní hodnotu ze session podle klíče
    public function remove($key) {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    // Vymaže celou session
    public function clear() {
        session_unset();
        session_destroy();
    }
}
