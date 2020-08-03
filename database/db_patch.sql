ALTER TABLE `tb_pembelian_detail`  ADD `detail_tanggal_faktur` DATE NULL  AFTER `detail_id_transaksi`;
ALTER TABLE `tb_pembelian_temp`  ADD `temp_tanggal_faktur` DATE NULL  AFTER `temp_faktur`;