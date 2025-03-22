<?
// 20 Sep 2010: Added not_in_table property
// 20 Sep 2010: Added on_change_array property
// 21 Sep 2010: Added span_id_array property
// 21 Sep 2010: Added on_blur_array property
// 25 Oct 2010: Improvement of uploading files for copying to disk
// 25 Oct 2010: Applying size for file type inputs
// 25 Oct 2010: Applying check empty value for file type inputs
// 11 Nov 2010: Added upload_file_name property for uploading files for saving out of database
// 11 Nov 2010: Added upload_allow_overwrite property for uploading files for saving out of database
// 18 Dec 2010: Bug fixed for updating fileds with use_md5_array property
// 24 Dec 2010: Bug fixed for updating password show types with use_md5_array property
// 24 Dec 2010: Bug fuxed for updating password show types with field_nul_array=false
// 24 Dec 2010: Bug fixed for updating nul values for combo boxes
// 08 Feb 2011: Added not_initialize_fields property
// 12 Feb 2011: Added dont_include_form_tag property
// 12 Feb 2011: Added dont_show_buttons property
// 15 Feb 2011: Added field_min_value_array, field_max_value_array, message_min_value & message_max_value properties
// 06 Mar 2011: Fixed some bugs in field_null_array property
// 11 Jun 2011; Now this file is independent to system or PHP or SQL server date format
// 18 Jun 2011: Removed space after message_before property and before message_after property
// 19 Jun 2011: Fixed bug when the key field is of string type.
// 25 Jun 2011: Added "G" type for show_type_array property to show the gregorian date.
// 25 Jun 2011: Added default_date_value property for "D" & "G" type show_type_array to show the default day (0 for today, 1 for tomorrow and so on and '' for none)
// 26 Jun 2011: Fixed another bug when the key field is of string type.
// 14 Sep 2011: Added custom_error_message_array and custom_error_number properties for custom error detecting
// 10 Dec 2011: Added on_before_delete, on_after_delete, on_success_delete, on_fail_delete property
// 10 Dec 2011: Added on_before_insert, on_after_insert, on_success_insert, on_fail_insert property
// 10 Dec 2011: Added on_before_update, on_after_update, on_success_update, on_fail_update property
// 12 Dec 2011: Added on_submit property
// 22 Oct 2012: Fixed form action for chrome browser
// 08 Dec 2012: Fixed a problem related to default_date_value property when it set to 0 for today
// 01 Oct 2014: Fixed a problem displayiny retype password and comment simoultaneously.
// 10 Oct 2014: Fixed problem in date start year when year value is less than start year.
// 16 Nov 2014: Added text_after_field property.
// 15 Mar 2015: Fixed problem for tables with the name of reserved words in database.
// 16 Mar 2015: Fixed problem for fields with regex and aloow nul value.
// 18 Mar 2015: Fixed radio buttom input with null value problem.
// 19 Mar 2015: Added on_input_array property for oninput attribute of input fields.
// 30 Apr 2015: Added "DM" type for show_type_array property to show date & time input.
// 12 Apr 2016: Fixed problem with [] in Schema table names.
// 16 Apr 2016: Fixed problem with disabled fields.
// 17 Jul 2016: Added auto_field_count property for caculating field_count property automatically.
// 18 Jul 2016: Added use_identity_insert and identity_insert properties for saving identity when inserting;
// 14 Aug 2016: Fixed problem with single quotation mark.
// 14 Aug 2016: Added ability to raise error at on_before_delete & on_before_insert & on_before_update functions.
// 04 Sep 2016: Added determining mssql error and warning in executing queries.
// 09 Sep 2016: Added tr_bgcolor_array, td1_bgcolor_array and td2_bgcolor_array properties for the background color of rows and cells.
// 09 Sep 2016: Added check_value_array property for value of the checkbox.
// 09 Sep 2016: Added field_class_array property for classifying checkboxes.
// 10 Sep 2016: Fixed a problem with existing @ character in destination property.
// 20 Dec 2016: Added ability to post null value for time input. ("M" & "DM" show type)
// 20 Dec 2016: Added value 60 to field_time_minute_step property.
// 14 Feb 2017: Added after_buttons_html property to show some elements after buttons.
// 14 Feb 2017: Added extended_buttons_array property to show additional buttons after classic buttons.
// 22 Apr 2017: Fixed problem in field_regex_array when field_value_array is true.
// 14 May 2023: Added field_unicode_array property to support unicode strings.
// 17 May 2023: Added field_readonly_array property to make textboxes and textareas readonly
// 20 May 2023: Fixed overflow of field_count property
// 12 Mar 2025: Changed for MySqli database connection.
// 12 Mar 2025: Chnaged for utf-8 character set.
// 14 Mar 2025: Fixed identity_insert for MySqli.
// 16 Mar 2025: Migrated from PHP 5.x to PHP 8.2 .
// 22 Mar 2025: Changed to composer compatible.
namespace ZojTools;

use ZojTools\farsiTools\farsiNumber;
use ZojTools\numberTools\formatNumber;
use ZojTools\dateTimeTools\dateTimeFormat;
use ZojTools\dbBase\dbBase;
use ZojTools\stringTools\stringTools;

// This class provides ability to create forms for edit
class dbform {
    public $on_submit;
	public $debug;
	public $_error_message;
	public $_redirected;
	public $_publics_set;
	public $after_buttons_html;
	public $border;
	public $border_color;
	public $button_style;
	public $button_class;
	public $cancel_caption;
	public $cancel_href;
	public $cancel_image;
	public $cellpadding;
	public $cellspacing;
	public $code_field;
	public $code_public;
	public $comment_array;
	public $custom_error_message_array;
	public $custom_error_number;
	public $default_date_value;
	public $delete_caption;
	public $delete_href;
	public $delete_image;
	public $delete_message;
	public $description_array;
	public $dont_include_form_tag;
	public $dont_show_buttons;
	public $error_class;
	public $error_style;
	public $even_bg_color;
	public $extended_buttons_array;
	public $farsi_type_array;
	public $field_count;
	public $field_date_end_hour;
	public $field_date_start_hour;
	public $field_height_array;
	public $field_length_array;
	public $field_max_length_array;
	public $field_max_value_array;
	public $field_min_value_array;
	public $field_name_array;
	public $field_nul_array;
	public $field_readonly_array;
	public $field_regex_array;
	public $field_show_class;
	public $field_show_style;
	public $field_type_array;
	public $field_time_end_hour;
	public $field_time_minute_step;
	public $field_time_start_hour;
	public $field_unicode_array;
	public $field_value_array;
	public $field_option_array;
	public $general_error_message;
	public $image_buttons;
	public $insert_href;
	public $message_after;
	public $message_before;
	public $message_max_value;
	public $message_min_value;
	public $not_in_table;
	public $not_initialize_fields;
	public $odd_bg_color;
	public $on_blur_array;
	public $on_change_array;
	public $on_after_delete;
	public $on_after_insert;
	public $on_after_update;
	public $on_before_delete;
	public $on_before_insert;
	public $on_before_update;
	public $on_fail_delete;
	public $on_fail_insert;
	public $on_fail_update;
	public $on_success_delete;
	public $on_success_insert;
	public $on_success_update;
	public $query;
	public $redescription_array;
	public $redirect;
	public $refield_name_array;
	public $reset_caption;
	public $reset_image;
	public $repeat_password_array;
	public $show_cancel;
	public $show_delete;
	public $show_reset;
	public $show_submit;
	public $show_type_array;
	public $span_id_array;
	public $state;
	public $submit_caption;
	public $submit_image;
	public $table_name;
	public $tb_style;
	public $tb_class;
	public $tb_width;
	public $td_align_1;
	public $td_align_2;
	public $td_class;
	public $td_style;
	public $td_style_1;
	public $td_style_2;
	public $td_width_1;
	public $td_width_2;
	public $text_after_field;
	public $tr_class;
	public $tr_style;
	public $update_href;
	public $upload_dir_array;
	public $upload_db_array;
	public $show_star;
	public $star_pos;
	public $star_source;
	public $error_type;
	public $auto_field_count;
	public $identity_insert;
	public $use_identity_insert;
	public $before_delete_result;
	public $before_insert_result;
	public $before_update_result;
	public $check_value_array;
	public $tr_bgcolor_array;
	public $td1_bgcolor_array;
	public $td2_bgcolor_array;
	public $db_link;
    public $field_time_date_part;
    public $upload_file_name;
    public $field_disabled_array;
    public $upload_directory;
    public $upload_file_without_extension;
    public $use_md5_array;
    public $upload_save_in_db;
    public $upload_allow_overwrite;
    public $on_input_array;
    public $field_ltr;
    public $date_time_separator_array;
    public $field_date_start_year;
    public $field_date_end_year;
    public $field_class_array;

