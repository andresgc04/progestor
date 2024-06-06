<?php
require_once("../../config/connection.php");
session_destroy();
header("Location:" . Connection::path() . "index.php");
exit();
