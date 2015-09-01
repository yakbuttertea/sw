<?php

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
include( "../../php/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Join,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'shelflocation' )
	->fields(
		Field::inst( 'itemnumber' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'herbname' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'chname' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'comment' ),
		Field::inst( 'lotnumber' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'revnumber' )->validator( 'Validate::notEmpty' ),
                Field::inst( 'supplier' )->validator( 'Validate::notEmpty' ),
                Field::inst( 'nboxes' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'location' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'label' ),
		Field::inst( 'date' )
			->validator( 'Validate::dateFormat', array(
				"format"  => Format::DATE_ISO_8601,
				"message" => "Please enter a date in the format yyyy-mm-dd"
			) )
			->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
			->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 )
	)
	->process( $_POST )
	->json();
