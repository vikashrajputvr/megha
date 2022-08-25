<?php
echo extension_loaded("mongodb") ? "extension loaded\n" : "extension not loaded\n";
$m = new MongoDB\Driver\Manager("mongodb://localhost:27017"); 
$c = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$bulk=new MongoDB\Driver\Bulkwrite;

$contact = array(
"First Name" => "Philip",
"Address" => array(
"Street" => "681 Hinkle Lake Road",
"Place" => "Newton",
"Postal Code" => "MA 02160",
"Country" => "USA"
),
"E-Mail" => array(
"pm@example.com",
"pm@office.com",
"philip@example.com",
"philip@office.com",
"moran@example.com",
"moran@office.com",
"pmoran@example.com",
"pmoran@office.com"
),
"Phone" => "617-546-8428",
"Age" => 60
);


$bulk->insert ($contact);

$contact2 = array(
"First Name" => "Victoria",
"Last Name" => "Wood",
"Address" => array(
"Street" => "50 Ash lane",
"Place" => "Ystradgynlais",
"Postal Code" => "SA9 6XT",
"Country" => "UK"
)
,
"E-Mail" => array("vw@example.com",
"vw@office.com"
),
"Phone" => "078-8727-8049",
"Age" => 28
);

$bulk->insert($contact2);
$m->executeBulkWrite('contact.people', $bulk);

$map = new MongoDB\BSON\Javascript('function()
{
emit(this.Address.Country, 1 );
}
');
echo "map done";
$reduce = new MongoDB\BSON\Javascript ('function(key, value) {
var Totals = 0;
for(index in value) {
Totals += value[index];
}
return Totals;
}');
echo "reduce done";

//$db = $c->contact;
$cmd = new MongoDB\Driver\Command(array('mapreduce' => 'people',
'map' => $map,
'reduce' => $reduce,
'out' => 'countries'
));

$cursor=$m->executeCommand('contact',$cmd);
echo "done"
?>