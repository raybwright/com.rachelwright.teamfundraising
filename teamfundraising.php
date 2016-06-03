<?php

require_once 'teamfundraising.civix.php';

/**
 Finds all contacts that have a 'Team Member of' realtionship to donor, places them in an array, then sends them an existing email template
*/

function teamfundraising_civicrm_post($op, $objectName, $objectId, &$objectRef) {
	 if ($op == 'create' && $objectName == 'Contribution') {
		// CRM_Core_Error::debug_var('id', $objectId);
		// CRM_Core_Error::debug_var('objectref', $objectRef);
		
		// need to update id 15 to the name of the relationship
		$result = civicrm_api3('Relationship', 'get', array(
		  	'contact_id_a' => $objectRef->contact_id ,
		  	'relationship_type_id' => 15,
			));
		
		$relationarray = array();
		foreach($result['values'] as $relationship){
         	$relationarray[] = $relationship['contact_id_b'];
      		}
			
		$result = civicrm_api3('Relationship', 'get', array(
		  	'contact_id_b' => $objectRef->contact_id ,
		  	'relationship_type_id' => 15,
			));	
		foreach($result['values'] as $relationship){
         	$relationarray[] = $relationship['contact_id_a'];
      		}
			// CRM_Core_Error::debug_var('result', $result);
			// CRM_Core_Error::debug_var('relation', $relationarray);
		
		// anyway to use an email template name not and id? This api is dependent on the Email API extension 
		foreach($relationarray as $emailid){
			$result2 = civicrm_api3('Email', 'send', array(
				  'contact_id' => $emailid,
				  'template_id' => "7",
			));
			// CRM_Core_Error::debug_var('result2', $result2);
			// CRM_Core_Error::debug_var('emailid', $emailid);
      	}
		
  	} else if ($op == 'edit' && $objectName == 'Contribution') {
   		// do something
  	}
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function teamfundraising_civicrm_config(&$config) {
  _teamfundraising_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function teamfundraising_civicrm_xmlMenu(&$files) {
  _teamfundraising_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function teamfundraising_civicrm_install() {
  _teamfundraising_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function teamfundraising_civicrm_uninstall() {
  _teamfundraising_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function teamfundraising_civicrm_enable() {
  _teamfundraising_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function teamfundraising_civicrm_disable() {
  _teamfundraising_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function teamfundraising_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _teamfundraising_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function teamfundraising_civicrm_managed(&$entities) {
  _teamfundraising_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function teamfundraising_civicrm_caseTypes(&$caseTypes) {
  _teamfundraising_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function teamfundraising_civicrm_angularModules(&$angularModules) {
_teamfundraising_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function teamfundraising_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _teamfundraising_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function teamfundraising_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function teamfundraising_civicrm_navigationMenu(&$menu) {
  _teamfundraising_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'com.rachelwright.teamfundraising')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _teamfundraising_civix_navigationMenu($menu);
} // */