	//consructor
	public function __construct($db_link, $table_name, $field_count = 0) {
		global $_POST;
		$this->tb_width = "100%";
		$this->db_link = $db_link;
		$this->table_name = $table_name;
		$this->field_count = $field_count;
		$this->general_error_message = "Error";
		$this->star_pos = 'before title';
		$this->correct_table_name();
		$this->correct_quote_char();
		//      $this->update_href=
		
	}

	private function correct_quote_char() {
		foreach ($_POST as & $val) $val = str_replace("'", "''", $val);
	}

	private function correct_table_name() {
		$table_name = $this->table_name;
		if (strpos($table_name, '[') === false) {
			$split_table_name = preg_split('/\./', $table_name);
			$table_name = "";
			foreach ($split_table_name as $key => $value) {
				if ($key != 0) $table_name .= '.';
				$table_name .= "`$value`";
			}
			$this->table_name = $table_name;
		}
	}

	public function query($query) {
		if ($this->debug) {
			print_r($_POST);
			echo $query;
			$this->query = $query;
			try {
				$result = mysqli_query($this->db_link, $query);
			}
			catch(\Exception $e) {
				echo "\nError:\n" . $e;
				$result = false;
			}
			exit;
		}
		else {
			$error_rep = error_reporting(E_ALL);
			$old_handler = set_error_handler("error_occured", E_WARNING);
			$this->query = $query;
			try {
				$result = mysqli_query($this->db_link, $query);
			}
			catch(\Exception $e) {
				$result = false;
			}
			error_reporting($error_rep);
			restore_error_handler();
			//        set_error_handler($old_handler,E_WARNING);
			return ($result);
		}
	}

	//get the state of the form: cancel, insert, update, delete, or view(select)
	public function get_state() {
		global $_POST, $_GET;
		for ($i = 0;$i < $this->field_count;$i++) {
			if ($_POST["submit"] != "") $this->field_value_array[$i] = $_POST[$this->field_name_array[$i]];
			if (!$this->field_value_array[$i] && ($this->field_type_array[$i] == "I" || $this->field_type_array[$i] == "i")) $this->field_value_array[$i] = 0;
		}

		$this->_publics_set = 1;
		if ($_POST["cancel"] != "") {
			$this->state = "cancel";
		}
		else if ($_POST["submit"] != "") {
			$code_public = $this->code_public;
			if ($_GET[$code_public] == "") //insert
			{
				$this->state = "insert";
			}
			else
			//update
			{
				$this->state = "update";
			}
		}
		else if ($_POST["delete"] != "") //delete
		{
			$this->state = "delete";
		}
		else
		//select
		{
			$this->state = "select";
		}
		return ($this->state);
	}

	//do the operation of the form based on the state of the form
	public function initialize() {
		if ($this->auto_field_count) $this->field_count = count($this->field_name_array);
		global $_POST, $_GET;
		if (!$this->_publics_set && $_POST["submit"] != "") {
			if (isset($this->on_submit)) {
				$fnc = $this->on_submit;
				$fnc();
			}
			for ($i = 0;$i < $this->field_count;$i++) {
				$this->field_value_array[$i] = $_POST[$this->field_name_array[$i]];
				if ($this->show_type_array[$i] == "M" || $this->show_type_array[$i] == "m") {
					$h = $this->field_name_array[$i] . "_h";
					$n = $this->field_name_array[$i] . "_n";
					$h = $_POST[$h];
					$n = $_POST[$n];
					if ($h != '' && $n != '') {
						$this->field_value_array[$i] = $this->field_time_date_part[$i] . " $h:$n";
					}
					else if ($h . $n == '') $this->field_value_array[$i] = "NULL";
					else $this->field_value_array[$i] = "Error";
				}
				if ($this->show_type_array[$i] == "D" || $this->show_type_array[$i] == "d") {
					$y = $this->field_name_array[$i] . "_y";
					$m = $this->field_name_array[$i] . "_m";
					$d = $this->field_name_array[$i] . "_d";
					$y = $_POST[$y];
					$m = $_POST[$m];
					$d = $_POST[$d];
					if ($y != '' && $m != '' && $d != '') {
						dateTimeFormat::sh2m($y, $m, $d);
						//              $this->field_value_array[$i]=month_name($m)." $d $y";
						$this->field_value_array[$i] = "$y-$m-$d";
					}
					else if ($y . $m . $d == '') $this->field_value_array[$i] = "NULL";
					else $this->field_value_array[$i] = "Error";
				}
				if ($this->show_type_array[$i] == "DM" || $this->show_type_array[$i] == "dm") {
					$y = $this->field_name_array[$i] . "_y";
					$m = $this->field_name_array[$i] . "_m";
					$d = $this->field_name_array[$i] . "_d";
					$y = $_POST[$y];
					$m = $_POST[$m];
					$d = $_POST[$d];
					$h = $this->field_name_array[$i] . "_h";
					$n = $this->field_name_array[$i] . "_n";
					$h = $_POST[$h];
					$n = $_POST[$n];
					if ($y != '' && $m != '' && $d != '' && $h != '' && $n != '') {
						dateTimeFormat::sh2m($y, $m, $d);
						$this->field_value_array[$i] = "$y-$m-$d $h:$n";
					}
					else if ($y . $m . $d == '') $this->field_value_array[$i] = "NULL";
					else $this->field_value_array[$i] = "Error";
				}
				if ($this->show_type_array[$i] == "G" || $this->show_type_array[$i] == "g") {
					$y = $this->field_name_array[$i] . "_y";
					$m = $this->field_name_array[$i] . "_m";
					$d = $this->field_name_array[$i] . "_d";
					$y = $_POST[$y];
					$m = $_POST[$m];
					$d = $_POST[$d];
					if ($y != '' && $m != '' && $d != '') {
						$this->field_value_array[$i] = "$y $m $d";
						//              $this->field_value_array[$i]=month_name($m)." $d $y";
						
					}
					else if ($y . $m . $d == '') $this->field_value_array[$i] = "NULL";
					else $this->field_value_array[$i] = "Error";
				}
				if ($this->field_value_array[$i] == "" && $this->field_type_array[$i] == "I") $this->field_value_array[$i] = 'NULL';
			}
		}
		if ($_POST["cancel"] != "") //cancel
		{
			$this->_redirected = 1;
			$this->state = "cancel";
		}
		//      else if ($_POST["submit"]!="")
		//      else if (count($_POST)>0 && $_POST["delete"]=="" && $_POST["delete_x"]=="" && $_POST["cancel"]=="" && $_POST["cancel_x"]=="" && $_POST["reset"]=="" && $_POST["reset_x"]=="")
		else if ($_POST["delete"] != "") //delete
		{
			if (isset($this->on_before_delete)) {
				$fnc = $this->on_before_delete;
				$this->before_delete_result = $fnc();
				if ($this->before_delete_result) {
					$this->_error_message = $this->before_delete_result;
					$error_occured = true;
				}
			}
			if (!$error_occured && $this->delete()) {
				if (isset($this->on_success_delete)) {
					$fnc = $this->on_success_delete;
					$fnc();
				}
				if (isset($this->on_after_delete)) {
					$fnc = $this->on_after_delete;
					$fnc();
				}
				$this->_redirected = 1;
				$this->state = "delete";
			}
			else {
				if (isset($this->on_fail_delete)) {
					$fnc = $this->on_fail_delete;
					$fnc();
				}
				if (isset($this->on_fail_delete)) {
					$fnc = $this->on_fail_delete;
					$fnc();
				}
				$this->_redirected = 0;
				$this->state = "error";
			}
		}
		else if ($_POST["_submitted_"] != "") {
			$this->error_type = '';
			if (($error = $this->check_rules()) == - 1) //no error
			{
				$code_public = $this->code_public;
				if ($_GET[$code_public] == "") //insert
				{
					if (isset($this->on_before_insert)) {
						$fnc = $this->on_before_insert;
						$this->before_insert_result = $fnc();
						if ($this->before_insert_result) {
							$this->_error_message = $this->before_insert_result;
							$error_occured = true;
						}
					}
					if (!$error_occured && $this->insert()) {
						if (isset($this->on_success_insert)) {
							$fnc = $this->on_success_insert;
							$fnc();
						}
						if (isset($this->on_after_insert)) {
							$fnc = $this->on_after_insert;
							$fnc();
						}
						$this->_redirected = 1;
						$this->state = "insert";
					}
					else {
						if (isset($this->on_fail_insert)) {
							$fnc = $this->on_fail_insert;
							$fnc();
						}
						if (isset($this->on_after_insert)) {
							$fnc = $this->on_after_insert;
							$fnc();
						}
						$this->_redirected = 0;
						$this->state = "error";
					}
				}
				else
				//update
				{
					$error_occured = false;
					if (isset($this->on_before_update)) {
						$fnc = $this->on_before_update;
						$this->before_update_result = $fnc(); //error message
						if ($this->before_update_result) {
							$this->_error_message = $this->before_update_result;
							$error_occured = true;
						}
					}
					if (!$error_occured && $this->update()) {
						if (isset($this->on_success_update)) {
							$fnc = $this->on_success_update;
							$fnc();
						}
						if (isset($this->on_after_update)) {
							$fnc = $this->on_after_update;
							$fnc();
						}
						$this->_redirected = 1;
						$this->state = "update";
					}
					else {
						if (isset($this->on_fail_update)) {
							$fnc = $this->on_fail_update;
							$fnc();
						}
						if (isset($this->on_after_update)) {
							$fnc = $this->on_after_update;
							$fnc();
						}
						$this->_redirected = 0;
						$this->state = "error";
					}
				}
			}
			else
			//has error
			{
				$this->_redirected = 0;
				if ($this->error_type == 'Repeat') $this->_error_message = $this->message_before . $this->redescription_array[$error] . $this->message_after;
				else if ($this->error_type == 'Max') $this->_error_message = $this->message_before . $this->message_max_value . " " . $this->description_array[$error] . $this->message_after;
				else if ($this->error_type == 'Min') $this->_error_message = $this->message_before . $this->message_min_value . " " . $this->description_array[$error] . $this->message_after;
				else if ($this->error_type == 'Custom') $this->_error_message = $this->custom_error_message_array[$error];
				else $this->_error_message = $this->message_before . $this->description_array[$error] . $this->message_after;
			}
		}
		else
		//select
		{
			if ($_GET[$this
				->code_public] != "" && !$this->not_initialize_fields) //not select for inserting
			$this->select();
			$this->state = "select";
		}
		if ($this->_redirected) {
			$this->go_destination();
		}
	}

