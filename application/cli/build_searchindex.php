<?php

function init_schluessel_detail($ID_HS)
{
    global $db;
    $s_code = $db->query("SELECT Aka_SchluesselCode.ID_CodeKuerz,Position,CodeBeschreibung,Zeichen 
            FROM Aka_SchluesselCode LEFT JOIN Aka_Codes USING(ID_CodeKuerz)
             WHERE ID_HS ='".$ID_HS."' ORDER BY Position")->fetchAll(PDO::FETCH_ASSOC);
    $schluessel_detail = array();
    foreach ($s_code as $rs) {
        $code_inhalt = $db->query("SELECT CodeBezeichnung,Code FROM Aka_CodeInhalt WHERE ID_CodeKuerz='".$rs["ID_CodeKuerz"]."'")->fetchAll(PDO::FETCH_ASSOC);
        $tmp = array();
        foreach($code_inhalt as $rs1) {
            $tmp[$rs1['Code']] = $rs1['CodeBezeichnung'];
        }
        $schluessel_detail[] = array('ID_CodeKuerz' => $rs['ID_CodeKuerz'], 'Position' => $rs['Position'],
                'CodeBeschreibung' => $rs['CodeBeschreibung'], 'Zeichen' => $rs['Zeichen'],
                'Code' => $tmp);
    }
    return $schluessel_detail;
}

function get_schluessel_detail($schluessel_name, $schluessel_detail)
{
    $ret = array();
    $tmp = explode("-",$schluessel_name);
    $schluessel = trim($tmp[1]);
    $id_hs = trim($tmp[0]);
    if (!$id_hs){
        $ret = false;
    }
   
    for ($j = 0; $j < count($schluessel_detail); ++$j){
        $start = $schluessel_detail[$j]["Position"]-1;
        $anzahl = $schluessel_detail[$j]["Zeichen"];
        $schluessel_teil = substr($schluessel,$start,$anzahl);
        $ret[$schluessel_detail[$j]["ID_CodeKuerz"]] = array("CodeBeschreibung" => $schluessel_detail[$j]["CodeBeschreibung"],
                "CodeBezeichnung" => $schluessel_detail[$j]["Code"][$schluessel_teil]);
    }
    return $ret;
}

PHP_SAPI === 'cli' or die();
define('SYSPATH', true); // fake SYSPATH to allow include from config
class Kohana
{
    const PRODUCTION = 1;
    const DEVELOPMENT = 0;
    public static $environment = 1;
}
$dbconfig = include dirname(__FILE__) . '/../config/database.php';
$db = new PDO($dbconfig['default']['connection']['dsn'], $dbconfig['default']['connection']['username'],$dbconfig['default']['connection']['password']);
$db->exec("SET CHARACTER SET " . $dbconfig['default']['charset']);

$db->exec("TRUNCATE TABLE `aka_schluesselindex`");
$db->exec("ALTER TABLE `aka_schluesselindex` DISABLE KEYS");

foreach($db->query("SELECT ID_HS, Name, ID_Projekt FROM Aka_Schluesselmaske") as $r) {
    $hs_name[$r['ID_HS']] = $r['Name'];
    $id_projekt[$r['ID_HS']] = $r['ID_Projekt'];
    $schluessel_details[$r['ID_HS']] = init_schluessel_detail($r['ID_HS']);
}

$query = "INSERT INTO aka_schluesselindex (ID_HS,Schluessel, schluessel_index, count_data,min_jahr_sem,max_jahr_sem,hs_name,ID_Projekt) VALUES ";
$data = $db->query("SELECT ID_HS, Schluessel,count(  `Data`  ) as count_data , max(  `Jahr_Sem`  ) as max_jahr_sem, min(  `Jahr_Sem`  )
            as min_jahr_sem FROM Daten__Aka
            GROUP  BY ID_HS, Schluessel");
echo " \n";
$i = 0;
$ii = 0;
$insert = array();
while ($r = $data->fetch(PDO::FETCH_ASSOC)) {
    $index = "";
    $ii++;
    foreach(get_schluessel_detail($r['ID_HS'] . '-' . $r['Schluessel'], $schluessel_details[$r['ID_HS']]) as $tmp) {
        $index .= $tmp['CodeBeschreibung'] . ' ' . $tmp['CodeBezeichnung'] . "\n";
    }
    $insert[$i++] = "('".$r['ID_HS']."','".$r['Schluessel']."',".$db->quote(trim($index)).",'".$r['count_data']."','".$r['min_jahr_sem']."','".$r['max_jahr_sem']."'," . $db->quote(trim($hs_name[$r['ID_HS']])) . ",'".$id_projekt[$r['ID_HS']]."')";
    echo  $hs_name[$r['ID_HS']] . "\n" .$r['ID_HS'] . '-' . $r['Schluessel']."\n". $index."\n";
    if ($i > 100){
        $db->exec($query . join(",",$insert));
        $i = 0;
        $insert = array();
    }
}
if ($i) {
    $db->exec($query . join(",",$insert));
}
$db->exec("ALTER TABLE `aka_schluesselindex` ENABLE KEYS");
echo "\n $ii Datensätze eingefügt.\n";

