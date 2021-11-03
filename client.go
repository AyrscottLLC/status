package main

import (
	"fmt"
	"net/http"
	"os"
)

func main() {
	if len(os.Args) == 3 {

		// generate our URL
		url := fmt.Sprintf("https://status-ayrscott-com.herokuapp.com/heartbeat.php?id=%s&key=%s", os.Args[1], os.Args[2])

		// display URL
		fmt.Println(url)

		// perform get request
		http.Get(url)

	} else {

		fmt.Printf("Usage: %s YourID YourKey\n", os.Args[0])
	}
}
