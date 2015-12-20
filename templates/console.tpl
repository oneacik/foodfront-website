<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="utils.js"></script>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="console.css" />
        

    
</head>
<body> 
    <div class="frame">
        
        <div class="top_banner">

        </div>

        <div class="navigation">
            <a href="/console/spots"><span>Spots</span></a>
            <a href="/console/menus"><span>Menus</span></a>
            <a href="/console/subscriptions"><span>Subscriptions</span></a>
            <a href=""><span>Properties</span></a>
            <a href="/logout/"><span>Logout</span></a>
            

        </div>
        
        <div class="content">
            {foreach from=$items item=$item}
                {$item}
              <hr/>
            {/foreach}

        </div>

    </div>

</body>
</html>