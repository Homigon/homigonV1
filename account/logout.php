<?php
session_start();

include '../classes/admin.class.php';

session_destroy();
$admin->goTo("../sign-in", "logged_out");
