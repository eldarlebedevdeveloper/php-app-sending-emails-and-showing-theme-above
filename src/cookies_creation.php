<?php
function cookies_creation($userData)
{
    foreach ($userData as $key => $value) {
        setcookie($key, $value, time() + (86400 * 30), "/");
    }
}
