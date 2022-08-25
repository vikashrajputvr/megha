<?php

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert(['ename' => "aaa", 'age'=>35, 'designation' => 'Manager', 'salary'=> 50000]);
$bulk->insert(['ename' => "bbb", 'age'=>40, 'designation' => 'Doctor', 'salary'=> 60000]);
$bulk->insert(['ename' => "ccc", 'age'=>50, 'designation' => 'Professor', 'salary'=> 70000]);
$bulk->insert(['ename' => "ddd", 'age'=>45, 'designation' => 'Manager', 'salary'=> 40000]);
$bulk->insert(['ename' => "eee", 'age'=>47, 'designation' => 'Professor', 'salary'=> 75000]);
$manager->executeBulkWrite('emp4.coll', $bulk);

echo "Listing all documents <br>";
$filter = [];
$options = [];

$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('emp4.coll', $query);

foreach ($cursor as $document) {
    var_dump($document);
echo "<br>";
}   
 

echo "Listing documents with a condition <br>";

$filter = ['salary' => ['$gt' => 60000]];
$options = [
    'projection' => ['_id' => 0],
    'sort' => ['salary' => 1],
];


$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('emp4.coll', $query);

foreach ($cursor as $document) {
    var_dump($document);
echo "<br>";
}   

echo "Listing two Documents in the database using LIMIT Command.<br>";

$filter1=[];
$options1 = ['sort'=>array('salary' => -1),'limit'=>2];

$query1 = new MongoDB\Driver\Query($filter1, $options1);
$cursor1 = $manager->executeQuery('emp4.coll', $query1);

foreach ($cursor1 as $document1) {
    var_dump($document1);
echo "<br>";
}

echo "Display from 5th document <br>";

$filter1=[];
$options1 = ['sort'=>array('salary' => -1),'skip'=>4];

$query1 = new MongoDB\Driver\Query($filter1, $options1);
$cursor1 = $manager->executeQuery('emp4.coll', $query1);

foreach ($cursor1 as $document1) {
       var_dump($document1);
echo "<br>";
}
$a=array('ename' => 'eee', 'designation' => 'Professor', 'salary'=> 75000, 'x'=> 1);

echo "Display the prescribed number in an array object using SLICE operator. <br>";
print_r(array_slice($a, 2));
echo "<br>";



?>