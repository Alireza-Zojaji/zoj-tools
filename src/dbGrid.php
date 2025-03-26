<?
// 24 Dec 2010: Added td_height_array property
// 11 Jun 2011; Now this file is independent to system or PHP or SQL server date format
// 18 Oct 2012: Added caller_file_name property
// 18 Oct 2012: Fixed displaying next pages problem in Chrome
// 26 Oct 2012: Added td_ltr_array property
// 08 Dec 2012: Added #h# tag for reverse hegira date
// 07 Oct 2014: Fixed problem in tables with zero size border.
// 15 Nov 1014: Set persian date rtl in browsers other than MSIE.
// 15 Nov 2014: Added use of functon get_farsi_date in #d# operations.
// 04 Apr 2015: Changed #r# tag for options to #o# because of conflict with #r# tag for radio buttom.
// 15 Jan 2016: Optimized some additional execution of the query.
// 26 Jan 2016: Added get_content & show_content functions.
// 31 May 2016: Added #T# for English time and changed #t# for farsi time.
// 23 Jul 2016: Added #m# for farsi row number.
// 23 Jul 2016: Added #s# for farsi number fields.
// 07 Mar 2017: Added td_class_array property.
// 12 Mar 2025: Chnaged for utf-8 character set.
// 14 Mar 2025: Fixed identity_insert for MySqli.
// 16 Mar 2025: Migrated from PHP 5.x to PHP 8.2 .
// 22 Mar 2025: Changed to composer compatible.
// 26 Mar 2025: Some optimizations applied.
// 26 Mar 2025: Added addColumn method.

namespace ZojTools;

use ZojTools\farsiTools\farsiNumber;
use ZojTools\numberTools\formatNumber;
use ZojTools\dateTimeTools\dateTimeFormat;

//This class shows a data table and manages it
class dbGrid {
	public $td_ltr_array;
	public $query;
	public $cellpading;
	public $cellspacing;
	public $border;
	public $border_color;
	public $tb_width;
	public $tb_style;
	public $tr_style;
	public $tb_class;
	public $tr_class;
	public $tr_head_bgcolor;
	public $tr_even_bgcolor;
	public $tr_odd_bgcolor;
	public $tr_head_color;
	public $tr_even_color;
	public $tr_odd_color;
	public $show_header;
	public $lines_per_page;
	public $page_number;
	public $row_count;
	public $max_page;
	public $have_prior;
	public $have_next;
	public $prior_message;
	public $next_message;
	public $primary_key;
	public $submit_label;
	public $table_name;
	public $title_spanned;
	public $label_array;
	public $add_qstr;
	public $max_page_link;
	public $is_null;
	public $col_count = 0;
	public $td_class;
	public $td_class_array;
	public $td_style_array;
	public $td_width_array;
	public $title_array;
	public $col_array; //text, field($f$field$), number($n$), query strings($q$)
	public $td_align_array;
	public $td_valign_array;
	public $sorting_array; //for developing
	public $has_form;
	public $submit_class;
	public $submit_style;
    public $db_link;
    public $col_array_content;
    public $caller_file_name;
    public $cellpadding;
    public $td_height_array;
	public $span_col_count;
	private $query_row;
	private $query_table;
	private $row_num;
	private $page_var;
	private $no_data_message;

	//constructor
	public function __construct(
		$db_link, 
		$query, 
		$lines_per_page = 10, 
		$page_var = "page", 
		$max_page_link = 10,
		$title_spanned = false,
		$span_col_count = 1
	) {
		global $$page_var;
        $this->db_link = $db_link;
		$this->max_page_link = $max_page_link;
		$this->page_var = $page_var;
		$this->query = $query;
		$this->page_number = $_GET[$this->page_var];
		if ($this->page_number == "") 
            $this->page_number = 1;
		$this->tb_width = "100%";
		$this->show_header = true;
		$this->lines_per_page = $lines_per_page;
		$this->query_table = $this->query($this->query);
		$this->row_count = mysqli_num_rows($this->query_table);
		$this->title_spanned = $title_spanned;
		$this->span_col_count = $span_col_count;
		if ($this->title_spanned) 
            $this->max_page = ceil($this->row_count / ($this->lines_per_page * $this->span_col_count));
		else 
            $this->max_page = ceil($this->row_count / ($this->lines_per_page));
		if ($this->max_page == 0) {
			$this->is_null = 1;
			$this->max_page = 1;
		}
		if ($this->page_number > $this->max_page) 
            $this->page_number = $this->max_page;
		if ($this->page_number < 1) 
            $this->page_number = 1;
		$this->have_prior = ($this->page_number > 1);
		$this->have_next = ($this->page_number < $this->max_page);
		$this->row_num = 1 + ($this->page_number - 1) * $this->lines_per_page;
		$this->no_data_message = "اطلاعات وجود ندارد.";
		//$this->no_data_message="No Data";
		$slash_pos = strrpos($_SERVER["PHP_SELF"], '/');
		$this->caller_file_name = substr($_SERVER["PHP_SELF"], $slash_pos + 1, strlen($_SERVER["PHP_SELF"]));
	}

