<?php
class Carrito {
    private $items = [];

    public function __construct() {
        session_start();
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
        $this->items = $_SESSION['carrito'];
    }

    public function add($product_id, $quantity) {
        if (isset($this->items[$product_id])) {
            $this->items[$product_id]['quantity'] += $quantity;
        } else {
            $this->items[$product_id] = ['product_id' => $product_id, 'quantity' => $quantity];
        }
        $this->save();
    }

    public function update($product_id, $quantity) {
        if (isset($this->items[$product_id])) {
            $this->items[$product_id]['quantity'] = $quantity;
            $this->save();
        }
    }

    public function remove($product_id) {
        unset($this->items[$product_id]);
        $this->save();
    }

    public function getItems() {
        return $this->items;
    }

    public function clear() {
        $this->items = [];
        $this->save();
    }

    private function save() {
        $_SESSION['carrito'] = $this->items;
    }
}
?>
