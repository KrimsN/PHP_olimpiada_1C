<? 
class Course{
    private $id;
    private $startDay;
    private $endDay;


    function __construct($str) {
        $data = explode(" ", $str);
        $this->id = $data[0];
        $this->startDay = new DateTime($data[1]);
        $this->endDay = new DateTime($data[2]);
        

    }
    public function show(){
        echo $this->id . ' ' . $this->startDay->format('d.m.Y') . ' ' . $this->endDay->format('d.m.Y') . '<br/>';
    }

    public function isIn($nowDate){
        return ($this->startDay <= $nowDate and $nowDate <= $this->endDay);
    }
    public function getId(){
        return $this->id;
    }
}

$fin = fopen('input.txt', 'r');
$fout = fopen('output.txt', 'w+');


$currentDate = new DateTime(fgets($fin));
echo $currentDate->format('d.m.Y') . '<br/>';


while($strLine = fgets($fin)){
    $course = new Course($strLine);
    
    if ($course->isIn($currentDate)){
        $id = $course->getID();
        echo $id . '<br/>';
        fwrite($fout, $id . PHP_EOL);

    }
}
fclose($fout);
fclose($fin);

?>