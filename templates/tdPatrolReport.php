<div class="container mb-5 pb-5">
	<h1 class="my-3">Traffic Division: Patrol Report - Form</h1>
	<form action="controllers/TDPatrolReportProcessor.inc.php" method="POST">

		<h4><i class="fas fa-archive fa-fw"></i> General Details</h4>
		<div class="form-row">
			<div class="form-group col-xl-6">
				<label>Date</label>
				<div class="input-group">
					<input
					class="form-control"
					type="text"
					id="inputDateFrom"
					name="inputDateFrom"
					placeholder="DD/MMM/YYYY"
					style="text-transform: uppercase;"
					value="<?php echo $g->getDate()?>"
					required>
					<div class="input-group-midpend">
						<span class="input-group-text" id="basic-addon1">-</span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputDateTo"
					name="inputDateTo"
					placeholder="DD/MMM/YYYY"
					style="text-transform: uppercase;">
				</div>
				<center><small id="helpDate" class="form-text text-muted">DD/MMM/YYYY Format</small></center>
			</div>
			<div class="form-group col-xl-3">
				<label>Time</label>
				<div class="input-group">
					<input
					class="form-control"
					type="text"
					id="inputTimeFrom"
					name="inputTimeFrom"
					placeholder="00:00"
					value="<?php echo $g->getTime()?>"
					required>
					<div class="input-group-midpend">
						<span class="input-group-text" id="basic-addon1">-</span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputTimeTo"
					name="inputTimeTo"
					placeholder="24:00"
					required>
				</div>
				<center><small id="helpTime" class="form-text text-muted">24-Hour Format</small></center>	
			</div>
			<div class="form-group col-xl-3">
				<label>Call Sign</label>
				<input
				class="form-control"
				type="text"
				id="inputCallsign"
				name="inputCallsign"
				placeholder="Call Sign"
				value="<?php echo $g->cookieCallSign(); ?>"
				required>
				<small id="helpCallSign" class="form-text text-muted">Example: 2-ADAM-1, 2A1</small>
			</div>
		</div>

		<h4><i class="fas fa-car fa-fw"></i> Traffic Stops</h4>
		<div class="form-row groupSlotTS">
			<div class="form-group col-xl-2">
				<label>Additional Options</label>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addSlotTS"><i class="fas fa-plus-square fa-fw"></i> Traffic Stop Slot</a>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-xl-3">
				<div class="form-group">
					<h5 class="text-center"><i class="fas fa-truck-pickup fa-fw"></i> Vehicle Impounds</h5>
					<input
					class="form-control"
					type="number"
					id="inputVehicleImpounds"
					name="inputVehicleImpounds"
					placeholder="#">
				</div>
			</div>
			<div class="col-xl-3">
				<div class="form-group">
					<h5 class="text-center"><i class="fas fa-car-crash fa-fw"></i> Traffic Investigations</h5>
					<input
					class="form-control"
					type="number"
					id="inputTrafficInvestigations"
					name="inputTrafficInvestigations"
					placeholder="#">
				</div>
			</div>
			<div class="col-xl-3">
				<div class="form-group">
					<h5 class="text-center"><i class="fas fa-id-card fa-fw"></i> License Suspensions</h5>
					<input
					class="form-control"
					type="number"
					id="inputLicenseSuspensions"
					name="inputLicenseSuspensions"
					placeholder="#">
				</div>
			</div>
			<div class="col-xl-3">
				<div class="form-group">
					<h5 class="text-center"><i class="fas fa-user-lock fa-fw"></i> Arrests Conducted</h5>
					<input
					class="form-control"
					type="number"
					id="inputArrestsConducted"
					name="inputArrestsConducted"
					placeholder="#">
				</div>
			</div>
		</div>

		<h4><i class="fas fa-clipboard fa-fw"></i> Notes & Other Details</h4>
		<div class="form-row">
			<div class="form-group col-xl-12">
				<textarea
				class="form-control"
				id="inputNotes"
				name="inputNotes"
				rows="2"
				placeholder="Any optional and extra notes regarding the patrol."></textarea>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-xl-12">
				<input
				class="form-control"
				type="text"
				id="inputTDPatrolReportURL"
				name="inputTDPatrolReportURL"
				value="<?php echo $g->cookieTrafficPatrolURL(); ?>"
				placeholder="Direct URL to your personal Patrol Report thread."
				required>
			</div>
		</div>
		<div class="container my-5 text-center">
			<button id="submit" type="submit" name="submit" class="btn btn-primary px-5"><i class="fas fa-plus-square fa-fw"></i>Submit</button>
		</div>
	</form>

	<!-- COPY SLOTS -->

	<div class="container groupCopySlotTS" style="display: none;">
		<div class="form-group col-xl-3">
			<input
			class="form-control"
			type="text"
			id="inputNameTS[]"
			name="inputNameTS[]"
			placeholder="Firstname Lastname"
			required>
		</div>
		<div class="form-group col-xl-6">
			<input
			class="form-control"
			type="text"
			id="inputReasonTS[]"
			name="inputReasonTS[]"
			placeholder="Reason"
			required>
		</div>
		<div class="form-group col-xl-1">
			<input
			class="form-control"
			type="text"
			id="inputCitationsTS[]"
			name="inputCitationsTS[]"
			placeholder="#"
			data-placement="bottom" title="Leave empty if none for warnings.">
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeSlotTS" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Slot</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		// Maximum Slots
		var maxSlotTS = 30;
		$(".addSlotTS").click(function(){
			if($('body').find('.groupSlotTS').length < maxSlotTS){
				var fieldHTML = '<div class="form-row groupSlotTS">'+$(".groupCopySlotTS").html()+'</div>';
				$('body').find('.groupSlotTS:last').after(fieldHTML);
			}else{
				alert('Maximum '+maxSlotTS+' traffic stop slots are allowed.');
			}
		});

		$("body").on("click",".removeSlotTS",function(){ 
			$(this).parents(".groupSlotTS").remove();
		});

		// Tooltips
		$('input').tooltip();

	});
</script>
