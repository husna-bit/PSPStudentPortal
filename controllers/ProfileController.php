<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

class ProfileController {

    public function index() {

        global $pdo;

        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // User must be logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $userModel = new User($pdo);

        // Get active logged-in user
        $user = $userModel->findById($_SESSION['user_id']);

        $message = '';
        $messageType = '';

        /*
        |--------------------------------------------------------------------------
        | PROFILE PICTURE UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Check whether file was submitted
            if (!isset($_FILES['profile_picture'])) {

                $message = "Please select a profile picture.";
                $messageType = "danger";

            } else {

                $file = $_FILES['profile_picture'];

                /*
                |--------------------------------------------------------------------------
                | 1. CHECK UPLOAD ERROR
                |--------------------------------------------------------------------------
                */

                if ($file['error'] !== UPLOAD_ERR_OK) {

                    $message = "There was an error uploading the file.";
                    $messageType = "danger";

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | 2. CHECK FILE SIZE - MAXIMUM 2MB
                    |--------------------------------------------------------------------------
                    */

                    $maxSize = 2 * 1024 * 1024;

                    if ($file['size'] > $maxSize) {

                        $message = "File size must not exceed 2MB.";
                        $messageType = "danger";

                    } else {

                        /*
                        |--------------------------------------------------------------------------
                        | 3. CHECK FILE EXTENSION
                        |--------------------------------------------------------------------------
                        */

                        $originalName = $file['name'];

                        $extension = strtolower(
                            pathinfo(
                                $originalName,
                                PATHINFO_EXTENSION
                            )
                        );

                        $allowedExtensions = [
                            'jpg',
                            'jpeg',
                            'png'
                        ];

                        if (!in_array($extension, $allowedExtensions, true)) {

                            $message = "Invalid file type. Only JPG, JPEG and PNG files are allowed.";
                            $messageType = "danger";

                        } else {

                            /*
                            |--------------------------------------------------------------------------
                            | 4. CHECK REAL MIME TYPE
                            |--------------------------------------------------------------------------
                            */

                            $finfo = new finfo(FILEINFO_MIME_TYPE);

                            $mimeType = $finfo->file(
                                $file['tmp_name']
                            );

                            $allowedMimeTypes = [
                                'image/jpeg',
                                'image/png'
                            ];

                            if (!in_array($mimeType, $allowedMimeTypes, true)) {

                                $message = "Invalid image file.";
                                $messageType = "danger";

                            } else {

                                /*
                                |--------------------------------------------------------------------------
                                | 5. CREATE UPLOAD DIRECTORY
                                |--------------------------------------------------------------------------
                                */

                                $uploadDirectory =
                                    __DIR__ . '/../uploads/profile/';

                                if (!is_dir($uploadDirectory)) {

                                    mkdir(
                                        $uploadDirectory,
                                        0755,
                                        true
                                    );
                                }

                                /*
                                |--------------------------------------------------------------------------
                                | 6. SECURE FILE RENAMING
                                |--------------------------------------------------------------------------
                                */

                                $newFileName =
                                    uniqid('profile_', true)
                                    . '.'
                                    . $extension;

                                /*
                                |--------------------------------------------------------------------------
                                | 7. CREATE FULL FILE PATH
                                |--------------------------------------------------------------------------
                                */

                                $targetPath =
                                    $uploadDirectory
                                    . $newFileName;

                                /*
                                |--------------------------------------------------------------------------
                                | 8. MOVE UPLOADED FILE
                                |--------------------------------------------------------------------------
                                */

                                if (
                                    move_uploaded_file(
                                        $file['tmp_name'],
                                        $targetPath
                                    )
                                ) {

                                    /*
                                    |--------------------------------------------------------------------------
                                    | 9. DELETE OLD PROFILE PICTURE
                                    |--------------------------------------------------------------------------
                                    */

                                    if (
                                        !empty(
                                            $user['profile_picture']
                                        )
                                    ) {

                                        $oldFile =
                                            $uploadDirectory
                                            . $user['profile_picture'];

                                        if (
                                            file_exists($oldFile)
                                        ) {

                                            unlink($oldFile);
                                        }
                                    }

                                    /*
                                    |--------------------------------------------------------------------------
                                    | 10. SAVE NEW FILENAME TO DATABASE
                                    |--------------------------------------------------------------------------
                                    */

                                    $updated =
                                        $userModel->updateProfilePicture(
                                            $_SESSION['user_id'],
                                            $newFileName
                                        );

                                    if ($updated) {

                                        $message =
                                            "Profile picture uploaded successfully.";

                                        $messageType =
                                            "success";

                                        // Refresh user information
                                        $user =
                                            $userModel->findById(
                                                $_SESSION['user_id']
                                            );

                                    } else {

                                        // Remove uploaded file if DB update fails
                                        if (
                                            file_exists($targetPath)
                                        ) {
                                            unlink($targetPath);
                                        }

                                        $message =
                                            "Failed to save profile picture information.";

                                        $messageType =
                                            "danger";
                                    }

                                } else {

                                    $message =
                                        "Failed to upload profile picture.";

                                    $messageType =
                                        "danger";
                                }
                            }
                        }
                    }
                }
            }
        }

        require __DIR__ . '/../views/profile/index.php';
    }
}
?>