<?


// $str = 'In My23 Cart : 11 items';
// $int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
// echo $int;
$fin = fopen('input.txt', 'r');


while($line = fgets($fin)) 
{ 
    // echo $line . '<br/>';
    $line = explode(":", $line);
    $id = $line[0];
    $params = explode(" ", $line[1]);
    echo $id . '->';
    for ($i = 0; $i < count($params); $i++) {   
        $G[$id][$i] = $params[$i];
        echo $params[$i] . ' ';
    }
    echo '<br/>';
}
foreach($G as $Ver)
{
    echo '<br/>';
print_r($Ver);
}