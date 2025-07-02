<?php
// Jangan ada spasi atau newline sebelum baris ini

$checked = 0;
if (!empty($_SESSION['autoplay'])) { 
    if (!empty($_COOKIE['autoplay']) && $_COOKIE['autoplay'] == 2) {
        $checked = 2;
    } 
}

// Hapus sesi di database
if (!empty($_SESSION['user_id'])) {
    $db->where('session_id', PT_Secure($_SESSION['user_id']));
    $db->delete(T_SESSIONS);
}

// Hapus sesi PHP
session_destroy();
$_SESSION = array();
unset($_SESSION);

// Hapus cookie user_id jika ada
if (!empty($_COOKIE['user_id'])) {
    $db->where('session_id', PT_Secure($_COOKIE['user_id']));
    $db->delete(T_SESSIONS);
    
    unset($_COOKIE['user_id']);
    setcookie('user_id', '', time() - 3600, '/'); // Ganti null → ''
}

// Atur ulang autoplay jika sebelumnya 2
if ($checked == 2) {
    $_COOKIE['autoplay'] = 2;
}

// Arahkan kembali ke home
if (!headers_sent()) {
    header("Location: {$site_url}");
    exit();
}

