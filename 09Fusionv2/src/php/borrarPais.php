
<?php
header('Content-Type: application/json');

$response = array('success' => false);

// Your code to delete the country
// ...

if ($deletionSuccessful) {
    $response['success'] = true;
}

echo json_encode($response);
?>