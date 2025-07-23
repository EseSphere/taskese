<?php
$appName = 'TaskEse';
if (isset($_SESSION['app_name'])) {
    $appName = $_SESSION['app_name'];
}

$appIcon = './assets/img/icon/user.jpg';
if (isset($_SESSION['app_icon'])) {
    $appIcon = $_SESSION['app_icon'];
}

$subtitle = 'Task Board - Collaborative Task and Workflow Management';
if (isset($_SESSION['subtitle'])) {
    $subtitle = $_SESSION['subtitle'];
}

$description = 'Task Board helps teams organize, prioritize, and complete work with real-time updates, detailed reporting, and seamless communication across devices.';
if (isset($_SESSION['description'])) {
    $description = $_SESSION['description'];
}

$appUrl = 'https://yourdomain.com/';
if (isset($_SESSION['app_url'])) {
    $appUrl = $_SESSION['app_url'];
}
