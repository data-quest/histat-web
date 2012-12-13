
<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Validation rules.
 *
 * @package    Kohana
 * @category   Security
 * @author     Kohana Team
 * @copyright  (c) 2008-2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Valid extends Kohana_Valid{
    public static function name($str,$utf8){
		return (bool) preg_match('/^[-\w]++$/uD', $str);
    }
}
