<div class="element">
            Nowy baner (720x360):<br/>
            <div class="banner">
                <img src="/{if isset($map_banner)}{$map_banner}{/if}"/>

            </div>
                <form style="float:left;clear :left;" method="POST" enctype="multipart/form-data">
                <input type="file" name="image"/><br/>
                <input  class="button" type="submit" name="banner" value="Wyślij"/>
            </form>

        </div>
