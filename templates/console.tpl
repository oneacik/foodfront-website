<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="utils.js"></script>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="console.css" />
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,100,700' rel='stylesheet' type='text/css'>


</head>
<body>
    <div class="frame">

        <div class="top_banner">

        </div>

        <div class="navigation">
            <div class="logo">

            </div>
            <a href="/console/spots"><span>Spots</span></a>
            <a href="/console/menus"><span>Menus</span></a>
            <a href="/console/subscriptions"><span>Subscriptions</span></a>
            <a href=""><span>Properties</span></a>
            <a href="/logout/"><span>Logout</span></a>


        </div>

        <div class="content">
            {foreach from=$items item=$item}
                {$item}
            {/foreach}

        </div>

    </div>

</body>
</html>
