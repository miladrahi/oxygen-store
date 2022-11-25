<?php
error_reporting(0);
class page_class
{
// Properties
    var $current_page;
    var $amount_of_data;
    var $page_total;
    var $row_per_page;

// Constructor
    function page_class($rows_per_page,$page)
    {
        $this->row_per_page = $rows_per_page;
if(isset($_GET[$page]))
        $this->current_page = $_GET[$page];
        if (empty($this->current_page))
            $this->current_page = 1;
    }

    function specify_row_counts($amount)
    {
        $this->amount_of_data = $amount;
        $this->page_total =
            ceil($amount / $this->row_per_page);

    }

    function get_starting_record()
    {
        $starting_record = ($this->current_page - 1) *
            $this->row_per_page;
        return $starting_record;
    }
	

    function show_pages_link($page)
    {
        if ($this->page_total > 1) {
            print("<div style='margin: auto 750px auto auto;float: right' class='notice'><span class='note'><span style='color: white;margin-left: 5px'>| </span>");
            for ($hal = 1; $hal <= $this->page_total; $hal++) {
                if ($hal == $this->current_page)
                    echo "<span class='active'>$hal</span><span style='color: white;margin-left: 5px'>|  </span>";
                else {
                    $script_name = $_SERVER['PHP_SELF'];

                    echo "<a class='pagesbtn' href='$script_name?$page=$hal'>$hal</a><span style='color: white;margin-left: 5px'>|</span>\n ";
                }
            }
        }
    }
}

?>