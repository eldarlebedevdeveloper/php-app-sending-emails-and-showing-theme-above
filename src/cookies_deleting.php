<?php
function cookies_deleting($userData, $hostDomain)
{
    foreach ($userData as $key => $value) {
        setcookie($key, FALSE, -1, "/", "$hostDomain");
    }
}
