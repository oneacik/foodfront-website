function post($form) {
    var $inputs = $form.getElementsByTagName("input");
    var $query="";
    for (var $x = 0; $x < $inputs.length; $x++) {
        $query="&"+$inputs[$x].name+"="+encodeURIComponent($inputs[$x].value)+$query;
    }
    $query=$query.substring(1);
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", window.location.toString(), false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhttp.send($query);
    
    return false;
}