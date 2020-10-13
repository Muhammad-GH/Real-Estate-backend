<style rel="stylesheet">
	table {
		border: 0px;
	}

	tr,
	td,
	p {
		margin: 0px;
		padding: 0px;
	}

	h4 {
		margin: 2px;
	}

	h2 {
		margin-top: 0px;
	}

	.set-font {
		font-size: 14px;
		padding-bottom: 20px;
	}

	.heading {
		color: #000;
		margin-top: 20px;
		font-size: 14px;
		margin-bottom: 0px;
	}

	.time {
		margin-bottom: 5px;
		font-size: 13px;
	}

	.time span {
		font-size: 11px;
		color: #000;
		font-weight: 700;
	}

	.foot {
		color: #9d9d9d;
		font-size: 10px;
	}

	.tb-head {
		margin-bottom: 10px;
		margin-top: 10px;
		font-size: 11px;
	}

	h3 {
		margin: 10px;
	}

	.tableeds {
		border: 1px solid #bfbfbf;
		height: 60px;
		padding: 10px;
	}

	.tableed {
		border-collapse: collapse;
	}

	.tableed td {
		height: 8px;
		padding: 4px 10px 4px 10px;
		border: 1px solid #ccc;
		font-size: 10px;
	}

	.tb-bg {
		background-color: #f2f2f2;
	}

	table {
		width: 100%;
	}

	.bold {
		font-weight: bold;
	}
</style>
<page>

	<table style="padding:0px 10px 10px; width: 100%;">
		<tr>
			<td style="width:100%; padding-bottom:10px;">
				<table>
					<tr>
						<td style="width:80%;">
							<img style="width: 200px" src="<?= public_path() . '/images/marketplace/company_logo/' . $variables["logo"]; ?>" alt="Logo">
						</td>
						<td style="font-size: 15px;color: #ccc; font-weight: bold; padding-top:30px;">Proposal</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="width:100%; padding-bottom:20px">
				<table>
					<tr>
						<td style="width:80%;">
							<p class="bold" style="line-height:1.4; font-size:12px;">
								{{$variables["company_id"]}}<br>
								{{$variables["names"]}}<br>
								{{$variables["email"]}}<br>
							</p>
						</td>
						<td>
							<p style="line-height:1.4; font-size:11px;">
								Request ID #FK{{$variables["proposal_request_id"]}}<br>
								Proposal Date: {{$variables["date"]}}<br>
								Due date: {{$variables["proposal_due_date"]}}<br>
							</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="width:100%;">
				<table>
					<tr style="vertical-align: top;">
						<td style="width:200px;">
							<p class="" style="line-height:1.4; font-size:11px;">
								{{$variables["address"]}}<br>
								Phone no: {{$variables["phone"]}}<br>
								Business ID: {{$variables["bussiness_id"]}}<br>
								Other info <br>
							</p>
						</td>
						<td>
							<p style="line-height:1.4;font-size:11px; ">
								<h5 style="margin-bottom:5px; font-weight:400; margin-top:0; font-size:11px;">Proposal To</h5>
								{{$variables["proposal_client_id"]}}<br>
								<br>
							</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="width:100%; padding-top:15px; padding-bottom:0px;">
				<hr style="color:#bfbfbf">
			</td>
		</tr>
		<tr>
			<th>
				<h2 class="heading">Proposal Summary</h2>
			</th>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td style="width:33.33%; padding-right:10px;">
							<h4 class="tb-head">Total Cost</h4>
							<table class="tableed" style="width:100%">
								<tbody style="width:100%">
									<tr class="tb-bg">
										<td style="width:50%; border-right:none;">Work Cost</td>
										<td style="width:50%; text-align:right;">{{$variables["left"]}} {{$variables["workTotal"]}} {{$variables["right"]}}</td>
									</tr>
									<tr class="">
										<td style="width:50%; border-right:none;">Material Cost</td>
										<td style="width:50%; text-align:right;">{{$variables["left"]}} {{$variables["matTotal"]}} {{$variables["right"]}}</td>
									</tr>
									<tr class="tb-bg">
										<td style="width:50%; border-right:none;">Total Cost</td>
										<td style="width:50%; text-align:right;">{{$variables["left"]}} {{$variables["matTotal"]+$variables["workTotal"]}} {{$variables["right"]}}</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td style="width:33.33%; padding-right:5px; padding-left:5px;">
							<h4 class="tb-head">Materials payment terms</h4>
							<div class="tableeds">
								<p style="font-size:10px;">{{$variables["proposal_material_payment"]}}.</p>
							</div>
						</td>
						<td style="width:33.33%; padding-left:10px;">
							<h4 class="tb-head">Work payment terms</h4>
							<div class="tableeds">
								<p style="font-size:10px;">{{$variables["proposal_work_payment"]}}</p>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th>
				<h2 class="heading">Project Plan</h2>
			</th>
		</tr>
		<tr>
			<td>
				<table>
					<tr style="vertical-align:top;">
						<td style="width:33.33%; padding-right:10px">
							<h4 class="tb-head">Work</h4>
							<table class="tableed" style="width:100%">
								<tbody style="width:100%" style="vertical-align: middle;">
									@foreach (explode (",", $variables["workItems"]) as $work)
									<tr class=<?= $retVal = ($loop->odd) ? 'tb-bg' : ''; ?> style="width:100%">
										<td style="width:100%;">{{$work}}</td>
									</tr>
									@endforeach

								</tbody>
							</table>
						</td>
						<td style="width:33.33%; padding-left:5px;">
							<h4 class="tb-head">Material</h4>
							<table class="tableed">
								<tbody style="vertical-align: middle;">
									@foreach (explode (",", $variables["matItems"]) as $mat)
									<tr class=<?= $retVal = ($loop->odd) ? 'tb-bg' : ''; ?> style="width:100%">
										<td style="width:100%;">{{$mat}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th>
				<h2 class="heading">Proposal details</h2>
			</th>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td style="width:33.33%; padding-right:10px;">
							<h4 class="tb-head">Guarantee for work</h4>
							<div class="tableeds">
								<p style="font-size:10px;">{{$variables["proposal_work_guarantee"]}}</p>
							</div>
						</td>
						<td style="width:33.33%; padding-left:5px;">
							<h4 class="tb-head">Insurance</h4>
							<div class="tableeds">
								<p style="font-size:10px;">{{$variables["proposal_insurance"]}}</p>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<h3></h3>
			</td>
		</tr>
		<tr>
			<th>
				<h2 class="time" style="padding-bottom:10px;">Project start date: <span>{{$variables["proposal_start_date"]}}</span></h2>
			</th>
		</tr>
		<tr style="margin-top:0px;">
			<th>
				<h2 class="time">Project end date: <span>{{$variables["proposal_end_date"]}}</span></h2>
			</th>
		</tr>

	</table>


	<page_footer>
		<table style="padding:0 10px 0 10px;">
			<tr>
				<td style="width:100%; padding-top:30px; padding-bottom:0px;">
					<hr style="color:#bfbfbf">
				</td>
			</tr>
			<tr>
				<td>
					<p class="foot" style="margin-top:5px;">Powered by FlipkotiPro </p>
				</td>
			</tr>
		</table>
	</page_footer>


</page>