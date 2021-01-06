<!--
php
$title
require debut.php;
echo 'css fichier'; la c'est le css que vous devez en gros mettre le css qui vous est particulier
require debut-2.php
$h3='title';
require nav-banner-[USER];

-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <meta charset="utf-8"/>
</head>
<body>
    <!-- .wrapper .body .melbanner #btn-menu.okmenu -->
    <script>
        function show_hide(){
            var div = document.getElementById("navbar");
            var body = document.getElementById("body");
            var firstButton = document.getElementById("btn-menu1");
            div.classList.toggle("okmenu");
            body.classList.toggle("yesmenu");
            firstButton.classList.toggle("okmenu");
        }
        </script>
    <div class="wrapper">