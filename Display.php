<?php

require("smarty.php");
$sma=SSmarty::returnSmarty();
$sma->display("templates/".$_GET["what"].".tpl");