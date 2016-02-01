
<html>
	<head>
		<style>
			#about {
			  	background: #202024 url('/black-thread.png');
			    position: relative;
			    margin-right: auto;
			    margin-left: auto;
			    width:50%;
			    height: 30%;
			    //margin-top:5%;
			    top:3%;
			    float:center;
			    border-radius:10px;
			    font-family:raleway;
			    border:2px solid #ccc;
			    padding:10px 50px 30px;
			    overflow: auto;
			}
			#main {
				background: #202024 url('/black-thread.png');
			   	height: 100vh;
			    -webkit-background-size: cover;
			    -moz-background-size: cover;
			    -o-background-size: cover;
			    background-repeat:repeat;
			    background-size:cover;
			    position: relative;
			    font-family:raleway;
			}
			p {				
				word-wrap: break-word;
				white-space: normal;
				font-family: Tahoma, sans-serif;
			    color:white;
			    font-size: 16px;
			    text-align: justify;
			}
			footer {
			    color: #fff;
			}
			footer .footer-below {
			    padding: 25px 0;
			    background-color: #233140;
			    font-size: 16px;
			}
		</style>
	</head>
	<body>
		<div id="main">
			<div align="center">
				<form method='post' id='userform' action='index.php'>
					<textarea name="text" placeholder="Text" rows="10" cols="45"></textarea><br /> 
					<input type='submit' class='buttons' name='sub' value="Encrypt">
					<input type='submit' class='buttons' name='bus' value="Decrypt">
				</form>
			</div>
		<div id="about">
			<?php
				function multiexplode ($delimiters,$string) {
			    	$ready = str_replace($delimiters, $delimiters[0], $string);
			    	$launch = explode($delimiters[0], $ready);
			    	return  $launch;
				}
				
				$letter=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','Y','Z','W','Q','0','1','2','3','4','5','6','7','8','9',':',';','(',')','X',' ','.','?',',','!','-');//46
				//$encryp=array('A','C','H','B','W','D','F','G','I','K','N','P','T','Y','0','3','7',';','E','1','4','6','Z','5','2','R','V','U','J','L','Q','S','M','(','O','8',')','9',':','X','&','~','`','<','>','/');
				
				//file_put_contents("path.txt", implode(",", $encryp) , FILE_APPEND);

				$myfile = fopen("path.txt", "r") or die("Unable to open file!");
				$encryp = explode(",",fgets($myfile));
				fclose($myfile);
				
				//$myfile = fopen("time.txt", "w") or die("Unable to open file!");
				//$txt = date("Ymd");
				//fwrite($myfile, $txt);
				//fclose($myfile);

				$myfile = fopen("time.txt", "r") or die("Unable to open file!");
				$time = fgets($myfile);
				fclose($myfile);

				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				$query  = "SELECT NOW() as `now`";
				$result = $mysqli->query($query);
				$row    = $result->fetch_array();
				$now    = $row['now'];
				$old_date_timestamp = strtotime($now);
				$new_date = date('Ymd', $old_date_timestamp);

				if($time!=$new_date){
					foreach ($encryp as $key => $value) {
						if($key < 35){
							$a = $key + 11;
						}
						else{
							$a = $key - 35;
						}
						$en[$a] = $encryp[$key];
					}
					$myfile = fopen("time.txt", "w") or die("Unable to open file!");
					fwrite($myfile, $new_date);
					fclose($myfile);

					$encryp = $en;
					ksort($encryp);

					$myfile = fopen("path.txt", "w") or die("Unable to open file!");
					$txt = implode(",", $encryp);
					fwrite($myfile, $txt);
					fclose($myfile);
				}
				if (isset($_POST['sub'])) {
					$text = strtoupper($_POST['text']);
					$seperatedText = explode(" ",$text);
					echo '<p>';
					foreach ($seperatedText as $key => $value) {
						for ($i=0; $i < strlen($value); $i++) { 
							$a = $value[$i];
							$letterKey = array_search($a, $letter);
							$chr = $encryp[$letterKey];
							$value[$i] = $chr;
							$c = ord($value[$i]);
							$d = decbin($c);
							if ($i<strlen($value) -1 ) {
								echo $d . '&';
							}
							else
								echo $d;
						}
						if($key<sizeof($seperatedText) - 1)
							echo "&`&";					
					}
					echo '</p>';
				}
				else if(isset($_POST['bus'])) {
					$text = strtoupper($_POST['text']);
					$seperatedText = multiexplode(array("&"),$text);
					echo '<p>';
					foreach ($seperatedText as $key => $value) {
						if($value != '`'){
							$as = bindec($value);
							$s = chr($as);
							for ($i=0; $i < strlen($s); $i++) { 
								$a = $s[$i];
								$letterKey = array_search($a, $encryp);
								$chr = $letter[$letterKey];
								$s[$i] = $chr;
							}
							echo $s;
						}
						else
							echo '&nbsp';		
					}
					echo '</p>';
				}
				echo '</div>';
				/*
				<footer class="text-center">
			        <div class="footer-below">
			            <div class="container">
			                <div class="row">
			                    <div style="text-align:center">
			                        Copyright &copy; Berk Cetinsaya & Furkan Sayin 2016
			                    </div>
			                </div>
			            </div>
			        </div>
			    </footer>*/
			?>
		</div>
	</body>
</html>