	public function addColumn(
		$title,
		$content,
		$alignment = "center",
		$width = ""
	) {
		$this->title_array[$this->col_count] = $title;
		$this->td_align_array[$this->col_count] = $alignment;
		$this->col_array[$this->col_count] = $content;
		$this->td_width_array[$this->col_count] = $width;
		$this->col_count ++;
		return($this->col_count - 1);
	}

	//internal use
	public function query($query) {
		try {
			$result = mysqli_query($this->db_link, $query);
		}
		catch(\Exception $e) {
			$result = false;
		}
		return ($result);
        /*
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
		*/
	}

	function _do_submit() {
		for ($i = 0;$i <= $this->col_count;$i++) {
			if (($pos = strpos($this->col_array[$i], "#c#")) !== false) {
				$j = $pos + 3;
				$this->_next_sign($this->col_array[$i], $j);
				$field_name = substr($this->col_array[$i], $pos + 3, $j - $pos - 3);
				$row = 1;
				mysqli_data_seek($this->query_table, $this->row_num - 1);
				while (($this->query_row = mysqli_fetch_array($this->query_table)) && ($row <= $this->lines_per_page)) {
					$pk_code = $this->query_row[$this->primary_key];
					$var_name = "c" . $i . "_" . $pk_code;
					$value = $_POST[$var_name];
					if ($value == "") $value = "0";
					$this->query("
                        UPDATE {$this->table_name} SET {$field_name} = {$value} WHERE {$this->primary_key} = {$pk_code};
                    ");
					$row++;
				}
			}
			if (($pos = strpos($this->col_array[$i], "#r#")) !== false) {
				$j = $pos + 3;
				$pos2 = $this->_next_sign($this->col_array[$i], $j);
				$j = $pos2 + 1;
				$pos3 = $this->_next_sign($this->col_array[$i], $j);
				$j = $pos3 + 1;
				$pos4 = $this->_next_sign($this->col_array[$i], $j);
				$_field = substr($this->col_array[$i], $pos + 3, $pos2 - $pos - 3);
				$_value = substr($this->col_array[$i], $pos2 + 1, $pos3 - $pos2 - 1);
				$field_name = substr($this->col_array[$i], $pos3 + 1, $pos4 - $pos3 - 1);
				$radio_field[$_field] = $field_name;
			}
		}
		$row = 1;
		mysqli_data_seek($this->query_table, $this->row_num - 1);
		while (($this->query_row = mysqli_fetch_array($this->query_table)) && ($row <= $this->lines_per_page)) {
			$pk_code = $this->query_row[$this->primary_key];
			reset($radio_field);
            foreach ($radio_field as $key => $val) {
				$var_name = "r" . $key . "_" . $pk_code;
				$value = $_POST[$var_name];
				if ($value != "") 
                    $this->query("
                        UPDATE {$this->table_name} SET {$val} = {$value} WHERE {$this->primary_key} = {$pk_code};
                    ");
			}
			$row++;
		}
	}

	//internal use
	function query_string() {
		//      global $QUERY_STRING;
		$qstr = $_SERVER["QUERY_STRING"];
		$page_pos = strpos($qstr, "&page=");
		if (substr($qstr, 0, 5) == "page=") {
			$and_pos = strpos($qstr, "&");
			if ($and_pos === false) 
				$new_qstr = "";
			else 
				$new_qstr = substr($qstr, $and_pos + 1, strlen($qstr));
		}
		else {
			$page_pos = strpos($qstr, "&page=");
			if ($page_pos !== false) {
				$first_part = substr($qstr, 0, $page_pos);
				$second_part = substr($qstr, $page_pos + 1, strlen($qstr));
				$and_pos = strpos($second_part, "&");
				if ($and_pos === false) 
					$new_qstr = $first_part;
				else 
					$new_qstr = $first_part . substr($second_part, $and_pos, strlen($second_part));
			}
			else 
				$new_qstr = $qstr;
		}
		return ($new_qstr);
	}

	//internal use
	function initialize_grid() {
		if ($this->submit_label == "") 
			$this->submit_label = "Submit";
		$found_form = false;
        foreach ($this->col_array as $key => $val) {
			if (strpos($val, "#c#") !== false or strpos($val, "#r#") !== false) 
                $found_form = true;
		}
		$this->has_form = $found_form;
		if ($this->has_form && $_POST["_submit"] != "") 
			$this->_do_submit();
	}

	//shows link for page numbers
	function show_page_link($style = '', $class = '') {
		$step = (int)$this->max_page_link / 2;
		$min = $this->page_number - $step;
		if ($min < 1) 
			$min = 1;
		$max = $min + $this->max_page_link;
		if ($max > $this->max_page) 
			$max = $this->max_page;
		for ($page = $min;$page <= $max;$page++) {
			if ($page != $this->page_number) {
				$qs = $this->query_string();
				$qstr = $this->caller_file_name . '?' . $qs . ($qs == "" ? "" : "&") . $this->page_var . '=' . $page;
				if ($this->add_qstr) 
					$qstr .= '&' . $this->add_qstr;
				echo '<a href="' . $qstr . '"';
				if ($style) 
					echo ' style="' . $style . '"';
				if ($class) 
					echo ' class="' . $class . '"';
				echo '>' . $page . '</a>';
			}
			else echo '<span style="font-size: 135%"><b>' . $page . '</b></span>';
			echo '&nbsp&nbsp';
		}
	}

	//show prior page link
	function show_prior($message, $style = '', $class = '', $show_disabled = false) {
		if ($this->have_prior) {
			$qs = $this->query_string();
			$qstr = $this->caller_file_name . '?' . $qs . ($qs == "" ? "" : "&") . $this->page_var . '=' . ($this->page_number - 1);
			if ($this->add_qstr) 
				$qstr .= '&' . $this->add_qstr;
			echo '<a href="' . $qstr . '"';
			if ($style) 
				echo ' style="' . $style . '"';
			if ($class) 
				echo ' class="' . $class . '"';
			echo '>' . $message . '</a>';
		}
		else if ($show_disabled) 
			echo $message;
	}

	//show next page link
	function show_next($message, $style = '', $class = '', $show_disabled = false) {
		if ($this->have_next) {
			$qs = $this->query_string();
			$qstr = $this->caller_file_name . '?' . $qs . ($qs == "" ? "" : "&") . $this->page_var . '=' . ($this->page_number + 1);
			if ($this->add_qstr) 
				$qstr .= '&' . $this->add_qstr;
			echo '<a href="' . $qstr . '"';
			if ($style) 
				echo ' style="' . $style . '"';
			if ($class) 
				echo ' class="' . $class . '"';
			echo '>' . $message . '</a>';
		}
		else if ($show_disabled) 
			echo $message;
	}

	//shows defined code for all rows
	function show_content($content, $return = false) {
		$this->row_num = 1 + ($this->page_number - 1) * $this->lines_per_page;
		if ($this->title_spanned) 
			mysqli_data_seek($this->query_table, $this->col_count * ($this->row_num - 1));
		else 
			mysqli_data_seek($this->query_table, $this->row_num - 1);
		$row = 0;
		while (($this->query_row = mysqli_fetch_array($this->query_table)) && (($this->title_spanned && $row <= (($this->lines_per_page) * ($this->col_count))) || (!$this->title_spanned && $row <= ($this->lines_per_page)))) {
			$this->_show_content($content);
			$this->row_num++;
			$row++;
		}
	}

	//returns defined code for all rows
	function get_content($content) {
		$this->row_num = 1 + ($this->page_number - 1) * $this->lines_per_page;
		if ($this->title_spanned) 
			mysqli_data_seek($this->query_table, $this->col_count * ($this->row_num - 1));
		else 
			mysqli_data_seek($this->query_table, $this->row_num - 1);
		$row = 0;
		$result = '';
		while (($this->query_row = mysqli_fetch_array($this->query_table)) && (($this->title_spanned && $row <= (($this->lines_per_page) * ($this->col_count))) || (!$this->title_spanned && $row <= ($this->lines_per_page)))) {
			$result .= $this->_show_content($content, -1, true);
			$this->row_num++;
			$row++;
		}
		return ($result);
	}

	//internal use
	function _show_content($content, $col_num = - 1, $return = false) {
		$empty = false;
		while (($pos = strpos($content, '#g#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			if ($this->query_row = mysqli_fetch_array($this->query_table)) 
				$content = substr($content, 0, $pos) . $this->query_row[$field_name] . substr($content, $i + 1, strlen($content));
			else {
				$content = "";
				$empty = true;
			}
		}
		while (($pos = strpos($content, '#u#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$pos2 = $i;
			$i = $pos2 + 1;
			$this->_next_sign($content, $i);
			$pos3 = $i;
			$first = $pos3 + 1;
			$func = substr($content, $pos + 3, $pos2 - $pos - 3);
			$param_count = substr($content, $pos2 + 1, $pos3 - $pos2 - 1);
			for ($count = 1;$count <= $param_count;$count++) {
				$i = $first;
				$this->_next_sign($content, $i);
				$second = $i;
				$field_name = substr($content, $first, $second - $first);
				$param[] = $this->query_row[$field_name];
				$first = $second + 1;
			}
			$function_result = call_user_func_array($func, $param);
			$content = substr($content, 0, $pos) . $function_result . substr($content, $i + 1, strlen($content));
			unset($param);
		}
		while (($pos = strpos($content, '#b#')) !== false) {
			$i = $pos + 3;
			$pos2 = $this->_next_sign($content, $i);;
			$i = $pos2 + 1;
			$this->_next_sign($content, $i);
			$label_number = substr($content, $pos + 3, $pos2 - $pos - 3);
			$field_name = substr($content, $pos2 + 1, $i - $pos2 - 1);
			$content = substr($content, 0, $pos) . $this->label_array[$label_number][$this->query_row[$field_name]] . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#f#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			$content = substr($content, 0, $pos) . $this->query_row[$field_name] . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#s#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			$content = substr($content, 0, $pos) . farsiNumber::number_en2fa($this->query_row[$field_name]) . substr($content, $i + 1, strlen($content));
		}

		while (($pos = strpos($content, '#2#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			$content = substr($content, 0, $pos) . round($this->query_row[$field_name], 2) . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#e#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			$content = substr($content, 0, $pos) . nl2br($this->query_row[$field_name]) . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#3#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			$content = substr($content, 0, $pos) . formatNumber::split($this->query_row[$field_name]) . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#o#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			$content = substr($content, 0, $pos) . $this->col_array_content[$col_num][$this->query_row[$field_name]] . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#D#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			if ($this->query_row[$field_name] == "") 
				$date_str = "";
			else 
				$date_str = dateTimeFormat::str2date($this->query_row[$field_name]);
			$content = substr($content, 0, $pos) . $date_str . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#d#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			if ($this->query_row[$field_name] == "")
				$date_str = "";
			else
				$date_str = dateTimeFormat::get_farsi_date($this->query_row[$field_name]);
			$content = substr($content, 0, $pos) . $date_str . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#h#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			if ($this->query_row[$field_name] == "")
				$date_str = "";
			else {
				$time_stamp = dateTimeFormat::str2time($this->query_row[$field_name]);
				$date_str = dateTimeFormat::mtosh(date("Y-m-d", $time_stamp) , true);
			}
			$content = substr($content, 0, $pos) . $date_str . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#t#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			if ($this->query_row[$field_name] == "")
				$time_str = "";
			else {
				$time_stamp = dateTimeFormat::str2time($this->query_row[$field_name]);
				$time_str = dateTimeFormat::get_farsi_time($time_stamp, false, true);
			}
			$content = substr($content, 0, $pos) . $time_str . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#T#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			if ($this->query_row[$field_name] == "") {
				$time_str = "";
			}
			else {
				$time_stamp = dateTimeFormat::str2time($this->query_row[$field_name]);
				$time_str = date("H:i", $time_stamp);
			}
			$content = substr($content, 0, $pos) . $time_str . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#w#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			if ($this->query_row[$field_name] == "") {
				$time_str = "";
			}
			else {
				$time_stamp = dateTimeFormat::str2time($this->query_row[$field_name]);
				$time_str = dateTimeFormat::day_of_week(date("w", $time_stamp));
			}
			$content = substr($content, 0, $pos) . $time_str . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#c#')) !== false) {
			$i = $pos + 3;
			$this->_next_sign($content, $i);
			$field_name = substr($content, $pos + 3, $i - $pos - 3);
			$content = substr($content, 0, $pos) . '<input type="checkbox" name="c' . $col_num . '_' . $this->query_row[$this->primary_key] . '" value="1"' . ($this->query_row[$field_name] ? ' checked' : '') . '>' . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#r#')) !== false) {
			$i = $pos + 3;
			$pos2 = $this->_next_sign($content, $i);
			$i = $pos2 + 1;
			$pos3 = $this->_next_sign($content, $i);
			$i = $pos3 + 1;
			$pos4 = $this->_next_sign($content, $i);
			$_field = substr($content, $pos + 3, $pos2 - $pos - 3);
			$_value = substr($content, $pos2 + 1, $pos3 - $pos2 - 1);
			$field_name = substr($content, $pos3 + 1, $pos4 - $pos3 - 1);
			$content = substr($content, 0, $pos) . '<input type="radio" name="r' . $_field . '_' . $this->query_row[$this->primary_key] . '" value="' . $_value . '"' . ($this->query_row[$field_name] == "$_value" ? ' checked' : '') . '>' . substr($content, $i + 1, strlen($content));
		}
		while (($pos = strpos($content, '#i#')) !== false) {
			$i = $pos + 3;
			$pos2 = $this->_next_sign($content, $i);
			$i = $pos2 + 1;
			$pos3 = $this->_next_sign($content, $i);
			$i = $pos3 + 1;
			$pos4 = $this->_next_sign($content, $i);
			$i = $pos4 + 1;
			$pos5 = $this->_next_sign($content, $i);
			$picture_field_name = substr($content, $pos + 3, $pos2 - $pos - 3);
			$address = substr($content, $pos2 + 1, $pos3 - $pos2 - 1);
			$picture_code = $this->query_row[substr($content, $pos3 + 1, $pos4 - $pos3 - 1) ];
			$align = substr($content, $pos4 + 1, $pos5 - $pos4 - 1);
			if (strlen($this->query_row[$picture_field_name]) != 0) {
				$sub_content = '<img hspace="6" vspace="6" border="0" src="' . $address . $picture_code . '" align="' . $align . '">';
				$content = substr($content, 0, $pos) . $sub_content . substr($content, $i + 1, strlen($content));
			}
			else 
				$content = substr($content, 0, $pos) . substr($content, $i + 1, strlen($content));
		}
		$content = str_replace("#n#", $this->row_num, $content);
		$content = str_replace("#m#", farsiNumber::number_en2fa($this->row_num) , $content);
		global $QUERY_STRING;
		$content = str_replace("#q#", urlencode($QUERY_STRING) , $content);
		if (!$return) 
			echo $content;
		else 
			return ($content);
		if ($content == "" && !$empty) echo "&nbsp;";
	}

	//internal use
	function _show_table($start = 1) {
		if ($start != 0) {
			echo '<table';
			if ($this->tb_class) 
				echo ' class="' . $this->tb_class . '"';
			if ($this->tb_style) 
				echo ' style="' . $this->tb_style . '"';
			if ($this->tb_width) 
				echo ' width="' . $this->tb_width . '"';
			if ($this->cellpadding != "") 
				echo ' cellpadding="' . $this->cellpadding . '"';
			if ($this->cellspacing != "") 
				echo ' cellspacing="' . $this->cellspacing . '"';
			if ($this->border != "") 
				echo ' border="' . $this->border . '"';
			if ($this->border_color) 
				echo ' bordercolor="' . $this->border_color . '"';
			echo '>';
		}
		else echo '</table>';
		echo "\n";
	}

	//internal use
	function _show_td($col, $start = 1, $col_span = 1) {
		if ($start != 0) {
			echo '<td';
			if ($this->td_width_array[$col]) 
				echo ' width="' . $this->td_width_array[$col] . '"';
			if ($this->td_height_array[$col]) 
				echo ' height="' . $this->td_height_array[$col] . '"';
			if ($this->td_align_array[$col]) 
				echo ' align="' . $this->td_align_array[$col] . '"';
			if ($this->td_valign_array[$col]) 
				echo ' valign="' . $this->td_valign_array[$col] . '"';
			if ($this->td_style_array[$col]) 
				echo ' style="' . $this->td_style_array[$col] . '"';
			if ($this->td_class_array[$col]) 
				echo ' class="' . $this->td_class_array[$col] . '"';
			if ($this->td_ltr_array[$col]) 
				echo ' dir="ltr"';
			if ($this->td_class) 
				echo ' class="' . $this->td_class . '"';
			if ($col_span != 1) 
				echo ' colspan="' . $col_span . '"';
			echo '>';
		}
		else {
			echo '</td>';
			echo "\n";
		}
	}

	//internal use
	function _show_tr($bg_color, $start = 1) {
		if ($start != 0) {
			echo '<tr';
			if ($bg_color) 
				echo ' bgcolor="' . $bg_color . '"';
			if ($this->tr_style) 
				echo ' style="' . $this->tr_style . '"';
			if ($this->tr_class) 
				echo ' class="' . $this->tr_class . '"';
			echo '>';
		}
		else echo '</tr>';
		echo "\n";
	}

	//shows the table
	function show_grid() {
		$this->initialize_grid();
		if ($this->has_form) {
			echo '<form method="POST" action="" style="margin-top: 0; margin-bottom: 0">';
		}
		$this->_show_table();
		if ($this->show_header) {
			$this->_show_tr($this->tr_head_bgcolor);
			if ($this->title_spanned) {
				$this->_show_td(0, 1, $this->col_count);
				if ($this->tr_head_color) 
					echo '<font color="' . $this->tr_head_color . '">';
				echo $this->title_array[0];
				if ($this->tr_head_color) 
					echo '</font>';
				$this->_show_td("", 0);
			}
			else for ($i = 0;$i < $this->col_count;$i++) {
				$this->_show_td($i);
				if ($this->tr_head_color) 
					echo '<font color="' . $this->tr_head_color . '">';
				echo $this->title_array[$i];
				if ($this->tr_head_color) 
					echo '</font>';
				$this->_show_td("", 0);
			}
			$this->_show_tr("", 0);
		}
		$even = false;
		$row = 1;
		if ($this->title_spanned) 
			mysqli_data_seek($this->query_table, $this->col_count * ($this->row_num - 1));
		else 
			mysqli_data_seek($this->query_table, $this->row_num - 1);
		if (mysqli_num_rows($this->query_table) == 0) {
			echo "";
			$this->_show_tr($this->tr_odd_bgcolor);
			echo '<td';
			echo ' width="100%"';
			echo ' align="center"';
			if ($this->td_class) 
				echo ' class="' . $this->td_class . '"';
			echo ' colspan="' . $this->col_count . '"';
			echo '>';
			echo $this->no_data_message;
			echo "</td></tr>";
		}
		while (($this->query_row = mysqli_fetch_array($this->query_table)) && ($row <= $this->lines_per_page)) {
			if ($even) {
				$bgcolor = $this->tr_even_bgcolor;
				$color = $this->tr_even_color;
			}
			else {
				$bgcolor = $this->tr_odd_bgcolor;
				$color = $this->tr_odd_color;
			}
			$this->_show_tr($bgcolor);
			for ($i = 0;$i < $this->col_count;$i++) {
				$this->_show_td($i);
				if ($color) 
					echo '<font color="' . $color . '">';
				$this->_show_content($this->col_array[$i], $i);
				if ($color) 
					echo '</font>';
				$this->_show_td("", 0);
			}
			$this->_show_tr("", 0);
			$even = !$even;
			$this->row_num++;
			$row++;
		}
		if ($this->has_form) {
			echo '<tr><td align="center" colspan="' . $this->col_count . '">';
			echo '<input type="submit" name="_submit" value="' . $this->submit_label . '"';
			if ($this->submit_class) 
				echo ' class="' . $this->submit_class . '"';
			if ($this->submit_style) 
				echo ' class="' . $this->submit_style . '"';
			echo '>';
			echo '</td></tr>';
		}
		$this->_show_table(0);
		if ($this->has_form) 
			echo '</form>';
	}

	private function _next_sign($content, &$i) {
		while (substr($content, $i, 1) != "#") 
		    $i++;
		return($i);
    }

}
?>
