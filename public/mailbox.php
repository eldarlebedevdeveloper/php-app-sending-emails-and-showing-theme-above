<?php

require_once __DIR__ . '/../src/cookies_authorization_mailbox.php';
require_once __DIR__ . '/../host_connection.php';
$userCookies = $_COOKIE;
cookies_authorization_mailbox($userCookies, $hostPath);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>MailBox</title>
</head>

<body data-uname="<?php echo $_COOKIE['uname'] ?>">
    <?php if (isset($_GET['success'])) { ?>
        <div class="topbar">
            <div class="d-flex justify-content-center align-items-center bg-primary">
                <p class="fs-6 mb-0 text-white"> <?php echo $_GET['success']; ?></p>
            </div>
        </div>
    <?php } ?>
    <header>
        <div class="d-flex justify-content-between align-items-center bg-dark px-3 py-2">
            <div>
                <span class="fs-6 text-white" id="username"></span>
                <span class="fs-6 text-white px-1">/</span>
                <span class="fs-6 text-white" id="email"> </span>
            </div>
            <div>
                <a href="logout">
                    <button type="button" class="btn btn-primary">Logout</button>
                </a>
            </div>
        </div>
    </header>
    <main>
        <div class="send_letter">
            <form action="emails" method="post" class="px-3 mt-4 w-50" id="send_letter">
                <input type="hidden" name="uname" value="<?php echo $_COOKIE['uname'] ?>">
                <label class="mb-2"><?php echo $_COOKIE['email'] ?></label>
                <div class="mb-3">
                    <input type="email" name="recipient" class="form-control" placeholder="Email">
                </div>
                <div class="mb-3">
                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                </div>
                <div class="mb-3">
                    <textarea type="text" name="message" class="form-control" placeholder="Message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send letter</button>
            </form>
        </div>
        <div class="letters_tabel">
            <div class="w-75 px-3 mt-4">
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Recipient</th>
                            <th scope="col">Subject</th>
                        </tr>
                    </thead>
                    <tbody class="letters_container">
                    </tbody>
                </table>
            </div>
        </div>
        <nav>
            <ul class="pagination pagination_container  px-3">
            </ul>
        </nav>
    </main>

    <script>
        const uname = document.querySelector('[data-uname]').dataset.uname
        const page = 1
        const pagesize = 4

        document.addEventListener("DOMContentLoaded", function() {
            lettersTable(uname)
            pagination(uname, page, pagesize)
        });

        function lettersTable(uname) {
            fetch(`users/current?uname=${uname}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok')
                    }
                    return response.json()
                })
                .then((data) => {
                    document.querySelector('#username').textContent = data.uname
                    document.querySelector('#email').textContent = data.email
                })
                .catch((error) => {
                    console.error('Error:', error)
                })
        }

        function pagination(uname, page, pagesize) {
            fetch(`emails?uname=${uname}&page=${page}&pagesize=${pagesize}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data)
                    let container = document.querySelector('.letters_container')
                    let paginationContainer = document.querySelector('.pagination_container')

                    container.innerHTML = ''
                    data.result[page - 1].forEach(letter => {
                        let latterLayout = `
                    <tr>
                        <th scope="row">${letter.id}</th>
                        <td>${letter.recipient}</td>
                        <td>${letter.subject}</td>
                    </tr>`
                        container.innerHTML += latterLayout;
                    })

                    paginationContainer.innerHTML = ''
                    data.result.forEach((paginationItem, index) => {
                        let paginatioItemLayout
                        if (index === page - 1) {
                            paginatioItemLayout = `
                        <li class="page-item active" data-page="${index+1}">
                            <a class="page-link"  >${index+1}</a>
                        </li>`
                        } else {
                            paginatioItemLayout = `
                        <li class="page-item" data-page="${index+1}">
                            <a class="page-link"  >${index+1}</a>
                        </li>`
                        }
                        paginationContainer.innerHTML += paginatioItemLayout;
                    })

                    changePaginationPage()
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function changePaginationPage() {
            const paginationItems = document.querySelectorAll('.page-item')

            paginationItems.forEach(paginationItem => {
                console.log(paginationItem)
                paginationItem.addEventListener('click', () => {
                    console.log(paginationItem.dataset.page)
                    pagination(uname, paginationItem.dataset.page, pagesize)
                })
            })
        }
    </script>

</body>

</html>