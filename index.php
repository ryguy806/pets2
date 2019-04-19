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

//animal route
$f3->route('GET /@animal', function ($f3, $params) {

    $animal = $params['animal'];

    $animalTypes = array('dog', 'cat',
        'fish', 'bird', 'monkey');

    if (!in_array($animal, $animalTypes)) {
        echo "$animal doesnt exist";
    }
    else
        {

        switch ($animal)
        {
            case 'dog':
                echo "<h3>Woof</h3>";
                break;
            case 'cat':
                echo "<h3>Meow</h3>";
                break;
            case 'fish':
                echo "<h3>Blub</h3>";
                break;
            case 'bird':
                echo "<h3>Chirp</h3>";
                break;
            case 'monkey':
                echo "<h3>Poo Fling</h3>";
                break;
            default:
                $f3->error(404);

        }
    }


});



//Run fat-free
$f3->run();