	//go to the page after the operation being done
	private function go_destination() {
		switch ($this->state) {
			case "update":
				$destination = $this->update_href;
			break;
			case "insert":
				$destination = $this->insert_href;
				if (strpos($destination, "@")) {
					$id_code = dbBase::get_field($this->db_link, "SELECT LAST_INSERT_ID() AS id", "id");
					$destination = str_replace("@", "$id_code", $destination);
				}
			break;
			case "delete":
				$destination = $this->delete_href;
			break;
			case "cancel":
				$destination = $this->cancel_href;
			break;
		}
		if ($this->redirect) {
			header("Location: " . $destination);
			exit();
		}
		else {
			include $destination;
			//          exit();
			
		}
	}

	//internal use
	private function select() {
		global $_POST, $_GET;
		$table_name = $this->table_name;
		$code_field = $this->code_field;
		$value = $_GET[$this->code_public];
		$query = "
        SELECT * FROM $table_name WHERE $code_field='$value'
        ";
		if ($table = $this->query($query)) {
			$row = mysqli_fetch_array($table);
			for ($i = 0;$i < $this->field_count;$i++) if (!$this->not_in_table[$i]) $this->field_value_array[$i] = trim($row[$this->field_name_array[$i]]);
			return (true);
		}
		else {
			return (false);
		}
	}

	//internal use
	private function insert() {
		global $_POST;
		$table_name = $this->table_name;
		$field_name_str = "";
		$field_value_str = "";
		$first = true;
        $query = '';
		for ($i = 0;$i < $this->field_count;$i++) if (!$this->not_in_table[$i] && !$this->field_disabled_array[$i]) {
			$empty = false;
			if ($this->show_type_array[$i] == "F" || $this->show_type_array[$i] == "f") {
				if ($_FILES[$this->field_name_array[$i]]['name']) {
					if ($this->upload_db_array[$i]) {
						$uploaded_file_content = file_get_contents($_FILES[$this->field_name_array[$i]]['tmp_name']);
						$this->field_value_array[$i] = '0x'.bin2hex($uploaded_file_content);
					}
					else {
						if ($this->upload_file_name[$i] == '') $file_name = $_FILES[$this->field_name_array[$i]]['name'];
						else {
							$file_name = $_FILES[$this->field_name_array[$i]]['name'];
							$ext = '';
							$pos = strrpos($file_name, '.');
							if ($pos !== false) $ext = substr($file_name, $pos, strlen($file_name));
							if ($this->upload_file_without_extension) $file_name = $this->upload_file_name[$i];
							else $file_name = $this->upload_file_name[$i] . $ext;
						}
						$directory_exists = false;
						if (file_exists($this->upload_directory[$i])) $directory_exists = true;
						else $directory_exists = mkdir($this->upload_directory[$i]);
						if (file_exists($this->upload_directory[$i] . '\\' . $file_name) && !$this->upload_allow_overwrite[$i]) $file_name = stringTools::get_unique_id() . '_' . $file_name;
						$file_created = move_uploaded_file($_FILES[$this->field_name_array[$i]]['tmp_name'], $this->upload_directory[$i] . '\\' . $file_name);
						if ($this->upload_save_in_db == "original") $this->field_value_array[$i] = $_FILES[$this->field_name_array[$i]]['name'];
						else $this->field_value_array[$i] = $file_name;
					}
				}
				else {
					$this->field_value_array[$i] = "";
					$empty = true;
				}
			}
			if ($this->field_name_array != '' && !$empty) {
				if (!$first) {
					$field_name_str .= ",";
					$field_value_str .= ",";
				}
				if ($this->use_md5_array[$i]) $this->field_value_array[$i] = md5($this->field_value_array[$i]);
				$field_name_str .= $this->field_name_array[$i];
				if (($this->field_type_array[$i] == "S" || $this->field_type_array[$i] == "s" || (($this->field_type_array[$i] == "D" || $this->field_type_array[$i] == "d") && $this->field_value_array[$i] != 'NULL')) && (!($this->show_type_array[$i] == "F" || $this->show_type_array[$i] == "f") || !$this->upload_db_array[$i])) {
					if ($this->field_unicode_array[$i]) $field_value_str .= "N";
					$field_value_str .= "'";
				}
				$field_value_str .= $this->field_value_array[$i];
				if (($this->field_type_array[$i] == "S" || $this->field_type_array[$i] == "s" || (($this->field_type_array[$i] == "D" || $this->field_type_array[$i] == "d") && $this->field_value_array[$i] != 'NULL')) && (!($this->show_type_array[$i] == "F" || $this->show_type_array[$i] == "f") || !$this->upload_db_array[$i])) $field_value_str .= "'";
			}
			$first = false;
		}
		$query .= sprintf("INSERT INTO $table_name (%s) VALUES (%s);\n", $field_name_str, $field_value_str);
		$result = $this->query($query);

		if ($result && $this->use_identity_insert) {
			$query = "SELECT LAST_INSERT_ID() AS id;";
			$identity_result = $this->query($query);
			$row = mysqli_fetch_array($identity_result);
			$this->identity_insert = $row["id"];
			$result = $result && $identity_result;
		}
		return ($result);
	}

