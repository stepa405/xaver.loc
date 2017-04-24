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
                   <?php createMenu(); ?>
                </div>
            </div>
        </header>
        <div id="content">
            <?php include (getPage()); ?>
        </div>
    </body>
</html>


