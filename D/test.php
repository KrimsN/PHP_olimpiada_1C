<?php

function topological_sort($nodeids, $edges) {
    $L = $S = $nodes = array();
    foreach($nodeids as $id) {
        $nodes[$id] = array('in'=>array(), 'out'=>array());
        foreach($edges as $e) {
            if ($id==$e[0]) { $nodes[$id]['out'][]=$e[1]; }
            if ($id==$e[1]) { $nodes[$id]['in'][]=$e[0]; }
        }
    }
    foreach ($nodes as $id=>$n) { if (empty($n['in'])) $S[]=$id; }
    while (!empty($S)) {
        $L[] = $id = array_shift($S);
        foreach($nodes[$id]['out'] as $m) {
            $nodes[$m]['in'] = array_diff($nodes[$m]['in'], array($id));
            if (empty($nodes[$m]['in'])) { $S[] = $m; }
        }
        $nodes[$id]['out'] = array();
    }
    foreach($nodes as $n) {
        if (!empty($n['in']) or !empty($n['out'])) {
            return null; 
        }
    }
    return $L;
}



$nodes1 = array (
  0 => '0',
  1 => '1',
  2 => '2'
);
$edges1 = array (
    0 => 
    array (
      0 => '1',
      1 => '2',
    ),
    1 => 
    array (
      0 => '2',
    ),
    2 => 
    array (
    ));



$nodes= array (
    0 => '0',
    1 => '1',
    2 => '2',
    3 => '4'
);

$edges = array (
    0 => 
    array (
        0 => '2',
    ),
    1 => 
    array (
        0 => '0',
        
    ),
    2 => 
    array (
        0 => '1',
    ),
    4 =>
    array(
        0 => '1',
        1 => '2' 
    ));
$G = topological_sort($nodes, $edges);

foreach($G as $brand => $value){
    
        echo "[$brand] = $value";
    
}

