<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="login.css" />
    </head>
    <body> 
        <div class="frame">

            <form method="POST">
                {if isset($error)}<span class="error">{$error}</span>{/if}
                {if isset($note)}<span class="note">{$note}</span>{/if}
                <img src="/img/foodfront.png">
                <input type="text" placeholder="użytkownik" name="user"/>
                <input type="text" placeholder="hasło" name="pass"/>
                <input type="text" placeholder="e-mail" name="email"/>
                
                
                <input type="submit" name="register" value="rejestruj">
                

            </form>
                
        </div>

    </body>
</html>