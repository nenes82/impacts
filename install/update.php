<?php

function impacts_update() {
   global $DB;

   // update from older versions
   // load config to get current version
   if (!$DB->fieldExists("glpi_plugin_impacts_configs", "db_version" )) {
      $current_version = '1.0.0';
   } else {
      include_once(GLPI_ROOT."/plugins/impacts/inc/config.class.php");
      $config = PluginImpactsConfig::getInstance();
      $current_version = $config->fields['db_version'];
      if (empty($current_version)) {
         $current_version = '1.0.0';
      }
   }

   //switch ($current_version) {
   //   case '1.1.0' :
   //       //include_once(GLPI_ROOT."/plugins/impacts/install/update_to_X_X_X.php");
   //       //$new_version = update_to_X_X_X();
   //}

   if (isset($new_version)) {
      // end update by updating the db version number
      $DB->updateOrDie('glpi_plugin_impacts_configs', [
         'db_version' => $new_version
      ], [
         'id' => 1
      ], "error when updating db_version field in glpi_plugin_impacts_configs".$DB->error());
   }

}
