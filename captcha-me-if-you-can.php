<?php
@include('tesseract-ocr-for-php/TesseractOCR/TesseractOCR.php');
$requete=curl_init("http://challenge01.root-me.org/programmation/ch8/");
curl_setopt($requete,CURLOPT_RETURNTRANSFER,true);
curl_setopt($requete,CURLOPT_COOKIE,"PHPSESSID=steqg78m4usn9ukui4tos1trg2"); // ur session cookie here
//curl_setopt($requete,CURLOPT_POSTFIELDS,"cametu=");
$execution=curl_exec($requete);
curl_close($requete);
fwrite(fopen('tmp.txt',"w+"),$execution);
 $stor=shell_exec('sed "s/.* src=\"\(.*\)\".*/\1/" tmp.txt');
$stor=str_replace("data:image/png;base64,",'',$stor);
$stor=str_replace("data:image/png;base64,",'',$stor);
$stor=str_replace('" /><br><br><form action="" method="POST"><input type="text" name="cametu" /><input type="submit" value="Try','',$stor);
$stor=base64_decode($stor);
$x=fopen("recognition.png","w+");
fwrite($x,$stor);
fclose($x);
$tesseract = new TesseractOCR('recognition.png');
$stor=($tesseract->recognize());
$stor=trim($stor);
$req2=curl_init("http://challenge01.root-me.org/programmation/ch8/");
curl_setopt($req2,CURLOPT_RETURNTRANSFER,true);
curl_setopt($req2,CURLOPT_COOKIE,"challenge_frame=1;spip_session=11819_f1bbf4b41a576aefaa5f67307002a198;PHPSESSID=steqg78m4usn9ukui4tos1trg2"); // ur session cookie here
curl_setopt($req2,CURLOPT_POST,true);
curl_setopt($req2,CURLOPT_POSTFIELDS,"cametu=$stor");
$exe=curl_exec($req2);
echo $exe;


?>
