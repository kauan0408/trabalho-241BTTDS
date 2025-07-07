<?php
if (!function_exists('total_itens_carrinho')) {
    function total_itens_carrinho() {
        if (!isset($_SESSION)) session_start();

        $total = 0;
        if (isset($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $item) {
                $total += $item['quantidade'];
            }
        }
        return $total;
    }
}