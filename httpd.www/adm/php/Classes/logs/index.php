<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<!--

					 __                                                       
					/\_\  __  __    ____             ___    ___ ___     ____  
					\/\ \/\ \/\ \  /',__\  _______  /'___\/' __` __`\  /',__\ 
					 \ \ \ \ \_\ \/\__, `\/\______\/\ \__//\ \/\ \/\ \/\__, `\
					  \ \_\/`____ \/\____/\/______/\ \____\ \_\ \_\ \_\/\____/
					   \/_/`/___/> \/___/           \/____/\/_/\/_/\/_/\/___/ 
							  /\___/                                          
							  \/__/                                           
						  

									########  ##    ## 
									##     ##  ##  ##  
									##     ##   ####   
									########     ##    
									##     ##    ##    
									##     ##    ##    
									########     ##    
	  
	  
	  
        :::     :::::::::  :::::::::  :::    ::: :::        :::            :::     :::    ::: 
      :+: :+:   :+:    :+: :+:    :+: :+:    :+: :+:        :+:          :+: :+:   :+:    :+: 
     +:+   +:+  +:+    +:+ +:+    +:+ +:+    +:+ +:+        +:+         +:+   +:+  +:+    +:+ 
    +#++:++#++: +#++:++#+  +#+    +:+ +#+    +:+ +#+        +#+        +#++:++#++: +#++:++#++ 
    +#+     +#+ +#+    +#+ +#+    +#+ +#+    +#+ +#+        +#+        +#+     +#+ +#+    +#+ 
    #+#     #+# #+#    #+# #+#    #+# #+#    #+# #+#        #+#        #+#     #+# #+#    #+# 
    ###     ### #########  #########   ########  ########## ########## ###     ### ###    ### 



					 ::::::::      :::     :::    ::: ::::::::::: ::::    ::: 
					:+:    :+:   :+: :+:   :+:    :+:     :+:     :+:+:   :+: 
					+:+         +:+   +:+  +:+    +:+     +:+     :+:+:+  +:+ 
					+#++:++#++ +#++:++#++: +#++:++#++     +#+     +#+ +:+ +#+ 
						   +#+ +#+     +#+ +#+    +#+     +#+     +#+  +#+#+# 
					#+#    #+# #+#     #+# #+#    #+#     #+#     #+#   #+#+# 
					 ########  ###     ### ###    ### ########### ###    #### 



-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-language" content="de">
	<title>IYS-CMS Logs</title>
 </head>
 <body>
<?php
if(isset($_SESSION['logs'])){

if(isset($_GET['unlink'])){
	if(file_exists($_GET['unlink'])){
	unlink($_GET['unlink']);
	}
}elseif(isset($_GET['logout'])){
	session_destroy();
	die('<script type="text/javascript">window.location.href=window.location.pathname</script>');
	exit;
}
echo '<hr><blockquote><a href="?logout" title="ausloggen" onclick="if(confirm(\'Willst du ausloggen?\')==true){return true;}else{return false}">[Ausloggen]</a></blockquote><hr>';
 $files = glob('*.txt');
usort($files, function($a, $b) {
    return strcmp($b, $a);
});

foreach($files as $file){
echo '<hr><blockquote><a href="?unlink='.$file.'" title="löschen" onclick="if(confirm(\'Willst du den Log wirklich löschen?\')==true){return true;}else{return false}">[Löschen]</a> <a href="'.$file.'" target="_blank" title="'.$file.'">'.$file.'</a></blockquote><hr>';
}
}else{
	if(isset($_POST['einloggen'])){
		if(isset($_POST['name']) && isset($_POST['pswd']) && $_POST['name'] == 'admin' && $_POST['pswd'] == 'iyscms44809'){
			$_SESSION['logs'] = '1';
			echo '<script type="text/javascript">window.location.href=window.location.pathname</script>';
		}
		
	}
	echo '<center><form action="index.php" method="post" id="form_2">
	<label for="name">Benutzername</label> 
	<input type="text" id="name" name="name" maxlength="30"> 
	<label for="pswd">Passwort</label> 
	<input type="password" id="pswd" name="pswd" maxlength="40"> 
	<input type="submit" name="einloggen" id="einloggen" value="Einloggen">
	</form></center>';
}
?>
</body>
</html>