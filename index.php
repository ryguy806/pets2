<?php


/**
 * Index page for the pets2 file.
 * User: Ryan Guelzo
 * Date: 04/15/19
 */
//Creates the session
session_start();


//Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload
require_once('vendor/autoload.php');

//Creates the instance of the base class
$f3 = Base::instance();

//Specified the default route
$f3->route('GET /', function () {

    echo '<h1>My Pets</h1>';
    echo '<a href="order">Order a Pet</a>';
});

//Run fat-free
$f3->run();