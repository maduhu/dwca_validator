<?php
$namespaces[] = 'eol';

$eol_strict = FALSE;

function eol_terms_freetext(){
  return array(
    'http://eol.org/schema/reference/full_reference' => array('empty' => 'error'),
    'http://eol.org/schema/reference/primaryTitle'  => array('empty' => 'error'),
    'http://xmlns.com/foaf/spec/#term_firstName' => array('empty' => 'error'),
    'http://xmlns.com/foaf/spec/#term_familyName' => array('empty' => 'error'),
    'http://eol.org/schema/agent/organization' => array('empty' => 'info'),
    'http://xmlns.com/foaf/spec/#term_accountName' => array('empty' => 'error'),
    'http://xmlns.com/foaf/spec/#term_name' => array('empty' => 'error'),
    'http://iptc.org/std/Iptc4xmpExt/1.0/xmlns/CVterm' => array('empty' => 'error'),
  );
}

function eol_term_eol_org_schema_agent_agentID($file, $rowType, $row, $value, &$core_ids, $all_ids) {
  if (trim($value) == "") {return;}
  if (!array_key_exists($value, $all_ids['http://eol.org/schema/agent/Agent']['ids'])) {
  	dwcav_error('error', $file, "EoL Agent ($value) does not exist in archive", $row);
  }
}

function eol_exclusions_files_core_index() {
	return array(
	  'http://eol.org/schema/agent/Agent',
	);
}

function eol_term_purl_org_dc_terms_language($file, $rowType, $row, $value, &$core_ids) {
  if(trim($value) == "" && $rowType = "http://rs.gbif.org/terms/1.0/VernacularName"){
  	global $eol_strict;
  	$level = ($eol_strict ? 'error' : 'info');
  	dwcav_error($level, $file, "EoL expects vernacular names to have a language", $row);
  }
}