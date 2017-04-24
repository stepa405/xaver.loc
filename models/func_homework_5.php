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
        echo '<td><a href="index.php?page=5&id_news=' . $key . '">Показать новость</a></td>'; //используем метод GET
        echo '<tr>';
    }
}

// функция вывода новостей
function show_news() {
    $news_text = '';
    
    if (array_key_exists('id_news', $_GET)) {
        $news_text = show_one_news(filter_input(INPUT_GET, 'id_news'));
    } elseif (array_key_exists('id_news', $_POST)) {
        $news_text = show_one_news($id = filter_input(INPUT_POST, 'id_news'));
    } elseif (filter_input(INPUT_POST, 'show_all_news')) {
        $news_text = show_all_news();
    } 
    return $news_text;
}

//функция вывода конкретной новости
function show_one_news($id) {
    global $news;
    $one_news_text = '';
        
    // Если новость присутствует - вывести ее на сайте, иначе мы выводим весь список
    if (!empty($news[$id])) {
        $one_news_text = $news[$id];
    } else {
        $one_news_text = show_all_news();
    }

    return $one_news_text;
}

//функция вывода всего списка новостей
function show_all_news() {
    global $news;
    
    return join('<br>', $news);
}

?>