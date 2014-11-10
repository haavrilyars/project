<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* CSVReader Class
*
* $Id: csvreader.php 136 2007-05-30 15:36:00Z Pierre-Jean $
*
* Allows to retrieve a CSV file content as a two dimensional array.
* The first text line shall contains the column names.
*
* Let's consider the following CSV formatted data:
*
*        col1;col2;col3
*         11;12;13
*         21;22;23
*
* It's returned as follow by the parsing operations:
*
*         Array(
*             [0] => Array(
*                     [col1] => 11,
*                     [col2] => 12,
*                     [col3] => 13
*             )
*             [1] => Array(
*                     [col1] => 21,
*                     [col2] => 22,
*                     [col3] => 23
*             )
*        )
*
* @author        Pierre-Jean Turpeau
* @link        http://www.codeigniter.com/wiki/CSVReader
*/
class CSVReader {
    
    var $fields;            /** columns names retrieved after parsing */
    var $separator = ',';    /** separator used to explode each line */
    
    /**
     * Parse a text containing CSV formatted data.
     *
     * @access    public
     * @param    string
     * @return    array
     */
    function parseText($p_Text) {
        $lines = explode("\n", $p_Text);
        return $this->parseLines($lines);
    }
    
    /**
     * Parse a file containing CSV formatted data.
     *
     * @access    public
     * @param    string
     * @return    array
     */
    function parseFile($p_Filepath) {
        $lines = file($p_Filepath);
        return $this->parseLines($lines);
    }
    
    /**
     * Parse an array of text lines containing CSV formatted data.
     *
     * @access    public
     * @param    array
     * @return    array
     */
    function parseLines($p_CSVLines) {    
        $content = FALSE;
        foreach( $p_CSVLines as $line_num => $line ) {
            if( $line != '' ) { // skip empty lines
                $elements = split($this->separator, $line);
                
                if( !is_array($content) ) { // the first line contains fields names
                    $this->_fields = $elements;
                    $content = array();
                } else {
                    $item = array();
                    foreach( $this->_fields as $id => $field ) {
                        $item[$field] = $elements[$id];
                    }
                    $content[] = $item;
                }
            }
        }
        return $content;
    }
}
?> 