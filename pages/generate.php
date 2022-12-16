<?php

use Orhanerday\OpenAi\OpenAi;

const NUM_IMAGES = 6;
const IMAGE_DIMENSION = "512x512";

if (strtoupper($_SERVER["REQUEST_METHOD"]) == "GET") {
  http_response_code(405);
  exit;
}


$has_no_data = (int)(!isset($_POST["prompt"]) && !(isset($_FILES["user_image"]) && $_FILES["user_image"]["error"] === UPLOAD_ERR_OK));
$open_ai_key = $_ENV["OPENAI_API_KEY"];
$open_ai = new OpenAi($open_ai_key);

if (!$has_no_data) {
  try {
    $results = [];

    if (isset($_POST["prompt"]) && $_POST["prompt"] != "") {
      $results = json_decode($open_ai->image([
        "prompt" => htmlspecialchars($_POST["prompt"]),
        "n" => NUM_IMAGES,
        "size" => IMAGE_DIMENSION,
        "response_format" => "url"
      ]) ?? [], true)["data"] ?? [];
    } elseif (isset($_FILES["user_image"])) {

      $file = $_FILES["user_image"];

      if ($file["size"] > 3000000) throw new \Exception("File too large!");

      $temp_name = $file["tmp_name"];
      $file_name = basename($file["name"]);
      $image = curl_file_create($temp_name, $file["type"], $file_name);

      $results = json_decode(
        $open_ai->createImageVariation([
          "image" => $image,
          "n" => NUM_IMAGES,
          "size" => IMAGE_DIMENSION
        ]) ?? [],
        true
      )["data"] ?? [];
    }
  } catch (\Exception $e) {
    $has_error = true;
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Generate AI profile images easily">
  <meta name="keywords" content="openai, profile image, stable diffusion, social media, artificial, intelligence, dalle, dall-e">
  <meta name="og:title" content="Intellimage">
  <meta name="og:description" content="Generate AI profile images easily">
  <meta name="og:image" content="">
  <meta name="og:url" content="">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="Intellimage">
  <meta name="twitter:description" content="Generate AI profile images easily">
  <meta name="twitter:image" content="">
  <meta name="twitter:creator" content="@trulyao">
  <link rel="icon" href="/assets/images/favicon.jpg" type="image/x-icon">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="/assets/js/main.js"></script>
  <link rel="stylesheet" href="/assets/css/main.css" />
  <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
  <title>Intellimage | Generate AI profile images</title>
</head>

<body>
  <nav class="px-1 py-6">
    <a href="/">
      <h2 class="text-blue-500 text-xl md:text-2xl font-semibold">Intellimage.</h2>
    </a>
  </nav>

  <h1 class="text-5xl xl:text-8xl font-bold mt-1">Done! 🎉</h1>

  <?php

  if ($has_no_data) {
    echo '<div class="bg-red-200 text-center text-red-600 text-sm p-4 rounded-lg my-4">No data provided!</div>';
  }

  if (isset($has_error) && $has_error) {
    echo '<div class="bg-red-200 text-center text-red-600 text-sm p-4 rounded-lg my-4">Something went wrong!</div>';
  }
  ?>

  <?php
  if (isset($results) && count($results) > 0) :
  ?>
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 my-8 lg:my-10">
      <?php foreach ($results as $key => $result) : ?>
        <div class="w-full aspect-square">
          <img src="<?= $result["url"] ?>" class="" />
          <a href="<?= $result["url"] ?>" class="block w-full text-center font-normal text-xs text-white bg-blue-500 hover:bg-blue-400 uppercase py-4 transition-all" download="intellimage_<?= $key ?>">Download</a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else : ?>
    <div class="bg-neutral-200 py-8 rounded-lg">
      No results...
    </div>
  <?php endif; ?>

  <footer class="flex flex-col lg:flex-row items-center justify-center lg:justify-between gap-4 text-xs mt-20 mb-16">
    <p class="text-center">Powered by <a href="https://www.openai.com" class="text-blue-500" target="_blank">OpenAI</a></p>
    <div>
      <a href="https://github.com/aosasona/Intellimage" class="text-blue-500 no-underline hover:underline" target="_blank">GitHub</a>
      | <a href="https://twitter.com/trulyao" class="text-blue-500 no-underline hover:underline" target="_blank">Twitter</a>
    </div>
  </footer>
</body>

</html>
