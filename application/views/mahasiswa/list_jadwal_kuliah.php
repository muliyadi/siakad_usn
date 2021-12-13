 <div class="panel panel-primary">
<div class="panel-heading">Jadwal Kuliah</div>
<div class="panel-body">
        <table class="table table-bordered table-hover">
            <thead>
                <th>
                    Hari / Jam 
                </th>
                <th>
                    Matakuliah / SKS 
                </th>
                <th>Kelas</th>
                <th>Dosen Pengampu</th>
                 <th>GROUP</th>
                
            </thead>
            <tbody>
<?php
	$tot=0;
    foreach ($jadwalkuliah as $datax) {
    ?>
    <tr>
        <td><?php echo $datax['hari'].'/'.$datax['jam']?></td>
       
        <td><?php echo $datax['nm_mtk'].'/'.$datax['sks']?></td>
         <td><?php echo $datax['kelas']?></td>
        <td><?php echo $datax['dosen']?></td>
        <td><?php if($datax['group_wa'])
        {
            ?>
             <a class="btn btn-info btn-xs" href="<?php echo $datax['group_wa']?>">GABUNG </a>
        <?php
        }?>
           
            </td>
    </tr>
    
    <?php
    }
    ?>
            </tbody>
        </table>
        </div>
        </div>