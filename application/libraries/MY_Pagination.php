<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is an extension of the core Pagination class designed to allow use of "real" page numbers
 * instead of offset values.  The majority of the code is the original create_links() function
 * but slightly modified.
 */
//require_once BASEPATH . 'libraries/Pagination.php';
Class MY_Pagination extends CI_Pagination
{
    function __construct($params = array())
    {
        parent::__construct($params);
    }
    function initialize($params = array())
    {
        parent::initialize($params);
    }
    function create_links($use_offsets = true, $type = '')
    {
        if ($use_offsets)
            return parent::create_links();
        elseif ($type == 'project')
            return $this->create_links2();
        elseif ($type == 'job')
            return $this->create_links3();
        elseif ($type == 'ajax')
            return $this->create_links4();
        elseif ($type == 'ajax2')
            return $this->create_links5();
        else
            return $this->create_links_without_offsets();
    }
    function create_links_without_offsets()
    {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0) {
            return '';
        }
        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);
        //echo $this->total_rows.",".$this->per_page;exit;
        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1) {
            return '';
        }
        // Determine the current page number.
        $CI =& get_instance();
        if ($CI->uri->segment($this->uri_segment) != 0) {
            $this->cur_page = $CI->uri->segment($this->uri_segment);
            // Prep the current page - no funny business!
            $this->cur_page = (int)$this->cur_page;
        }
        $this->num_links = (int)$this->num_links;
        if ($this->num_links < 1) {
            show_error('Your number of links must be a positive number.');
        }
        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 1;
        }
        // make sure cur_page is atleast 1
        if ($this->cur_page < 1) {
            $this->cur_page = 1;
        }
        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $num_pages) {
            $this->cur_page = $num_pages;
        }
        $uri_page_number = $this->cur_page;
        //$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
        // Add a trailing slash to the base URL if needed
        //$this->base_url = rtrim($this->base_url, '/') .'/';
        // And here we go...
        $output = '';
        // Render the "First" link
        if ($this->cur_page > $this->num_links) {
            $output .= $this->first_tag_open . '<a href="' . $this->base_url . '">' . $this->first_link . '</a>' . $this->first_tag_close;
        }
        // Render the "previous" link
        if ($this->cur_page > 1) {
            $i = $uri_page_number - 1;
            if ($i == 1) $i = '';
            $output .= $this->prev_tag_open . '<a href="' . $this->base_url . '/' . $i . '">' . $this->prev_link . '</a>' . $this->prev_tag_close;
        }
        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = $loop;
            if ($i >= 1) {
                if ($this->cur_page == $loop) {
                    $output .= $this->cur_tag_open . $loop . $this->cur_tag_close; // Current page
                } else {
                    $n = ($i == 0) ? '' : $i;
                    $output .= $this->num_tag_open . '<a href="' . $this->base_url . '/' . $n . '">' . $loop . '</a>' . $this->num_tag_close;
                }
            }
        }
        // Render the "next" link
        if ($this->cur_page < $num_pages) {
            $output .= $this->next_tag_open . '<a href="' . $this->base_url . '/' . ($this->cur_page + 1) . '">' . $this->next_link . '</a>' . $this->next_tag_close;
        }
        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages) {
            $i = $num_pages;
            $output .= $this->last_tag_open . '<a href="' . $this->base_url . '/' . $i . '">' . $this->last_link . '</a>' . $this->last_tag_close;
        }
        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        // Add the wrapper HTML if exists
        $output = $this->full_tag_open . $output . $this->full_tag_close;
        return $output;
    }
    function create_links2()
    {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0) {
            return '';
        }
        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);
        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1) {
            return '';
        }
        // Determine the current page number.
        $CI =& get_instance();
        if ($CI->uri->segment($this->uri_segment) != 0) {
            $this->cur_page = $CI->uri->segment($this->uri_segment);
            // Prep the current page - no funny business!
            $this->cur_page = (int)$this->cur_page;
        }
        
        $this->num_links = (int)$this->num_links;
        if ($this->num_links < 1) {
            show_error('Your number of links must be a positive number.');
        }
        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 1;
        }
        // make sure cur_page is atleast 1
        if ($this->cur_page < 1) {
            $this->cur_page = 1;
        }
       
        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $num_pages) {
            $this->cur_page = $num_pages;
        }


        $uri_page_number = $this->cur_page;
        //$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
        // Add a trailing slash to the base URL if needed
        $this->base_url = rtrim($this->base_url, '/') . '/';
        // And here we go...
        $output = '';
        
        // Render the "First" link
        if ($this->cur_page > $this->num_links) {
            $output .= $this->first_tag_open . '<a href="' . $this->base_url . '">' . $this->first_link . '</a>' . $this->first_tag_close;
        }
        
        // Render the "previous" link
        if ($this->cur_page > 1) {
            $i = $uri_page_number - 1;
            if ($i == 1) $i = '';
            $output .= $this->prev_tag_open . '<a href="' . $this->base_url . $i . '">' . $this->prev_link . '</a>' . $this->prev_tag_close;
        }
        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = $loop;
            if ($i >= 1) {
                if ($this->cur_page == $loop) {
                    $output .= $this->cur_tag_open . $loop . $this->cur_tag_close; // Current page
                } else {
                    $n = ($i == 0) ? '' : $i;
                    $output .= $this->num_tag_open . '<a href="' . $this->base_url . $n . '">' . $loop . '</a>' . $this->num_tag_close;
                }
            }
        }
        // Render the "next" link
        if ($this->cur_page < $num_pages) {
            $output .= $this->next_tag_open . '<a href="' . $this->base_url . ($this->cur_page + 1) . '">' . $this->next_link . '</a>' . $this->next_tag_close;
        }
        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages) {
            $i = $num_pages;
            $output .= $this->last_tag_open . '<a href="' . $this->base_url . $i . '">' . $this->last_link . '</a>' . $this->last_tag_close;
        }
        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        // Add the wrapper HTML if exists
        $output = $this->full_tag_open . $output . $this->full_tag_close;
        return $output;
    }

    function create_links3()
    {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0) {
            return '';
        }
        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);
        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1) {
            return '';
        }
        // Determine the current page number.
        $CI =& get_instance();
        $params = (uri_to_assoc())?uri_to_assoc():'';

        if ($CI->uri->segment($this->uri_segment) != 0) {
            //$this->cur_page = $CI->uri->segment($this->uri_segment);
            //$page = $_GET['p'];
            $page = isset($params['p'])?$params['p']:1;
            //$this->cur_page = $CI->uri->segment($this->uri_segment);
            $this->cur_page = $page;

            // Prep the current page - no funny business!
            $this->cur_page = (int)$this->cur_page;
        }

        $this->num_links = (int)$this->num_links;
        if ($this->num_links < 1) {
            show_error('Your number of links must be a positive number.');
        }
        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 1;
        }
        // make sure cur_page is atleast 1
        if ($this->cur_page < 1) {
            $this->cur_page = 1;
        }

        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $num_pages) {
            $this->cur_page = $num_pages;
        }


        $uri_page_number = $this->cur_page;
        //$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
        // Add a trailing slash to the base URL if needed
        $this->base_url = rtrim($this->base_url, '/') . '/';
        // And here we go...
        $output = '';

        /*$strParam = '';
        if(isset($_GET)){
            unset($_GET['p']);
            $strParam = implode (
                '&',
                array_map ( function($k, $v){
                    return $v . '=' . $k;
                }, $_GET, array_keys ( $_GET ) )
            );
        }*/

        // Render the "First" link
        if ($this->cur_page > $this->num_links) {
            $output .= $this->first_tag_open . '<a href="' . $this->base_url . '">' . $this->first_link . '</a>' . $this->first_tag_close;
        }

        // Render the "previous" link
        if ($this->cur_page > 1) {
            $i = $uri_page_number - 1;
            if ($i == 1)
                $n = '';
            else
                $n = '/p/'. $i;

            $output .= $this->prev_tag_open . '<a href="' . $this->base_url . $n . '">' . $this->prev_link . '</a>' . $this->prev_tag_close;
        }
        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = $loop;
            if ($i >= 1) {
                if ($this->cur_page == $loop) {
                    $output .= $this->cur_tag_open . $loop . $this->cur_tag_close; // Current page
                } else {
                    $n = ($i == 0) ? '' : '/p/'.$i;
                    $output .= $this->num_tag_open . '<a href="' . $this->base_url . $n . '">' . $loop . '</a>' . $this->num_tag_close;
                }
            }
        }
        // Render the "next" link
        if ($this->cur_page < $num_pages) {
            $output .= $this->next_tag_open . '<a href="' . $this->base_url .'/p/'. ($this->cur_page + 1) . '">' . $this->next_link . '</a>' . $this->next_tag_close;
        }
        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages) {
            $i = $num_pages;
            $output .= $this->last_tag_open . '<a href="' . $this->base_url .'/p/'. $i . '">' . $this->last_link . '</a>' . $this->last_tag_close;
        }
        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        // Add the wrapper HTML if exists
        $output = $this->full_tag_open . $output . $this->full_tag_close;
        return $output;
    }

    function create_links3_12012015()
    {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0) {
            return '';
        }
        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);
        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1) {
            return '';
        }
        // Determine the current page number.
        $CI =& get_instance();
        $params = ($CI->uri->uri_to_assoc())?$CI->uri->uri_to_assoc():'';

        if ($CI->uri->segment($this->uri_segment) != 0) {
            //$this->cur_page = $CI->uri->segment($this->uri_segment);
            //$page = $_GET['p'];
            $page = $params['p'];
            //$this->cur_page = $CI->uri->segment($this->uri_segment);
            $this->cur_page = $page;

            // Prep the current page - no funny business!
            $this->cur_page = (int)$this->cur_page;
        }

        $this->num_links = (int)$this->num_links;
        if ($this->num_links < 1) {
            show_error('Your number of links must be a positive number.');
        }
        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 1;
        }
        // make sure cur_page is atleast 1
        if ($this->cur_page < 1) {
            $this->cur_page = 1;
        }

        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $num_pages) {
            $this->cur_page = $num_pages;
        }


        $uri_page_number = $this->cur_page;
        //$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
        // Add a trailing slash to the base URL if needed
        $this->base_url = rtrim($this->base_url, '/') . '/';
        // And here we go...
        $output = '';

        /*$strParam = '';
        if(isset($_GET)){
            unset($_GET['p']);
            $strParam = implode (
                '&',
                array_map ( function($k, $v){
                    return $v . '=' . $k;
                }, $_GET, array_keys ( $_GET ) )
            );
        }*/

        // Render the "First" link
        if ($this->cur_page > $this->num_links) {
            $output .= $this->first_tag_open . '<a href="' . $this->base_url . '">' . $this->first_link . '</a>' . $this->first_tag_close;
        }

        // Render the "previous" link
        if ($this->cur_page > 1) {
            $i = $uri_page_number - 1;
            if ($i == 1)
                $n = '';
            else
                $n = '/p/'. $i;

            $output .= $this->prev_tag_open . '<a href="' . $this->base_url . $n . '">' . $this->prev_link . '</a>' . $this->prev_tag_close;
        }
        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = $loop;
            if ($i >= 1) {
                if ($this->cur_page == $loop) {
                    $output .= $this->cur_tag_open . $loop . $this->cur_tag_close; // Current page
                } else {
                    $n = ($i == 0) ? '' : '/p/'.$i;
                    $output .= $this->num_tag_open . '<a href="' . $this->base_url . $n . '">' . $loop . '</a>' . $this->num_tag_close;
                }
            }
        }
        // Render the "next" link
        if ($this->cur_page < $num_pages) {
            $output .= $this->next_tag_open . '<a href="' . $this->base_url .'/p/'. ($this->cur_page + 1) . '">' . $this->next_link . '</a>' . $this->next_tag_close;
        }
        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages) {
            $i = $num_pages;
            $output .= $this->last_tag_open . '<a href="' . $this->base_url .'/p/'. $i . '">' . $this->last_link . '</a>' . $this->last_tag_close;
        }
        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        // Add the wrapper HTML if exists
        $output = $this->full_tag_open . $output . $this->full_tag_close;
        return $output;
    }

    function create_links3_old()
    {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0) {
            return '';
        }
        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);
        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1) {
            return '';
        }
        // Determine the current page number.
        $CI =& get_instance();
        if ($CI->uri->segment($this->uri_segment) != 0) {
            //$this->cur_page = $CI->uri->segment($this->uri_segment);
            $page = $_GET['p'];
            //$this->cur_page = $CI->uri->segment($this->uri_segment);
            $this->cur_page = $page;

            // Prep the current page - no funny business!
            $this->cur_page = (int)$this->cur_page;
        }

        $this->num_links = (int)$this->num_links;
        if ($this->num_links < 1) {
            show_error('Your number of links must be a positive number.');
        }
        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 1;
        }
        // make sure cur_page is atleast 1
        if ($this->cur_page < 1) {
            $this->cur_page = 1;
        }

        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $num_pages) {
            $this->cur_page = $num_pages;
        }


        $uri_page_number = $this->cur_page;
        //$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
        // Add a trailing slash to the base URL if needed
        $this->base_url = rtrim($this->base_url, '/') . '/';
        // And here we go...
        $output = '';

        $strParam = '';
        if(isset($_GET)){
            unset($_GET['p']);
            $strParam = implode (
                '&',
                array_map ( function($k, $v){
                    return $v . '=' . $k;
                }, $_GET, array_keys ( $_GET ) )
            );
        }

        // Render the "First" link
        if ($this->cur_page > $this->num_links) {
            if($strParam != ''){
                $output .= $this->first_tag_open . '<a href="' . $this->base_url . '?'.$strParam.'">' . $this->first_link . '</a>' . $this->first_tag_close;
            }else{
                $output .= $this->first_tag_open . '<a href="' . $this->base_url . '">' . $this->first_link . '</a>' . $this->first_tag_close;
            }
        }

        // Render the "previous" link
        if ($this->cur_page > 1) {
            $i = $uri_page_number - 1;
            if ($i == 1)
                $n = '';
            else
                $n = '?p='. $i;

            if($strParam != ''){
                $output .= $this->prev_tag_open . '<a href="' . $this->base_url . $n . '&'. $strParam . '">' . $this->prev_link . '</a>' . $this->prev_tag_close;
            }else{
                $output .= $this->prev_tag_open . '<a href="' . $this->base_url . $n . '">' . $this->prev_link . '</a>' . $this->prev_tag_close;
            }
        }
        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = $loop;
            if ($i >= 1) {
                if ($this->cur_page == $loop) {
                    $output .= $this->cur_tag_open . $loop . $this->cur_tag_close; // Current page
                } else {
                    $n = ($i == 0) ? '' : '?p='.$i;
                    if($strParam != ''){
                        $output .= $this->num_tag_open . '<a href="' . $this->base_url . $n . '&'.$strParam.'">' . $loop . '</a>' . $this->num_tag_close;
                    }else{
                        $output .= $this->num_tag_open . '<a href="' . $this->base_url . $n . '">' . $loop . '</a>' . $this->num_tag_close;
                    }
                }
            }
        }
        // Render the "next" link
        if ($this->cur_page < $num_pages) {
            if($strParam != ''){
                $output .= $this->next_tag_open . '<a href="' . $this->base_url .'?p='. ($this->cur_page + 1) . '&' . $strParam.'">' . $this->next_link . '</a>' . $this->next_tag_close;
            }else{
                $output .= $this->next_tag_open . '<a href="' . $this->base_url .'?p='. ($this->cur_page + 1) . '">' . $this->next_link . '</a>' . $this->next_tag_close;
            }
        }
        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages) {
            $i = $num_pages;
            if($strParam != ''){
                $output .= $this->last_tag_open . '<a href="' . $this->base_url .'?p='. $i . '&' . $strParam . '">' . $this->last_link . '</a>' . $this->last_tag_close;
            }else{
                $output .= $this->last_tag_open . '<a href="' . $this->base_url .'?p='. $i . '">' . $this->last_link . '</a>' . $this->last_tag_close;
            }
        }
        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        // Add the wrapper HTML if exists
        $output = $this->full_tag_open . $output . $this->full_tag_close;
        return $output;
    }

    function create_links4()
    {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0) {
            return '';
        }
        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);
        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1) {
            return '';
        }
        // Determine the current page number.
        $CI =& get_instance();
        if ($CI->uri->segment($this->uri_segment) != 0) {
            //$this->cur_page = $CI->uri->segment($this->uri_segment);
            $page = $_GET['p'];
            //$this->cur_page = $CI->uri->segment($this->uri_segment);
            $this->cur_page = $page;

            // Prep the current page - no funny business!
            $this->cur_page = (int)$this->cur_page;
        }

        $this->num_links = (int)$this->num_links;
        if ($this->num_links < 1) {
            show_error('Your number of links must be a positive number.');
        }
        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 1;
        }
        // make sure cur_page is atleast 1
        if ($this->cur_page < 1) {
            $this->cur_page = 1;
        }

        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $num_pages) {
            $this->cur_page = $num_pages;
        }


        $uri_page_number = $this->cur_page;
        //$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
        // Add a trailing slash to the base URL if needed
        $this->base_url = rtrim($this->base_url, '/') . '/';
        // And here we go...
        $output = '';

        // Render the "First" link
        if ($this->cur_page > $this->num_links) {
            $output .= $this->first_tag_open . '<a data-page="0" href="' . $this->base_url . '">' . $this->first_link . '</a>' . $this->first_tag_close;
        }

        // Render the "previous" link
        if ($this->cur_page > 1) {
            $i = $uri_page_number - 1;
            if ($i == 1)
                $n = '';
            else
                $n = '?p='. $i;
            $output .= $this->prev_tag_open . '<a data-page="'.$i.'" href="' . $this->base_url . $n . '">' . $this->prev_link . '</a>' . $this->prev_tag_close;
        }
        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = $loop;
            if ($i >= 1) {
                if ($this->cur_page == $loop) {
                    $output .= $this->cur_tag_open . $loop . $this->cur_tag_close; // Current page
                } else {
                    $n = ($i == 0) ? '' : '?p='.$i;
                    $output .= $this->num_tag_open . '<a data-page="'.$i.'" href="' . $this->base_url . $n . '">' . $loop . '</a>' . $this->num_tag_close;
                }
            }
        }
        // Render the "next" link
        if ($this->cur_page < $num_pages) {
            $output .= $this->next_tag_open . '<a data-page="'.($this->cur_page + 1).'" href="' . $this->base_url .'?p='. ($this->cur_page + 1) . '">' . $this->next_link . '</a>' . $this->next_tag_close;
        }
        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages) {
            $i = $num_pages;
            $output .= $this->last_tag_open . '<a data-page="'.$i.'" href="' . $this->base_url .'?p='. $i . '">' . $this->last_link . '</a>' . $this->last_tag_close;
        }
        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        // Add the wrapper HTML if exists
        $output = $this->full_tag_open . $output . $this->full_tag_close;
        return $output;
    }

    function create_links5()
    {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0) {
            return '';
        }
        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);
        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1) {
            return '';
        }
        // Determine the current page number.
        $CI =& get_instance();
        if ($CI->uri->segment($this->uri_segment) != 0) {
            //$this->cur_page = $CI->uri->segment($this->uri_segment);
            //$page = $_GET['p'];
            //$this->cur_page = $CI->uri->segment($this->uri_segment);
            //$this->cur_page = $page;

            // Prep the current page - no funny business!
            $this->cur_page = (int)$this->cur_page;
        }
