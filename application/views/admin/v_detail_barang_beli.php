					<?php
					error_reporting(0);
					$b = $brg->row_array();
					?>
					<table>
						<tr>
							<th>Nama Barang</th>
							<th>Satuan</th>
							<?php if ($b['nama_barang'] != "") { ?>
								<th>Harga Pokok</th>
								<th>Harga Jual</th>
								<th>Jumlah</th>
							<?php } ?>
						</tr>
						<tr>
							<td><input type="text" name="nabar" value="<?php echo ($b['nama_barang'] != "") ? $b['nama_barang'] : "-"; ?>" style="width:300px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<td><input type="text" name="satuan" value="<?php echo ($b['satuan_barang'] != "") ? $b['satuan_barang'] : "-"; ?>" style="width:120px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<?php if ($b['nama_barang'] != "") { ?>
								<td><input type="text" name="harpok" value="<?= $b['harga_pokok']; ?>" style="width:130px;margin-right:5px;" class="form-control input-sm" required></td>
								<td><input type="text" name="harjul" value="<?= $b['harga_jual']; ?>" style="width:130px;margin-right:5px;" class="form-control input-sm" required></td>
								<td><input type="text" name="jumlah" id="jumlah" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
								<td><button type="submit" class="btn btn-sm btn-primary">OK</button></td>
							<?php } ?>
						</tr>
					</table>