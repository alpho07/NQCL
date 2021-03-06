<html>
    <script>
        $(document).ready(function() {
            var success1 = $(".success");
            var error1 = $(".error");
            var selecterror = $(".selecterror");
            success1.hide();
            error1.hide();
            selecterror.hide()
        });
    </script>
    <style type="text/css">
        .success{
            background-color: greenyellow;
            display: none;
            width:100%;
            height: 20px;
            border-radius: 5px;
            color:black;
            text-align: center;
            padding-top: 10px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
            z-index: 100;
            opacity: .9;

        }

        .error{
            display: none;
            background-color: red;
            width:100%;
            height: 20px;
            border-radius: 5px;
            color:white;
            text-align: center;
            padding-top: 10px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
        }
        .selecterror{
            background-color: red;
            width:100%;            
            border-radius: 3px;
            color:white;
            display: none;
            text-align: center;
            padding-top: 1px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
        }
        .data{
            display: none;
        }


    </style>

    <div class ="content">

<legend><a href="<?php echo site_url() ."documentation/home/"; ?>">Analyzed Samples</a>&nbsp;||&nbsp;<a href="<?php echo site_url() ."documentation/reviewed/"; ?>">Reviewed Samples&nbsp;||&nbsp;<a href="<?php echo site_url() ."documentation/fromDirector/"; ?>">Samples From The Director </a></legend>        <div>&nbsp;</div>
        <div class="success">Success: Worksheet was successfully sent to the deputy director</div>
        <div class="error">Error: Worksheet could not be sent to the Director, Please try again later!</div>
        <div class="content4">
            <table id = "refsubs">
                <thead>
                    <tr>
                        <th>Labreference (.xlsx)</th>
                        
                        <th></th>
                         <th>Reviewer Name</th>
                         <th>Time and Date of completion</th>                       
                         <th>COA Status</th>
                         <th>COA Action</th>
                        <th>Next Task...</th>   
                        <th>Priority</th>

                       
                        
                    </tr>
                </thead>
                <tbody class="tablebody">


                    <?php foreach ($documentation_data as $sheets) : ?>	

                        <tr>
                            <td><?php echo $sheets->labref ?></td>

                            <td  class="bold assign" ><strong><em><?php echo $sheets->labref ?></em></td>

                            <td><?php echo $sheets->reviewer_name ?></td>

                            <td><?php echo $sheets->time_rev_finished ?></td>
                            <?php if($sheets->coa_status=='0'){?>
                            <td style="background: red; color: white; font-weight: bold">Not Drafted &nbsp; | &nbsp; <?php echo anchor('reviewer_uploads/'. $sheets->labref.".xlsx",'Download Worksheet');?></td>
                            <td><?php echo anchor('coa/generateCoa/' . $sheets->labref, 'Draft') ?></td>
                            <td style="background: red; color: white; font-weight: bold">Draft COA First</td>
                            <?php }else{?>
                              <td <td style="background: greenyellow; color: black; font-weight: bold">Drafted &nbsp; | &nbsp; <?php echo anchor('reviewer_uploads/'. $sheets->labref.".xlsx",'Download Worksheet');?></td>></td> 
                               <td><?php echo anchor('coa/generateCoa/' . $sheets->labref, 'Update COA') ?></td>
                            <td><a class="inline1" href="#data" id="<?php echo $sheets->labref; ?>" >Submit Worksheet & Draft COA</a><input type="hidden" id="labref_no" /></td>
                         
                                <?php } ?>
                            <?php if($sheets->priority==='1'){?>
                     <td><span id="high">High</span></td>
                     <?php }else{?>
                      <td><span id="low">Low</span></td>    
                     <?php }?>
                           
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <div id="data">
            <form id="popup" >
                <div class="selecterror">Please select a Director first!</div>
                <table>
                    <tr>
                        <th>Director Name </th> 
                    </tr>
                    <tr><td>
                            <label><?php echo $sheets->labref; ?></label>
                            <select name="director" required id="reviewer">
                                <option value="" selected="selected">--Select Director--</option>              
                                   
                            </select>
                        </td>
                        <td>

                            <input type="button" value="Assign" id="assign_button1" class="submit-button"/> 
                        </td>
                    </tr>


                </table>
            </form>
        </div>

        <!--div id ="showreviewer">Choose Reviewer</div-->
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.css" media="screen" />
       

        <script type="text/javascript">


            var $lmtable = $('#refsubs').dataTable({
                "bJQueryUI": true,
                "bRetrieve": true
            }).rowGrouping({
                iGroupingColumnIndex: 1,
                sGroupingColumnSortDirection: "asc",
                iGroupingOrderByColumnIndex: 1,
                //bExpandableGrouping:true,
                //bExpandSingleGroup: true,
                iExpandGroupOffset: -1

            });

            $(document).ready(function() {
                $('#data').hide();
                $(".inline1").fancybox({
           

                });
            });

    $('.inline1').click(function(){
      labref = $(this).attr('id');
      console.log(labref);
     $('#labref_no').val(labref)
 
    });

            $(document).ready(function() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>assign_director/getAJAXDirectors/",
                    dataType: "JSON",
                    success: function(reviewers)
                    {

                        $.each(reviewers, function(id, city)
                        {
                            var opt = $('<option />'); // here we're creating a new select option for each group
                            opt.val(city.id);
                            opt.text(city.alias);
                            $('#reviewer').append(opt);
                        });
                    }

                });

                $('#assign_button1').click(function() {
                    var rev = $('#reviewer').val();
                    if (rev == '') {
                        $('div.selecterror').slideDown('slow').animate({opacity: 1.0}, 3000).slideUp('slow');
                        return true;
                    } else {


                       var labref = $('#labref_no').val();
                        var data1 = $('#popup').serialize();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>assign_director/sendSamplesFolderToDirector/" + labref,
                            data: data1,
                            success: function(data)
                            {

                                // var content=$('.refsubs');
                                $('div.success').slideDown('slow').animate({opacity: 1.0}, 2000).slideUp('slow');
                                $.fancybox.close();


                                setTimeout(function() {
                                    window.location.href = '<?php echo base_url(); ?>documentation/reviewed';
                                }, 3000);

                                return true;
                            },
                            error: function(data) {
                                $('div.error').slideDown('slow').animate({opacity: 1.0}, 5000).slideUp('slow');
                                $.fancybox.close();


                                return false;
                            }
                        });
                        return false;
                    }
                });

            });

        </script>


    </script>
</html>