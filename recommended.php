<?php
	$pics = array('Pictures/worldh.jpg', 'Pictures/telecom.jpg', 'Pictures/love.jpg', 'Pictures/infl.jpg',
	'Pictures/genetics.jpg','Pictures/friends.jpg', 'Pictures/engen.jpg', 'Pictures/art.jpg','Pictures/art1.jpg', 'Pictures/anatomy.jpg');
	shuffle($pics); //funkcija koja izmesa slike u nizu slike
?>
<hr>
	<center><h3>Recommended for you</h3>
		<table width="100%" cellspacing="3" cellpadding="3">
			<tr>
				<?php
					for($i = 0; $i < count($pics) / 2; $i++) {
						echo '<td align="center"><img src="';
						echo $pics[$i];
						echo '"width="140"></td>';
					}
				?>
			</tr>
			<tr>
				<hr>
					<?php
						for($i = count($pics) / 2; $i < count($pics); $i++){
							echo '<td align="center"><img src="';
							echo $pics[$i];
							echo '"width="140"></td>';
						}
					?>
			</tr>
		</table>
	</center>
		<hr>
