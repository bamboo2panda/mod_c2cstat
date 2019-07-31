<?php
/**
 * @package    mod_c2cstat
 *
 * @author     Pavel <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addScript(JURI::root(). 'media/mod_c2cstat/script.js');


foreach ($relations as $relation){
    print_r($relation->technology);
    echo '<br>';
}

?>
