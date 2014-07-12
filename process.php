<?php 
date_default_timezone_set('America/Chicago'); 
header('Content-type: text/html; charset=utf-8');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 
$_POST = array_map('trim', $_POST);
// PHP May try to encode values that are not JSON encodable.  STRIP them out.


$errors = array();

$json_options = 'JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT';
$sanitizeStringOptions = 'FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH';   

isset($_POST['restaurantName']) ? $_POST['restaurantName'] = filter_var($_POST['restaurantName'], FILTER_SANITIZE_STRING, $sanitizeStringOptions)  : $errors[] = 'No Restaurant Name Given.';
isset($_POST['rating']) ? $_POST['rating'] = filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_INT) : $errors[] = "No rating given.";
isset($_POST['location']) ? $_POST['location'] = filter_var($_POST['location'], FILTER_SANITIZE_STRING, $sanitizeStringOptions)   : $errors[] = 'No location given';
isset($_POST['description']) ? $_POST['description'] = filter_var($_POST['description'], FILTER_SANITIZE_STRING, $sanitizeStringOptions) : $_POST['description'] = 'No description given.';

if(empty($errors)){
    $storage = 'storage/restaurant.json';
    
    if(!file_exists($storage)){
        touch($storage);
        $json = json_encode($_POST);
        // Touch will create the file if it does not exist.
        // JSON encode will convert the input into a JavaScript Object.
    }else{
        // By default, you cannot append new data to a JSON and have it parse as valid.
        // You have to unencode and then re-encode the data.
        // Make sure that the returned string is not empty or this will just create errors.
        $testEmptyStorage = file_get_contents($storage);
        // File get contents will return a string.  If that string is empty, we can proceed.
        if(!empty($testEmptyStorage)){
            $jsonDecode = json_decode($testEmptyStorage, true);
            // Remerge the arrays back together to create one new array.
            // Use recursive array so that it will properly stack the items.
            $fullArray = array_merge_recursive($jsonDecode, $_POST);
            $json = json_encode($fullArray);
        }else{
            $json = json_encode($_POST);
        }
    }
    
    file_put_contents($storage, $json);
    // File append says do not ovewrite, but add this data to what already exists.
    $restaurantName = urlencode($_POST['restaurantName']);
    header("Location: input.php?success=true&restaurant=$restaurantName");
}else{
    foreach($errors as $error){
        $error .= $error;
    }
    
    $error = urlencode($error);
    header("Location: input.php?error=$error");
}


?>