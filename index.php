<?php

require 'vendor/autoload.php';

function solveTime($timestamp)
{
    global $request_start;
    return $request_start - $timestamp;
}

/*

https://github.com/predis/predis

Predis example code:

$client->set('foo', 'bar');
$value = $client->get('foo');

*/

// where we will store our redis client...
$client = null;
$request_start = microtime(true);

// check if we are in heroku or on our local dev station
if (empty($_ENV['REDIS_TLS_URL'])) {
    $client = new Predis\Client();
} else {
    $client = new Predis\Client(getenv('REDIS_URL') . "?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
}

$results = array();

$servers = ['3700X', 'i3-8100'];

foreach ($servers as $server) {
    $results[$server] = $client->get($server);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ayrscott Status</title>
</head>

<body>

    <header>
        <div id="header-left">
            <a href="https://ayrscott.com/" alt="Ayrscott, LLC" title="Ayrscott, LLC"><img id="logo" src="logo.png" alt="Ayrscott, LLC"></a>
        </div>
        <div id="header-right">
            Status
        </div>
    </header>
    <section id=wrapper>
        <section id=news>
            <h1>Latest News</h1>
            <section>
                <h2>2021-11-01</h2>
                Heroku environments added
            </section>
        </section>

        <section id=live>

            <h1>Live Status</h1>
            <section>
                <h2>Servers</h2>
                <ul>
                    <?php
                    foreach ($servers as $server) {
                        $last_heard_from = $results[$server];
                        $ago = solveTime($last_heard_from);
                        $ago_text = number_format($ago, 1);
                        $class = 'false';
                        if ($ago < 150) $class = 'true';
                        echo "<li class=$class>$server (~$ago_text seconds ago)</li>\n";
                    }
                    ?>
                </ul>
            </section>

            <section>
                <h2>Data Centers</h2>

                <h3>Georgia</h3>
                <ul>
                    <li class=true>Atlanta, GA [Linode:a]</li>
                    <li class=true>Atlanta, GA [Linode:d]</li>
                    <li class=true>Atlanta, GA [Linode:k]</li>
                </ul>

                <h3>Virginia</h3>
                <ul>
                    <li class=true>Mechanicsville, VA [Comcast]</li>
                    <li class=false>Mechanicsville, VA [T-Mobile]</li>
                    <li class=true>Manassas, VA [Verizon]</li>
                </ul>

                <h3>Utah</h3>
                <ul>
                    <li class=true>Ogden, UT</li>
                </ul>

            </section>
            <section>
                <h2>Application Heartbeats</h2>
                <ul>
                    <li class=true>CEB</li>
                    <li class=true>BigSad.me</li>
                </ul>
            </section>

            <section>
                <h2>PaaS Providers Status Pages</h2>
                <ul>
                    <li class=link>WPEngine</li>
                    <li class=link>Linode</li>
                    <li class=link>GitHub</li>
                    <li class=link>Heroku</li>
                </ul>
            </section>

        </section>
    </section>
    <footer>
        Copyright &copy; <?= date('Y') ?> Ayrscott, LLC
    </footer>
</body>

</html>