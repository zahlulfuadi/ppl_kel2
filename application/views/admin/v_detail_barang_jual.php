					<?php
					error_reporting(0);
					$b = $brg->row_array();
					?>
					<table>
						<tr>
							<th>Nama Barang</th>
							<th>Satuan</th>
							<?php if ($b['nama_barang'] != "") { ?>
								<th>Stok</th>
								<th>Harga(Rp)</th>
								<th>Diskon(Rp)</th>
								<th>Jumlah</th>
							<?php } ?>
						</tr>
						<tr>
							<td><input type="text" name="nabar" value="<?php echo ($b['nama_barang'] != "") ? $b['nama_barang'] : "-"; ?>" style="width:300px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<td><input type="text" name="satuan" value="<?php echo ($b['satuan_barang'] != "") ? $b['satuan_barang'] : "-"; ?>" style="width:120px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<?php if ($b['nama_barang'] != "") { ?>
								<td><input type="text" name="stok" value="<?php echo $b['stok']; ?>" style="width:60px;margin-right:5px;" class="form-control input-sm" readonly></td>
								<td><input type="text" name="harjul" value="<?php echo number_format($b['harga_jual']); ?>" style="width:120px;margin-right:5px;text-align:right;" class="form-control input-sm" readonly></td>
								<td><input type="number" name="diskon" id="diskon" value="0" min="0" class="form-control input-sm" style="width:130px;margin-right:5px;" required></td>
								<td><input type="number" name="qty" id="qty" value="1" min="1" max="<?php echo $b['stok']; ?>" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
								<td><button type="submit" class="btn btn-sm btn-primary">OK</button></td>
							<?php } ?>
						</tr>
					</table>