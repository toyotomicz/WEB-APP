<?php
class PizzaManager {
    private $pizzas;

    public function __construct() {
        // Načtení pizzy (může být z databáze nebo statický seznam)
        $this->pizzas = [
            ['id' => 1, 'name' => 'Margherita', 'description' => 'Klasická pizza s rajčaty a mozzarellou', 'price' => 150, 'image' => 'pizza-1.jpg'],
            ['id' => 2, 'name' => 'Pepperoni', 'description' => 'Pizza s pikantním salámem', 'price' => 180, 'image' => 'pizza-2.jpg'],
            ['id' => 3, 'name' => 'Funghi', 'description' => 'Pizza s houbami a sýrem', 'price' => 170, 'image' => 'pizza-3.jpg']
        ];
    }

    public function getPizzas() {
        return $this->pizzas;
    }
}
?>
