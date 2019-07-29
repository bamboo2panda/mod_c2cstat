<?php
/**
 * @package    mod_c2cstat
 *
 * @author     Pavel <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;
require_once __DIR__.'/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$relations = ModC2cstatHelper::getRelations($params);

require ModuleHelper::getLayoutPath('mod_c2cstat', $params->get('layout', 'default'));