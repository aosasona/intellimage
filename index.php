<?php

ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);
ini_set("error_reporting", 0);
ini_set("log_errors", 1);

require_once __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$request_path = parse_url($_SERVER["REQUEST_URI"])["path"];
$pages_dir = __DIR__ . "/pages";
$filename = $pages_dir . (strlen($request_path) < 2 ? "/index" : $request_path);


$method = $_SERVER["REQUEST_METHOD"];
$page_name = $filename . ".php";

if (!file_exists($page_name)) {
  $not_found_path = $pages_dir . "/404";
  if (!file_exists($not_found_path . "php")) {
    echo "<h1>Page not found!<h1>";
    http_response_code(404);
    exit;
  }

  require $not_found_path;
  exit;
}

require $page_name;
exit;
