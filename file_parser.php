<?php

$folderName = "Winter_2014";
mkdir($folderName);
$surveyDataFile = $folderName.".txt";
$lines = file($surveyDataFile);
$startSurvey = [];
$endSurvey = [];
$surveyLength = [];
$surveyFileName = [];




//Find Start of each Survey, Put to Array	
$i = 0;	
foreach ($lines as $key=>$value) {
    $searchCriteria = "1 of ";
    if (substr(rtrim($value), 0, 5) == $searchCriteria) {
	$startSurvey[$i] = $key;
	$surveyFileName[$i] = $key+1;
	$i++;
	}
}   

 $surveyMax = count($startSurvey);

//Find End of each Survey, Put to Array	
foreach (array_slice($startSurvey,1) as $key=>$value) {
    $endSurvey[$key] = $value-1;
} 

//echo end($lines);
$endSurvey[] = count($lines)-1;



//Find Length of each Survey
for ($l=0;$l<$surveyMax; $l++) {
    $surveyLength[$l] = (($endSurvey[$l] - $startSurvey[$l]) + 1);
}



 //Find Course Name of each Survey
$charactersOut = ['/','\',',':','<','>','"','|','?','*'];
foreach ($startSurvey as $key=>$value) {
    $surveyFileName[$key] = $folderName."/".str_replace($charactersOut,'-',rtrim($lines[$value+1])).".txt";
}  



 //echo $surveyMax;
/*  echo var_dump($startSurvey);
 echo "<br>";
 echo var_dump($endSurvey);
 echo "<br>";
 echo var_dump($surveyFileName);
 echo "<br>";
 echo $startSurvey[0];
 echo "<br>";
 echo $endSurvey[0];
 echo "<br>";
 echo $surveyFileName[0];
  echo "<br>";
 echo  $surveyLength[0]; */

 
 //echo $startSurvey[55];
 
for ($j=0;$j<$surveyMax; $j++) {
    file_put_contents($surveyFileName[$j], array_slice($lines, $startSurvey[$j], $surveyLength[$j]));
} 

echo $folderName . " finished";
?>