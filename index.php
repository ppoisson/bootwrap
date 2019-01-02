<?php 
include "bootwrap/bootwrap.php";
$bw = new BootWrap();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Starter Template for Bootstrap</title>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

  </head>

  <body>

    <?php

    $sidebar = "<h3>Navigation</h3>";
    $sidebar .= $bw->navs([
      [
        "href" => "./",
        "class" => "",
        "content" => "BootWrap1",
        "target" => ""
      ],
      [
        "href" => "./",
        "class" => "",
        "content" => "BootWrap2",
        "target" => ""
      ]
    ], 'flex-column');

    $button = $bw->button(["href" => "./", "content" => "BUTTON", 'class' => 'btn-outline-success']);
    $sidebar .= $button;

    $content = "<h3>Content</h3>";
    $card = [
      "header" => "Card Header",
      "footer" => "Card Footer",
      "image" => [
        "class" => "card-img-top",
        "src" => "/img/homeview-website.jpg",
        "alt" => "HomeView"
      ],
      "title" => "Card Title",
      "subtitle" => "Card Subtitle",
      "text" => "Card Text",
      "class" => "",
      "buttons" => [
        [
          "content" => "Card Button",
          "class" => "btn-outline-success",
          "href" => "./"
        ]
      ],
      "body" => "Card body extra addon"
    ];
    $content .= $bw->card($card);

    $col .= $bw->col($sidebar, "col-12 col-md-3 col-xl-2 bd-sidebar");
    $col .= $bw->col($content, "col-12 col-md-9 col-xl-10 bd-content");
    $row .= $bw->row($col, "row flex-xl-nowrap");

    echo $bw->container($row, "container-fluid");

  ?>
  </body>
</html>

