<!DOCTYPE html>
<html>
<head>
  <title>Report Pembelian</title>
  <style type="text/css">
    #outtable{
      padding: 20px;
      border:1px solid #e3e3e3;
      width:600px;
      border-radius: 5px;
    }
 
    .short{
      width: 50px;
    }
 
    .normal{
      width: 150px;
    }
 
    table{
      border-collapse: collapse;
      font-family: arial;
      color:#5E5B5C;
    }
 
    thead th{
      text-align: left;
      padding: 10px;
    }
 
    tbody td{
      border-top: 1px solid #e3e3e3;
      padding: 10px;
    }
 
    tbody tr:nth-child(even){
      background: #F6F5FA;
    }
 
    tbody tr:hover{
      background: #EAE9F5
    }
  </style>
</head>
<body>
	<div id="outtable">
  <h3 align="center">Report Penjualan</h3> 
    <h5>ID Transaksi : <?=$penjualans->penjualan_id_transaksi; ?></h5>
    <h5>Tanggal : <?=$penjualans->penjualan_tanggal; ?></h5>
	  <table>
	  	<thead>
	  		<tr>
	  			<th class="short">#</th>
	  			<th class="normal">Nama Obat</th>
	  			<th class="normal">Jumlah</th>
	  			<th class="normal">Subtotal</th>
	  		</tr>
	  	</thead>
	  	<tbody>
      <?php $totalharga = 0; ?>
	  		<?php $no=1; ?>
	  		<?php foreach($details as $detail): ?>
	  		  <tr>
	  			<td><?php echo $no; ?></td>
	  			<td><?php echo $detail->detail_obat ?></td>
      <td><?php echo $detail->detail_jumlah ?></td>
      <td><?php echo $detail->detail_harga ?></td>
	  		  </tr>
          <?php $totalharga += $detail->detail_harga; ?>
	  		<?php $no++; ?>
	  		<?php endforeach; ?>
        <tr>
        <td colspan="4" style="text-align:right;">Total : <?= "Rp " . number_format($totalharga,2,',','.'); ?></td>
        </tr>
	  	</tbody>
	  </table>
	 </div>
</body>
</html>