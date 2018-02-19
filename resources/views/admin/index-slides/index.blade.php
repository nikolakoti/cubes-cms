@extends('admin.layout')

@section('content')
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="{{route('admin.index-slides.index')}}">Index Slides</a>
	</li>
</ol>
<h1>Index Slides</h1>
<hr>			

@include('admin.global-partials.system-messages')

<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-table"></i> Index Slides

		<div class="btn-group btn-group-sm float-right" id="list-menu">
			<button type="button" class="btn btn-secondary" data-action="change-order">Change Order</button>
			<a class="btn btn-secondary" href="{{route('admin.index-slides.add')}}">
				<i class="fa fa-plus"></i>
				Add Slide
			</a>
		</div>
		<form action="" method="post" id="save-order-form" class="btn-group btn-group-sm float-right">
			{{csrf_field()}}
			<input name="order_ids" value="">
			<button type="button" class="btn btn-secondary" data-action="cancel-change-order">Cancel</button>
			<button type="submit" class="btn btn-success">Save Order</button>
		</form>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="records-table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>#</th>
						<th>Photo</th>
						<th>Status</th>
						<th>Title</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					
					@foreach($indexSlides as $indexSlide)
					<tr data-id="{{$indexSlide->id}}">
						<td>{{$indexSlide->id}}</td>
						<td style="width: 200px;">
							@if(\Storage::disk('public')->exists('/index-slides/' . $indexSlide->photo_filename))
							<img 
							style="max-width: 200px;"
							class="img-fluid img-thumbnail" 
							src="{{\Storage::disk('public')->url('/index-slides/' . $indexSlide->photo_filename)}}" 
							alt="placeholder">
							@endif
						</td>
						<td class="text-center">
							@if($indexSlide->status == 1)
							<i title="enabled" class="fa fa-check-circle text-success"></i>
							@else
							<i title="disabled" class="fa fa-ban text-danger"></i>
							@endif
						</td>
						<td>{{$indexSlide->title}}</td>
						<td class="text-center">
							<div class="btn-group">
								<a 
									class="btn btn-secondary"
									href="{{route('admin.index-slides.edit', ['id' => $indexSlide->id])}}"
									title="edit"
								><i class="fa fa-pencil"></i></a>
								@if($indexSlide->status == 1)
								<button 
									class="btn btn-secondary" 
									title="disable" 
									data-action="disable"
									data-id="{{$indexSlide->id}}"
								>
									<i class="fa fa-ban"></i>
								</button>
								@else
								<button 
									class="btn btn-secondary" 
									title="enable" 
									data-action="enable"
									data-id="{{$indexSlide->id}}"
								>
									<i class="fa fa-check-circle"></i>
								</button>
								@endif
								<button 
									class="btn btn-secondary" 
									title="delete" 
									data-action="delete"
									data-id="{{$indexSlide->id}}"
								>
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>
					</tr>
					@endforeach
					
				</tbody>
			</table>
		</div>
	</div>
</div>


<form method="post" action="{{route('admin.index-slides.delete')}}" class="modal fade" id="delete-record-modal" tabindex="-1" role="dialog" aria-hidden="true">
	{{csrf_field()}}
	<input type="hidden" name="id" value="">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete Slide</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are you sure you want to delete slide on Index slider?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Delete</button>
			</div>
		</div>
	</div>
</form>
<form method="post" action="" class="modal fade" id="delete-record-modal" tabindex="-1" role="dialog" aria-hidden="true">
	{{csrf_field()}}
	<input type="hidden" name="id" value="">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Enable Slide</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are you sure you want to enable slide on Index slider?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success">
					<i class="fa fa-check-circle"></i>
					Enable
				</button>
			</div>
		</div>
	</div>
</form>
<form method="post" action="" class="modal fade" id="delete-record-modal" tabindex="-1" role="dialog" aria-hidden="true">
	{{csrf_field()}}
	<input type="hidden" name="id" value="">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Disable Slide</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are you sure you want to disable slide on Index slider?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-warning">
					<i class="fa fa-ban"></i>
					Disable
				</button>
			</div>
		</div>
	</div>
</form>
@endsection

@push('footer_javascript')
<script>
	$('#records-table').on('click', '[data-action="delete"]', function(e) {
		
		e.preventDefault();
		
		var target = $(this);
		
		var id = target.attr('data-id');
		
		var deletePopup = $('#delete-record-modal');
		
		deletePopup.find('[name="id"]').val(id);
		
		deletePopup.modal('show');
	});
</script>
@endpush
