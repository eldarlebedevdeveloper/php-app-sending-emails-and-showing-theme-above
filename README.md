Щоб запустити проєкт у файл host_commention.php потрібно змінити значення для двох змінних
$hostDomain = 'localhost'; - замінити localhost домененне ім'я на якому ви розгортаєте проєкт
$hostPath = '/tecktask-compassway'; замінити /tecktask-compassway на назву вашої кореневої папки у якій запускаєте проєкт

Також у фолі db/db_accesses.php потрібно оновити дані до вашої бази даних
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "techtask_mailbox_compassway"; - базу даних з такою або іншою назвою потрібно створити у MySQL