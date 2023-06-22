<?php

if (empty($_GET['entryId'])) return header("Location: index.php");

$controller->displayEntry($_GET['entryId']);