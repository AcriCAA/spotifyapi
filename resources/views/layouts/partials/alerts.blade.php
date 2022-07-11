@if($alerts->count() > 0)

	<div class="col-xl-12 col-lg-12 mb-3">
		<div class="alert-warning card card-stats mb-4 mb-xl-0">
 <div class="card-header">
    <h5 class="card-title text-uppercase mb-0">Alerts <i class="fa-solid fa-triangle-exclamation"></i></h5>
  </div>

			<div class="card-body">
						
						<table class="table table-responsive">
							<tbody>	
								@foreach($alerts as $a)

								<tr>
									<td class="col">{{date_format($a->updated_at, 'D F j, Y h:i a')}}</td>
									<td class="col">{{$a->type}}</td>
									<td class="col">{{$a->description}}</td>
									<td class="col"><p>
          <a class="btn btn-danger" href="/alerts/dismiss/{{$a->id}}" role="button">
           X
         </a>

         
</td>

								</tr>
								@endforeach
								{{ $alerts->links() }}
							</tbody>
						</table>
			</div>
		</div>
	</div>


@endif