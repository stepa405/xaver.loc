<?php
require_once("models/func_homework_6.php");
echo '<h3> Урок 6 Домашнее задание</h3>';

// is_show_dz = 1 показывать панель с домашним заданием
// is_show_form = 1 показывать панель с формой
#Функции находятся тут  \models\func_homework_7.php 

page_show();
?>

<!--Панель управления уроком-->
<div class="panel panel-default">
    <a href=" <?= createLink(getUrlParam('page'), ['is_show_dz' => '1']) ?>"
       class="btn btn-default" >Домашнее задание</a>
    <a href=" <?= createLink(getUrlParam('page'), ['action' => 'rec_add']) ?>"
       class="btn btn-primary" name="btn_add">Добавить объявление</a>
    <a href=" <?= createLink(getUrlParam('page'), ['action' => 'rec_del']) ?>"
       class="btn btn-primary" name="btn_del">Удалить все объявления</a>
</div>

<!--Панель с информацией-->
<div 
<?php echo getUrlParam('is_show_dz') ? "style='display:block;' " : "style='display:none;' " ?>
    class="panel panel-default">
    <div class="panel-heading">Урок 6 Домашнее задание </div>
    1)	Создать html форму на подобие данной:<br>
    2)	Всё что пришло из формы записать в $_SESSION как новое объявление.<br>
    3)	Под формой создать вывод всех объявлений, содержащихся в сессии по шаблону:<br>
    Название объявления | Цена | Имя | Удалить<br>
    4)	При нажатии на «название объявления» на экран выводится шаблон объявления как из пункта 1, только в места полей подставляются истинные значения<br>
    5)	При нажатии на «Удалить», объявление удаляется из сессии<br>

    <a href=" <?= createLink(getUrlParam('page')) ?>"
       class="btn btn-default btn-sm" >Закрыть</a>      
</div>

<!--Форма объявления-->
<div 
    <?= ((getUrlParam('action') == 'rec_add') || (getUrlParam('action') == 'rec_edt')) ? "style='display:block;' " : "style='display:none;' " ?>>
    <div style="width: 60%; margin-left: 20%; margin-right: 20%;"
         class="panel panel-default">

        <form class="form-horizontal" method="post">
            <fieldset>

                <!--Radios-->
                <div class="form-group">
                    <label class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="private" id="private1" value="option1" 
                                       <?php echo ($record_data['private'] == 'option1') ? 'checked=""' : ''; ?>>
                                Частное лицо
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="private" id="private2" value="option2"
                                       <?php echo ($record_data['private'] == 'option2') ? 'checked=""' : ''; ?>>
                                Компания
                            </label>
                        </div>
                    </div>
                </div>        

                <!--Имя-->
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">Имя</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="ФИО"
                               value="<?php echo $record_data['name'] ?>">
                    </div>
                </div> 

                <!--Email и Чек-->
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                               value="<?php echo $record_data['email'] ?>">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="mails"
                                    <?php echo ($record_data['mails']) ? 'checked=""' : ''; ?>>
                                    Я не хочу получать вопросы по объявлению по e-mail
                            </label>
                        </div>
                    </div>
                </div>

                <!--Телефон-->
                <div class="form-group">
                    <label for="phone" class="col-lg-2 control-label">Телефон</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон"
                               value="<?php echo $record_data['phone'] ?>">
                    </div>
                </div>        

                <!--Город-->
                <div class="form-group">
                    <label for="city" class="col-lg-2 control-label">Город</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="city_id" id="sity">
                            <?php ($record_data['city_id']) ? show_cities($record_data['city_id']) : show_cities(); ?>
                        </select>
                    </div>
                </div>   

                <!--Категория-->
                <div class="form-group">
                    <label for="category" class="col-lg-2 control-label">Категория</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="category_id" id="category">
                            <?php ($record_data['category_id']) ? show_categories($record_data['category_id']) : show_categories(); ?>
                        </select>
                    </div>
                </div>        

                <!--Название объявления-->
                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">Название объявления</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="title" id="title"  placeholder="Название объявления"
                               value="<?php echo $record_data['title'] ?>">
                    </div>
                </div>        

                <!--Описание объявления-->
                <div class="form-group">
                    <label for="description" class="col-lg-2 control-label">Описание объявления</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" name="description" id="description"><?php echo $record_data['description'] ?></textarea>
                    </div>
                </div>

                <!--Цена-->
                <div class="form-group">
                    <label for="price" class="col-lg-2 control-label">Цена</label>
                    <div class="col-lg-10" style="width: 250px;">
                        <input type="text" class="form-control" name="price" id="price" placeholder="Цена"
                               value="<?php echo $record_data['price'] ?>">
                    </div>
                    <label class="col-lg-2 control-label" style="text-align: left;">руб.</label>
                </div> 

                <!--Кнопки-->
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a href=" <?= createLink(getUrlParam('page')) ?>"
                           accesskey=""class="btn btn-default" >Закрыть</a>
<!--                        <button type="reset" class="btn btn-default">Закрыть</button>-->
                        <button type="submit" class="btn btn-primary" name="btn_ok" value="btn_ok">Сохранить</button>
                        <button type="submit" class="btn btn-primary" name="btn_ok_close" value="btn_ok_close">Сохранить и закрыть</button>
                        <?= ((getUrlParam('action') == 'rec_add')) 
                                       ? '<button type="submit" class="btn btn-default" name="btn_fill" value="btn_fill">Заполнить</button>' 
                                       : "" ?>
                        
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<!--Панель с Таблицей-->
<div class="panel panel-default">
    <div class="panel-heading">Объявления</div>
    <table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th style="text-align: center;">id</th>
                <th style="text-align: center;">ФИО</th>
                <th style="text-align: center;">Название объявления</th>
                <th style="text-align: center;">Цена</th>
                <th style="text-align: center;"></th>
                <th style="text-align: center;"></th>
            </tr>
        </thead>
        <tbody>
            <?php tbl_fill_body() ?>
        </tbody>
    </table>  
</div>


