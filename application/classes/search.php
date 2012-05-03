<?php

defined('SYSPATH') or die('No direct access allowed.');

class Search {

    private static $search_words;
    private static $search_query;

    public static function set_search_query($search_query = '') {
        self::$search_query = $search_query;
    }

    public static function get_search_words() {

        if (!is_array(self::$search_words)) {
            $s_str = self::$search_query;
            $s_str = str_replace(array('+', '-', '(', ')', '<', '>'), ' ', $s_str);
            preg_match_all('/"[^"]*"/', $s_str, $tmp1);
            $s_str = preg_replace('/"[^"]*"/', '', $s_str);
            preg_match_all('/\S*/', $s_str, $tmp2);

            foreach (array_merge($tmp1[0], $tmp2[0]) as $tmp3) {
                trim($tmp3);

                if (preg_match('/^".*"$/', $tmp3)) {
                    $tmp3 = substr($tmp3, 1, -1);
                }
                if ($tmp3) {
                    $pos = strpos($tmp3, '*');
                    if ($pos !== false) {
                        $tmp3 = substr($tmp3, 0, $pos);

                        self::$search_words[] = '/\b' . preg_quote($tmp3) . '\S*\b/i';
                    } else {

                        self::$search_words[] = '/\b' . preg_quote($tmp3) . '\b/i';
                    }
                }
            }
            if (!is_array(self::$search_words)) {
                self::$search_words = array();
            }
        }

        return self::$search_words;
    }

    public static  function highlight_search($str) {
        return preg_replace(self::$search_words, '<span style="color:#FE8F00">$0</span>', $str);
    }

    public static function get_search_excerpt($str) {


        $str_a = explode("|", wordwrap($str, 80, "|"));

        $count = 0;
        $grepped = array();
        $ret = false;
        foreach (self::get_search_words() as $pattern) {

            foreach (preg_grep($pattern, $str_a) as $grep_key => $detail) {
                $grepped[$grep_key] = $detail;
            }
        }

        if (count($grepped) > 0)
            $ret = array('');
        
        foreach ($grepped as $grep_key => $detail) {
            if ($grep_key > 0) {
                $ret[$count] = self::highlight_search($str_a[$grep_key - 1]);
            }
          
            $ret[$count] .= " " . self::highlight_search($detail);
            if ($grep_key < count($str_a) - 1) {
                $ret[$count] .= " " . self::highlight_search($str_a[$grep_key + 1]);
            }
            ++$count;
        }

        return ($ret);
    }

    public static function create_filter(array $keys) {
        $diff = '';
        $out = '';
        $keys = array_keys($keys);
        
        for ($i = 0, $c = count($keys); $i < $c; ++$i) {
            $diff |= $keys[0] ^ $keys[$i];
        }
        
        $out = $keys[0];
       
        for ($i = 0, $c = strlen($out); $i < $c; ++$i) {
            if ($diff[$i] !== "\x0") {
                $out[$i] = '_';
            }
        }
        return $out;
    }

}