	//internal use
	private function update() {
		global $_POST, $_GET, $_FILES;
		$table_name = $this->table_name;
		$code_field = $this->code_field;
		$value = $_GET[$this->code_public];
		$query = "UPDATE $table_name SET ";
		$first = true;
		for ($i = 0;$i < $this->field_count;$i++) if (!$this->not_in_table[$i] && !$this->field_disabled_array[$i]) {
			$empty = false;
			//          echo $this->field_value_array[$i].'c';
			if ($this->show_type_array[$i] == "F" || $this->show_type_array[$i] == "f") {
				if ($_FILES[$this->field_name_array[$i]]['name'] != "") {
					if ($this->upload_db_array[$i]) {
						if (!$first) $query .= ',';
						$first = false;
						$query .= $this->field_name_array[$i] . "=";
						$uploaded_file_content = implode("", file($_FILES[$this->field_name_array[$i]]['tmp_name']));
						//                $uploaded_file_content=file_get_contents($_FILES[$this->field_name_array[$i]]['tmp_name']);
						$query .= '0x' . bin2hex($uploaded_file_content);
					}
					else {
						$code_field = $this->code_field;
						$value = $_GET[$this->code_public];
						$__query = "SELECT " . $this->field_name_array[$i] . " FROM " . $this->table_name . " WHERE $code_field='$value'";
						$__table = $this->query($__query);
						$__row = mysqli_fetch_array($__table);
						if ($__row[$this->field_name_array[$i]]) unlink($this->upload_dir_array[$i] . '/' . $__row[$this->field_name_array[$i]]);
						//                $imagepath = time().'_'.rand(1,32000).'_'.$_FILES[$this->field_name_array[$i]]['name'];
						//                move_uploaded_file($_FILES[$this->field_name_array[$i]]['tmp_name'],$this->upload_dir_array[$i].'/'.$imagepath);
						if ($this->upload_file_name[$i] == '') $file_name = $_FILES[$this->field_name_array[$i]]['name'];
						else {
							$file_name = $_FILES[$this->field_name_array[$i]]['name'];
							$ext = '';
							if ($pos = strrpos($file_name, '.') !== false) $ext = substr($file_name, $pos, strlen($file_name));
							if ($this->upload_file_without_extension) $file_name = $this->upload_file_name[$i];
							else $file_name = $this->upload_file_name[$i] . $ext;
						}
						if (file_exists($this->upload_directory[$i] . '\\' . $file_name) && !$this->upload_allow_overwrite[$i]) $file_name = stringTools::get_unique_id() . '_' . $file_name;
						move_uploaded_file($_FILES[$this->field_name_array[$i]]['tmp_name'], $this->upload_directory[$i] . '/' . $file_name);
						if ($this->upload_save_in_db == "original") $this->field_value_array[$i] = $_FILES[$this->field_name_array[$i]]['name'];
						else $this->field_value_array[$i] = $file_name;
						if (!$first) $query .= ',';
						$first = false;
						$query .= $this->field_name_array[$i] . "=";
						if ($this->field_unicode_array[$i]) $query .= "N";
						$query .= "'" . $this->field_value_array[$i] . "'";
					}
				}
				else $empty = true;
			}
			else {
				if ($this->field_name_array[$i] != '' && ($this->field_value_array[$i] != '' || $this->show_type_array[$i] != "P")) {
					if (!$first) $query .= ',';
					$first = false;
					if ($this->use_md5_array[$i]) $this->field_value_array[$i] = md5($this->field_value_array[$i]);
					$query .= $this->field_name_array[$i] . "=";
					if ($this->field_type_array[$i] == "S" || (($this->field_type_array[$i] == "D" || $this->field_type_array[$i] == "d") && $this->field_value_array[$i] != 'NULL')) $query .= "'";
					$query .= $this->field_value_array[$i];
					if ($this->field_type_array[$i] == "S" || (($this->field_type_array[$i] == "D" || $this->field_type_array[$i] == "d") && $this->field_value_array[$i] != 'NULL')) $query .= "'";
				}
			}
			//          if ($i!=$this->field_count-1 && !$empty)
			//            $query.=",";
			
		}
		$code_field = $this->code_field;
		$value = $_GET[$this->code_public];
		$query .= " WHERE $code_field='$value'";
		return ($this->query($query));
	}

	//internal use
	private function delete() {
		global $_POST, $_GET;
		$table_name = $this->table_name;
		$code_field = $this->code_field;
		$value = $_GET[$this->code_public];
		$query = "DELETE FROM $table_name WHERE $code_field='$value'";
		return ($this->query($query));
	}

	//internal use
	private function _show_form($start = 1) {
		$QUERY_STRING = $_SERVER["QUERY_STRING"];
		if ($start != 0) {
			if (!$this->dont_include_form_tag) {
?>
<form name="_form" id="_form" method="POST" action="<?=$_SERVER["PHP_SELF"] ?>?<?=$_SERVER["QUERY_STRING"] ?>"<?=(in_array("F", $this->show_type_array) ? ' enctype="multipart/form-data"' : "") ?>>
<?
			}
?>
<input type="hidden" name="_submitted_" value="1">
<?
		}
		else {
			if (!$this->dont_include_form_tag) {
?>
</form>
<?
			}
		}
	}

	public function show_form_body() {
		if (!$this->_redirected) {
			$this->_show_form(1);
			$this->_show_error();
			$this->_show_table_body();
			$this->_show_form(0);
		}
	}

	//internal use
	private function _show_error() {
		if ($this->state == "error" && $this->_error_message == '') {
			$this->_error_message = $this->general_error_message;
		}
		if ($this->_error_message != '') {
			echo '<p';
			if ($this->error_style) echo ' style="' . $this->error_style . '"';
			if ($this->error_class) echo ' class="' . $this->error_class . '"';
			echo '>';
			echo $this->_error_message;
			echo '</p>';
		}
	}

	//internal use
	private function _show_table($start = 1) {
		if ($start != 0) {
			echo '<table';
			if ($this->tb_class) echo ' class="' . $this->tb_class . '"';
			if ($this->tb_style) echo ' style="' . $this->tb_style . '"';
			if ($this->tb_width) echo ' width="' . $this->tb_width . '"';
			if ($this->cellpadding) echo ' cellpadding="' . $this->cellpadding . '"';
			if ($this->cellspacing) echo ' cellspacing="' . $this->cellspacing . '"';
			if ($this->border) echo ' border="' . $this->border . '"';
			if ($this->border_color) echo ' bordercolor="' . $this->border_color . '"';
			echo '>';
		}
		else echo '</table>';
		echo "\n";
	}

	//internal use
	private function _show_td($row, $col, $start = 1, $col_span = 1) {
		if ($start != 0) {
			$bg_color = '';
			if ($col == 1 && $col_span == 1) $bg_color = $this->td1_bgcolor_array[$row];
			if ($col == 2 && $col_span == 1) $bg_color = $this->td2_bgcolor_array[$row];
			echo '<td';
			if ($bg_color != '') echo ' bgcolor="' . $bg_color . '"';
			if ($col == 1 && $this->td_width_1) echo ' width="' . $this->td_width_1 . '"';
			if ($col == 2 && $this->td_width_2) echo ' width="' . $this->td_width_2 . '"';
			if ($col == 1 && $this->td_align_1) echo ' align="' . $this->td_align_1 . '"';
			if ($col == 2 && $this->td_align_2) echo ' align="' . $this->td_align_2 . '"';
			if ($col == 1 && ($this->show_type_array[$row] == "A" || $this->show_type_array[$row] == "a")) echo ' valign="top"';
			if ($col == 3) echo ' align="center" colspan="2"';
			if ($this->td_style) echo ' style="' . $this->td_style . '"';
			if ($col == 1 && $this->td_style_1) echo ' style="' . $this->td_style_1 . '"';
			if ($col == 2 && $this->td_style_2) echo ' style="' . $this->td_style_2 . '"';
			if ($this->td_class) echo ' class="' . $this->td_class . '"';
			echo '>';
		}
		else {
			echo '</td>';
			echo "\n";
		}
	}

	//internal use
	private function _show_tr($bg_color, $start = 1) {
		if ($start != 0) {
			echo '<tr';
			if ($bg_color) echo ' bgcolor="' . $bg_color . '"';
			if ($this->tr_style) echo ' style="' . $this->tr_style . '"';
			if ($this->tr_class) echo ' class="' . $this->tr_class . '"';
			echo '>';
		}
		else echo '</tr>';
		echo "\n";
	}

