@extends('layouts.master')

@section('content')
	@include('wiki.partials.menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="wiki-setting">
					<div class="wiki-setting-header">
					  	Wiki Settings
					</div>
					<div role="tabpanel">
						@include('wiki.setting.partials.menu')
						<div class="tab-content">
							<div class="table-responsive" style="margin-top: 40px;">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th></th>
											<th colspan="2" class="text-center" width="25%" style="font-family: lato;">Pages</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center"><b style="font-family: lato;">Members</b></td>
											<td class="text-center" style="font-family: lato;"><b>Delete</b></td>
											<td class="text-center" style="font-family: lato;"><b>Add</b></td>
										</tr>
										<tr>	
											<td><img src="/img/christian.jpg" width="28" height="28" style="border-radius: 3px; margin-right: 12px;"> Christian</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value=""	>
												</label>
											</td>
										</tr>
										<tr>	
											<td><img src="/img/elliot.jpg" width="28" height="28" style="border-radius: 3px; margin-right: 12px;"> Elliot</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="">
												</label>
											</td>
										</tr>
										<tr>	
											<td><img src="/img/helen.jpg" width="28" height="28" style="border-radius: 3px; margin-right: 12px;"> Helen</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="">
												</label>
											</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
										</tr>
										<tr>	
											<td><img src="/img/jenny.jpg" width="28" height="28" style="border-radius: 3px; margin-right: 12px;"> Jenny</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
										</tr>
										<tr>	
											<td><img src="/img/joe.jpg" width="28" height="28" style="border-radius: 3px; margin-right: 12px;"> Joe</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="">
												</label>
											</td>
										</tr>
										<tr>	
											<td><img src="/img/justen.jpg" width="28" height="28" style="border-radius: 3px; margin-right: 12px;"> Justen</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="">
												</label>
											</td>
										</tr>
										<tr>	
											<td><img src="/img/laura.jpg" width="28" height="28" style="border-radius: 3px; margin-right: 12px;"> Laura</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="">
												</label>
											</td>
										</tr>
										<tr>	
											<td><img src="/img/matt.jpg" width="28" height="28" style="border-radius: 3px; margin-right: 12px;"> Matt</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="">
												</label>
											</td>
										</tr>
										<tr>	
											<td><img src="/img/steve.jpg" width="28" height="28" style="border-radius: 3px; margin-right: 12px;"> Steve</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="">
												</label>
											</td>
										</tr>
										<tr>	
											<td><img src="/img/stevie.jpg" width="28" height="28" style="border-radius: 3px; margin-right: 12px;"> Stevie</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="" checked>
												</label>
											</td>
											<td class="text-center">
												<label>
													<input type="checkbox" value="">
												</label>
											</td>
										</tr>
									</tbody>
								</table>
							</div>			
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection