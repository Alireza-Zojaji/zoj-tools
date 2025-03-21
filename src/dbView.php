<?
// 19 Mar 2025: Developing completed!

namespace zoj-tools;

use zoj-tools\farsiTools\fasiNumber;
use zoj-tools\numberTools\formatNumber;

class dbView {
	public $query;
	public $db_link;
	public $row_count = 0;

	public $_vars_set; //
	public $border;
	public $border_color;
	public $cellpadding;
	public $cellspacing;
	public $comment_array;
	public $default_date_value; //
	public $description_array;
	public $dont_include_form_tag; //
	public $even_bg_color;
	public $field_count; //
	public $field_height_array; //
	public $field_length_array; //
	public $field_name_array;
	public $field_show_class;
	public $field_show_style;
	public $field_type_array;
	public $field_unicode_array; //
	public $field_value_array; //
	public $field_option_array; //
	public $not_in_table; //
	public $odd_bg_color;
	public $show_type_array; //
	public $span_id_array; //
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
	public $tr_class;
	public $tr_style;
	public $auto_field_count; //
	public $check_value_array; //
	public $tr_bgcolor_array;
	public $td1_bgcolor_array;
	public $td2_bgcolor_array;
	private $query_row;
	public $empty_result = false;
	public $error = 0;
	public $error_message = "";
	public $button_style;
	public $button_class;
	public $button_labels;
	public $button_onclicks;
	private $direction_array;
	private $alignment_array;

	//consructor
	public function __construct($db_link, $query) {
		$this->query = $query;
		$this->db_link = $db_link;
		$this->tb_width = "100%";
		$this->correct_quote_char();
    	$query_table = $this->execute($query);
    	$this->error = mysqli_errno($this->db_link);
    	if ($this->error)
    	    $this->error_message = $this->error($this->db_link);
    	$this->query_row = mysqli_fetch_array($this->db_link, $query_table);
    	if (! $thos->query_row)
    	    $empty_result = true;
	}

	public function addRow($description, $content, $direction = "rtl", $alignment = "right") {
		$description_array[$this->row_count] = $description;
		$content_array[$this->row_count] = $content;
		if ($direction != "rtl")
		    $this->durection_array = $direction;
		if ($alignment != "right")
		    $this->alignment_array = $alignment;
		$this->row_count ++;
		return ($this->row_count - 1);
	}

	public function execute($query) {
		try {
			$result = mysqli_query($this->db_link, $query);
		}
		catch(Exception $e) {
			$result = false;
		}
		return ($result);
	}

	public function show_body() {
		$this->_show_table_body();
	}

	//internal use
	private function _show_table($start = 1) {
		if ($start != 0) {
			echo '<table';
			if ($this->tb_class) 
			    echo ' class="' . $this->tb_class . '"';
			if ($this->tb_style) 
			    echo ' style="' . $this->tb_style . '"';
			if ($this->tb_width) 
			    echo ' width="' . $this->tb_width . '"';
			if ($this->cellpadding) 
			    echo ' cellpadding="' . $this->cellpadding . '"';
			if ($this->cellspacing) 
			    echo ' cellspacing="' . $this->cellspacing . '"';
			if ($this->border) 
			    echo ' border="' . $this->border . '"';
			if ($this->border_color) 
			    echo ' bordercolor="' . $this->border_color . '"';
			echo '>';
		}
		else echo '</table>';
		echo "\n";
	}

	//internal use
	private function _show_td($row, $col, $start = 1, $col_span = 1) {
		if ($start != 0) {
			$bg_color = '';
			if ($col == 1 && $col_span == 1) 
			    $bg_color = $this->td1_bgcolor_array[$row];
			if ($col == 2 && $col_span == 1) 
			    $bg_color = $this->td2_bgcolor_array[$row];
			echo '<td';
			if ($bg_color != '') 
			    echo ' bgcolor="' . $bg_color . '"';
			if ($col == 1 && $this->td_width_1) 
			    echo ' width="' . $this->td_width_1 . '"';
			if ($col == 2 && $this->td_width_2) 
			    echo ' width="' . $this->td_width_2 . '"';
			if ($col == 1 && $this->td_align_1) 
			    echo ' align="' . $this->td_align_1 . '"';
			if ($col == 2 && $this->td_align_2) 
			    echo ' align="' . $this->td_align_2 . '"';
			if ($col == 3) 
			    echo ' align="center" colspan="2"';
			if ($this->td_style) 
			    echo ' style="' . $this->td_style . '"';
			if ($col == 1 && $this->td_style_1) 
			    echo ' style="' . $this->td_style_1 . '"';
			if ($col == 2 && $this->td_style_2) 
			    echo ' style="' . $this->td_style_2 . '"';
			if ($this->td_class) 
			    echo ' class="' . $this->td_class . '"';
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

	//internal use
	private function _show_table_body() {
		$this->_show_table();
		for ($i = 0; $i < $this->field_count; $i++) {
			$this->_show_tr($this->tr_bgcolor_array[$i]);
			$this->_show_td($i, 1);
			$this->_show_description($i);
			$this->_show_td($i, 1, 0);
			$this->_show_td($i, 2);
			$this->_show_data($i);
			$this->_show_td($i, 2, 0);
			$this->_show_tr('', 0);
			if ($this->comment_array[$i] != '') {
				$this->_show_tr($this->tr_bgcolor_array[$i]);
				$this->_show_td($i, 3, 1);
				echo $this->comment_array[$i];
				$this->_show_td($i, 3, 0);
				$this->_show_tr('', 0);
			}
		}
		$this->_show_tr('');
		$this->_show_td($i, 3, 1);
		$this->_show_buttons();
		$this->_show_td($i, 3, 0);
		$this->_show_tr('', 0);
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
    function _show_data($col_num) {
        if ($this->empty_result)
            return(false);
        $style="";
        if ($direction_array[$col_num] != "")
            $style .= "direction: {$direction_array[$col_num]};";
        if ($alignment_array[$col_num] != "")
            $style .= "text-align: {$alignment_array[$col_num]};";
        if ($style != "")
            echo '<span style="'.$style.'">';
        else
            echo '<span>';
        $content = $this->content_array[$col_num];
    	while (($pos = strpos($content, '#f#')) !== false) { // #f#field_name# Outputs the field value.
    		$i = $pos + 3;
    		$this->_next_sign($content, $i);
    		$field_name = substr($content, $pos + 3, $i - $pos - 3);
    	    $content = substr($content, 0, $pos) . $this->query_row[$field_name] . substr($content, $i + 1, strlen($content));
    	}
    	while (($pos = strpos($content, '#u#')) !== false) {  // #u#function_name#field_name_1#field_name_2#...#field_name_n# Call the function with fields as its parameters and outputs its returned value.
    		$i = $pos + 3;
    		$pos2 = $this->_next_sign($content, $i);
    		$i = $pos2 + 1;
    		$pos3 = $this->_next_sign($content, $i);
    		$first = $pos3 + 1;
    		$func = substr($content, $pos + 3, $pos2 - $pos - 3);
    		$param_count = substr($content, $pos2 + 1, $pos3 - $pos2 - 1);
    		for ($count = 1; $count <= $param_count; $count++) {
    			$i = $first;
    			$second = $this->_next_sign($content, $i);
    			$field_name = substr($content, $first, $second - $first);
    			$param[] = $this->query_row[$field_name];
    			$first = $second + 1;
    		}
    		$function_result = call_user_func_array($func, $param);
    		$content = substr($content, 0, $pos) . $function_result . substr($content, $i + 1, strlen($content));
    		unset($param);
    	}
    	while (($pos = strpos($content, '#b#')) !== false) { // #b#label_number#field_name# Outputs the element number field value of the label_array[label_number] array.
    		$i = $pos + 3;
    		$pos2 = $this->_next_sign($content, $i);
    		$i = $pos2 + 1;
    		$this->_next_sign($content, $i);
    		$label_number = substr($content, $pos + 3, $pos2 - $pos - 3);
    		$field_name = substr($content, $pos2 + 1, $i - $pos2 - 1);
    		$content = substr($content, 0, $pos) . $this->label_array[$label_number][$this->query_row[$field_name]] . substr($content, $i + 1, strlen($content));
    	}
    	while (($pos = strpos($content, '#s#')) !== false) { // #s#field_name# Outputs the field value and converts its numbers to Farsi numbers.
    		$i = $pos + 3;
    		$this->_next_sign($content, $i);
    		$field_name = substr($content, $pos + 3, $i - $pos - 3);
    		$content = substr($content, 0, $pos) . (farsiNumber::number_en2fa($this->query_row[$field_name])) . substr($content, $i + 1, strlen($content));
    	}
    	while (($pos = strpos($content, '#2#')) !== false) { // #2#field_name# Outputs the field value rounded by 2 decimal digits.
    		$i = $pos + 3;
    		$this->_next_sign($content, $i);
    		$field_name = substr($content, $pos + 3, $i - $pos - 3);
    		$content = substr($content, 0, $pos) . round($this->query_row[$field_name], 2) . substr($content, $i + 1, strlen($content));
    	}
    	while (($pos = strpos($content, '#e#')) !== false) { // #e#field_name# Outputs the field value converted \n to <br> tag.
    		$i = $pos + 3;
    		$this->_next_sign($content, $i);
    		$field_name = substr($content, $pos + 3, $i - $pos - 3);
    		$content = substr($content, 0, $pos) . nl2br($this->query_row[$field_name]) . substr($content, $i + 1, strlen($content));
    	}
    	while (($pos = strpos($content, '#3#')) !== false) { // #3#field_name# Outputs the field value splitted 3 digits.
    		$i = $pos + 3;
    		$this->_next_sign($content, $i);
    		$field_name = substr($content, $pos + 3, $i - $pos - 3);
    		$content = substr($content, 0, $pos) . formatNumber::split($this->query_row[$field_name]) . substr($content, $i + 1, strlen($content));
    	}
    	while (($pos = strpos($content, '#D#')) !== false) { // #D#field_name# Outputs the field value converted to date.
    		$i = $pos + 3;
    		$this->_next_sign($content, $i);
    		$field_name = substr($content, $pos + 3, $i - $pos - 3);
    		if ($this->query_row[$field_name] == "") 
    		    $date_str = "";
    		else 
    		    $date_str = str2date($this->query_row[$field_name]);
    		$content = substr($content, 0, $pos) . $date_str . substr($content, $i + 1, strlen($content));
    	}
    	while (($pos = strpos($content, '#d#')) !== false) { // #d#field_name# Outputs the field value converted to Farsi character hegira date.
    		$i = $pos + 3;
    		$this->_next_sign($content, $i);
    		$field_name = substr($content, $pos + 3, $i - $pos - 3);
    		if ($this->query_row[$field_name] == "") {
    			$date_str = "";
    		}
    		else {
    			$date_str = dateTimeFormat::get_farsi_date($this->query_row[$field_name]);
    		}
    		$content = substr($content, 0, $pos) . $date_str . substr($content, $i + 1, strlen($content));
    	}
    	while (($pos = strpos($content, '#h#')) !== false) { // #h#field_name# Outputs the field value converted to English character hegira date.
    		$i = $pos + 3;
    		$this->_next_sign($content, $i);
    		$field_name = substr($content, $pos + 3, $i - $pos - 3);
    		if ($this->query_row[$field_name] == "") {
    			$date_str = "";
    		}
    		else {
    			$time_stamp = dateTimeFormat::str2time($this->query_row[$field_name]);
    			$date_str = dateTimeFormat::mtosh(date("Y-m-d", $time_stamp) , true);
    		}
    		$content = substr($content, 0, $pos) . $date_str . substr($content, $i + 1, strlen($content));
    	}
    	while (($pos = strpos($content, '#t#')) !== false) {  // #t#field_name# Outputs the field value converted to Farsi charcter time.
    		$i = $pos + 3;
    		$this->_next_sign($content, $i);
    		$field_name = substr($content, $pos + 3, $i - $pos - 3);
    		if ($this->query_row[$field_name] == "") {
    			$time_str = "";
    		}
    		else {
    			$time_stamp = dateTimeFormat::str2time($this->query_row[$field_name]);
    			$time_str = dateTimeFormat::get_farsi_time($time_stamp, false, true);
    		}
    		$content = substr($content, 0, $pos) . $time_str . substr($content, $i + 1, strlen($content));
    	}
    	while (($pos = strpos($content, '#T#')) !== false) { // #T#field_name# Outputs the field value converted to English character time.
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
    	while (($pos = strpos($content, '#w#')) !== false) { // #w#field_name# Outputs the field value converted to Farsi day of week.
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
    	while (($pos = strpos($content, '#i#')) !== false) { // #i#address#picture_code#field_name# Outputs an image.
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
    	$content = str_replace("#q#", urlencode($_SERVER["QUERY_STRING"]) , $content);
        echo $content;
        echo '</span>';
    	if ($content == "") 
    	    echo "&nbsp;";
    }
    
    private function _next_sign($content, &$i) {
		while (substr($content, $i, 1) != "#") 
		    $i++;
		return($i);
    }

	private function _show_buttons() {
	    foreach($this->button_labels as $key => $val) {
?>
<button name="<?=
$button_name?>" onclick="<?=
$this->button_onclicks[$key] ?>" <?=
($this->button_style ? 'style="' . $this->button_style . '"' : "") ?> <?=
($this->button_class ? 'class="' . $this->button_class . '"' : '') ?>><?=
$this->button_labels[$key] ?></button>
<?
	    }
	}
}

?>
