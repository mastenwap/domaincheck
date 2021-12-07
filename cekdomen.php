<?php 

function curldomen($domen)
{
	// echo "token=9bc051c6d2165f10dff0db0c0a1221fd6922bb89&a=checkDomain&domain=$domen&type=domain";
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://member.kencengsolusindo.co.id/cart.php');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "token=9bc051c6d2165f10dff0db0c0a1221fd6922bb89&a=checkDomain&domain=$domen&type=domain");

	$headers = array();
	$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
	$headers[] = 'Cookie: _ga=GA1.3.26924290.1638845066; _gid=GA1.3.635236994.1638845066; WHMCSeHdbAiOk95yl=uo8vshn4fvst26tg5hgl7m0lo6; __utma=115442970.26924290.1638845066.1638847951.1638847951.1; __utmb=115442970.1.10.1638847951; __utmc=115442970; __utmz=115442970.1638847951.1.1.utmcsr=kencengsolusindo.co.id|utmccn=(referral)|utmcmd=referral|utmcct=/; __utmt=1; TawkConnectionTime=1638847979696';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	$result = json_decode($result,true);
	// print_r($result['result'][0]);
	// print_r($result['result'][0]['pricing']);
	echo $domen." ".$result['result'][0]['legacyStatus']." ".$result['result'][0]['pricing'][1]['register']."\n";
	$data = $result['result'][0]['domainName']." ".$result['result'][0]['legacyStatus']." ".$result['result'][0]['pricing'][1]['register'];
	if ($result['result'][0]['legacyStatus'] == 'available' and $result['result'][0]['domainName'] !== 'siloam-hospitals.com') 
	{
		$file = fopen('LogDomain2.txt', 'a+') or die ("gabisa di buka bosque !");
		$isi  = $data."\n";
		fwrite($file, $isi);
		fclose($file); 
	}
}


$file_handle = fopen("listdomain.txt", "rb");
$no = 1;
while (!feof($file_handle))
{
	$line_of_text = fgets($file_handle);
	$line_of_text = trim($line_of_text);
	// echo "$line_of_text";
	curldomen("siloam-hospitals.".$line_of_text);
	// echo "siloamhospitals.".$line_of_text;
}

?>