<?
function str_to_datetime($str)
{
    //$str = str_replace('.', '-', $str);
    $date = new DateTime($str);
    //echo $date->format('d.m.Y');
    return $date;

}
$fd = fopen('input.txt', 'r');
$fw = fopen('output.txt', 'w+');

$str = (fread($fd, 10));
$now_time = str_to_datetime($str);
// echo 'now: ' . $now_time->format('d.m.Y') . '<br/>';



while(!feof($fd))
{

    $num = (int)fread($fd, 3);
    // echo '<br/> num: ' . $num . '<br/>';
    
    $str = (fread($fd, 11));
    $time_p = str_to_datetime($str);

    // echo $time_p->format('d.m.Y') . '   ---   ';
    
    $str = fread($fd, 1);
    
    
    $str = (fread($fd, 10));
    $time_a = str_to_datetime($str);  
    // echo $time_a->format('d.m.Y');
    
    if($time_p <= $now_time and $now_time <= $time_a){
        
        fwrite($fw, $num . PHP_EOL);
        
        echo $num . '<br/>';
    }
}

fclose($fd);
fclose($fw);
?>