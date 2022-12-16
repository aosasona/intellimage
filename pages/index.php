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
  <script src="https://kit.fontawesome.com/56783586cd.js" crossorigin="anonymous"></script>
  <script src="/assets/js/main.js"></script>
  <link rel="stylesheet" href="/assets/css/main.css" />
  <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
  <title>Intellimage | Generate AI profile images</title>
</head>

<body>
  <nav class="px-1 py-6">
    <h2 class="text-blue-500 text-xl md:text-2xl font-semibold">Intellimage.</h2>
  </nav>
  <h1 class="text-5xl xl:text-8xl font-bold mt-1">Generate AI Profile Images</h1>
  <p class="text-neutral-300 text-sm my-4 xl:my-6">Enter a prompt or upload an image of yourself (or anything) to create new variations for your social media profile.</p>

  <form action="/generate" method="post" id="generate_form" class="flex flex-col gap-4" enctype="multipart/form-data">
    <input type="text" name="prompt" id="prompt" minlength="6" maxlength="255" class="w-full bg-neutral-200 border-none outline-none hover:outline focus:bg-blue-50 focus:outline-blue-500 rounded-lg p-3" placeholder="a cat driving a car..." />
    <input type="file" name="user_image" class="py-2" id="user_image" accept="image/*" />
    <button type="submit" name="submit_btn" id="submit_btn" class="w-full bg-blue-500 disabled:opacity-50 hover:bg-blue-600 text-sm text-white rounded-lg transition-all py-4" disabled>Generate</button>
  </form>

  <footer class="flex flex-col lg:flex-row items-center justify-center lg:justify-between gap-4 text-xs mt-20 mb-16">
    <p class="text-center">Powered by <a href="https://www.openai.com" class="text-blue-500" target="_blank">OpenAI</a></p>
    <div>
      <a href="https://github.com/aosasona/Intellimage" class="text-blue-500 no-underline hover:underline" target="_blank">GitHub</a>
      | <a href="https://twitter.com/trulyao" class="text-blue-500 no-underline hover:underline" target="_blank">Twitter</a>
    </div>
  </footer>
</body>

</html>
