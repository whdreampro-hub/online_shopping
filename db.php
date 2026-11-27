<?php
mysqli_report(MYSQLI_REPORT_OFF);

$conn = mysqli_connect("localhost", "root", "", "online_shop");

if (!$conn) {
    error_log('Database connection failed: ' . mysqli_connect_error());
    http_response_code(500);
    exit('The service is temporarily unavailable. Please try again later.');
}

if (!mysqli_set_charset($conn, 'utf8mb4')) {
    error_log('Unable to configure the database connection character set: ' . mysqli_error($conn));
    http_response_code(500);
    exit('The service is temporarily unavailable. Please try again later.');
}
