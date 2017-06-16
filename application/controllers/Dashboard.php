<?php
set_time_limit(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public $data = array();
	public function __construct(){
		parent::__construct();
		$this->load->model("Base_model");
	}
	
	public function index(){
		$date = ($this->input->get("date")) ? date("Y-m-d" , strtotime($this->input->get("date"))) : date("Y-m-d");
		$this->data["form_title"] = "Main To Branch Comparison ".date("m/d/Y", strtotime($date)) . "";
		$branches = $this->Base_model->select_table("branches", "datacenter"); 
		$content = '
		<form method = "get" action = "" >
			<div class="box-body">
              <div class="row">
                <div class="col-lg-1">
                   Select Date: 
                </div>
                <div class="col-lg-2">
                  <input id = "date_selected" style = "width:200px" class = "form-control" type = "date" name = "date" value = "'.$date.'"> 
                </div>
                <div class="col-lg-1">
                   <button type = "submit" class = "btn btn-primary">OK</button>
                </div>
              </div>
            </div>
            </form>
		';
        
		foreach($branches as $branch){
			$branch_name = $branch["branchlocation"];
			$branch = $branch["branchcode"];
			$content .= '<div class="box">
	            <div class="box-header">
	              <h3 class="box-title"><b>'.$branch_name.' </b></h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body no-padding">
	              <table class="table table-striped branch_table" branch = "'.$branch.'">
	                <tbody>
	                <tr >
	                  <th style="width: 10px">#</th>
	                  <th>Description</th>
	                   <td></td>
	                  <th>Main</th>
	                  <th >Branch</th>
	                  <th>Status</th>
	                </tr>
	                <tr class = "Products">
	                  <td>1.</td>
	                  <td>Products</td>
	                   <td></td>
	                   <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>
	                 <tr class = "ProductHistory">
	                  <td>2.</td>
	                  <td>Product History</td>
	                   <td></td>
	                   <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>
	                <tr class = "FinishedPayments">
	                  <td>3.</td>
	                  <td>Finished Payments</td>
	                   <td></td>
	                   <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>
	                 <tr class = "FinishedTransaction">
	                  <td>4.</td>
	                  <td>Finished Transaction</td>
	                   <td></td>
	                  <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>
	                 <tr class = "FinishedSales">
	                  <td>5.</td>
	                  <td>Finished Sales</td>
	                  <td></td>
	                  <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>

			<tr class = "FinishedSalesExtended">
	                  <td>6.</td>
	                  <td>Finished Sales Extended</td>
	                  <td></td>
	                  <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>

			<tr class = "FinishedSalesAverageUnitCost">
	                  <td>7.</td>
	                  <td>Finished Sales Average Unit Cost</td>
	                  <td></td>
	                  <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>

			<tr class = "Movements">
	                  <td>8.</td>
	                  <td>Movements</td>
	                  <td></td>
	                  <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>
	                <tr class = "MovementLine">
	                  <td>9.</td>
	                  <td>MovementLine</td>
	                  <td></td>
	                  <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>

	                 <tr class = "Receiving">
	                  <td>10.</td>
	                  <td>Receiving</td>
	                  <td></td>
	                  <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>
	                <tr class = "ReceivingLine">
	                  <td>11.</td>
	                  <td>ReceivingLine</td>
	                  <td></td>
	                  <td class = "main"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "branch"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class = "tally"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                </tr>
	                 
	                <tr class = "Pending">
	                  <td>12.</td>
	                  <td>Pending Terminal</td>
	                  <td class = "pending"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></td>
	                  <td class ></td>
	                  <td class ></td>
	                   <td></td>
	                </tr>
	              </tbody></table>
	            </div>
	            <!-- /.box-body -->
	          </div>';
        }
                $this->data["use_js"] = "scripts/main_branch.js";
		$this->data["content"] = $content;
		$this->load->view("dashboard", $this->data);
	}

        /*public function product_history_comparison(){
             $this->session->unset_userdata("po_comparison");
             $date = ($this->input->get("date")) ? date("Y-m-d" , strtotime($this->input->get("date"))) : date("Y-m-d");
             $this->data["form_title"] = "M-B PO Product History Comparison ".date("m/d/Y", strtotime($date)) . '<div id = "generating"> Generating Data <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i></div>' ;
             $this->data["use_js"] = "scripts/po_comparison.js";

             $title = "";
             $content = $this->_content($date);    
             $this->data["content"] = $content;
             $this->load->view("dashboard", $this->data);  
        }

        public function create_table_comparison(){
            $table = $this->session->userdata("po_comparison");
            echo $table;
        } */

        public function product_history_comparison(){
             $date = ($this->input->get("date")) ? date("Y-m-d" , strtotime($this->input->get("date"))) : date("Y-m-d");
             $this->data["form_title"] = "M-B PO Product History Comparison ".date("m/d/Y", strtotime($date));
             $this->data["use_js"] = "";
               $branches = $this->Base_model->select_table("branches", "datacenter");
               $header = array("Name", "Main", "Branch", "Status","PO Created", "PO status");
               $table_body = array(); 
               $yesterday = date("Y-m-d", strtotime('-1 day', strtotime($date)) );
               $select = array("round(sum(selling_area_out), 2)  as sales, round(sum(wholesale_qty), 2) as wholesale");
               $select_po_branch = array();
               $select_po_branch["po_created"] =  array("count(1) as count");
               $select_po_branch["po_where"] = array("date_added"=> $yesterday);
               $where = array("date_posted" => $yesterday );
               $join = array();
               $order_by = array();
               $group_by = array();
               foreach($branches as $index => $branch){
                   if($branch["branchcode"] == "BGB" || $branch["branchcode"] == "SPT" || $branch["branchcode"] == "RML") continue;
                    $branch_record = $this->Base_model->dynamic_select_table("product_history",$branch["branchcode"],"branch",$select, $where, $join, $order_by, $group_by, "mysql", "migration"); 
                    $po_created = $this->Base_model->dynamic_select_table("auto_purchase",$branch["branchcode"],"branch",$select_po_branch["po_created"], $select_po_branch["po_where"], $join, $order_by, $group_by, "mysql", "migration"); 
                    $po_throw = $this->Base_model->dynamic_select_table("auto_purchase",$branch["branchcode"],"branch",$select_po_branch["po_created"],  array("date_added" => $yesterday, "throw" => 1 ), $join, $order_by, $group_by, "mysql", "migration");
                    $po_main_dbase = $this->Base_model->select_table("branch_po", "datacenter", array(), array("branch_id" => $branch["id"]));
                    if(count($po_main_dbase) > 0 ){
                      $po_main_dbase = end($po_main_dbase);
                      $main_record = $this->Base_model->dynamic_select_table("product_history",$branch["branchcode"],"remote",$select, $where, $join, $order_by, $group_by, "mysql", $po_main_dbase["po_database"], "192.168.0.56"); 
                    if($branch_record) {
                      $po_created = end($po_created);
                      $po_throw = end($po_throw);
                      $po_created_description = "Created: ". $po_created." - Throw: ".$po_throw;
                      $po_status =  ($po_created == $po_throw ) ? '<span class="label label-success">Equal</span>' :  '<span class="label label-warning">Not Equal</span>';
                      $status = ($main_record["sales"] == $branch_record["sales"] && $main_record["wholesale"] == $branch_record["wholesale"] ) ? '<span class="label label-success">Equal</span>' :  '<span class="label label-warning">Not Equal</span>'; 
                      $table_body[] = array($branch["branchlocation"] , "Sales: ".$main_record["sales"] . " - Wholesale:" . $main_record["wholesale"] , "Sales: ".$branch_record["sales"] . " - Wholesale: " . $branch_record["wholesale"] , $status, $po_created_description, $po_status); //eak;
                    } else $table_body[] = array($branch["branchlocation"], "Sales: ".$main_record["sales"] . " - Wholesale: " . $main_record["wholesale"] , 0, "<span class='label label-danger'>NO CONNECTION</span>", "" , "");
                    }
               }
             $content = $this->_content($date);
             $content .=  $this->data_table_list("test_id",$header, $table_body, "");
             $this->data["content"] = $content;
             $this->load->view("dashboard", $this->data);
        }

        public function _content($date){
              return  '
                <form method = "get" action = "" >
                        <div class="box-body">
              <div class="row">
                <div class="col-lg-1">
                   Select Date: 
                </div>
                <div class="col-lg-2">
                  <input id = "date_selected" style = "width:200px" class = "form-control" type = "date" name = "date" value = "'.$date.'"> 
                </div>
                <div class="col-lg-1">
                   <button type = "submit" class = "btn btn-primary">OK</button>
                </div>
              </div>
            </div>
            </form>
                ';

        }

	public function get_branch_details($branch , $to = null){
		$details = array();
		
		if($to == null) $to = date("Y-m-d");

		$to = date("Y-m-d" , strtotime($to));
		$from = date("Y-m-d", strtotime('-1 day', strtotime($to)) );
		
		$select = array("count(1) as count");
		$where = array("LastSellingDate>=" => $from , "LastSellingDate<" => $to);
		$branch_record = $this->Base_model->dynamic_select_table("Products",$branch,"branch",$select, $where);
		$main_record = $this->Base_model->dynamic_select_table("Products",$branch,"remote",$select, $where);
		$details["Products"]["main"] = $main_record["count"];
		if($branch_record){
		$details["Products"]["branch"] = $branch_record["count"];
		$details["Products"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["Products"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["Products"]["tally"] = "";
		} $where = array("DatePosted>=" => $from , "DatePosted<" => $to);
		$branch_record = $this->Base_model->dynamic_select_table("ProductHistory",$branch,"branch",$select, $where);
		$main_record = $this->Base_model->dynamic_select_table("ProductHistory",$branch,"remote",$select, $where);
		
		$details["ProductHistory"]["main"] = $main_record["count"];
		if($branch_record){
		$details["ProductHistory"]["branch"] = $branch_record["count"];
		$details["ProductHistory"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["ProductHistory"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["ProductHistory"]["tally"] = "";
		}
		$where = array("LogDate>=" => $from , "LogDate<" => $to);
		$branch_record = $this->Base_model->dynamic_select_table("FinishedSales",$branch,"branch",$select, $where);
		$main_record = $this->Base_model->dynamic_select_table("FinishedSales",$branch,"remote",$select, $where);
		$details["FinishedSales"]["main"] = $main_record["count"];
		if($branch_record){
		$details["FinishedSales"]["branch"] = $branch_record["count"];
		$details["FinishedSales"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["FinishedSales"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["FinishedSales"]["tally"] = "";
		}
		$branch_record = $this->Base_model->dynamic_select_table("FinishedPayments",$branch,"branch",$select, $where);
		$main_record = $this->Base_model->dynamic_select_table("FinishedPayments",$branch,"remote",$select, $where);
		$details["FinishedPayments"]["main"] = $main_record["count"];
		if($branch_record){
		$details["FinishedPayments"]["branch"] = $branch_record["count"];
		$details["FinishedPayments"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["FinishedPayments"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["FinishedPayments"]["tally"] = "";
		}
		$branch_record = $this->Base_model->dynamic_select_table("FinishedTransaction",$branch,"branch",$select, $where);
		$main_record = $this->Base_model->dynamic_select_table("FinishedTransaction",$branch,"remote",$select, $where);
		$details["FinishedTransaction"]["main"] = $main_record["count"];
		if($branch_record){
		$details["FinishedTransaction"]["branch"] = $branch_record["count"];
		$details["FinishedTransaction"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["FinishedTransaction"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["FinishedTransaction"]["tally"] = "";
		}

		$_select = array("sum(extended) as count");
		$branch_record = $this->Base_model->dynamic_select_table("FinishedSales",$branch,"branch",$_select, $where);
		$main_record = $this->Base_model->dynamic_select_table("FinishedSales",$branch,"remote",$_select, $where);

		$details["FinishedSalesExtended"]["main"] = $main_record["count"];
		if($branch_record){
		$details["FinishedSalesExtended"]["branch"] = $branch_record["count"];
		$details["FinishedSalesExtended"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["FinishedSalesExtended"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["FinishedSalesExtended"]["tally"] = "";
		}

		$_select = array("sum(AverageUnitCost) as count");
		$branch_record = $this->Base_model->dynamic_select_table("FinishedSales",$branch,"branch",$_select, $where);
		$main_record = $this->Base_model->dynamic_select_table("FinishedSales",$branch,"remote",$_select, $where);

		$details["FinishedSalesAverageUnitCost"]["main"] = $main_record["count"];
		if($branch_record){
		$details["FinishedSalesAverageUnitCost"]["branch"] = $branch_record["count"];
		$details["FinishedSalesAverageUnitCost"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["FinishedSalesAverageUnitCost"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["FinishedSalesAverageUnitCost"]["tally"] = "";
		}


		$where = array("PostedDate>=" => $from , "PostedDate<" => $to);

		$branch_record = $this->Base_model->dynamic_select_table("Movements",$branch,"branch",$select, $where);
		$main_record = $this->Base_model->dynamic_select_table("Movements",$branch,"remote",$select, $where);
		$details["Movements"]["main"] = $main_record["count"];
		if($branch_record){
		$details["Movements"]["branch"] = $branch_record["count"];
		$details["Movements"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["Movements"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["Movements"]["tally"] = "";
		}

		$join = array(
			"MovementLine" => "Movements.MovementID = MovementLine.MovementID"
		);
		$where = array("Movements.PostedDate>=" => $from , "Movements.PostedDate<" => $to);
		
		$branch_record = $this->Base_model->dynamic_select_table("Movements",$branch,"branch",$select, $where, $join);
		$main_record = $this->Base_model->dynamic_select_table("Movements",$branch,"remote",$select, $where, $join);
		$details["MovementLine"]["main"] = $main_record["count"];
		if($branch_record){
		$details["MovementLine"]["branch"] = $branch_record["count"];
		$details["MovementLine"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["MovementLine"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["MovementLine"]["tally"] = "";
		}


		$where = array("PostedDate>=" => $from , "PostedDate<" => $to);

		$branch_record = $this->Base_model->dynamic_select_table("Receiving",$branch,"branch",$select, $where);
		$main_record = $this->Base_model->dynamic_select_table("Receiving",$branch,"remote",$select, $where);
		$details["Receiving"]["main"] = $main_record["count"];
		if($branch_record){
		$details["Receiving"]["branch"] = $branch_record["count"];
		$details["Receiving"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["Receiving"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["Receiving"]["tally"] = "";
		}


		$join = array(
			"ReceivingLine" => "Receiving.ReceivingID = ReceivingLine.ReceivingID"
		);
		$where = array("Receiving.PostedDate>=" => $from , "Receiving.PostedDate<" => $to);
		
		$branch_record = $this->Base_model->dynamic_select_table("Receiving",$branch,"branch",$select, $where, $join);
		$main_record = $this->Base_model->dynamic_select_table("Receiving",$branch,"remote",$select, $where, $join);
		$details["ReceivingLine"]["main"] = $main_record["count"];
		if($branch_record){
		$details["ReceivingLine"]["branch"] = $branch_record["count"];
		$details["ReceivingLine"]["tally"] = ($main_record["count"] == $branch_record["count"]) ? '<span class="label label-success">Success</span>' : '<span class="label label-warning">Warning</span>';
		} else {
			$details["ReceivingLine"]["branch"] = '<span class="label label-danger">No Connection</span>';
			$details["ReceivingLine"]["tally"] = "";
		}


		$select =array("LogDate" ,"TerminalNo" ,"Status" ,"Netsales" ,"StatusDescription");
		$order_by = array("MAX(LogDate)" => "desc");
		$group_by = array("LogDate" ,"TerminalNo" ,"Netsales" ,"Status" ,"StatusDescription");
		$details["Pending"]["pending"] = "";
		$where = array("status!="=> 3, "DATEDIFF(d,[LogDate],getdate())!=" => 0);
		$branch_record = $this->Base_model->dynamic_all_select_table("OpenTerminals",$branch,"branch",$select, $where , array(), array(), $group_by );
		if($branch_record){
			$content = "";
			$branch_record = array_reverse($branch_record);
			if($branch_record)
			foreach($branch_record as $record){
				$content .= "<tr><td>".date("m/d/Y", strtotime($record["LogDate"]))." </td><td> ".$record["TerminalNo"]." </td><td> ".$record["Status"]." </td><td>".$record["Netsales"]."</td><td> ".$record["StatusDescription"]."</td></tr>";
			}
			$data = '<table class="table table-striped branch_table">
	                <tbody>
	                <tr >
	                  <th> LogDate</th>
	                  <th>Terminal No</th>
	                  <th>Status</th>
	                  <th >Net Sales</th>
	                  <th>Status Description</th>
	                </tr>
	               	'.$content.'
	              </tbody></table>';
			$details["Pending"]["pending"] = $data;
		}

		header('Content-Type: application/json');
		echo json_encode( $details );
	}
}
