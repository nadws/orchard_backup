<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
<br>
<center>
	<p><strong>LIST APPOINTMENT <?= date('d-M-Y', strtotime($tgl1)); ?> - <?= date('d-M-Y', strtotime($tgl2)); ?></strong></p>
</center>
<table class="table text-center" width="100%">
	<thead class="thead-light" >
		<tr >
            <th>Tanggal</th>
			<th>Costumer</th>
			<th>Therapist</th>
            <th>Service</th>
            <th>Jam mulai</th>
            <th>Jam selesai</th>
		</tr>
	</thead>
	
	<tbody>
    <?php foreach($d_order_all as $d): ?>
    <tr>
        <td><?= date('d-M-Y', strtotime($d->tanggal)); ?></td>
        <td><?= $d->nama; ?></td>
        <td><?= $d->nama_t; ?></td>
        <td><?= $d->nm_servis; ?></td>
        <td><?= $d->start; ?></td>
        <td><?= $d->end; ?></td>
    </tr>
    <?php endforeach; ?>    
	</tbody>
</table>



</body>
</html>