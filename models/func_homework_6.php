<?php

# ФУНКЦИИ
# Функции для Урока 6
//функция получения значения поля у записи
function get_field_val($field_name, $id_rec) { 

    if ($id_rec != '') {
        return $_SESSION['data'][$id_rec][$field_name];
    } else {
        return '';
    }    
}

//функция вывода формы просмотра/добавления
function show_form($id_rec = NULL) {
// не нравится мне в целом эта отрисовка
// хочется как-то поизящнне    
    
    if ($id_rec == NULL) {
        echo '<form  method="post">';
    } else {
        echo '<form>';
    }
    
    //вывод формы
    //если $id_rec = '' то это форма добавления,
    //если нет, то заполнятся значения полей для записи $id_rec
    echo '   
    <div> 
        <input type="radio" value="1" name="private" checked="">Частное лицо
        <input type="radio" value="0" name="private">Компания
    </div>
    <br>    
    <div>
       <label id="left_col" for="fld_title">Название объявления</label>
        <input type="text" maxlength="50" value="' . get_field_val('title', $id_rec) . '" name="title" id="fld_title">
    </div>
    <br>    
    <div>
        <label id="left_col" for="fld_description">Описание объявления</label>
        <textarea maxlength="3000" name="description" id="fld_description" cols="22">' . get_field_val('description', $id_rec) . '</textarea>
    </div>
    <br> 
    <div>
        <label id="left_col" for="fld_price">Цена, руб</label>
        <input type="text" maxlength="9" value="' . get_field_val('price', $id_rec) . '" name="price" id="fld_price">
    </div>
    <br>
    ';

    if ($id_rec == NULL) {
        echo ' 
        <div>
            <input type="submit" value="Сохранить" name="btn_ok" />
        </div>
        <div>
            <input type="submit" value="Сохранить и закрыть" name="btn_ok_close" />
        </div>
        <br>
        ';
    } else {
        echo '<a href="' . createLink(getUrlParam('page')) . '">Закрыть</a>'
        . '</form>';
    }
}


//функция вывода тела таблицы
function add_table_body () {
    
    if (!empty($_SESSION['data'])) {
        foreach ($_SESSION['data'] as $key => $value) {
            echo ''
            . '<tr>'
            . '<td>' . $key . '</td>'
            . '<td>' . $value['title'] . '</td>'
            . '<td>' . $value['price'] . '</td>'
            . '<td>' . 'Имя' . '</td>'
            . '<td><a href="' . createLink(getUrlParam('page'), ['action' => 'del_rec', 'id' => $key]) . '">Удалить</a></td>'
            . '<td><a href="' . createLink(getUrlParam('page'), ['action' => 'edt_rec', 'id' => $key]) . '">Показать</a></td>'
            . '</tr>';
        }
    }
}

//функция удаления записи
function del_rec($id_rec = NULL) {
    if ($id_rec == NULL) {//удалить все записи
        session_unset();
    } else {
        unset($_SESSION['data'][$id_rec]);
    }
}

//функция обработки данных в POST
function handle_post() {
    //События от Кнопок управления
    if (filter_input(INPUT_POST, 'btn_add')) { //Добавить объявление
        show_form();
    }
    if (filter_input(INPUT_POST, 'btn_del')) { //Удалить все объявления
        del_rec();
    }

    //События от Кнопок на форме объявления
    if (filter_input(INPUT_POST, 'btn_ok_close')) { //форма кнопка "Сохранить и закрыть"
        $_SESSION['data'][] = $_POST;
    }
    if (filter_input(INPUT_POST, 'btn_ok')) {//форма кнопка "Сохранить" но не закрывать
        $_SESSION['data'][] = $_POST;
        show_form();
    }
}

//функция обработки данных в GET
function handle_get() {
    $action = getUrlParam('action');
    $id = getUrlParam('id');
    if (($action != NULL) && (id != NULL)) {
        switch ($action) {
            case 'del_rec':
                del_rec($id);
                break;
            case 'edt_rec':
                show_form($id);
                break;
            default:
                break;
        }
    }
}

?>