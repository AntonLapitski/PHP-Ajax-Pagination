<?php

require __DIR__ . '/Paginator.php';

$paginator = new Paginator();

if (isset($_GET['test'])) {
    $paginator->getFirstEntries();
}

if (isset($_GET['another'])) {
    $paginator->getRequestedEntries();
}

if(isset($_GET['counted'])){
    $paginator->getCount();
}