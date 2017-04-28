<?php

# ПЕРЕМЕННЫЕ 
$record_data = array(); //массив для отображения данных записи в форме
# ФУНКЦИИ
# Функции для Урока 6

//
function page_show() {
    if (!empty($_POST)) {
        handle_post();
    }
    if (!empty($_GET)) {
        handle_get();
    }
}

//функция обработки данных в POST
function handle_post() {

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
}

//функция обработки данных в GET
function handle_get() {
    $action = getUrlParam('action');

    switch ($action) {
        case 'rec_del':
            rec_del();
            break;
        case 'rec_edt':
            rec_set_data($_SESSION['data'][getUrlParam('id')]);
            break;
        default:
            break;
    }
}

//функция получения данных из объявления
function rec_set_data($rec_array = NULL) {
    global $record_data;
    if ($rec_array == NULL) {
        $record_data = array(
        'private' => 'option1',
        'name' => 'Алексей',
        'email' => 'alex@mail.ru',
        'phone' => '911',
        'sity_id' => '641600',
        'category_id' => '26',
        'title' => 'Усадьба №' . substr(time(), -4, 4),
        'description' => 'Доступен с 18:00 до 21:00');
    } else {
        $record_data = $rec_array;
    }
}

//функция добавления или редактирования записи
function rec_add_edt() {
    $id = getUrlParam('id');

    if (isset($id)) {
        $_SESSION['data'][(int) $id] = $_POST;
    } else {
        $_SESSION['data'][] = $_POST;
    }
}

//функция удаления записи
function rec_del() {
    $id = getUrlParam('id');

    if (isset($id)) {
        unset($_SESSION['data'][$id]);
    } else {
        session_unset();
    }
}

//функция вывода тела таблицы
function tbl_fill_body() {
    if (!empty($_SESSION['data'])) {
        foreach ($_SESSION['data'] as $key => $value) {
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