<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				{{ __('My Todos') }}
			</h2>
			<!-- Authentication -->
			<form method="POST" action="{{ route('logout') }}">
				@csrf
				
				<x-dropdown-link :href="route('logout')"
				                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
					{{ __('Log Out') }}
				</x-dropdown-link>
			</form>
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">
					@if(Session::get('message'))
						<div class="p-3 bg-green-200 mb-6">
							{!! Session::get('message') !!}
						</div>
					@endif
					
					<form method="POST" action="{{route('todo.store')}}">
						@method('POST')
						@csrf
						
						<div class="flex">
							<div class="mb-6 w-4/5">
								<input type="text" name="name" id="name" class="border border-r-0 p-3 w-full focus:border-green-500" placeholder="Todo Name..." autofocus required>
								
								@error('name')
								<span class="block text-red-600 mt-2">{{$message}}</span>
								@enderror
							</div>
							
							<div class="w-1/5">
								<button class="p-3 border border-green-500 px-5 bg-green-500 text-white w-full">Add</button>
							</div>
						</div>
					</form>
					
					<table class="border-l border-b w-full">
						<tr>
							<th class="border-r border-t py-2 px-5 text-left">Name</th>
							<th class="border-r border-t py-2 px-5 text-center">Status</th>
							<th class="border-r border-t py-2 px-5 text-center">Action</th>
						</tr>
						@empty($todos)
							<tr>
								<td class="border-r border-t py-2 px-5">No Todo</td>
							</tr>
						@else
							@foreach($todos as $todo)
								<tr class="@empty(!$todo->done) text-gray-500 @endempty">
									<td class="border-r border-t py-1 px-5">
										<a class="todo-name" href="#">{{$todo->name}}</a>
										<form action="{{route('todo.update', $todo->id)}}" method="POST" class="todo-input hidden w-full">
											@csrf
											@method('PUT')
											<input type="text" name="name" class="w-full py-1 focus:border-green-500" value="{{$todo->name}}">
										</form>
									</td>
									<td class="border-r border-t py-2 px-5 text-center status-update flex justify-center">
										<form action="{{route('done', $todo->id)}}" method="POST">
											@csrf
											@include('layouts.form.toggle-switch', ['name'=>'done', 'value'=> $todo->done])
										</form>
									</td>
									<td class="border-r border-t py-2 px-5 text-center">
										<a class="todo-edit" href="#">Edit</a>
										|
										<form action="{{route('todo.destroy', $todo->id)}}" method="POST" class="inline">
											@csrf
											@method('DELETE')
											<button type="submit">Delete</button>
										</form>
									</td>
								</tr>
							@endforeach
					</table>
					
					<div class="admin-table-paginate mt-5">
						{{ $todos->links() }}
					</div>
					
					<script>
						document.querySelectorAll( '.todo-name, .todo-edit' ).forEach( function ( element ) {
							element.addEventListener( 'click', function ( event ) {
								event.preventDefault();
								
								document.querySelectorAll( '.todo-input' ).forEach( function ( element ) {
									element.classList.add( 'hidden' );
									element.previousElementSibling.classList.remove( 'hidden' );
								} );
								
								event.currentTarget.closest( 'tr' ).querySelector( '.todo-name' ).classList.add( 'hidden' );
								event.currentTarget.closest( 'tr' ).querySelector( '.todo-input' ).classList.remove( 'hidden' );
								event.currentTarget.closest( 'tr' ).querySelector( '.todo-input input[name="name"]' ).focus();
							} );
						} );
						document.querySelectorAll( '.status-update input[type="checkbox"]' ).forEach( function ( element ) {
							element.addEventListener( 'change', function ( event ) {
								event.currentTarget.closest( 'form' ).submit();
							} );
						} );
					</script>
					@endempty
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
