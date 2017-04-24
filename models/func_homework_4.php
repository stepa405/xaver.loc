<?php

# ПЕРЕМЕННЫЕ  
# Инициализация переменных для Урока 4
$total = array();
$order = array();

# ФУНКЦИИ
# Функции для Урока 4
//функция вывода тела таблицы
function add_table_body() { 
    global $ini_string, $order;
    $i = 0; //номер по порядку

    $bd = parse_ini_string($ini_string, true);

    foreach ($bd as $key => $value) { //бежим по массиву
        # надо все посчитать и заполнить в один проход */
        сalc_orders($key, $value); //считаем итого по всем парметрам, заполняем уведомления
        // заполняем таблицу 
        echo '<tr>';
        echo '<td>' . ++$i . '</td>';
        echo '<td id="td_left">' . $key . '</td>';
        echo '<td>' . $value['цена'] . '</td>';
        echo '<td>' . $value['количество заказано'] . '</td>';
        echo '<td>' . $value['осталось на складе'] . '</td>';
        echo '<td id="td_left">' . $order['diskont_text'] . '</td>';
        echo '<td>' . $order['diskont_price'] . '</td>';
        echo '<td>' . $order['order_count'] . '</td>';
        echo '<td>' . $order['order_sum'] . '</td>';
        echo '</tr>';
    }
}

//функция вывода итоговой строки в таблице
function add_table_footer() {
    global $total;

    echo '<td></td>';
    echo '<td id="td_left">ИТОГО</td>';
    echo '<td>' . $total['sum_cost'] . '</td>';
    echo '<td>' . $total['sum_cnt_zak'] . '</td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td>' . $total['order_count'] . '</td>';
    echo '<td>' . $total['order_sum'] . '</td>';
}

//функция расчета итоговых значений
function сalc_orders($key, $value) {
    global $total, $order, $quantity_discount;

    set_diskont($value['diskont'], $value['цена']); //расчет скидки по купону
    //- Вам нужно сделать секцию "Уведомления", где необходимо извещать покупателя о том,
    // что нужного количества товара не оказалось на складе
    if ($value['осталось на складе'] >= $value['количество заказано']) {
        $order['order_count'] = $value['количество заказано'];
    } else {
        $order['order_count'] = $value['осталось на складе'];
        $total['stock_note'] = $total['stock_note'].'"'.$key.'"'.
                ' В заказе: '.$value['количество заказано'].
                'шт. На складе: '.$value['осталось на складе'].'шт.<br>';
    }

    // - Вам нужно сделать секцию "Скидки", где известить покупателя о том, что если он заказал "игрушка детская велосипед"
    // в количестве >=3 штук, то на эту позицию ему 
    // автоматически дается скидка 30% (соответственно цены в корзине пересчитываются тоже автоматически)
    # считаем скидка по купону + скидка по количеству, заполнем уведомление
    if (($key == $quantity_discount) && ($value['количество заказано'] >= 3)) {
        $order['diskont_price'] = $order['diskont_price'] / 100 * 30; //новая цена с учетом скидки по купону
        $total['diskont_note'] = 
                'Скидка 30% при заказе "' . $key . '" более 3 шт. <br>'
                . 'Цена без скидки: ' . $value['цена'] . 'руб. <br>'
                . 'Цена со скидкой 30%: ' . $value['цена'] / 100 * 30 . 'руб. <br>'
                . 'Цена c учетом купона: ' . $order['diskont_price'] . 'руб.';
        
    } else {
        $total['diskont_note'] = 'К сожалению у вас нет скидки по количеству товара.';
    }

    //Считаем сумму по товару (с учетом скидки по количеству и скидок по купонам)
    $order['order_sum'] = $order['order_count'] * $order['diskont_price'];

    //Считаем итого
    $total['sum_cost'] += $value['цена'];
    $total['sum_cnt_zak'] += $value['количество заказано'];
    $total['order_count'] += $order['order_count'];
    $total['order_sum'] += $order['order_sum'];
}

//функция расчета скидки по купону
function set_diskont($diskont, $price) { 
    /*  Из задания:
      у каждого товара есть автоматически генерируемый скидочный купон diskont,
      используйте переменную функцию, чтобы делать скидку на итоговую цену в корзине
      diskont0 = скидок нет, diskont1 = 10%, diskont2 = 20%
     */
    global $order;

    switch ($diskont) { //используем switch по требованию задания
        case 'diskont0': {
                $order['diskont_text'] = $diskont . '&nbsp&nbsp 0%';
                $order['diskont_price'] = $price;
                break;
            }
        case 'diskont1': {
                $order['diskont_price'] = $price / 100 * 10;
                $order['diskont_text'] = $diskont . '&nbsp&nbsp 10%';
                break;
            }
        case 'diskont2': {
                $order['diskont_price'] = $price / 100 * 20;
                $order['diskont_text'] = $diskont . '&nbsp&nbsp 20%';
                break;
            }
    }
}

?>