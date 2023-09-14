<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-clipboard-list mr-2"></i>Incident Report</h1>
	<h6><a target="_blank" rel="noopener noreferrer" href="https://lssd.gta.world/viewforum.php?f=1188">Incident Reports - Forum<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></a></h6>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="IncidentReport">
		<?php
			// Section - General
			$c->form('general', 'sections', array(
				'g' => $g,
				'c' => $c,
				'time' => true,
				'patrol' => false,
				'callsign' => true,
			));
			// Section - Officers
			$c->form('officer', 'sections', array(
				'g' => $g,
				'pg' => $pg,
				'c' => $c,
				'badge' => false,
				'slots' => true,
				'faction' => "LSSD"

			));
			// Section - Location
			require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/sections/location.php';
			// Form - List - Reporting District
			echo('<div class="form-row">');
				$c->form('list', 'forms', array(
					'size' => '4',
					'label' => '<label>Reporting District of Incident</label>',
					'icon' => 'map',
					'class' => 'selectpicker',
					'id' => 'inputReportingDistrict',
					'name' => 'inputReportingDistrict',
					'attributes' => 'required',
					'title' => 'Select Reporting District',
					'list' => $pg->pSheriffsReportingDistricts(),
					'hint' => '',
					'hintClass' => ''
				));
			echo('</div>');
			// Section - Involved Persons
			$c->form('person', 'sections', array(
				'g' => $g,
				'pg' => $pg,
				'c' => $c,
				'detailed_info' => true,
				'relation' => true,
				'slots' => true,
			));
		?>
		<hr>
		<h4><i class="fas fa-fw fa-gavel mr-2"></i>Suspected Crimes</h4>
		<div class="form-row groupSlotCitation crimeSelectorGroup">
		<?php
			// Form - List - Citation
			$c->form('list', 'forms', array(
				'size' => '6',
				'label' => '<label>Charge</label>',
				'icon' => 'gavel',
				'class' => 'selectpicker inputCrimeSelector',
				'id' => 'inputCrime-1',
				'name' => 'inputCrime[]',
				'attributes' => 'required data-live-search="true"',
				'title' => 'Select Charge',
				'list' => $pg->chargeChooser('generic'),
				'hint' => '',
				'hintClass' => ''
			));
			// Form - List - Citation Class
			$c->form('list', 'forms', array(
				'size' => '3',
				'label' => '<label>Class</label>',
				'icon' => 'ellipsis-v',
				'class' => 'selectpicker inputCrimeClassSelector',
				'id' => 'inputCrimeClass-1',
				'name' => 'inputCrimeClass[]',
				'attributes' => 'required',
				'title' => 'Select Class',
				'list' => '',
				'hint' => '',
				'hintClass' => ''
			));
			// Form - Options Add - Citation
			$c->form('options', 'forms', array(
				'size' => '3',
				'label' => '<label>Options</label>',
				'action' => 'addCitation',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Charge'
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Incident Details</h4>
		<div class="form-row">
		<?php
			// Form - Textfield - Incident Title
			$c->form('textfield', 'forms', array(
				'size' => '12',
				'type' => 'text',
				'label' => '<label>Incident Title</label>',
				'icon' => 'heading',
				'class' => '',
				'id' => 'inputIncidentTitle',
				'name' => 'inputIncidentTitle',
				'value' => '',
				'placeholder' => 'Deputy Involved Shooting',
				'tooltip' => '',
				'attributes' => 'required',
				'style' => ''
			));

			// Form - Textbox - Narrative & Notes
			$c->form('textbox', 'forms', array(
				'size' => '12',
				'label' => '<label>Narrative</label>',
				'icon' => 'clipboard',
				'id' => 'inputNarrative',
				'name' => 'inputNarrative',
				'rows' => '4',
				'placeholder' => 'On September 11th of 20XX, there was an incident that took place in XXXXX where X shot X.',
				'attributes' => 'required',
				'hint' => '<strong>Enter a detailed account of the incident.</strong>'
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-camera mr-2"></i>Evidence</h4>
		<div class="form-row groupEvidence">
		<?php
			// Form - Options Add - Evidence Photograph
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '',
				'action' => 'addEvidenceImage',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Photograph'
			));
			// Form - Options Add - Evidence Description
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '',
				'action' => 'addEvidenceBox',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Description'
			));
		?>
		</div>
		<?php
			// Form - Submit
			$c->form('submit', 'forms', array());
		?>
	</form>
</div>

<!-- COPY SLOTS -->
<?php
	// OFFICER SLOT
	require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/copy-slots/officer-nobadge.php';

	// PERSON SLOT
	require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/copy-slots/person.php';
?>

<!-- Evidence Photograph -->
<div class="container groupCopyImage" style="display: none;">
<?php
	// Form - Textfield - Evidence Photograph
	$c->form('textfield', 'forms', array(
		'size' => '10',
		'type' => 'text',
		'label' => '',
		'icon' => 'image',
		'class' => '',
		'id' => 'inputEvidenceImage',
		'name' => 'inputEvidenceImage[]',
		'value' => '',
		'placeholder' => 'https://imgur.com',
		'tooltip' => '',
		'attributes' => 'required',
		'style' => ''
	));
	// Form - Options Remove - Evidence Photograph
	$c->form('options', 'forms', array(
		'size' => '2',
		'label' => '',
		'action' => 'removeImage',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Photograph'
	));
?>
</div>
<!-- Evidence Description -->
<div class="container groupCopyBox" style="display: none;">
<?php
	// Form - Textbox - Evidence Description
	$c->form('textbox', 'forms', array(
		'size' => '10',
		'label' => '',
		'icon' => 'clipboard',
		'id' => 'inputEvidenceBox',
		'name' => 'inputEvidenceBox[]',
		'rows' => '1',
		'placeholder' => 'Brief Description',
		'attributes' => '',
		'hint' => ''
	));
	// Form - Options Remove - Evidence Description
	$c->form('options', 'forms', array(
		'size' => '2',
		'label' => '',
		'action' => 'removeBox',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Description'
	));
?>

<!-- COPY SLOT - Charge -->
<div class="container copyGroupSlotCitation" style="display: none;">
<?php
	// Form - List - Charge
	$c->form('list', 'forms', array(
		'size' => '6',
		'label' => '',
		'icon' => 'gavel',
		'class' => 'select-picker-copy inputCrimeSelector',
		'id' => 'inputCrime-',
		'name' => 'inputCrime[]',
		'attributes' => 'required data-live-search="true"',
		'title' => 'Select Charge',
		'list' => $pg->chargeChooser('traffic'),
		'hint' => '',
		'hintClass' => ''
	));
	// Form - List - Charge Class
	$c->form('list', 'forms', array(
		'size' => '3',
		'label' => '',
		'icon' => 'ellipsis-v',
		'class' => 'select-picker-copy inputCrimeClassSelector',
		'id' => 'inputCrimeClass-',
		'name' => 'inputCrimeClass[]',
		'attributes' => 'required',
		'title' => 'Select Class',
		'list' => '',
		'hint' => '',
		'hintClass' => ''
	));
	// Form - Options Remove - Charge
	$c->form('options', 'forms', array(
		'size' => '3',
		'label' => '',
		'action' => 'removeCitation',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Citation'
	));
?>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/form-footer.php'; ?>