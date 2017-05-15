<html lang="ru">
    <head>
        <meta charset="UTF-8">
        
        <?= (getUrlParam('page')>=6) 
                ? '<!-- Bootstrap CSS -->' 
                .'<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/sandstone/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-G3G7OsJCbOk1USkOY4RfeX1z27YaWrZ1YuaQ5tbuawed9IoreRDpWpTkZLXQfPm3" crossorigin="anonymous">'
                . '<!--https://bootswatch.com/sandstone/-->'
                : '' ?>
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
       <footer>
           <div id="footerInside">
               <?php showError() ; ?>
           </div>    
       </footer>        
    </body>
</html>


