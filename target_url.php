<?php

  $url = "http://onlinesubtitrat.com";

  if (!filter_var($_GET['url'], FILTER_VALIDATE_URL) === false) {
    $url = $_GET['url'];
  }

    
  function render_page($url)
  {
      $parse = parse_url($url);
      $domain = $parse['scheme'] . '://' . $parse['host'] . '/';
      $content = file_get_contents($url);
      $base_url = '';
      $content = str_replace('', $base_url . '', $content);
      $content = str_replace('src="/', 'src="' . $domain, $content);
      $content = str_replace('href="/', 'href="' . $domain, $content);

      return $content;
  }

  echo render_page($url);
?>
