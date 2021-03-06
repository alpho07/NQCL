<?php

class Uniformity extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('testing');
    }
    function worksheet($labref){
    
        $rawform=  $this->justBringDosageForm($labref);
        $dosageForm=$rawform[0]->dosage_form;
        if($dosageForm=="2"){
            $this->capsules();
        }else if($dosageForm=="1"){
            $this->tabs();
        }
        }
    
   

    public function capsules() {
        $data = array();


        $id = $this->uri->segment(4);
        $uri = $this->uri->segment(3);
        $fulluri = $uri . '/' . $id;
        $data['labrefuri'] = $fulluri;
        $data['labref'] = $uri;
        $data['repeat_no']= $this->getDoStatus();
        $data['test_id'] = $this->uri->segment(7);
        $data['settings_view'] = "uniformity_v";
        $data['lastworksheet'] = $this->getWorksheet() + 1;




        $this->base_params($data);

        //echo $GLOBALS['labref'];
    }

    public function getWorksheet() {
        $res = mysql_query("SELECT MAX(id) AS lastId FROM worksheets");
        while ($row = mysql_fetch_assoc($res)) {
            $lastId = $row['lastId'];
        }
        return $lastId;
    }
    function getDoStatus(){
        $labref=  $this->uri->segment(3);
        $test_id=  $this->uri->segment(4);
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->where('lab_ref_no',$labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id',$analyst_id);
        $query=  $this->db->get('sample_issuance')->result();
        return $result=$query[0]->do_count;     
        
    }

    function updateSampleIssuance(){
        $do_status=  $this->getDoStatus()+'1';
        $labref=  $this->uri->segment(3);
        $test_id=  $this->uri->segment(4);
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->where('lab_ref_no',$labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id',$analyst_id);
        $this->db->update('sample_issuance',array('do_count'=>$do_status));
    }
    public function save_capsule_weights() {
        if($this->getDoStatus()>1){  
            echo 'You have reached sample test limit, This test is marked as an OOS sample now';
        }else{
            $this->updateSampleIssuance();
            $labref = $this->uri->segment(3);
            $max_row_id = $this->getUniformityTestRepeatStatus($labref);
            (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
            $analyst_id = $this->session->userdata('user_id');

            $tcsv1 = $this->input->post('tcsv1');
            $ecsv1 = $this->input->post('ecsv1');
            $csvc1 = $this->input->post('csvc1');
            $dfm1 = $this->input->post('dfm1');

            $tcsv2 = $this->input->post('tcsv2');
            $ecsv2 = $this->input->post('ecsv2');
            $csvc2 = $this->input->post('csvc2');
            $dfm2 = $this->input->post('dfm2');

            $tcsv3 = $this->input->post('tcsv3');
            $ecsv3 = $this->input->post('ecsv3');
            $csvc3 = $this->input->post('csvc3');
            $dfm3 = $this->input->post('dfm3');

            $tcsv4 = $this->input->post('tcsv4');
            $ecsv4 = $this->input->post('ecsv4');
            $csvc4 = $this->input->post('csvc4');
            $dfm4 = $this->input->post('dfm4');

            $tcsv5 = $this->input->post('tcsv5');
            $ecsv5 = $this->input->post('ecsv5');
            $csvc5 = $this->input->post('csvc5');
            $dfm5 = $this->input->post('dfm5');

            $tcsv6 = $this->input->post('tcsv6');
            $ecsv6 = $this->input->post('ecsv6');
            $csvc6 = $this->input->post('csvc6');
            $dfm6 = $this->input->post('dfm6');

            $tcsv7 = $this->input->post('tcsv7');
            $ecsv7 = $this->input->post('ecsv7');
            $csvc7 = $this->input->post('csvc7');
            $dfm7 = $this->input->post('dfm7');

            $tcsv8 = $this->input->post('tcsv8');
            $ecsv8 = $this->input->post('ecsv8');
            $csvc8 = $this->input->post('csvc8');
            $dfm8 = $this->input->post('dfm8');

            $tcsv9 = $this->input->post('tcsv9');
            $ecsv9 = $this->input->post('ecsv9');
            $csvc9 = $this->input->post('csvc9');
            $dfm9 = $this->input->post('dfm9');

            $tcsv10 = $this->input->post('tcsv10');
            $ecsv10 = $this->input->post('ecsv10');
            $csvc10 = $this->input->post('csvc10');
            $dfm10 = $this->input->post('dfm10');

            $tcsv11 = $this->input->post('tcsv11');
            $ecsv11 = $this->input->post('ecsv11');
            $csvc11 = $this->input->post('csvc11');
            $dfm11 = $this->input->post('dfm11');

            $tcsv12 = $this->input->post('tcsv12');
            $ecsv12 = $this->input->post('ecsv12');
            $csvc12 = $this->input->post('csvc12');
            $dfm12 = $this->input->post('dfm12');

            $tcsv13 = $this->input->post('tcsv13');
            $ecsv13 = $this->input->post('ecsv13');
            $csvc13 = $this->input->post('csvc13');
            $dfm13 = $this->input->post('dfm13');

            $tcsv14 = $this->input->post('tcsv14');
            $ecsv14 = $this->input->post('ecsv14');
            $csvc14 = $this->input->post('csvc14');
            $dfm14 = $this->input->post('dfm14');

            $tcsv15 = $this->input->post('tcsv15');
            $ecsv15 = $this->input->post('ecsv15');
            $csvc15 = $this->input->post('csvc15');
            $dfm15 = $this->input->post('dfm15');

            $tcsv16 = $this->input->post('tcsv16');
            $ecsv16 = $this->input->post('ecsv16');
            $csvc16 = $this->input->post('csvc16');
            $dfm16 = $this->input->post('dfm16');

            $tcsv17 = $this->input->post('tcsv17');
            $ecsv17 = $this->input->post('ecsv17');
            $csvc17 = $this->input->post('csvc17');
            $dfm17 = $this->input->post('dfm17');

            $tcsv18 = $this->input->post('tcsv18');
            $ecsv18 = $this->input->post('ecsv18');
            $csvc18 = $this->input->post('csvc18');
            $dfm18 = $this->input->post('dfm18');

            $tcsv19 = $this->input->post('tcsv19');
            $ecsv19 = $this->input->post('ecsv19');
            $csvc19 = $this->input->post('csvc19');
            $dfm19 = $this->input->post('dfm19');

            $tcsv20 = $this->input->post('tcsv20');
            $ecsv20 = $this->input->post('ecsv20');
            $csvc20 = $this->input->post('csvc20');
            $dfm20 = $this->input->post('dfm20');

            $comment = $this->input->post('comment');



            


            $array = array(
                0 => array('labref' => $labref, 'tcsv' => $tcsv1, 'ecsv' => $ecsv1, 'csvc' => $csvc1, 'percent_deviation' => $dfm1,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 1 => array('labref' => $labref, 'tcsv' => $tcsv2, 'ecsv' => $ecsv2, 'csvc' => $csvc2, 'percent_deviation' => $dfm2,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 2 => array('labref' => $labref, 'tcsv' => $tcsv3, 'ecsv' => $ecsv3, 'csvc' => $csvc3, 'percent_deviation' => $dfm3,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 3 => array('labref' => $labref, 'tcsv' => $tcsv4, 'ecsv' => $ecsv4, 'csvc' => $csvc4, 'percent_deviation' => $dfm4,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 4 => array('labref' => $labref, 'tcsv' => $tcsv5, 'ecsv' => $ecsv5, 'csvc' => $csvc5, 'percent_deviation' => $dfm5,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 5 => array('labref' => $labref, 'tcsv' => $tcsv6, 'ecsv' => $ecsv6, 'csvc' => $csvc6, 'percent_deviation' => $dfm6,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 6 => array('labref' => $labref, 'tcsv' => $tcsv7, 'ecsv' => $ecsv7, 'csvc' => $csvc7, 'percent_deviation' => $dfm7,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 7 => array('labref' => $labref, 'tcsv' => $tcsv8, 'ecsv' => $ecsv8, 'csvc' => $csvc8, 'percent_deviation' => $dfm8,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 8 => array('labref' => $labref, 'tcsv' => $tcsv9, 'ecsv' => $ecsv9, 'csvc' => $csvc9, 'percent_deviation' => $dfm9, 'r_status'=>$new_status,'analyst_id' => $analyst_id)
                , 9 => array('labref' => $labref, 'tcsv' => $tcsv10, 'ecsv' => $ecsv10, 'csvc' => $csvc10, 'percent_deviation' => $dfm10,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 10 => array('labref' => $labref, 'tcsv' => $tcsv11, 'ecsv' => $ecsv11, 'csvc' => $csvc11, 'percent_deviation' => $dfm11,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 11 => array('labref' => $labref, 'tcsv' => $tcsv12, 'ecsv' => $ecsv12, 'csvc' => $csvc12, 'percent_deviation' => $dfm12,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 12 => array('labref' => $labref, 'tcsv' => $tcsv13, 'ecsv' => $ecsv13, 'csvc' => $csvc13, 'percent_deviation' => $dfm13,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 13 => array('labref' => $labref, 'tcsv' => $tcsv14, 'ecsv' => $ecsv14, 'csvc' => $csvc14, 'percent_deviation' => $dfm14,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 14 => array('labref' => $labref, 'tcsv' => $tcsv15, 'ecsv' => $ecsv15, 'csvc' => $csvc15, 'percent_deviation' => $dfm15,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 15 => array('labref' => $labref, 'tcsv' => $tcsv16, 'ecsv' => $ecsv16, 'csvc' => $csvc16, 'percent_deviation' => $dfm16,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 16 => array('labref' => $labref, 'tcsv' => $tcsv17, 'ecsv' => $ecsv17, 'csvc' => $csvc17, 'percent_deviation' => $dfm17,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 17 => array('labref' => $labref, 'tcsv' => $tcsv18, 'ecsv' => $ecsv18, 'csvc' => $csvc18, 'percent_deviation' => $dfm18,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 18 => array('labref' => $labref, 'tcsv' => $tcsv19, 'ecsv' => $ecsv19, 'csvc' => $csvc19, 'percent_deviation' => $dfm19,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
                , 19 => array('labref' => $labref, 'tcsv' => $tcsv20, 'ecsv' => $ecsv20, 'csvc' => $csvc20, 'percent_deviation' => $dfm20,'r_status'=>$new_status, 'analyst_id' => $analyst_id)
            );

           
            //print_r($array);
                  foreach($array as $v){
                      $this->db->insert('weight_uniformity',$v);
                       
  /* $sql = "INSERT INTO uniformity_status (`labref`,`tcsv`,`ecsv`,`csvc`,`percent_deviation`,`r_status`,`analyst_id`)
   value
   ('{$v['labref']}','{$v['tcsv']}','{$v['ecsv']}','{$v['csvc']}','{$v['percent_deviation']}','{$v['r_status']}','{$v['analyst_id']}')";
    //execute $sql here or it will overwrite on loop
   $k=mysql_query($sql);*/
    }
    
      
            
            $this->save_totalaverage_weights();
            $this->updateTestIssuanceStatus();
            $this->updateSampleSummary();
            //$sql1 = "UPDATE worksheets SET comment='$comment' WHERE labref='$labref'";
            //$j = mysql_query($sql1);

          

        //redirect('assay/assay_page/' . $labref);
      
        }
    }
    
    
    function updateTestIssuanceStatus(){
       $labref=  $this->uri->segment(3);
       
       $analyst_id=  $this->session->userdata('user_id');
       $done_status ='1';
       $data= array(
         'done_status'=>$done_status  
       );
       $this->db->where('lab_ref_no',$labref);
       $this->db->where('test_id',6);
       $this->db->where('analyst_id',$analyst_id);
       $this->db->update('sample_issuance',$data);
       
       $this->comparetToDecide($labref);
    
    }

    public function save_totalaverage_weights() {
        $this->load->database();
        if ($_POST):
            
           
            $labref = $this->uri->segment(3);
            $max_row_id = $this->getUniformityTestRepeatStatus($labref);
            (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
            
            $labref = $this->uri->segment(3);
            $analyst_id = $this->session->userdata('user_id');

            $average_weights = array(
                'labref' => $labref,
                'overall_total' => $overall_total = $this->input->post('utotals'),
                'overall_average' => $this->input->post('uav1'),
                'actual_total' => $this->input->post('totalss2'),
                'actual_average' => $actual_average = $this->input->post('uav3'),
                'cstatus'=> $this->input->post('comment'),
                'analyst_id' => $analyst_id,
                'repeat_status'=>$new_status
            );
            $this->db->insert('weight_caps_ta', $average_weights);
            $this->save_test();

            $average_weights1 = array(
                'labref' => $labref,
                'average' => $actual_average = $this->input->post('uav3'),
                'test_status' => $capsStatus = $this->input->post('capsStatus'),
                'analyst_id' => $analyst_id
            );
            $this->db->insert('caps_tabs_data', $average_weights1);

      $uniformity_status=array(
      'labref'=>$labref,      
      'uniformity_status'=>1 ,
      'test_type'=>'TC',
      'analyst_id'=>$analyst_id
            
       );
       $this->db->insert('uniformity_status',$uniformity_status);

            return false;
        else :
            return true;
        endif;
    }
    
    
    
     public function exportCapsulesToExcel() {
         if($_POST):
            $tcsv1 = $this->input->post('tcsv1');
            $ecsv1 = $this->input->post('ecsv1');
            $csvc1 = $this->input->post('csvc1');
            $dfm1 = $this->input->post('dfm1');

            $tcsv2 = $this->input->post('tcsv2');
            $ecsv2 = $this->input->post('ecsv2');
            $csvc2 = $this->input->post('csvc2');
            $dfm2 = $this->input->post('dfm2');

            $tcsv3 = $this->input->post('tcsv3');
            $ecsv3 = $this->input->post('ecsv3');
            $csvc3 = $this->input->post('csvc3');
            $dfm3 = $this->input->post('dfm3');

            $tcsv4 = $this->input->post('tcsv4');
            $ecsv4 = $this->input->post('ecsv4');
            $csvc4 = $this->input->post('csvc4');
            $dfm4 = $this->input->post('dfm4');

            $tcsv5 = $this->input->post('tcsv5');
            $ecsv5 = $this->input->post('ecsv5');
            $csvc5 = $this->input->post('csvc5');
            $dfm5 = $this->input->post('dfm5');

            $tcsv6 = $this->input->post('tcsv6');
            $ecsv6 = $this->input->post('ecsv6');
            $csvc6 = $this->input->post('csvc6');
            $dfm6 = $this->input->post('dfm6');

            $tcsv7 = $this->input->post('tcsv7');
            $ecsv7 = $this->input->post('ecsv7');
            $csvc7 = $this->input->post('csvc7');
            $dfm7 = $this->input->post('dfm7');

            $tcsv8 = $this->input->post('tcsv8');
            $ecsv8 = $this->input->post('ecsv8');
            $csvc8 = $this->input->post('csvc8');
            $dfm8 = $this->input->post('dfm8');

            $tcsv9 = $this->input->post('tcsv9');
            $ecsv9 = $this->input->post('ecsv9');
            $csvc9 = $this->input->post('csvc9');
            $dfm9 = $this->input->post('dfm9');

            $tcsv10 = $this->input->post('tcsv10');
            $ecsv10 = $this->input->post('ecsv10');
            $csvc10 = $this->input->post('csvc10');
            $dfm10 = $this->input->post('dfm10');

            $tcsv11 = $this->input->post('tcsv11');
            $ecsv11 = $this->input->post('ecsv11');
            $csvc11 = $this->input->post('csvc11');
            $dfm11 = $this->input->post('dfm11');

            $tcsv12 = $this->input->post('tcsv12');
            $ecsv12 = $this->input->post('ecsv12');
            $csvc12 = $this->input->post('csvc12');
            $dfm12 = $this->input->post('dfm12');

            $tcsv13 = $this->input->post('tcsv13');
            $ecsv13 = $this->input->post('ecsv13');
            $csvc13 = $this->input->post('csvc13');
            $dfm13 = $this->input->post('dfm13');

            $tcsv14 = $this->input->post('tcsv14');
            $ecsv14 = $this->input->post('ecsv14');
            $csvc14 = $this->input->post('csvc14');
            $dfm14 = $this->input->post('dfm14');

            $tcsv15 = $this->input->post('tcsv15');
            $ecsv15 = $this->input->post('ecsv15');
            $csvc15 = $this->input->post('csvc15');
            $dfm15 = $this->input->post('dfm15');

            $tcsv16 = $this->input->post('tcsv16');
            $ecsv16 = $this->input->post('ecsv16');
            $csvc16 = $this->input->post('csvc16');
            $dfm16 = $this->input->post('dfm16');

            $tcsv17 = $this->input->post('tcsv17');
            $ecsv17 = $this->input->post('ecsv17');
            $csvc17 = $this->input->post('csvc17');
            $dfm17 = $this->input->post('dfm17');

            $tcsv18 = $this->input->post('tcsv18');
            $ecsv18 = $this->input->post('ecsv18');
            $csvc18 = $this->input->post('csvc18');
            $dfm18 = $this->input->post('dfm18');

            $tcsv19 = $this->input->post('tcsv19');
            $ecsv19 = $this->input->post('ecsv19');
            $csvc19 = $this->input->post('csvc19');
            $dfm19 = $this->input->post('dfm19');

            $tcsv20 = $this->input->post('tcsv20');
            $ecsv20 = $this->input->post('ecsv20');
            $csvc20 = $this->input->post('csvc20');
            $dfm20 = $this->input->post('dfm20');

            $comment = $this->input->post('comment');
            
            $labref=  $this->uri->segment(3);
              // var_dump($_POST);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        //we load the file that we want to read

        $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
             
               $objPHPExcel->getActiveSheet() ;
               $objWorkSheet = $objPHPExcel->createSheet(1);
                              $objWorkSheet ->setCellValue('A22', 'Tablets(mg)') 
                               ->setCellValue('C22', 'Percentage Deviation') 
                               ->setCellValue('A24', $tcsv1) 
                               ->setCellValue('C24', $dfm1) 
                               ->setCellValue('A25', $tcsv2) 
                               ->setCellValue('C25', $dfm2)
                               ->setCellValue('A26', $tcsv3) 
                               ->setCellValue('C26', $dfm3) 
                               ->setCellValue('A27', $tcsv4) 
                               ->setCellValue('C27', $dfm4)
                               ->setCellValue('A28', $tcsv5) 
                               ->setCellValue('C28', $dfm5) 
                               ->setCellValue('A29', $tcsv6) 
                               ->setCellValue('C29', $dfm6)
                               ->setCellValue('A30', $tcsv7) 
                               ->setCellValue('C30', $dfm7) 
                               ->setCellValue('A31', $tcsv8) 
                               ->setCellValue('C31', $dfm8)
                               ->setCellValue('A32', $tcsv9) 
                               ->setCellValue('C32', $dfm9) 
                               ->setCellValue('A33', $tcsv10) 
                               ->setCellValue('C33', $dfm10)
                               ->setCellValue('A34', $tcsv11) 
                               ->setCellValue('C34', $dfm11) 
                               ->setCellValue('A35', $tcsv12) 
                               ->setCellValue('C35', $dfm12) 
                               ->setCellValue('A36', $tcsv13) 
                               ->setCellValue('C36', $dfm13) 
                               ->setCellValue('A37', $tcsv14) 
                               ->setCellValue('C37', $dfm14) 
                               ->setCellValue('A38', $tcsv15) 
                               ->setCellValue('C38', $dfm15) 
                               ->setCellValue('A39', $tcsv16) 
                               ->setCellValue('C39', $dfm16) 
                               ->setCellValue('A40', $tcsv17) 
                               ->setCellValue('C40', $dfm17) 
                               ->setCellValue('A41', $tcsv18) 
                               ->setCellValue('C41', $dfm18) 
                               ->setCellValue('A42', $tcsv19) 
                               ->setCellValue('C42', $dfm19) 
                               ->setCellValue('A43', $tcsv20) 
                               ->setCellValue('C43', $dfm20) ;
      
            // $objPHPExcel->setTitle("uniformity: Tabs");

        $dir = "workbooks";
        
        if (is_dir($dir)) {
            
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('NQCL');
        $objDrawing->setDescription('The Image that I am inserting');
        $objDrawing->setPath('exclusive_image/nqcl.png');
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
             
                  
             echo 'Data exported';
        } else {
            echo 'Dir does not exist';
            
        }
        
                
                
                return true;
                else:
                return false;
                endif;
    }
     

       function check_repeat_status(){
        $this->db->select_max('repeat_status');
        $this->db->where('labref',  $this->uri->segment(3));
        $this->db->where('test_name','uniformity');
        $query=  $this->db->get('tests_done');
        return $result=$query->result();
        
    }
   function save_test(){
       $labref=  $this->uri->segment(3);
        $priority=  $this->findPriority($labref);
        $urgency=$priority[0]->urgency;
        $data1=  $this->getAnalystId();
        $supervisor_id=$data1[0]->supervisor_id;
        
        $data=$this->check_repeat_status();
        $r_status= $data[0]->repeat_status;
        $new_r_status=$r_status+1;
        $analyst_id=  $this->session->userdata('user_id');
        
        $final_test_done=array(
            'labref'=>$labref,
            'test_name'=>'uniformity',
            'repeat_status'=>$new_r_status,
            'supervisor_id'=>$supervisor_id, 
            'test_subject'=>'uniformity_r',
            'analyst_id'=>$analyst_id,
            'priority'=>$urgency
        );
        $this->db->insert('tests_done',$final_test_done);
    }
       function updateSampleSummary(){
        $labref=  $this->uri->segment(3);
        $data = array(
            'determined' => $this->input->post('comment'),
            'complies' => $this->input->post('comment')
        );
        $this->db->where('test_id',6);
        $this->db->where('labref',$labref);
        $this->db->update('coa_body',$data);
    }
    
    function getAnalystId(){
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id',$analyst_id);
        $query=  $this->db->get('analyst_supervisor');
        return $result=$query->result();
       // print_r($result);
    }

    public function getUniformityTestRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('weight_caps_ta');
        return $row = $query->result();
    }

    public function tabs() {
        $data = array();
        $id = $this->uri->segment(4);
        $uri = $this->uri->segment(3);
        $fulluri = $uri . '/' . $id;
        $data['labrefuri'] = $fulluri;
        $data['labref'] = $uri;
         $data['repeat_no']= $this->getDoStatus();
        $data['settings_view'] = "tabs_v";
        $data['lastworksheet'] = $this->getWorksheet() + 1;
        $this->base_params_tabs($data);
    }

    public function tabs_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r']=$r = $this->uri->segment(4);
        $analyst_id = $this->session->userdata('user_id');
        $data['tabs_results'] = $this->getTabs_v($labref, $r);
        $data['tabs_ta'] = $this->getTabsTotal($labref, $r);
          $username=$this->getAnalystData();
        $new=$username[0]->analyst_name;
        //$username=$user[0]->username;
        $this->session->set_userdata('mail_name',$new);
        $labref=  $this->uri->segment(3);
        $module=  $this->uri->segment(2);
        $this->session->set_userdata(array('labref'=>$labref,'module'=>$module));
        $data['settings_view'] = 'tabs_r_v';
        $this->base_params($data);
    }
       public function uniformity_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r']=$r = $this->uri->segment(4);
        $analyst_id = $this->session->userdata('user_id');
        $data['caps_results'] = $this->getCaps_v($labref, $r);
       // print_r($data['caps_results']);
       $username=$this->getAnalystData();
        $new=$username[0]->analyst_name;
        //$username=$user[0]->username;
        $this->session->set_userdata('mail_name',$new);
        $labref=  $this->uri->segment(3);
        $module=  $this->uri->segment(2);
        $this->session->set_userdata(array('labref'=>$labref,'module'=>$module));
        $data['caps_ta'] = $this->getUniformityTotal($labref, $r);
        $data['settings_view'] = 'uniformity_r_v';
        $this->base_params($data);
    }
    
    
    
    function getAnalystData() {
        $supervisor_id = $this->session->userdata('user_id');
        $url = $this->uri->segment(3);
        $data1 = $this->getAnalystId_1($url);
        foreach ($data1 as $data) {
            $analyst_id = $data->analyst_id;          
            $this->db->where('analyst_id', $analyst_id);
            $this->db->where('supervisor_id', $supervisor_id);
            $query = $this->db->get('analyst_supervisor');
            $result = $query->result();
        }
        return $result;
        //print_r($result);
    }
  function getAnalystId_1($url = '') {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $this->db->where('labref', $url);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }
    

    
     function getUsername(){
            $this->db->select('analyst_name');
            $this->db->where('supervisor_id',  $this->session->userdata('user_id'));
            $query=  $this->db->get('analyst_supervisor');
            return $result=  $query->result();
           
        }
    function getTabs_v($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_tablets');
        return $result = $query->result();
        //print_r($result);
    }

    function getTabsTotal($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_tablets_ta');
        return $result = $query->result();
        //print_r($result);
    }
    
     function getCaps_v($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('r_status', $r);
        $query = $this->db->get('weight_uniformity');
        return $result = $query->result();
       // print_r($result);
    }

    function getUniformityTotal($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_caps_ta');
         return $result = $query->result();
      //  print_r($result);
    }
    
    public function approve_data(){
       $labref=  $this->uri->segment(3);
       $r=  $this->uri->segment(4);
      $supervisor_id=  $this->session->userdata('user_id');
       $supervisor=  $this->getSupervisorName();
       //print_r($supervisor);
       $supervisor_name=$supervisor[0]->fname." ".$supervisor[0]->lname;
       $analyst=  $this->getAnalystName();
       $analyst_name=$analyst[0]->analyst_name;
        $priority=  $this->findPriority($labref);
            $urgency=$priority[0]->urgency;
       $approve_data=array(
           'supervisor_name'=>$supervisor_name,
           'analyst_name'=>$analyst_name,
           'labref'=>$labref,
           'repeat_status'=>$r,
           'test_name'=>'uniformity',
           'test_product'=>'csv',
           'supervisor_id'=>$supervisor_id,
           'user_type'=>'5',
           'status'=>'1',
           'priority'=>$urgency
       );
       $this->db->insert('supervisor_approvals',$approve_data);
       
        $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('test_name','uniformity');
       $this->db->update('tests_done',array('approval_status'=>'1'));
       
       
       $this->compareToDecide($labref);
       
       redirect('supervisors/home/'.$this->session->userdata('lab'));
       
       
    }
    
    public function approve(){
       $labref=  $this->uri->segment(3);
       $r=  $this->uri->segment(4);
       $status='1';
       $this->db->select('status');
       $this->db->where('status',$status);
       $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('test_name','uniformity');
       $this->db->where('test_product','csv');
       $query=  $this->db->get('supervisor_approvals');
       if($query->num_rows()>0){
           echo 'Already Approved';
       }else{
           $this->approve_data();  
       }
               
    }

    

function justBringDosageForm($labref){
    $this->db->select('dosage_form');
    $this->db->from('dosage_form df');
    $this->db->join('request r','df.id=r.dosage_form');
    $this->db->where('r.request_id',$labref);
    $query=  $this->db->get();
    return $result=$query->result();
    //print_r($result);
}
    
 
        public function getSupervisorName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('id', $supervisor_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }
     public function getAnalystName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        //print_r($result);
    }
         function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
    }
    
    
    

    public function base_params($data) {
        $uri = $this->uri->segment(3);
        $data['title'] = "Weights and uniformity :" . $uri;
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "uniformity";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

    public function base_params_tabs($data) {
        $uri = $this->uri->segment(3);
        $data['title'] = "Weights and uniformity - Tabs:" . $uri;
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "uniformity";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}
