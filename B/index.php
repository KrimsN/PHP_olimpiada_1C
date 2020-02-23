<?

$fin = fopen('input.txt', 'r');
$fout = fopen('output.txt', 'w+');


$global_res = true;
$local_res = 0;

while($str = fread($fin, 8)){
    $arr[] = $str;
}



for ($i = 0; $i < count($arr); $i++) 
{   
    // echo $arr[$i]. 'res '. $local_res . "<br/>"; 
    if($local_res == 0){
        
        if(substr($arr[$i],0, 1) == '0'){
            // echo '1 ' . substr($arr[$i],0, 1) . '<br/>';
            $local_res = 0;
            continue;
        }
        elseif(substr($arr[$i],0, 3) == '110'){
            // echo '2 ' . substr($arr[$i],0, 3) . '<br/>';
            $local_res = 1;
            continue;
        }
        elseif(substr($arr[$i],0, 4) == '1110'){
            // echo '3 ' . substr($arr[$i],0, 4) . '<br/>';
            $local_res = 2;
            continue;
        }
        elseif(substr($arr[$i],0, 5) == '11110'){
            // echo '4 ' . substr($arr[$i],0, 5) . '<br/>';
            $local_res = 3;
            continue;
        }else{
            $global_res = false;
            // echo 'N';
            break;
        }
    }else{
        if(substr($arr[$i],0, 2) == '10'){
            // echo '10 ' . substr($arr[$i],0, 2) . '<br/>';
            $local_res--;
            continue;
        }else{
            $global_res = false;
            // echo 'N';
            break;
        }
    }
    
    // echo $arr[$i]."<br/>"; 
} 

if($global_res and $local_res == 0){
    echo 'Y';
    fwrite($fout, 'Y');
}
else{
    echo 'N';
    fwrite($fout, 'N');
}

fclose($fout);
fclose($fin);
?>