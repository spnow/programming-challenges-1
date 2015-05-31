<?php
$req=curl_init("http://challenge01.root-me.org/programmation/ch1/");
curl_setopt($req,CURLOPT_RETURNTRANSFER,true);
curl_setopt($req,CURLOPT_COOKIEJAR,"x.txt");

curl_setopt($req,CURLOPT_COOKIE,"challenge_frame=1;PHPSESSID=xxx; PHPSESSID=xxx; spip_session=xxx");
$exe=curl_exec($req);

exec("touch tmp.txt");
file_put_contents("tmp.txt",$exe);
$returnresu0=shell_exec("cat tmp.txt | grep 'U<sub>0</sub>' | cut -d= -f 2");
$returnresoperation=shell_exec("cat tmp.txt | grep '<body' | cut -d[ -f2,3");
$u0=trim($returnresu0);
$returnresoperation=str_replace("+ U<sub>n</sub> ] + [ n * ",'',$returnresoperation);
$returnresoperation=str_replace("<br />",'',$returnresoperation);
$returnresoperation=str_replace("]",'',$returnresoperation);
if(preg_match("#\- \[ n \*#",$returnresoperation))
{
exit("Please relaunch the script... ( until you don't see this warning.\n");


}
fwrite(fopen('tmp.txt','w+'),$returnresoperation);
$content=shell_exec("cat tmp.txt");
$content=trim($content);
$tbl=explode(" ",$content);
file_put_contents("tmp.txt",$exe);
$term_a_trouver=exec("cat tmp.txt | grep -o 'n&deg;[0-9]*' | cut -d';' -f2");
$terme=trim($term_a_trouver);
echo $terme;
/*
$u0
$tbl[0]
$tbl[1]
$terme
*/



for($occurence=0;$occurence<=$terme;$occurence++)
{
if($occurence==0)
{
$thxncomputer=($tbl[0]+$u0)+($occurence*$tbl[1]);
}
else
{
$thxncomputer=($tbl[0]+$thxncomputer)+($occurence*$tbl[1]);
}

if($occurence==$terme)
{
echo $thxncomputer;

}


}
$thxncomputer=(int)$thxncomputer;
$req=curl_init("http://challenge01.root-me.org/programmation/ch1/ep1_v.php?resultat=$thxncomputer");
curl_setopt($req,CURLOPT_RETURNTRANSFER,true);
curl_setopt($req,CURLOPT_REFERER,"http://challenge01.root-me.org/programmation/ch1/index.php");
curl_setopt($req,CURLOPT_COOKIEFILE,"x.txt");

$exe=curl_exec($req);
curl_close($req);
echo "\n$exe";
@unlink("tmp.txt");
@unlink("x.txt");
?>
