<?php
echo "Host: ";
$host = trim(fgets(STDIN));

echo "User: ";
$user = trim(fgets(STDIN));

echo "Password: ";
$password = trim(fgets(STDIN));

echo "Database: ";
$database = trim(fgets(STDIN));

$text = "<?php
	\$link = mysqli_connect('$host', '$user', '$password', '$database');";

$fp = fopen("api" . DIRECTORY_SEPARATOR . "settings.php", "w");
fwrite($fp, $text);
