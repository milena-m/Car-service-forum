<?php
include_once './DBconnect.php';
session_start();
session_destroy();
header('Location: service-index.php');

