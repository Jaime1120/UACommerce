<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /UACommerce/index.php");
        exit;
    }
}

function getUserName() {
    return $_SESSION['user_name'] ?? '';
}

function getUserType() {
    return $_SESSION['user_type'] ?? '';
}