<?php


/**
 * Index page for the pet3 file.
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
require_once('model/validation-functions.php');

//Creates the instance of the base class
$f3 = Base::instance();
$f3->set('colors', array('pink','green','blue'));

$f3->set('DEBUG', 3);

//Specified the default route
$f3->route('GET /', function ($f3) {

    session_destroy();

    echo '<h1>My Pets</h1>';
    echo '<a href="order">Order a Pet</a>';
});

//animal route
$f3->route('GET | POST/animal', function ($f3, $params) {

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

$f3->route('GET|POST /order', function ($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_POST['animalName']) && validString($_POST['animalName'])){
            $_SESSION['animalName'] = $_POST['animalName'];
            $f3->reroute('/order2');
        } else {
            $f3->set("errors['animal']", "Please enter an animal.");
        }
    }
    $view = new Template();
    echo $view->render('views/form1.html');
});

$f3->route('GET|POST /order2', function ($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_POST['color']) && validColor($_POST['color'])){
            $_SESSION['color'] = $_POST['color'];
            $f3->reroute('/results');
        } else {
            $f3->set("errors['color']", "Please enter an animal.");
        }
    }
    $view = new Template();
    echo $view->render('views/form2.html');
});

$f3->route('GET|POST /results', function () {

    $view = new Template();
    echo $view->render('views/results.html');
});



//Run fat-free
$f3->run();