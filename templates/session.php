<?php
session_start();
function isSession() {
    if(!isset($_SESSION['username'])){
        header('Location: .././');
        exit();
    }
}