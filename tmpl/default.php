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

// Access to module parameters
$domain = $params->get('domain', 'https://www.joomla.org');
?>

    <a href="<?php echo $domain; ?>">
        <?php echo 'mod_c2cstat'; ?>
    </a>

<?php

foreach ($relations as $relation){
    print_r($relation->source_city);
    echo '<br>';
}