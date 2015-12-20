<div class="element">
            Nowa ikona (64x64):<br/>
            <div class="icon">
                <img src="/{if isset($map_icon)}{$map_icon}{/if}"/>

            </div>
                <form style="float:left;clear :left;" method="POST" enctype="multipart/form-data">
                <input type="file" name="image"/><br/>
                <input  class="button" type="submit" name="icon" value="Wyślij"/>
            </form>
            
        </div>