//echo $this->cur_page; die;
        $this->num_links = (int)$this->num_links;
        if ($this->num_links < 1) {
            show_error('Your number of links must be a positive number.');
        }
        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 1;
        }
        // make sure cur_page is atleast 1
        if ($this->cur_page < 1) {
            $this->cur_page = 1;
        }

        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $num_pages) {
            $this->cur_page = $num_pages;
        }


        $uri_page_number = $this->cur_page;
        //$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
        // Add a trailing slash to the base URL if needed
        //$this->base_url = rtrim($this->base_url, '/') . '/';
        // And here we go...
        $output = '';

        // Render the "First" link
        if ($this->cur_page > $this->num_links) {
            $output .= $this->first_tag_open . '<a data-page="0">' . $this->first_link . '</a>' . $this->first_tag_close;
        }

        // Render the "previous" link
        if ($this->cur_page > 1) {
            $i = $uri_page_number - 1;
            if ($i == 1)
                $n = '';
            else
                $n = '?p='. $i;
            $output .= $this->prev_tag_open . '<a data-page="'.$i.'">' . $this->prev_link . '</a>' . $this->prev_tag_close;
        }
        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = $loop;
            if ($i >= 1) {
                if ($this->cur_page == $loop) {
                    $output .= $this->cur_tag_open . $loop . $this->cur_tag_close; // Current page
                } else {
                    $n = ($i == 0) ? '' : '?p='.$i;
                    $output .= $this->num_tag_open . '<a data-page="'.$i.'" >' . $loop . '</a>' . $this->num_tag_close;
                }
            }
        }
        // Render the "next" link
        if ($this->cur_page < $num_pages) {
            $output .= $this->next_tag_open . '<a data-page="'.($this->cur_page + 1).'">' . $this->next_link . '</a>' . $this->next_tag_close;
        }
        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages) {
            $i = $num_pages;
            $output .= $this->last_tag_open . '<a data-page="'.$i.'">' . $this->last_link . '</a>' . $this->last_tag_close;
        }
        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        // Add the wrapper HTML if exists
        $output = $this->full_tag_open . $output . $this->full_tag_close;
        return $output;
    }
    function create_linksContestJoin()
    {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0) {
            return '';
        }
        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);
        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1) {
            return '';
        }
        // Determine the current page number.
        $CI =& get_instance();
        if ($CI->uri->segment($this->uri_segment) != 0) {
            $this->cur_page = $CI->uri->segment($this->uri_segment);
            // Prep the current page - no funny business!
            $this->cur_page = (int)$this->cur_page;
        }

        $this->num_links = (int)$this->num_links;
        if ($this->num_links < 1) {
            show_error('Your number of links must be a positive number.');
        }
        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 1;
        }
        // make sure cur_page is atleast 1
        if ($this->cur_page < 1) {
            $this->cur_page = 1;
        }

        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $num_pages) {
            $this->cur_page = $num_pages;
        }


        $uri_page_number = $this->cur_page;
        //$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
        // Add a trailing slash to the base URL if needed
        $this->base_url = rtrim($this->base_url, '/') . '';
        // And here we go...
        $output = '';

        // Render the "First" link
        if ($this->cur_page > $this->num_links) {
            $output .= $this->first_tag_open . '<a href="' . $this->base_url . '.html">' . $this->first_link . '</a>' . $this->first_tag_close;
        }

        // Render the "previous" link
        if ($this->cur_page > 1) {
            $i = $uri_page_number - 1;
            if ($i == 1) $i = '';
            $output .= $this->prev_tag_open . '<a href="' . $this->base_url . $i . '.html">' . $this->prev_link . '</a>' . $this->prev_tag_close;
        }
        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = $loop;
            if ($i >= 1) {
                if ($this->cur_page == $loop) {
                    $output .= $this->cur_tag_open . $loop . $this->cur_tag_close; // Current page
                } else {
                    $n = ($i == 0) ? '' : $i;
                    $output .= $this->num_tag_open . '<a href="' . $this->base_url . $n . '.html">' . $loop . '</a>' . $this->num_tag_close;
                }
            }
        }
        // Render the "next" link
        if ($this->cur_page < $num_pages) {
            $output .= $this->next_tag_open . '<a href="' . $this->base_url . ($this->cur_page + 1) . '.html">' . $this->next_link . '</a>' . $this->next_tag_close;
        }
        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages) {
            $i = $num_pages;
            $output .= $this->last_tag_open . '<a href="' . $this->base_url . $i . '.html">' . $this->last_link . '</a>' . $this->last_tag_close;
        }
        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        // Add the wrapper HTML if exists
        $output = $this->full_tag_open . $output . $this->full_tag_close;
        return $output;
    }
}
?>