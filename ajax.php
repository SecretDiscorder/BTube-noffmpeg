<?php
// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle OPTIONS request (preflight for CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Init
require_once('./assets/init.php');
decryptConfigData();

// Default response
$data = [];
$type = '';
$first = '';
$second = '';
$api_requests = ['go_pro', 'wallet', 'download_user_info'];

// Ambil parameter type, first, second
if (!empty($_GET['type'])) {
    $type = PT_Secure($_GET['type']);
}
if (!empty($_GET['first'])) {
    $first = PT_Secure($_GET['first'], 0);
}
if (!empty($_GET['second'])) {
    $second = PT_Secure($_GET['second'], 0);
}

// Session check jika bukan API atau pengecualian
if ($type != 'ap' && !in_array($type, $api_requests) && $first != 'download_user_info') {
    $is_error = 0;
    $hash_id = '';

    if (!empty($_POST['hash'])) {
        $hash_id = PT_Secure($_POST['hash']);
    } elseif (!empty($_GET['hash'])) {
        $hash_id = PT_Secure($_GET['hash']);
    } else {
        $is_error = 1;
    }

    if (!empty($hash_id) && PT_CheckMainSession($hash_id) === false) {
        $is_error = 1;
    }

    if ($is_error === 1) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 400, 'message' => 'bad-request']);
        exit();
    }
}

// Eksekusi file ajax jika valid
$files = scandir('ajax');
$files = array_diff($files, ['.', '..']);

if (!empty($type)) {
    $file = PT_Secure($type);

    if (file_exists("./ajax/$file.php") && in_array("$file.php", $files)) {
        ob_start();
        require "./ajax/$file.php";
        $output = trim(ob_get_clean());

        if (!empty($output)) {
            header('Content-Type: application/json');
            echo $output;
            exit();
        }
    } else {
        $data = ['error' => 404, 'error_message' => 'type not found'];
    }
} else {
    $data = ['error' => 400, 'error_message' => 'type not provided'];
}

// Fallback response jika tidak ada output dari ajax/$file.php
header('Content-Type: application/json');
echo json_encode($data);
exit();