	//internal use
	private function _show_table_body() {
		$this->_show_table();
		for ($i = 0;$i < $this->field_count;$i++) {
			if ($this->show_type_array[$i] == "H" || $this->show_type_array[$i] == "h") {
				$this->_show_input($i);
			}
			else {
				$this->_show_tr($this->tr_bgcolor_array[$i]);
				$this->_show_td($i, 1);
				if ($this->show_star && !$this->field_nul_array[$i] && $this->star_pos == 'before title') echo $this->star_source;
				$this->_show_description($i);
				if ($this->show_star && !$this->field_nul_array[$i] && $this->star_pos == 'after title') echo $this->star_source;
				$this->_show_td($i, 1, 0);
				$this->_show_td($i, 2);
				if ($this->show_star && !$this->field_nul_array[$i] && $this->star_pos == 'before field') echo $this->star_source;
				$this->_show_input($i);
				if ($this->text_after_field[$i] != '') echo ' ' . $this->text_after_field[$i];
				if ($this->show_star && !$this->field_nul_array[$i] && $this->star_pos == 'after field') echo $this->star_source;
				$this->_show_td($i, 2, 0);
				$this->_show_tr('', 0);
				if ($this->repeat_password_array[$i]) {
					$this->_show_tr($this->tr_bgcolor_array[$i]);
					$this->_show_td($i, 1);
					if ($this->show_star && !$this->field_nul_array[$i] && $this->star_pos == 'before title') echo $this->star_source;
					$this->_show_description($i, 1);
					if ($this->show_star && !$this->field_nul_array[$i] && $this->star_pos == 'after title') echo $this->star_source;
					$this->_show_td($i, 1, 0);
					$this->_show_td($i, 2);
					if ($this->show_star && !$this->field_nul_array[$i] && $this->star_pos == 'before field') echo $this->star_source;
					$this->_show_input($i, 1);
					if ($this->show_star && !$this->field_nul_array[$i] && $this->star_pos == 'after field') echo $this->star_source;
					$this->_show_td($i, 2, 0);
					$this->_show_tr('', 0);
				}
				if ($this->comment_array[$i] != '') {
					$this->_show_tr($this->tr_bgcolor_array[$i]);
					$this->_show_td($i, 3, 1);
					echo $this->comment_array[$i];
					$this->_show_td($i, 3, 0);
					$this->_show_tr('', 0);
				}
			}
		}
		$this->_show_tr('');
		$this->_show_td($i, 3, 1);
		$this->_show_buttons();
		$this->_show_td($i, 3, 0);
		$this->_show_tr('', 0);
		if ($this->after_buttons_html != '') {
			$this->_show_tr('');
			$this->_show_td($i, 3, 1);
			echo $this->after_buttons_html;
			$this->_show_td($i, 3, 0);
			$this->_show_tr('', 0);
		}
		$this->_show_table(0);
	}

	//internal use
	private function _show_description($row, $repeat = 0) {
		if ($repeat) {
			if ($this->redescription_array[$row] != '') echo $this->redescription_array[$row] . ':';
			else echo "&nbsp;";
		}
		else {
			if ($this->description_array[$row] != '') echo $this->description_array[$row] . ':';
			else echo "&nbsp;";
		}
	}

	//internal use
	private function _show_input($row, $repeat = 0) {
		switch ($this->show_type_array[$row]) {
			case "h":
			case "H": //text
				$this->_show_hidden_input($row);
			break;
			case "t":
			case "T": //text
				$this->_show_text_input($row);
			break;
			case "p":
			case "P": //password
				$this->_show_password_input($row, $repeat);
			break;
			case "r":
			case "R": //radio button
				$this->_show_radio_input($row);
			break;
			case "s":
			case "S": //combo box
				$this->_show_select_input($row);
			break;
			case "c":
			case "C": //check box
				$this->_show_check_input($row);
			break;
			case "a":
			case "A": //text area
				$this->_show_textarea_input($row);
			break;
			case "f":
			case "F": //file upload
				$this->_show_file_input($row);
			break;
			case "g":
			case "G": //Gregorian date input
				$this->_show_gregorian_date_input($row);
			break;
			case "dm":
			case "DM": //date & time input
				$this->_show_date_input($row);
				$this->_show_date_time_separator($row);
				$this->_show_time_input($row, false);
			break;
			case "d":
			case "D": //date input
				$this->_show_date_input($row);
			break;
			case "m":
			case "M": //time input
				$this->_show_time_input($row, true);
			break;
		}
		if ($this->span_id_array[$row] != '') echo '<span id="' . $this->span_id_array[$row] . '"></span>';
	}

	//internal use
	private function _show_file_input($row) {
		echo '<input type="file" name="';
		echo $this->field_name_array[$row];
		echo '"';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		echo ' id="';
		echo $this->field_name_array[$row];
		echo '"';
		if ($this->field_show_class) echo ' class="' . $this->field_show_class . '"';
		if ($this->field_show_style[$row]) echo ' style="' . $this->field_show_style[$row] . '"';
		if ($this->field_ltr[$row]) echo ' dir="ltr" ';
		if ($this->field_length_array[$row]) echo ' size="' . $this->field_length_array[$row] . '" ';
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '"';
		if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '"';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '"';
		echo '>';
	}

	//internal use
	private function _show_date_time_separator($row) {
		echo $this->date_time_separator_array[$row];
	}

	//internal use
	private function _show_hidden_input($row) {
		echo '<input type="hidden" name="';
		echo $this->field_name_array[$row];
		echo '" id="';
		echo $this->field_name_array[$row];
		echo '" value="';
		echo $this->field_value_array[$row];
		echo '">';
	}

	//internal use
	private function _show_text_input($row) {
		echo '<input type="text" name="';
		echo $this->field_name_array[$row];
		echo '" id="';
		echo $this->field_name_array[$row];
		echo '" value="';
		if ($this->field_type_array[$row] != "I" || $this->field_value_array[$row] != "NULL") echo $this->field_value_array[$row];
		echo '" ';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_readonly_array[$row]) echo " readonly ";
		if ($this->field_show_class) echo 'class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo 'style="' . $this->field_show_style[$row] . '" ';
		if ($this->field_length_array[$row]) echo 'size="' . $this->field_length_array[$row] . '" ';
		if ($this->field_max_length_array[$row]) echo 'maxlength="' . $this->field_max_length_array[$row] . '" ';
		if ($this->field_ltr[$row]) echo 'dir="ltr" ';
		if ($this->farsi_type_array[$row]) echo 'onkeypress="FKeyPress()" onkeydown="FKeyDown()" ';
		if ($this->on_change_array[$row] != '') echo 'onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo 'onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo 'oninput="' . $this->on_input_array[$row] . '" ';
		echo '>';
	}

	//internal use
	private function _show_time_input($row, $show_date_part) {
		if ($this->field_value_array[$row] == 'NULL' || $this->field_value_array[$row] == '') {
			$h = '';
			$n = '';
		}
		else if ($this->field_value_array[$row] == 'Error') {
			if ($_POST[$this->field_name_array[$row] . "_d"] != '') $this->field_time_date_part[$row] = $_POST[$this->field_name_array[$row] . "_d"];
			$h = $this->field_name_array[$row] . "_h";
			$n = $this->field_name_array[$row] . "_n";
			$h = $_POST[$h];
			$n = $_POST[$n];
		}
		else {
			$time = strtotime($this->field_value_array[$row]);
			$h = date('H', $time);
			$n = date('i', $time);
			if ($this->state == "select") $this->field_time_date_part[$row] = date('m-d-Y', $time);
			else if ($_POST[$this->field_name_array[$row] . "_d"] != '') $this->field_time_date_part[$row] = $_POST[$this->field_name_array[$row] . "_d"];
		}
		if ($show_date_part) echo '<input type="hidden" name="' . $this->field_name_array[$row] . '_d" value="' . $this->field_time_date_part[$row] . '">';
		echo '<span dir="ltr">';
		echo '<select size="1" name="';
		echo $this->field_name_array[$row];
		echo '_h" id="';
		echo $this->field_name_array[$row];
		echo '_h"';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_show_class) echo ' class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo ' style="' . $this->field_show_style[$row] . '" ';
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		echo 'style="margin-left: 1">';
		if ($this->field_time_start_hour[$row] == "") $this->field_time_start_hour[$row] = 0;
		if ((int)($this->field_time_start_hour[$row]) > 23) $this->field_time_start_hour[$row] = 23;
		if ($this->field_time_end_hour[$row] == "") $this->field_time_end_hour[$row] = 23;
		if ((int)($this->field_time_end_hour[$row]) < 0) $this->field_time_end_hour[$row] = 0;
