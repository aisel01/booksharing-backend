<?php
require_once('settings.php');
require_once('functions.php');

if (isAuthed()) {
    respose200('ok');
} else {
    e404('Сессия недействительна!');
}