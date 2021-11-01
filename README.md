Windows 10/11
Create a new scheduled task.

Application: powershell.exe

Arguments:

-Command "Invoke-WebRequest https://status-ayrscott-com.herokuapp.com/heartbeat.php?id=MACHINE_ID&key=SERVICE_KEY"