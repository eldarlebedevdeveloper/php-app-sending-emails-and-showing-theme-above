<?php
function cookies_authorization_mailbox($userCookies, $hostPath)
{
    if (!isset($userCookies['email']) && !isset($userCookies['uname']) && !isset($userCookies['pass'])) {
        header("Location: $hostPath");
        exit;
    }
}
