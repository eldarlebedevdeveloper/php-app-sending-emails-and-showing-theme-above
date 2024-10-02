<?php
require_once __DIR__ . '/../src/functions.php';

// Pages
router('GET', '^/$', function () {
    require_once __DIR__ . '/../public/index.php';
});

router('GET', '^/mailbox$', function () {
    require_once __DIR__ . '/../public/mailbox.php';
});

router('GET', '^/login$', function () {
    require_once __DIR__ . '/../public/login.php';
});

router('POST', '^/signup$', function () {
    require_once __DIR__ . '/../src/signup.php';
});

router('POST', '^/signin$', function () {
    require_once __DIR__ . '/../src/signin.php';
});

router('GET', '^/logout$', function () {
    require_once __DIR__ . '/../src/logout.php';
});

// API
router('GET', '^/users/current$', function () {
    require_once __DIR__ . '/../src/curent_user_receiving.php';
});

router('GET', '^/emails$', function () {
    require_once __DIR__ . '/../src/letters_receiving.php';
});

router('POST', '^/emails$', function () {
    require_once __DIR__ . '/../src/letters_sending.php';
});
