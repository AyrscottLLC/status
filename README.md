# Status

This project contains the server and clientside code required to operate status.ayrscott.com

## index.php
### The Ayrscott Staus Page

Provides an overview of the health and uptime of services and devices managed by Ayrscott, LLC

## heartbeat.php
### The Ayrscott Status Heartbeat Listener

This listens for authorized clients and updates their information in Redis 

## client.go
### The Ayrscott Status Page Client

### Registration

Contact info@ayrscott.com to request a monitoring service ID.

### Installation
#### Linux

* Build client.go
* Create a cronjob that runs the compiled client and passes in the monitoring service ID and key

#### Windows 10/11


* Build client.go
* Create a scheduled task that runs the compiled client and passes in the monitoring service ID and key

### Copyright (C) 2021 Ayrscott, LLC
