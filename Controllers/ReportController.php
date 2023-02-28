<?php
require('system/core/DBConfig.php');
require('Controllers/BaseController.php');
require('Model/User.php');
require('Model/Follow.php');
require('Model/Report.php');
require('system/library/function.php');
class ReportController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }

    public function AddReport()
    {
        if($_POST)
        {
            $report = new Report($_POST);
            $report->reporter_id=$_SESSION[User::TABLE]['id'];
            $report_ex = $this->db->SingleOrDefault(['reporter_id'=>$report->reporter_id,'user_id'=>$report->user_id,'type_id'=>$report->type_id,'type'=>$report->type],Report::TABLE);
            if(!(array)$report_ex){
                 if($this->db->Add(Report::TABLE,$report)) echo json_encode(['status'=>1]);
                 else echo json_encode(['status'=>0]);
            }
            else echo json_encode(['status'=>2]);
    }}}

?>