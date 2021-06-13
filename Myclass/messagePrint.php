<?php 

$false = '';
$true = '';

if ($msg != '' && $isError == false) {
$false = 'bg-success';
}

if ($msg != '' && $isError == true) {
$false = 'bg-danger';
}

 ?>

<div>

<div class="col-md-12 text-white <?php echo $true . $false ?> msg my-2">
	<?php echo $msg; ?>
</div>


	
</div>