?>
<option value=""></option>
<?
		for ($i = $this->field_time_start_hour[$row];$i <= $this->field_time_end_hour[$row];$i++) {
			$ii = ($i < 10 ? '0' . $i : $i);
?>
<option value="<?=$ii
?>"<?=($h == $ii) ? " selected" : "" ?>><?=$ii ?></option>
<?
		}
		echo "</select>";
		echo " : ";
		echo '<select size="1" name="';
		echo $this->field_name_array[$row];
		echo '_n" id="';
		echo $this->field_name_array[$row];
		echo '_n"';
		if ($this->field_show_class) echo ' class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo ' style="' . $this->field_show_style[$row] . '" ';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		echo 'style="margin-left: 1">';
		if ($n % $this->field_time_minute_step[$row] != 0) $n = round($n / $this->field_time_minute_step[$row]) * $this->field_time_minute_step[$row];
		if ($this->field_time_minute_step[$row] == '') $this->field_time_minute_step[$row] = 1;
?>
<option value=""></option>
<?
		switch ($this->field_time_minute_step[$row]) {
			case 1:
			case 5:
			case 10:
			case 15:
			case 30:
			case 60:
				for ($i = 0;$i <= 59;$i += $this->field_time_minute_step[$row]) {
					$ii = ($i < 10 ? '0' . $i : $i);
?>
<option value="<?=$ii
?>"<?=($n == $ii) ? " selected" : "" ?>><?=$ii ?></option>
<?
				}
				break;
			}
			echo "</select>";
			echo '</span>';
	}

	//internal use
	private function _show_date_input($row) {
		$start_year = $this->field_date_start_year[$row];
		$end_year = $this->field_date_end_year[$row];
		if ($this->field_value_array[$row] == 'NULL' || $this->field_value_array[$row] == '') {
			if ($this->default_date_value[$row] === '' || !isset($this->default_date_value[$row])) {
				$d = 0;
				$m = 0;
				$y = 0;
			}
			else {
				$time_set = time() + 86400 * $this->default_date_value[$row];
				$y = date("Y", $time_set);
				$m = date("m", $time_set);
				$d = date("d", $time_set);
				dateTimeFormat::m2sh($y, $m, $d);
			}
		}
		else if ($this->field_value_array[$row] == 'Error') {
			$y = $this->field_name_array[$row] . "_y";
			$m = $this->field_name_array[$row] . "_m";
			$d = $this->field_name_array[$row] . "_d";
			$y = $_POST[$y];
			$m = $_POST[$m];
			$d = $_POST[$d];
		}
		else {
			//echo $this->field_value_array[$row];
			//        $date_array=preg_split("/ /", $this->field_value_array[$row]);
			//        $_date=$date_array[1].' '.$date_array[0].' '.$date_array[2];
			//        $_date=strtodate($_date);
			//        $date_str=mtosh($_date);
			//        $d=substr($date_str,0,2);
			//        $m=substr($date_str,3,2);
			//        $y=substr($date_str,6,4);
			// changed for an unwanted error!!!:
			//        $time_set=str2time($this->field_value_array[$row]);
			$time_set = strtotime($this->field_value_array[$row]);
			if ($time_set == "") $time_set = time();
			$y = date("Y", $time_set);
			$m = date("m", $time_set);
			$d = date("d", $time_set);
			dateTimeFormat::m2sh($y, $m, $d);
		}
		$now_set = time();
		$y_now = date("Y", $now_set);
		$m_now = date("m", $now_set);
		$d_now = date("d", $now_set);
		dateTimeFormat::m2sh($y_now, $m_now, $d_now);

		echo '<select size="1" name="';
		echo $this->field_name_array[$row];
		echo '_d" id="';
		echo $this->field_name_array[$row];
		echo '_d"';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_show_class) echo ' class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo ' style="' . $this->field_show_style[$row] . '" ';
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		echo 'style="margin-left: 1">' . "\n\r";
?>
<option></option>
<option<?=($d == "01" ? " selected" : "") ?>>01</option>
<option<?=($d == "02" ? " selected" : "") ?>>02</option>
<option<?=($d == "03" ? " selected" : "") ?>>03</option>
<option<?=($d == "04" ? " selected" : "") ?>>04</option>
<option<?=($d == "05" ? " selected" : "") ?>>05</option>
<option<?=($d == "06" ? " selected" : "") ?>>06</option>
<option<?=($d == "07" ? " selected" : "") ?>>07</option>
<option<?=($d == "08" ? " selected" : "") ?>>08</option>
<option<?=($d == "09" ? " selected" : "") ?>>09</option>
<option<?=($d == "10" ? " selected" : "") ?>>10</option>
<option<?=($d == "11" ? " selected" : "") ?>>11</option>
<option<?=($d == "12" ? " selected" : "") ?>>12</option>
<option<?=($d == "13" ? " selected" : "") ?>>13</option>
<option<?=($d == "14" ? " selected" : "") ?>>14</option>
<option<?=($d == "15" ? " selected" : "") ?>>15</option>
<option<?=($d == "16" ? " selected" : "") ?>>16</option>
<option<?=($d == "17" ? " selected" : "") ?>>17</option>
<option<?=($d == "18" ? " selected" : "") ?>>18</option>
<option<?=($d == "19" ? " selected" : "") ?>>19</option>
<option<?=($d == "20" ? " selected" : "") ?>>20</option>
<option<?=($d == "21" ? " selected" : "") ?>>21</option>
<option<?=($d == "22" ? " selected" : "") ?>>22</option>
<option<?=($d == "23" ? " selected" : "") ?>>23</option>
<option<?=($d == "24" ? " selected" : "") ?>>24</option>
<option<?=($d == "25" ? " selected" : "") ?>>25</option>
<option<?=($d == "26" ? " selected" : "") ?>>26</option>
<option<?=($d == "27" ? " selected" : "") ?>>27</option>
<option<?=($d == "28" ? " selected" : "") ?>>28</option>
<option<?=($d == "29" ? " selected" : "") ?>>29</option>
<option<?=($d == "30" ? " selected" : "") ?>>30</option>
<option<?=($d == "31" ? " selected" : "") ?>>31</option>
</select>
<?
		echo '<select size="1" name="';
		echo $this->field_name_array[$row];
		echo '_m" id="';
		echo $this->field_name_array[$row];
		echo '_m"';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_show_class) echo ' class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo ' style="' . $this->field_show_style[$row] . '" ';
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		echo 'style="margin-left: 1; margin-right:1">' . "\n\r";
?>
<option></option>
<option value="01"<?=($m == "01" ? " selected" : "") ?>>فروردين</option>
<option value="02"<?=($m == "02" ? " selected" : "") ?>>ارديبهشت</option>
<option value="03"<?=($m == "03" ? " selected" : "") ?>>خرداد</option>
<option value="04"<?=($m == "04" ? " selected" : "") ?>>تير</option>
<option value="05"<?=($m == "05" ? " selected" : "") ?>>مرداد</option>
<option value="06"<?=($m == "06" ? " selected" : "") ?>>شهريور</option>
<option value="07"<?=($m == "07" ? " selected" : "") ?>>مهر</option>
<option value="08"<?=($m == "08" ? " selected" : "") ?>>آبان</option>
<option value="09"<?=($m == "09" ? " selected" : "") ?>>آذر</option>
<option value="10"<?=($m == "10" ? " selected" : "") ?>>دي</option>
<option value="11"<?=($m == "11" ? " selected" : "") ?>>بهمن</option>
<option value="12"<?=($m == "12" ? " selected" : "") ?>>اسفند</option>
</select>
<?
		echo '<select size="1" name="';
		echo $this->field_name_array[$row];
		echo '_y" id="';
		echo $this->field_name_array[$row];
		echo '_y"';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_show_class) echo ' class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo ' style="' . $this->field_show_style[$row] . '" ';
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		echo ">\n\r";
?>
<option></option>
<?
		$_start = $y_now + $start_year;
		$_end = $y_now + $end_year;
		if ($y < $_start && $y != 0) $_start = $y;
		if ($y > $_end) $_end = $y;
		for ($i = $_start;$i <= $_end;$i++) echo '<option' . ($i == $y ? " selected" : "") . '>' . $i . "</option>\n\r";
