<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_FILES && isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
    $authid = $fn->Auth()['usr_id'];
    $uploadDir = '../assets/uploads/';

    // Check if the uploads folder exists, if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Check if the user-specific folder exists, if not, create it
    $userDir = $uploadDir . $authid . '/';
    if (!is_dir($userDir)) {
        mkdir($userDir, 0755, true);
    }

    $image = $_FILES['profile_image'];
    $imageName = time() . '_' . basename($image['name']);
    $imagePath = $userDir . $imageName;

    // Move the uploaded file to the user-specific folder
    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
        // Insert the image path into the database
        $imagePathForDB = $db->real_escape_string($imagePath);
        $query = "UPDATE profiles SET profile_image = '$imagePathForDB' WHERE user_id = $authid AND status=0";

 
        if ($db->query($query)) {
            $response = [
                'success' => true,
                'image_name' => $imageName,
                'image_path' => $imagePath
            ];
        } else {
            $response['message'] = 'Failed to update database.';
        }
    } else {
        $response['message'] = 'Failed to upload image.';
    }
} else {
    $response['message'] = 'No file uploaded or there was an error uploading the file.';
}

echo json_encode($response);
?>

