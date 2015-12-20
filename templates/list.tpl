

<div class="module">


    <div class="bar">
        <form method="POST">
            <input class="button" type="submit" name="new" value="dodaj"/>
        </form>
    </div>

    {foreach $items as $item}
        <div class="element">
            <div class="icon">
                <img src="/{if isset($item->map_icon)}{$item->map_icon}{/if}"/>

            </div>
            <div class="texts">
                <div>{if isset($item->title)}{$item->title}{/if}</div>
                <div>{if isset($item->description)}{$item->description}{elseif isset($item->address)}{$item->address}{/if}</div>
            </div>
            <form style="float: right" method="POST">
                <input type="hidden" name="id" value="{$item->id}"/>
                <input  class="button" type="submit" name="delete" value="usuń"/>
            </form>
            <form style="float: right" action="/console/{$sub}/{$item->id}" method="POST">
                
                
                <input style="float: right" class="button" type="submit" name="edit" value="edytuj"/>
            </form>
        </div>
    {/foreach}

</div>

</body>