?>
</select>
<?
	}

	//internal use
	private function _show_gregorian_date_input($row) {
		$start_year = $this->field_date_start_year[$row];
		$end_year = $this->field_date_end_year[$row];
		if ($this->field_value_array[$row] == 'NULL' || $this->field_value_array[$row] == '') {
			if ($this->default_date_value[$row] == '') {
				$d = 0;
				$m = 0;
				$y = 0;
			}
			else {
				$time_set = time() + 86400 * $this->default_date_value[$row];
				$y = date("Y", $time_set);
				$m = date("m", $time_set);
				$d = date("d", $time_set);
			}
		}
		else if ($this->field_value_array[$row] == 'Error') {
			$y = $this->field_name_array[$row] . "_y";
			$m = $this->field_name_array[$row] . "_m";
			$d = $this->field_name_array[$row] . "_d";
			$y = $_POST[$y];
			$m = $_POST[$m];
			$d = $_POST[$d];
		}
		else {
			$time_set = dateTimeFormat::str2time($this->field_value_array[$row]);
			if ($time_set == "") $time_set = time();
			$y = date("Y", $time_set);
			$m = date("m", $time_set);
			$d = date("d", $time_set);
			//        m2sh($y,$m,$d);
			
		}

		$now_set = time();
		$y_now = date("Y", $now_set);
		$m_now = date("m", $now_set);
		$d_now = date("d", $now_set);
		//      m2sh($y_now,$m_now,$d_now);
		

		echo '<select size="1" name="';
		echo $this->field_name_array[$row];
		echo '_d" id="';
		echo $this->field_name_array[$row];
		echo '_d"';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_show_class) echo ' class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo ' style="' . $this->field_show_style[$row] . '" ';
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		echo 'style="margin-left: 1">' . "\n\r";
?>
<option></option>
<option<?=($d == "01" ? " selected" : "") ?>>01</option>
<option<?=($d == "02" ? " selected" : "") ?>>02</option>
<option<?=($d == "03" ? " selected" : "") ?>>03</option>
<option<?=($d == "04" ? " selected" : "") ?>>04</option>
<option<?=($d == "05" ? " selected" : "") ?>>05</option>
<option<?=($d == "06" ? " selected" : "") ?>>06</option>
<option<?=($d == "07" ? " selected" : "") ?>>07</option>
<option<?=($d == "08" ? " selected" : "") ?>>08</option>
<option<?=($d == "09" ? " selected" : "") ?>>09</option>
<option<?=($d == "10" ? " selected" : "") ?>>10</option>
<option<?=($d == "11" ? " selected" : "") ?>>11</option>
<option<?=($d == "12" ? " selected" : "") ?>>12</option>
<option<?=($d == "13" ? " selected" : "") ?>>13</option>
<option<?=($d == "14" ? " selected" : "") ?>>14</option>
<option<?=($d == "15" ? " selected" : "") ?>>15</option>
<option<?=($d == "16" ? " selected" : "") ?>>16</option>
<option<?=($d == "17" ? " selected" : "") ?>>17</option>
<option<?=($d == "18" ? " selected" : "") ?>>18</option>
<option<?=($d == "19" ? " selected" : "") ?>>19</option>
<option<?=($d == "20" ? " selected" : "") ?>>20</option>
<option<?=($d == "21" ? " selected" : "") ?>>21</option>
<option<?=($d == "22" ? " selected" : "") ?>>22</option>
<option<?=($d == "23" ? " selected" : "") ?>>23</option>
<option<?=($d == "24" ? " selected" : "") ?>>24</option>
<option<?=($d == "25" ? " selected" : "") ?>>25</option>
<option<?=($d == "26" ? " selected" : "") ?>>26</option>
<option<?=($d == "27" ? " selected" : "") ?>>27</option>
<option<?=($d == "28" ? " selected" : "") ?>>28</option>
<option<?=($d == "29" ? " selected" : "") ?>>29</option>
<option<?=($d == "30" ? " selected" : "") ?>>30</option>
<option<?=($d == "31" ? " selected" : "") ?>>31</option>
</select>
<?
		echo '<select size="1" name="';
		echo $this->field_name_array[$row];
		echo '_m" id="';
		echo $this->field_name_array[$row];
		echo '_m"';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_show_class) echo ' class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo ' style="' . $this->field_show_style[$row] . '" ';
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		echo 'style="margin-left: 1; margin-right:1">' . "\n\r";
?>
<option></option>
<option value="01"<?=($m == "01" ? " selected" : "") ?>>Jan</option>
<option value="02"<?=($m == "02" ? " selected" : "") ?>>Feb</option>
<option value="03"<?=($m == "03" ? " selected" : "") ?>>Mar</option>
<option value="04"<?=($m == "04" ? " selected" : "") ?>>Apr</option>
<option value="05"<?=($m == "05" ? " selected" : "") ?>>May</option>
<option value="06"<?=($m == "06" ? " selected" : "") ?>>Jun</option>
<option value="07"<?=($m == "07" ? " selected" : "") ?>>Jul</option>
<option value="08"<?=($m == "08" ? " selected" : "") ?>>Aug</option>
<option value="09"<?=($m == "09" ? " selected" : "") ?>>Sep</option>
<option value="10"<?=($m == "10" ? " selected" : "") ?>>Oct</option>
<option value="11"<?=($m == "11" ? " selected" : "") ?>>Nov</option>
<option value="12"<?=($m == "12" ? " selected" : "") ?>>Dec</option>
</select>
<?
		echo '<select size="1" name="';
		echo $this->field_name_array[$row];
		echo '_y" id="';
		echo $this->field_name_array[$row];
		echo '_y"';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_show_class) echo ' class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo ' style="' . $this->field_show_style[$row] . '" ';
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		echo '>' . "\n\r";
?>
<option></option>
<?
		$_start = $y_now + $start_year;
		$_end = $y_now + $end_year;
		if ($y < $_start && $y != 0) $_start = $y;
		if ($y > $_end) $_end = $y;
		for ($i = $_start;$i <= $_end;$i++) echo '<option' . ($i == $y ? " selected" : "") . '>' . $i . "</option>\n\r";
