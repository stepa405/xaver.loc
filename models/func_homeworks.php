<?php

# ПЕРЕМЕННЫЕ  
$pages = array(); //массив для страниц
# ФУНКЦИИ
# Функции инициализации и управления сайтом

function init() { //функция инициализации
    //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    //error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 1);
    set_pages();

    // session
    session_start();
}

function run() {
    include(getPage());
}

function set_pages() { //заполняем массив страниц
    global $pages;
    for ($index = 2; $index <= COUNT_DZ; $index++) {
        $pages[$index] = 'view_homeworks_' . $index . '.php';
    }
}

function getPage() { //возвращает имя страницы
    global $pages;
    $page_number = filter_input(INPUT_GET, 'page');
    if (!$page_number) {
        $page = VIEWS_DIR . MAIN_PAGE;
    } else {
        $page = VIEWS_DIR . $pages[$page_number]; 
    }
    return $page;
}

//функция создания меню
function createMenu() {
    echo '<a href="' . createLink('0') . '">Главная</a>';
    for ($index = 2; $index <= COUNT_DZ; $index++) {
        echo '<a href="' . createLink($index) . '">Урок ' . $index . '</a>';
    }
}

//функция создания url
function createLink($page, array $params = []) {
    unset($params['page']);
    return 'index.php?' . http_build_query(array_merge(['page' => $page], $params));
}

//функция создания получения параметра из url 
function getUrlParam($name) {
    if (!array_key_exists($name, $_GET)) {
        echo('URL parameter "' . $name . '" not found.');
        exit;
    }
    return $_GET[$name];
}

?>