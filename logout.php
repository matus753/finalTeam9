<?php
require_once "config.php";
session_start();

if(isset($_SESSION["role"])) {
    unset($_SESSION["role"]);
}