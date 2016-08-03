<?php
spl_autoload_register();
$obj = new Classes\Application;
$data = $obj->loadData('data.json');
$dataToArray = json_decode(json_encode($data),true);
$result = $obj->loopRecursive($dataToArray);
$returnResult = array_filter($result);
/** Print the data **/
echo "<pre>";
print_r($returnResult);
?>