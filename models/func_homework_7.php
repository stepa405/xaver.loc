<?php

# ПЕРЕМЕННЫЕ 
$record_data = array(); //массив для отображения данных записи в форме
# ФУНКЦИИ
# Функции для Урока 6

//
function page_show() {
    if (!empty($_GET)) {
        handle_get();
    }
    if (!empty($_POST)) {
        handle_post();
    }
}

//функция обработки данных в POST
function handle_post() {
global $ini_ad;
    
    if (filter_input(INPUT_POST, 'btn_ok_close')) { //форма кнопка "Сохранить и закрыть"
        rec_add_edt();
        header('Location: ' . createLink(getUrlParam('page')));
    }
    if (filter_input(INPUT_POST, 'btn_ok')) {//форма кнопка "Сохранить" но не закрывать
        rec_add_edt();
    }

    if (filter_input(INPUT_POST, 'btn_fill')) {//форма кнопка "Заполнить" но не закрывать
        rec_set_data();
    }
    
    if (filter_input(INPUT_POST, 'btn_ok_ad')) {//форма кнопка "Сохранить" но не закрывать
        $_SESSION['ad'] = $_POST;
    }
}

//функция обработки данных в GET
function handle_get() {
    $action = getUrlParam('action');

    switch ($action) {
        case 'rec_del':
            rec_del();
            break;
        case 'rec_edt':
            rec_set_data();
            break;
        default:
            break;
    }
}

//функция получения данных из объявления
function rec_set_data() {
    global $record_data;
    $id = getUrlParam('id');

    if (isset($id)) {
        if ($_SESSION['ad']['сookie']) {//если работаем через куки
            $var['data'] = unserialize($_COOKIE['data']);
            $record_data = $var['data'][(int) $id];
        } elseif ($_SESSION['ad']['file']) {// работаем через файл
            $var['data'] = unserialize(file_get_contents("myfile.txt"));
            $record_data = $var['data'][(int) $id];
        } else {
            $record_data = $_SESSION['data'][$id];
        }
    } else {
        $record_data = array(
            'private' => 'option1',
            'name' => 'Алексей',
            'email' => 'alex@mail.ru',
            'phone' => '911',
            'sity_id' => '641600',
            'category_id' => '26',
            'title' => 'Усадьба №' . substr(time(), -4, 4),
            'description' => 'Доступен с 18:00 до 21:00');
    }
}

function rec_add_edt_sess() {
    $id = getUrlParam('id');
    
    if (isset($id)) {
        $_SESSION['data'][(int) $id] = $_POST;
    } else {
        $_SESSION['data'][] = $_POST;
    }
}

function rec_add_edt_cook() {
    $id = getUrlParam('id');
    $var['data'] = unserialize($_COOKIE['data']);
    
    if (isset($id)) {
        $var['data'][(int) $id] = $_POST;
    } else {
        $var['data'][] = $_POST;
    }
    setcookie('data', serialize($var['data']));
}

function rec_add_edt_file() {
    $id = getUrlParam('id');
    $var['data'] = unserialize(file_get_contents("myfile.txt"));
    
    //изменяем содержимое 
    if (isset($id)) {// редактирование записи
        $var['data'][(int) $id] = $_POST;
    } else { // добавление записи
        $var['data'][] = $_POST;
    }
    file_put_contents("myfile.txt", serialize($var['data']));
}

//функция добавления или редактирования записи
function rec_add_edt() {
    if ($_SESSION['ad']['сookie']) {// работаем через куки
        rec_add_edt_cook();
    } elseif ($_SESSION['ad']['file']) {// работаем через файл
        rec_add_edt_file();
    } else { // работаем через сессию
        rec_add_edt_sess();
    }
}

//функция удаления записи
function rec_del() {
    if ($_SESSION['ad']['сookie']) {//если работаем через куки
        rec_del_cook();
    } elseif ($_SESSION['ad']['file']) {// работаем через файл
        rec_del_file();
    } else { // работаем через сессию
        rec_del_sess();
    }
}

function rec_del_cook() {
    $id = getUrlParam('id');
    $var['data'] = unserialize($_COOKIE['data']);

    if (isset($id)) {
        unset($var['data'][(int) $id]);
        setcookie('data', serialize($var['data']));
    } else {
        setcookie('data', '', time() - 3600);
    }
}

function rec_del_file() {
    $id = getUrlParam('id');
    $var['data'] = unserialize(file_get_contents("myfile.txt"));
    
    if (isset($id)) {
        unset($var['data'][(int) $id]);
    } else {
        unset($var['data']);
    }
    file_put_contents("myfile.txt", serialize($var['data']));
}

function rec_del_sess() {
    $id = getUrlParam('id');

    if (isset($id)) {
        unset($_SESSION['data'][$id]);
    } else {
        unset($_SESSION['data']);
    }
}

//функция вывода тела таблицы
function tbl_fill_body() {

    if ($_SESSION['ad']['сookie']) {
        $var = unserialize($_COOKIE['data']);
    } elseif ($_SESSION['ad']['file']) {
        $var = unserialize(file_get_contents("myfile.txt"));
    } else {
        $var = $_SESSION['data'];
    }

    if (!empty($var)) {
        foreach ($var as $key => $value) {
            echo ''
            . '<tr>'
            . '<td>' . $key . '</td>'
            . '<td> <a href="' . createLink(getUrlParam('page'), ['action' => 'rec_edt', 'id' => $key]) . '">' . $value['title']. '</a>'
            . '<td>' . $value['price'] . '</td>'
            . '<td>' . $value['name'] . '</td>'
            . '<td><a class="btn btn-primary btn-xs" href="' . createLink(getUrlParam('page'), ['action' => 'rec_del', 'id' => $key]) . '">Удалить</a></td>'
            . '</tr>';
        }
    }
    
}

//функция вывода города
function show_cities($city_id = '') {
    global $cities;
    foreach ($cities as $key => $city) {
        if ($key == $city_id) {
            echo '<option selected="" value="' . $key . '">' . $city . '</option>';
        } else {
            echo '<option value="' . $key . '">' . $city . '</option>';
        }
    }
}

//функция вывода категорий
function show_categories($category_id = '') {
    global $categories;
    foreach ($categories as $category => $subcategories) {
        echo "<optgroup label='$category'>";
        foreach ($subcategories as $key => $subcategory) {
            if ($key == $category_id) {
                echo "<option selected='' value='$key'>$subcategory</option>";
            } else {
                echo "<option value='$key'>$subcategory</option>";
            }
        }
        echo '</optgroup>';
    }
}

?>