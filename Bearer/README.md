1. run php local server `php -S localhost:8000`
2. firstly, send request to get token 
    `curl -i --header "Authorization: Basic dXNlcm5hbWU6dXNlcnBhc3M=" localhost:8000/Bearer/getToken.php`
3. secondly, send request to resourse 
    `curl -i --header "Authorization: Bearer this_is_bearer_token" localhost:8000/Bearer/index.php`