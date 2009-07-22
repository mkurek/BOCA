<?php
	/**
	* SCIG mambot for Joomla.
	* Copyright (C) 2006 Tomasz Piotrowski. All rights reserved.
	* http://www.gnu.org/copyleft/gpl.html GNU/GPL
	*/

	/** ensure this file is being included by a parent file */
	defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

	$_MAMBOTS->registerFunction( 'onPrepareContent', 'botSCIG' );

	function botSCIG( $published, &$row, $mask=0, $page=0  ) {
		global $mosConfig_absolute_path;

		if (!$published) {
			return true;
		}

		require_once( $mosConfig_absolute_path . '/includes/domit/xml_saxy_lite_parser.php' );

		// define the regular expression for the bot
		$regex = "#{scig:(.*?)}#s";

		// perform the replacement
		$row->text = preg_replace_callback( $regex, 'botSCIG_replacer', $row->text );

		return true;
	}

	function botSCIG_replacer( &$matches ) {

		return '<img src="includes/scig/scig.php?desc=mambot&data='.$matches[1].'"/>';
	}
?>
