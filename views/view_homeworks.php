<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <link href="styles/site.css" rel="stylesheet">
        <title>Xaver Уроки</title>
    </head>
    <body>
        <header>
            <div id="headerInside">
                <div id="companyName">XaVeR</div>
                <div id="navWrap"> 
                    <!--TODO: Подумать как здесь сделать вывод более правильно и интересно-->
                    <a href="?page=">Главная</a>
                    <a href="?page=2">Урок 2</a>
                    <a href="?page=3">Урок 3</a>
                    <a href="?page=4">Урок 4</a>
                    <a href="?page=5">Урок 5</a>
                    <a href="?page=6">Урок 6</a>
                </div>
            </div>
        </header>
        <div id="content">
            <?php include (getPage()); ?>
        </div>
    </body>
</html>


