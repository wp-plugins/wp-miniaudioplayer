<?php
/**
 * Download the mp3 file.
 */
$file_name = $_GET["filename"];
$file_url = $_GET["fileurl"];

header("Content-Description: File Transfer");
header('Content-type: application/mp3');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"".$file_name."\"");
readfile($file_url);
exit;