?>
</select>
<?
	}

	//internal use
	private function _show_password_input($row, $repeat) {
		echo '<input type="password" name="';
		if ($repeat) echo $this->refield_name_array[$row];
		else echo $this->field_name_array[$row];
		echo '" ';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		echo 'id="';
		if ($repeat) echo $this->refield_name_array[$row];
		else echo $this->field_name_array[$row];
		echo '" ';
		if ($this->field_show_class) echo 'class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo 'style="' . $this->field_show_style[$row] . '" ';
		if ($this->field_length_array[$row]) echo 'size="' . $this->field_length_array[$row] . '" ';
		if ($this->field_max_length_array[$row]) echo 'maxlength="' . $this->field_max_length_array[$row] . '" ';
		if ($this->field_ltr[$row]) echo 'dir="ltr" ';
		if ($this->on_change_array[$row] != '') echo 'onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo 'onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		echo '>';
	}

	//internal use
	private function _show_select_input($row) {
		echo '<select size="1" name="' . $this->field_name_array[$row] . '"';
		echo ' id="';
		echo $this->field_name_array[$row];
		echo '"';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_show_class) echo ' class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo ' style="' . $this->field_show_style[$row] . '" ';
		if ($this->field_ltr[$row]) echo ' dir="ltr" ';
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		echo '>';
		echo "\n";
		reset($this->field_option_array[$row]);
		foreach($this->field_option_array[$row] as $key => $val) {
			echo '<option value="';
			echo $key;
			echo '"';
			if ($this->field_value_array[$row] == $key) echo " selected";
			echo '>';
			echo $val;
			echo '</option>';
			echo "\n";
		}
		echo '</select>';
	}

	//internal use
	private function _show_radio_input($row) {
		reset($this->field_option_array[$row]);
        foreach ($this->field_option_array[$row] as $key => $val) {
			$key = (string)$key;
			echo '<input type="radio" name="';
			echo $this->field_name_array[$row];
			echo '" value="';
			echo $key;
			echo '" ';
			if ($this->field_value_array[$row] == $key) echo " checked ";
			if ($this->field_disabled_array[$row]) echo " disabled ";
			if ($this->field_ltr[$row]) echo 'dir="ltr" ';
			if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
			if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '" ';
			if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
			echo 'id="';
			echo $this->field_name_array[$row] . '_' . $key;
			echo '"';
			echo '>';
			echo '<label for="';
			echo $this->field_name_array[$row] . '_' . $key;
			echo '">';
			echo $val;
			echo '</label>';
			echo "<br>\n";
		}
	}

	//internal use
	private function _show_check_input($row) {
		if ($this->check_value_array[$row] == '') $this->check_value_array[$row] = 1;
		echo '<input type="checkbox" name="';
		echo $this->field_name_array[$row];
		echo '" value="' . $this->check_value_array[$row] . '" ';
		echo ' id="';
		echo $this->field_name_array[$row];
		echo '" ';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_value_array[$row] && $this->field_value_array[$row] != 'NULL') echo 'checked';
		if ($this->field_ltr[$row]) echo 'dir="ltr" ';
		if ($this->on_change_array[$row] != '') echo ' onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo ' onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		if ($this->field_class_array[$row]) echo ' class="' . $this->field_class_array[$row] . '" ';
		echo '>';
		if ($this->field_option_array[$row] != '') {
			echo '<label for="';
			echo $this->field_name_array[$row];
			echo '">';
			echo $this->field_option_array[$row];
			echo '</label>';
		}
	}

	//internal use
	private function _show_textarea_input($row) {
		echo '<textarea name="';
		echo $this->field_name_array[$row];
		echo '" id="';
		echo $this->field_name_array[$row];
		echo '" ';
		if ($this->field_disabled_array[$row]) echo " disabled ";
		if ($this->field_readonly_array[$row]) echo " readonly ";
		if ($this->field_show_class) echo 'class="' . $this->field_show_class . '" ';
		if ($this->field_show_style[$row]) echo 'style="' . $this->field_show_style[$row] . '" ';
		if ($this->field_length_array[$row]) echo 'cols="' . $this->field_length_array[$row] . '" ';
		if ($this->field_height_array[$row]) echo 'rows="' . $this->field_height_array[$row] . '" ';
		if ($this->field_ltr[$row]) echo 'dir="ltr" ';
		if ($this->on_change_array[$row] != '') echo 'onchange="' . $this->on_change_array[$row] . '" ';
		if ($this->on_blur_array[$row] != '') echo 'onblur="' . $this->on_blur_array[$row] . '" ';
		if ($this->on_input_array[$row] != '') echo ' oninput="' . $this->on_input_array[$row] . '" ';
		if ($this->farsi_type_array[$row]) echo 'onkeypress="FKeyPress()" onkeydown="FKeyDown()" ';
		echo '>';
		echo $this->field_value_array[$row];
		echo '</textarea>';
	}

	//internal use
	private function check_rules() {
		$error = - 1;
		for ($i = 0;$i < $this->field_count;$i++) {
			if (!($this->field_nul_array[$i]) && $this->show_type_array[$i] == "P" && $this->state == "insert" && $this->field_value_array[$i] == "") {
				$error = $i;
				$this->error_type = 'Empty';
				break;
			}
			else if (!($this->field_nul_array[$i]) && ($this->show_type_array[$i] == "R" || $this->show_type_array[$i] == "S" || $this->show_type_array[$i] == "D" || $this->show_type_array[$i] == "M" || $this->show_type_array[$i] == "DM" || $this->show_type_array[$i] == "T") && (($this->field_type_array[$i] == "I" && $this->field_value_array[$i] == "NULL") || $this->field_value_array[$i] == '')) {
				$error = $i;
				$this->error_type = 'Empty';
				break;
			}
			else if (!($this->field_nul_array[$i]) && $this->show_type_array[$i] == "F" && $_GET[$this->code_public] == "" && ($_FILES[$this->field_name_array[$i]]['error'] != 0 || $_FILES[$this->field_name_array[$i]]['size'] == 0)) {
				$error = $i;
				$this->error_type = 'Empty';
				break;
			}
			else if (($this->show_type_array[$i] == "D" || $this->show_type_array[$i] == "d" || $this->show_type_array[$i] == "DM" || $this->show_type_array[$i] == "dm") && $this->field_value_array[$i] == 'Error') {
				$error = $i;
				$this->error_type = 'Date';
				break;
			}
			else if ($this->show_type_array[$i] == "P" && $this->repeat_password_array[$i] && ($this->field_value_array[$i] != $_POST[$this->refield_name_array[$i]])) {
				$error = $i;
				$this->error_type = 'Repeat';
				break;
			}
			else if ($this->field_value_array[$i] != '' && $this->field_min_value_array[$i] != '' && $this->field_value_array[$i] < $this->field_min_value_array[$i]) {
				$error = $i;
				$this->error_type = 'Min';
				break;
			}
			else if ($this->field_value_array[$i] != '' && $this->field_max_value_array[$i] != '' && $this->field_value_array[$i] > $this->field_max_value_array[$i]) {
				$error = $i;
				$this->error_type = 'Max';
				break;
			}
			else if ((!$this->field_nul_array[$i] || $this->field_value_array[$i] != "") && ($this->field_regex_array[$i] != '' && !preg_match($this->field_regex_array[$i], $this->field_value_array[$i]))) {
				$error = $i;
				$this->error_type = 'Regex';
				break;
			}
		}
		if ($this->custom_error_number) {
			$this->error_type = 'Custom';
			$error = $this->custom_error_number;
		}
		return ($error);
	}

	private function _show_buttons() {
		global $_POST, $_GET;
		$value = $_GET[$this->code_public];
		if (!$this->dont_show_buttons) {
			if (!$this->image_buttons) {
				if ($this->show_submit) {
?>
<input type="submit" id="submit" name="submit" value="<?=$this->submit_caption
?>" <?=($this->button_style ? 'style="' . $this->button_style . '"' : '') ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>/>&nbsp;
<?
				}
				if ($this->show_cancel) {
?>
<input type="submit" name="cancel" value="<?=$this->cancel_caption
?>" <?=($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>/>&nbsp;
<?
				}
				if ($this->show_delete && $value != "") {
?>
<input type="submit" name="delete" value="<?=$this->delete_caption
?>" onclick="if (! confirm('<?=$this->delete_message
?>')) return(false)" <?=($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>/>&nbsp;
<?
				}
				if ($this->show_reset) {
?>
<input type="reset" name="reset" value="<?=$this->reset_caption
?>" <?=($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>/>&nbsp;
<?
				}
				foreach ($this->extended_buttons_array as $key => $val) {
					$caption = $val["caption"];
					$onclick = $val["onclick"];
					$button_type = $val["type"]; // submit reset button
					$button_name = $val["name"];
					if ($button_type == "submit") {
?>
<input type="submit" name="<?=$button_name
?>" value="<?=$caption
?>" onclick="<?=$onclick
?>" <?=($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>/>&nbsp;
<?
					}
					else if ($button_type == "reset") {
?>
<input type="reset" name="<?=$button_name
?>" value="<?=$caption
?>" onclick="<?=$onclick
?>" <?=($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>/>&nbsp;
<?
					}
					else if ($button_type == "button") {
?>
<button name="<?=$button_name
?>" onclick="<?=$onclick
?>" <?=($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>><?=$caption ?></button>
<?
					}
				}
			}
			else {
				if ($this->show_submit) {
?>
<input type="image" name="submit" src="<?=$this->submit_image
?>" value="<?=$this->submit_caption
?>" <?=($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>>&nbsp;
<?
				}
				if ($this->show_cancel) {
?>
<input type="image" name="cancel" src="<?=$this->cancel_image
?>" value="<?=$this->cancel_caption
?>" <?=($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>>&nbsp;
<?
				}
				if ($this->show_delete && $value != "") {
?>
<input type="image" name="delete" src="<?=$this->delete_image
?>" value="<?=$this->delete_caption
?>" onclick="if (! confirm(<?=$this->delete_message
?>)) return(false)" <?=($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>>&nbsp;
<?
				}
				if ($this->show_reset) {
?>
<input type="image" name="reset" src="<?=$this->reset_image
?>" value="<?=$this->reset_caption
?>" onclick="_form.reset();return(false);" <?=($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>>&nbsp;
<?
				}
			}
		}
	}
}

function error_occured($errorno, $errorstr) {
	throw new \Exception($errorstr);
}

?>