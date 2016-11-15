<html>
<title>
</title>
<style type="text/css">
body {
}
#main {
    position: relative;
}
#storetext, #bd {
    border: 1px solid white;
    min-height: 750px;
}
#storetext {
	width: 20%;
	float: left;
}
#bd {
	margin-top: 13px;
    float: left;
}
</style>
<head>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["setCookieDomain", "*.itdcduplicator"]);
  _paq.push(["setDomains", ["*.itdcduplicator/projects.php"]]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//itdcduplicator/Analytics/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//itdcduplicator/Analytics/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
</head>
<body>
<?php
require_once('../functions/functions.php');
function getrealip()
{
 if (isset($_SERVER)){
if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
if(strpos($ip,",")){
$exp_ip = explode(",",$ip);
$ip = $exp_ip[0];
}
}else if(isset($_SERVER["HTTP_CLIENT_IP"])){
$ip = $_SERVER["HTTP_CLIENT_IP"];
}else{
$ip = $_SERVER["REMOTE_ADDR"];
}
}else{
if(getenv('HTTP_X_FORWARDED_FOR')){
$ip = getenv('HTTP_X_FORWARDED_FOR');
if(strpos($ip,",")){
$exp_ip=explode(",",$ip);
$ip = $exp_ip[0];
}
}else if(getenv('HTTP_CLIENT_IP')){
$ip = getenv('HTTP_CLIENT_IP');
}else {
$ip = getenv('REMOTE_ADDR');
}
}
return $ip; 
}
$ip = getrealip();


$WbemLocator = new COM ("WbemScripting.SWbemLocator");
$WbemServices = $WbemLocator->ConnectServer($ip, 'root\\cimv2');
$WbemServices->Security_->ImpersonationLevel = 3;
$query = $WbemServices->ExecQuery("Select * From win32_computersystem");
foreach ( $query as $wmi_call )
    {
        $username = $wmi_call->UserName;
    }

$user = substr($username, strpos($username, "\\") + 1);

$log = '../log/user.txt';
$pageName = basename($_SERVER['PHP_SELF']);
logging($log,$user.' accessed '.$pageName);
/**
 *  @Trim Value
 *  
 *  @param [in] $Value in 
 *  @return trimmed value 
 *  
 *  @details trims unexpected white spaces or returns
 */
function trim_value(&$value) 
{ 
    $value = trim($value); 
}

if (isset($_GET['gen']) AND isset($_GET['new']) AND !isset($_POST['project'])){
/* echo "generated at step 4 the page";
echo "<pre>";
var_dump(get_defined_vars());
echo "</pre>"; 
echo "--------------------------------------------------------";
echo "<br>"; */
echo "<div id='main'>";
echo "<div id='storetext'>";
echo '<form  method="POST" id="mydata">';
echo 'Enter your Project Name: <input name="project" type="text">';
echo "<br>";
echo "<br>";
echo "<br>";
echo "Enter your store numbers below";
echo "<br>";
echo "Each store should be seperate by a comma.";
echo "<br>";
echo '<textarea name="stores" form="mydata" rows="100" id="stores">';
echo '</textarea>';
echo "</div>";
echo "<div id='bd'>";
echo '<button type="submit" name="create" method="post">';
echo "Create Project";
echo '</button>';
echo "</form>";
echo "</div>";
echo "</div>";
}
if (isset($_GET['gen']) AND isset($_GET['new']) AND isset($_POST['project'])){
$project = $_POST['project'];
	if (!file_exists('./'.$project.'/')){
	mkdir('./'.$project.'/', 0777, true);
	mkdir('./'.$project.'/master', 0777, true);
	$file = fopen('./'.$project.'/master/master.txt',"w");
	fclose($file);
	$f = fopen('./text/projects.txt',"a");
	fwrite ($f,"\n".$_POST['project'].",");
	fclose($f);
	}
}
/**
 *  
 *  
 *  
 *  
 *  @details generates project files if they are not currently present based on provided store numbers.
 */
if (isset($_POST['project'])){
	if (!file_exists('./'.$project.'/'.$project.'.php')){
	copy('./templates/project.php','./'.$project.'/'.$project.'.php');
	}
	if (isset($_POST['stores']) AND isset($_POST['create'])){
		$storevalues = explode(",",$_POST['stores']);
		array_walk($storevalues,'trim_value');
			foreach ($storevalues as $value){
			if (!file_exists('./'.$project.'/'.$value.'/')){
			mkdir('./'.$project.'/'.$value.'/', 0777, true);
			}
			if (!file_exists('./'.$project.'/'.$value.'/edit.php')){
			copy('./templates/edit.php','./'.$project.'/'.$value.'/edit.php');
			}
			if (!file_exists('./'.$project.'/'.$value.'/'.$value.'.csv')){
			$file = fopen('./'.$project.'/'.$value.'/'.$value.'.csv', "w");
			fclose($file);
			}
				/* echo "<pre>";
				var_dump(get_defined_vars());
				echo "</pre>"; */  
			if (file_exists('./'.$project.'/master/master.txt')){
			$file = fopen('./'.$project.'/master/master.txt',"a");
			fwrite ($file, $value.",".",".",".",".",".",".",".","."\n");
			fclose ($file);
			}
			if (file_exists('./'.$project.'/'.$value.'/'.$value.'.csv')){
				$storedata = $value.",".",".",".",".",".",".",".",";
				if (file_exists('./'.$project.'/'.$value.'/'.$value.'.csv')){
				$v = fopen('./'.$project.'/'.$value.'/'.$value.'.csv', "w");
				fwrite ($v,$storedata);
				fclose($v); 
				echo '<script type="text/javascript">
						window.location = "http://itdcduplicator/projects/'.$project.'/'.$project.'.php?project='.$project.'";
						</script>';
				}
			}
		}
	}
}
?>
</body>
</html>