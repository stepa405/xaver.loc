<?php

# ФУНКЦИИ
# Функции для Урока 5
//функция вывода тела таблицы
function add_table_body() {
    global $news;
    
    $news = explode("\n", $news);
    foreach ($news as $key => $value) { //бежим по массиву заполняем таблицу
        echo '<tr>';
        echo '<td id="td_id">' . $key . '</td>';
        echo '<td id="td_left">' . $value . '</td>';
        //используем метод GET
        echo '<td><a href="'.createLink(getUrlParam('page'), ['id_news' => $key]). '">Показать новость</a></td>';
        echo '<tr>';
    }
}

// функция вывода новостей
function show_news() {
    global $news;
    $news_text = '';
    
    if (array_key_exists('id_news', $_GET)) {
        $news_text = show_one_news(getUrlParam('id_news'), $news);
    } elseif (array_key_exists('id_news', $_POST)) {
        $news_text = show_one_news($id = filter_input(INPUT_POST, 'id_news'), $news);
    } elseif (filter_input(INPUT_POST, 'show_all_news')) {
        $news_text = join('<br>', $news);
    } 
    return $news_text;
}

//функция вывода конкретной новости
function show_one_news($id, $arr) {
    if ($arr[$id] != NULL) {
        return $arr[$id];
    }
}

?>