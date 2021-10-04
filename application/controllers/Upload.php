<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends Base_Controller {

    /**
     * Index Page for this controller.


     */

       
    public function __construct() {
        parent::__construct();
        $this->load->model('upload_m');
    }
 

    // upload xlsx|xls file
    public function index() {
        $data['page'] = 'import';
        $data['title'] = 'Import XLSX | TechArise';
        $this->load->view('import/index', $data);
    }

     // import excel data
    public function save() {
        $this->load->library('excel');
        
        if ($this->input->post('importfile')) {
            $path = './uploads/';
 
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|jpg|png';
            $config['max_size']             = 1000000;
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            

            $arrayCount = count($allDataInSheet);
            $flag = 0;

                if ($this->input->post('question_type')=='2') {
                    $createArray = array('ITEM','COMPREHENSION','INSTRUCTION', 'Answer');
                    $makeArray = array('ITEM' => 'ITEM','COMPREHENSION' =>'COMPREHENSION','INSTRUCTION' =>'INSTRUCTION', 'Answer' => 'KEY');
                    $SheetDataKey = array();
                }
                else {
                    $createArray = array('ITEM','COMPREHENSION','INSTRUCTION', 'First_Option', 'Second_Option', 'Third_Option', 'Fourth_Option', 'Answer');
                    $makeArray = array('ITEM' => 'ITEM','COMPREHENSION' =>'COMPREHENSION','INSTRUCTION' =>'INSTRUCTION', 'First_Option' => 'First_Option', 'Second_Option' => 'Second_Option', 'Third_Option' => 'Third_Option', 'Fourth_Option' => 'Fourth_Option', 'Answer' => 'KEY');
                    $SheetDataKey = array();

                }


            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);



            if (empty($data)) {
                $flag = 1;
            }
            if ($flag == 1) {
           

                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    $firstName = $SheetDataKey['ITEM'];
                    $instruction = $SheetDataKey['INSTRUCTION'];
                    $comprehension = $SheetDataKey['COMPREHENSION'];

                    if ($this->input->post('question_type')!='2') {
                    $lastName = $SheetDataKey['First_Option'];
                    $email = $SheetDataKey['Second_Option'];
                    $dob = $SheetDataKey['Third_Option'];
                    $contactNo = $SheetDataKey['Fourth_Option'];
                    }
                    $answer = $SheetDataKey['Answer'];
                    $firstName = filter_var(trim($allDataInSheet[$i][$firstName]), FILTER_SANITIZE_STRING);
                    if ($this->input->post('question_type')!='2') {
                    $lastName = filter_var(trim($allDataInSheet[$i][$lastName]), FILTER_SANITIZE_STRING);
                    $email = filter_var(trim($allDataInSheet[$i][$email]), FILTER_SANITIZE_STRING);
                    $dob = filter_var(trim($allDataInSheet[$i][$dob]), FILTER_SANITIZE_STRING);
                    $contactNo = filter_var(trim($allDataInSheet[$i][$contactNo]), FILTER_SANITIZE_STRING);
                    }
                    $comprehension = filter_var(trim($allDataInSheet[$i][$comprehension]), FILTER_SANITIZE_STRING);
                    $instruction = filter_var(trim($allDataInSheet[$i][$instruction]), FILTER_SANITIZE_STRING);
                    $answer = filter_var(trim($allDataInSheet[$i][$answer]), FILTER_SANITIZE_STRING);
                    if ($answer=='A') {
                        $answer =1;
                    }
                    elseif($answer=='B') {
                        $answer =2;
                    }
                    elseif ($answer=='C') {
                        $answer =3;
                    }
                    elseif ($answer=='D') {
                        $answer =4;
                    }
                    else { $answer = $answer; }
                    if (!empty($firstName))
                    {
                        if ($this->input->post('question_type')=='2') {
                            $fetchData[] = array('question' => $firstName, 'instruction' => $instruction, 'comprehension' => $comprehension, 'answer' => $answer, 'question_id' => $this->input->post('assessment_id'));

                        }
                        else {
                            $fetchData[] = array('question' => $firstName, 'option1' => $lastName, 'instruction' => $instruction, 'comprehension' => $comprehension, 'option2' => $email, 'option3' => $dob, 'option4' => $contactNo, 'answer' => $answer, 'question_id' => $this->input->post('assessment_id'));

                        }
                        
                    }
                }              
                $data['employeeInfo'] = $fetchData;


            $data_file = array(
                'file_name' => $import_xls_file,
            );
            $this->db->where('id', $this->input->post('assessment_id'));
            $update = $this->db->update('questions', $data_file);

                $this->upload_m->setBatchImport($fetchData);
                $this->upload_m->importData();
            } else {
                echo "Please import correct file";
            }
        }

        redirect('assessment/view_questions/'.$this->input->post('assessment_id').'/'.$this->input->post('question_type'));
        
    }

}

?>


