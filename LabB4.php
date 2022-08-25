<?php

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017"); 

$bulk = new MongoDB\Driver\BulkWrite; 
$bulk->insert(["Name"=>"aaa","Age"=>22,"Desig"=>"developer","Sal"=>50000]);
$bulk->insert(["Name"=>"bbb","Age"=>23,"Desig"=>"developer","Sal"=>65000]);
$bulk->insert(["Name"=>"ccc","Age"=>45,"Desig"=>"Professor","Sal"=>45000]);
$bulk->insert(["Name"=>"ddd","Age"=>25,"Desig"=>"Intern","Sal"=>25000,"DOJ"=>"1st June 2021"]);
$bulk->insert(["Name"=>"eee","Age"=>52,"Desig"=>"CEO","Sal"=>75000]);

$manager->executeBulkWrite('Emp1.empcol', $bulk);

echo "Listing all documents<br>";
$filter = [];
$options = ['projection'=>['_id'=>0]];
$query = new MongoDB\Driver\Query($filter,$options ); 
$cursor = $manager->executeQuery('Emp1.empcol', $query);
foreach($cursor as $document){
var_dump($document);
echo "<br>";}
//------------------------------------------------------------------------
echo "<br>Listing documents with condition<br>Return records where designation is developer:<br>";
$filter = ['Desig'=>'developer'];
$options = [
'projection'=>['_id'=>0],
'sort'=>['Sal'=>1]];
$query = new MongoDB\Driver\Query($filter,$options ); 
$cursor = $manager->executeQuery('Emp1.empcol', $query);
foreach($cursor as $document){
var_dump($document);
echo "<br>";}


echo "<br>Listing using Logical operators:<br>Salary greater than 60000:<br>";
$filter = ['Sal'=>['$gt'=>60000]];
$options = [
'projection'=>['_id'=>0],
'sort'=>['Sal'=>1]];
$query = new MongoDB\Driver\Query($filter,$options ); 
$cursor = $manager->executeQuery('Emp1.empcol', $query);
foreach($cursor as $document){
var_dump($document);
echo "<br>";}

echo "<br>Age less than 30:<br>";
$filter1 = ['Age'=>['$lt'=>30]];
$options1 = ['projection'=>['_id'=>0]];
$query1 = new MongoDB\Driver\Query($filter1,$options1 ); 
$cursor1 = $manager->executeQuery('Emp1.empcol', $query1);
foreach($cursor1 as $document1){
var_dump($document1);
echo "<br>";}

echo "<br>Age greater than equal to 25:<br>";
$filter = ['Age'=>['$gte'=>25]];
$options = [
'projection'=>['_id'=>0],
'sort'=>['Sal'=>1]];
$query = new MongoDB\Driver\Query($filter,$options ); 
$cursor = $manager->executeQuery('Emp1.empcol', $query);
foreach($cursor as $document){
var_dump($document);
echo "<br>";}

echo "<br>Salary less than equal to 50000:<br>";
$filter1 = ['Sal'=>['$lte'=>50000]];
$options1 = ['projection'=>['_id'=>0]];
$query1 = new MongoDB\Driver\Query($filter1,$options1 ); 
$cursor1 = $manager->executeQuery('Emp1.empcol', $query1);
foreach($cursor1 as $document1){
var_dump($document1);
echo "<br>";}

echo "<br>Name not equal to 'ccc':<br>";
$filter1 = ['Name'=>['$ne'=>'ccc']];
$options1 = ['projection'=>['_id'=>0]];
$query1 = new MongoDB\Driver\Query($filter1,$options1 ); 
$cursor1 = $manager->executeQuery('Emp1.empcol', $query1);
foreach($cursor1 as $document1){
var_dump($document1);
echo "<br>";}
//----------------------------------------------------------------------

echo "<br>Using Boolean operators:<br>Age greater than 25 AND Salary less than 50000:<br>";
$filter1 = ['$and'=>array(['Age'=>['$gt'=>25]],['Sal'=>['$lt'=>50000]])];
$options1 = ['projection'=>['_id'=>0]];
$query1 = new MongoDB\Driver\Query($filter1,$options1 ); 
$cursor1 = $manager->executeQuery('Emp1.empcol', $query1);
foreach($cursor1 as $doc1){
var_dump($doc1);
echo "<br>";}

echo "<br>Age greater than 25 OR Salary less than 50000:<br>";
$filter1 = ['$or'=>array(['Age'=>['$gt'=>25]],['Sal'=>['$lt'=>50000]])];
$options1 = ['projection'=>['_id'=>0]];
$query1 = new MongoDB\Driver\Query($filter1,$options1 ); 
$cursor1 = $manager->executeQuery('Emp1.empcol', $query1);
foreach($cursor1 as $document1){
var_dump($document1);
echo "<br>";}


echo "<br>Listing documents with condition<br>'Rio' not in 'Name' field:<br>";
$filter = ['Name'=>['$nin'=>['Rio']]];
$options = [
'projection'=>['_id'=>0],
'sort'=>['Sal'=>1]];
$query = new MongoDB\Driver\Query($filter ); 
$cursor = $manager->executeQuery('Emp1.empcol', $query);
foreach($cursor as $document){
var_dump($document);
echo "<br>";}

echo "<br>Listing documents with condition<br>'Developer, CEO' in 'Designation':<br>";
$filter = ['Desig'=>['$in'=>['developer','CEO']]];
$options = [
'projection'=>['_id'=>0],
'sort'=>['Sal'=>1]];
$query = new MongoDB\Driver\Query($filter,$options ); 
$cursor = $manager->executeQuery('Emp1.empcol', $query);
foreach($cursor as $document){
var_dump($document);
echo "<br>";}

echo "<br>Listing documents with condition<br>EXISTS:<br>";
$filter1 = ['DOJ'=>['$exists'=>true]];
$options1 = ['projection'=>['_id'=>0]];
$query1 = new MongoDB\Driver\Query($filter1,$options1 ); 
$cursor1 = $manager->executeQuery('Emp1.empcol', $query1);
foreach($cursor1 as $document1){
var_dump($document1);
echo "<br>";}

?>