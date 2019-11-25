<?php 
$request = $_SERVER['REQUEST_URI'];
$requestSplit = explode("/", $request);
$requestArr = array(
  "root" => $requestSplit[1],
  "page" => $requestSplit[2],
  "params" => $requestSplit[3]
);
$params = $requestArr["params"];
switch ($requestArr["page"]) {
  case 'index' :
    require __DIR__ . '/views/index.php';
    break;
  case 'about' :
    require __DIR__ . '/views/about.php';
    break;
  default:
    http_response_code(404);
    require __DIR__ . '/views/error.php';
    break;
}
?>