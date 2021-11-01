# Copyright 2021 Ayrscott, LLC
# Basic heartbeat client

$url="https://status-ayrscott-com.herokuapp.com/heartbeat.php"
$id=$args[0]
$key=$args[1]
$postData=@{id=$id;key=$key}

Invoke-WebRequest -Uri $url -Method POST -Body $postData
