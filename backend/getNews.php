<?php
set_time_limit(200);//to increase the maximum execution time as this script takes more than 30 secs to execute(default max execution time is 30secs).
$company = $argv[1]; //1st command line argument(company name)
//$company = 'intel';
$output = $company."_output.txt";
//to increase the maximum execution time as this script takes more than 30 secs to execute(default max execution time is 30secs).
$datesContent = file_get_contents('http://localhost/getNews/'.$company.'.txt');
//input file is the file with the inflection points dates 
$dates = explode("\n", $datesContent);
//inflection points dates are in this array
//removing the white space at the end for every date
for($i=0;$i<count($dates);$i++ ){
	$dates[$i]=substr($dates[$i], 0,8);
}
$curl = curl_init();
$result = '';
foreach ($dates as $value) {
	
	curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'http://api.nytimes.com/svc/search/v2/articlesearch.json?q='.$company.'&begin_date='.$value.'&end_date='.$value.'&api-key=7a7e9e5fc8f068b4cf9457a1abe884e5%3A2%3A71729777',
	));
	$resp = $value.' '.curl_exec($curl);; //printing date and news together
	$result = $result.$resp.PHP_EOL; //all the dates and news
	$result = $result.PHP_EOL; //adding a next line character between every set of date and news
}
echo $result;
$file = fopen($output, "w");
fwrite($file,$result);
fclose($file);
curl_close($curl);
?>


