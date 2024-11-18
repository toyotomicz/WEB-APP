<?php
namespace App\Config;

class Settings {
    const DB_SERVER = 'localhost';  // váš server
    const DB_NAME = 'pizzeria';  // název vaší databáze
    const DB_USER = 'root';  // váš uživatel
    const DB_PASS = '';  // vaše heslo

    const TABLE_USERS = 'users';
    const TABLE_ROLES = 'roles';
    const TABLE_PIZZA_TYPES = 'pizza_types';
    const TABLE_ORDERS = 'orders';
    const TABLE_ORDER_ITEMS = 'order_items';
}

define("BASEURL", "http://localhost/web-app/semestralka/public/");
