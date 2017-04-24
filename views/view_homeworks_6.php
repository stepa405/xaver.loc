<?php
// Урок 6 Домашнее задание

/*
  1)	Создать html форму на подобие данной:
  2)	Всё что пришло из формы записать в $_SESSION как новое объявление.
  3)	Под формой создать вывод всех объявлений, содержащихся в сессии по шаблону:
  Название объявления | Цена | Имя | Удалить
  4)	При нажатии на «название объявления» на экран выводится шаблон объявления как из пункта 1, только в места полей подставляются истинные значения
  5)	При нажатии на «Удалить», объявление удаляется из сессии
 */
require_once("models/func_homework_6.php");
echo '<h3> Урок 6 Домашнее задание</h3>';

#Функции находятся тут  \models\func_homework_6.php 

?>

<!--Форма управления-->
<form method="post">
    <div>
        <input type="submit" value="Добавить объявление" name="btn_add" />
    </div>
    <div>
        <input type="submit" value="Удалить все объявления" name="btn_del" />
    </div>
    <br>
</form>
    
<?php

if (!empty($_POST))
    handle_post();
if (!empty($_GET))
    handle_get();
?>

<table>
<thead>
    <tr>
        <th>id</th>
        <th>Название обяъявления</th>
        <th>Цена</th>
        <th>Имя</th>
        <th></th>
        <th></th>
    </tr>
</thead>
    <?php add_table_body() ?>
</table>


