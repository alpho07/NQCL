<html>
	<script type="text/javascript" charset="utf-8" src="<?php echo base_url()."javascripts/DataTables-1.9.3/media/js/jquery.dataTables.js"?>"></script>
	

<legend><a href="<?php echo base_url(); ?>" >Home</a></legend>
<hr />

<div class="rightside">

</div>



<div>
	<table id="tests2" class="sample_listing">
	<thead>
		<tr id="samples_l_th">
			<th><a id="lab_r" href="#" >Lab Reference Number</a></th>
			
		</tr>
	</thead>
	<tbody>	
		 <?php for($i=0; $i<count($samples); $i++){?>
                <tr>
                    <td class="green_bold"><a href='<?php echo site_url() . "sample_requests/samples/" . $samples[$i]->labref."/".$samples[$i]->repeat_status ."/".$samples[$i]->component_no; ?>'><?php echo $samples[$i]->labref . " Test ".$samples[$i]->repeat_status; ?></a>
                <?php  }  ?>
		    </td>
                </tr>
		</tbody>
	</table>	
</div>
	<script>
	$(document).ready(function() {
    $('#tests2').dataTable({
    	"bJQueryUI": true,
    	"asStripClasses": null
        
    });
		} );
	</script>
	
	
	
</html>