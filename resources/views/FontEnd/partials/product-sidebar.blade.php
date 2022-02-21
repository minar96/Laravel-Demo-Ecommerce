<ul class="list-group">
	@foreach('App\Models\Category'::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)
		<a href="#main-{{ $parent->id }}" class="list-group-item" data-toggle="collapse">
			<img src="{{ asset('images/category/'.$parent->image) }}" alt="" width="50"> 
			{{ $parent->name }}
		</a>

		<div class="collapse
			@if(Route::is('categories.show'))
							@if(App\Models\Category::ParentOrNotCategory($parent->id, $category->id))
								show
							@endif
						@endif

		" id="main-{{ $parent->id }}">
			<div class="child-rows">
					@foreach('App\Models\Category'::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
					<a href="{{ route('categories.show', $child->id) }}" class="list-group-item
						@if(Route::is('categories.show'))
							@if($child->id == $category->id)
								active
							@endif
						@endif

						">
						<img src="{{ asset('images/category/'.$child->image) }}" alt="" width="50"> 
						{{ $child->name }}
					</a>
				@endforeach
			</div>
		</div>

	@endforeach
	
	
</ul>