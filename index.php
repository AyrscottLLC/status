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
            <a href="https://ayrscott.com/" alt="Ayrscott, LLC" title="Ayrscott, LLC"><img src="data:image/png;base64,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" alt="" /></a>
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
