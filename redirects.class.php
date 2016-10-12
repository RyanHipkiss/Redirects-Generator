<?php

/**
 * Generates 301 redirects
 *
 * Description:
 * -> Requires UT8 Encoding of CSV file.
 */

class Redirects {
    public $domain = '',
           $old_url_column,
           $new_url_column,
           $redirect_type,
           $csv_values = array(),
           $redirects  = array();

    /**
     * Load CSV values into class
     * @param [string | file] $csv [CSV File]
     */
    function __construct($csv = null)
    {
        if($csv !== null) {

            $csv = fopen($csv, 'r');

            $line_counter = 1;
            while(($line = fgetcsv($csv)) !== false) {
                if($line_counter > 1) {

                    foreach($line as $key => $value) {
                        $line[$key] = utf8_decode($value);
                    }

                    $this->csv_values[] = $line;
                }
                $line_counter++;
            }

            fclose($csv);
        }
    }

    /**
     * Set old domain, to remove from URLS
     * @param string $domain
     */
    public function set_domain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Set column number in CSV for old urls
     * @param [int] $column_number
     */
    public function set_old_url_column($column_number)
    {
        $this->old_url_column = $column_number;
    }

    /**
     * Set column number in CSV for new urls
     * @param [int] $column_number
     */
    public function set_new_url_column($column_number)
    {
        $this->new_url_column = $column_number;
    }

    /**
     * Set redirect type (301/301)
     * @param [string] $redirect_type
     */
    public function set_redirect_type($redirect_type)
    {
        $this->redirect_type = $redirect_type;
    }

    /**
     * Generate URS and return to user
     * @return [array] $this->redirects [array of the redirects]
     */
    public function generate_redirects()
    {
        if(empty($this->csv_values)) {
            return $this->generate_error('There are no CSV values');
        }

        if(!is_array($this->csv_values)) {
            return $this->generate_error('Values are not of correct format');
        }

        foreach($this->csv_values as $key => $row) {
            $old_url = $row[$this->old_url_column];
            $new_url = $row[$this->new_url_column];

            if(strpos($old_url, $this->domain) !== false) {
                $old_url = str_replace($this->domain, '', $old_url);
            }

            if(!empty($old_url) && !empty($new_url)) {
                $this->redirects[] = 'Redirect' . ' ' . $this->redirect_type . ' ' . $old_url . ' ' . $new_url;
            }
        }

        return $this->redirects;
    }

    /**
     * Put redirects in a file for quick viewing
     * @param  [string] $file [File to store redirects]
     */
    public function insert_to_file($file)
    {
        if(!empty($this->redirects)) {

            $file = fopen($file, 'a');
            foreach($this->redirects as $key => $redirect) {
                fwrite($file, $redirect . PHP_EOL);
            }
            fclose($file);
        }
    }

    /**
     * Shows an error to the user.
     * @param  [string] $error [Erorr Message]
     */
    public function generate_error($error = null)
    {
        if($error !== null) {
            die($error);
        }
    }
}