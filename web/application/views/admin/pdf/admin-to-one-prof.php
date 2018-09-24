<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Exportation</title>
</head>
<body>
	<table>
		<tr>
			<td align="left"><img style="width:150px" src="<?= base_url() ?>assets/img/logo.png"></td>
			<?php if(!empty($logoEcole)): ?>
				<td align="right"><img style="width:70px;max-height: 80px;" src="<?= base_url() ?>assets/upload/<?= $logoEcole ?>"></td>
			<?php endif; ?>
		</tr>
		
	</table>
	<h3 style="text-align: center;margin-bottom: 60px;">Historique des messages d'administration à <?php echo $title; ?></h3> 
 	<table>	
		<?php foreach ($Messages as $key => $Message):?>
		 	<tr>
				<td style="border-bottom: 1px dotted #eee"><br><br>
				<strong style="margin-top: 10px;">Date: </strong><?= date("d/m/Y", $Message->time) ?><br>
				<strong>Message:</strong><br>
				<?php $dirImage = ($Message->typeFile != 'notImage') ? 'android/' : '' ?>
				<?= str_replace('dir="rtl"', 'align="right"', $Message->content)?><?php if(!empty($Message->file)): ?><br><strong>Pièce jointe:</strong> <a href="<?= base_url() ?>assets/upload/<?= $dirImage.$Message->file ?>" target="_blank" style="text-decoration: none;">[<?= $Message->file ?>]</a><?php endif; ?>
				<br></td>
			</tr>

		<?php endforeach; ?>
	</table>
</body>
</html>  
<?php  
	$html = ob_get_clean();
	$pdf->SetFont('dejavusans', '', 10);
	$pdf->WriteHTML($html, true, 0, true, 0);
	$pdf->Output('Envois-administration-a-'.$title.'.pdf', 'D');
	
?>