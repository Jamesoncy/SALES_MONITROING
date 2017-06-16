<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;
	public $order_by = array(), $data , $current_class = null,$select_users=array("id", "first_name", "last_name");
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
		$this->currenct_class = $this->router->class;
		if($this->currenct_class != "welcome"){
			$user = $this->session->userdata("user");
			if(!$user)redirect(base_url("welcome"));
		}
		$this->create_links();
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

	public function create_links(){
		$this->data["links"] = array(
			array(
					"url" => "dashboard/main_branch_comparison", 
					"text" => "Main Branch Comparison",
					"icon" => "fa-search"
			),
                        array(
                                        "url" => "dashboard/product_history_comparison",
                                        "text" => "M-B PO Product History",
                                        "icon" => "fa-money"
                        )

		);
	}

	public function table_list($tbl=""){
		$this->pm->sDivRow(array("style"=>"margin-bottom:10px;"));
		$this->pm->eDivRow();
		$this->pm->sDivRow();
			$this->pm->sDivCol();
				$this->pm->appendCode($tbl);
			$this->pm->eDivCol();
		$this->pm->eDivRow();
		return $this->pm->getCode();
	}

	public function redirect_login(){
		redirect(base_url("dashboard/"));
	}

	public function array_to_csv_download($headers, $arrays, $filename = "parcel.csv", $delimiter=";") {
	    // open raw memory as file so no temp files needed, you might run out of memory though
	    $f = fopen('php://memory', 'w'); 
	    // loop over the input array
	    fputcsv($f, $headers, $delimiter); 
	    foreach($arrays as $array){
	    	$array_data = array();
		    foreach ($array as $key => $line) array_push($array_data,$line); 
		    fputcsv($f, $array_data, $delimiter); 
		}
	    // reset the file pointer to the start of the file
	    fseek($f, 0);
	    // tell the browser it's going to be a csv file
	    header('Content-Type: application/csv');
	    // tell the browser we want to save it instead of displaying it
	    header('Content-Disposition: attachment; filename="'.$filename.'";');
	    // make php send the generated csv lines to the browser
	    fpassthru($f);
	}

	public function login(){
		redirect(base_url("welcome"));
	}

	public function create_link($location, $base_controller = null){
		if($base_controller == null) $base_controller = $this->currenct_class;
		return base_url($base_controller."/".$location);
	}

        public function data_table_list($id,$header = array(), $table_body = array(),$title, $sc = true, $other_elems='', $class = null){
       $head = ''; $body = ''; $td = ""; $tbd= ""; $cptd = "";
       $class_name = ($class==null) ? "": str_replace(" ","",$class);
       $upper = '<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.$title.'</h3>      
                                        <div class = "row">
                                                '.$other_elems.'
                                        </div>                              
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="'.$id.'" class="table table-bordered table-hover '.$class_name.'">
                                         ';
       foreach($header as $h){
                $td .= '<th>'.$h.'</th>';
       }
       foreach($table_body as $tbody){
          $tbd = "";
            foreach($tbody as $b){
                $tbd .= '<td>'.$b.'</td>';
            }
           $cptd.= "<tr>".$tbd."</tr>";
       }
       $head = '<tr>'.$td.'</tr>';
       $footer = ' </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
           ';
        $script = '<script type="text/javascript">
            $(function() {
                $("#'.$id.'").DataTable({
                   responsive: true, 
                   lengthMenu: [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ]
                });
            });
        </script>';
      $content = $upper . '<thead>'.$head.'</thead><tbody>'.$cptd.'</tbody><tfoot></tfoot>'.$footer;
      $content = ($sc == true) ? $content.$script : $content;
      return $content;
      }

}
