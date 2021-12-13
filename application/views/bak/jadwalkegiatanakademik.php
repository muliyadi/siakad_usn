<!-- Main content -->
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>JADWAL KEGIATAN AKADEMIK</h3>
</div >
<div class="panel-body">
<form action="<?php echo base_url();?>Bak/aja" method="post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<table class='table table-bordered'>
		<tr><td>KODE TAHUN AJARAN <?php echo form_error('kd_tahun_ajaran') ?></td>
			<td><input type="text"  class="form-control" name="kd_tahun_ajaran" id="kd_tahun_ajaran" placeholder="kd_tahun_ajaran" value="<?php echo $kd_tahun_ajaran; ?>" /></td>
		
		<tr><td>KODE KEGIATAN <?php echo form_error('kd_kegiatan') ?></td>
			<td><input type="text" data-toggle="modal" data-target="#myModalkegiatan" autofocus="true" class="form-control" name="kd_kegiatan" id="kd_kegiatan" placeholder="kd_kegiatan" value="<?php echo $kd_kegiatan; ?>" /></td>
		<tr><td>DARI TANGGAL <?php echo form_error('dari_tanggal') ?></td>
			<td><input type="text" autofocus="true" class="form-control" name="dari_tanggal" id="dari_tanggal" placeholder="dari_tanggal" value="<?php echo $dari_tanggal; ?>"  />
            </td>
		</tr>
				<tr><td>SAMPAI TANGGAL <?php echo form_error('sampai_tanggal') ?></td>
			<td><input type="text" autofocus="true" class="form-control" name="sampai_tanggal" id="sampai_tanggal" placeholder="sampai_tanggal" value="<?php echo $sampai_tanggal; ?>"  />
            </td>
		</tr>
        <tr><td>STATUS AKTIF<?php echo form_error('aktif') ?></td>
			<td><select name="aktif" class="form-control">
                    <?php
                        if($aktif=="YA")
                        {
                            ?>
                            <option value="YA" selected="selected">YA</option>
                            <option value="TIDAK">TIDAK</option>
                            <?php
                        }
                        else if($aktif=="TIDAK")
                        {
                            ?>
                            <option value="YA">YA</option>
                            <option value="TIDAK" selected="selected">TIDAK</option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="-" selected="selected">- Pilih -</option>
                            <option value="YA">YA</option>
                            <option value="TIDAK">TIDAK</option>
                            <?php
                        }
                    ?>
                </select></td>
		<tr><td colspan='2'><button type="submit" class="btn btn-primary">Simpan</button> 
				<a href="<?php base_url() ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</form>
</div >
</div >
 <!-- Modal -->
                <div class="modal fade " id="myModalkegiatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:600px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">KEGIATAN AKADEMIK></h4>
                            </div>
                            <div class="modal-body">
                                <table id="lookup" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>KODE</th>
                                            <th>NAMA KEGIATAN</th>
                                            <th>DESKRIPSI</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($listkegiatan as $rka) {
                                            ?>
                                            <tr>
                                                <td class="tkd_kegiatan"><?php echo $rka->kd_kegiatan; ?></td>
                                                <td class="tnm_kegiatan"><?php echo $rka->nm_kegiatan; ?></td>
                                                <td class="tdeskripsi"><?php echo $rka->deskripsi; ?></td>
                                               <td><button id="pilih" class="btn btn-small btn-primary pilih">Pilih</button></td> 
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>
                </div>
                <!--batas akhir modal -->
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">

//            jika dipilih, kode obat akan masuk ke input dan modal di tutup
$("#lookup").on('click', '.pilih', function(e) {
    var currentRow = $(this).closest("tr");
    document.getElementById("kd_kegiatan").value = currentRow.find(".tkd_kegiatan").html();
    $('#myModalkegiatan').modal('hide');
});

  $('#lookup').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });

  $(function() {
                        $("#dari_tanggal").datepicker({
                            format:"yyyy-mm-dd",
                            todayHightLight:true,    
                            todayBtn:true
                        })});

        $(function() {
                        $("#sampai_tanggal").datepicker({
                            format:"yyyy-mm-dd",
                            todayHightLight:true,    
                            todayBtn:true
                        });
                    });
</script>

                        
 