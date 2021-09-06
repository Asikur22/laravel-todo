<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('My Todos') }}
		</h2>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">
					<form method="POST" action="{{route('todo.store')}}">
						@method('POST')
						@csrf
						
						<div class="flex mb-10">
							<div class="mb-6 w-4/5">
								<input type="text" name="name" id="name" class="border border-r-0 p-3 w-full focus:border-green-500" placeholder="Todo Name...">
								
								@error('name')
								<span class="block text-red-600 mt-2">{{$message}}</span>
								@enderror
							</div>
							
							<div class="w-1/5">
								<button class="p-3 border border-green-500 px-5 bg-green-500 text-white w-full">Add</button>
							</div>
						</div>
					</form>
					
					<table class="border-r border-b w-full">
						<tr>
							<th class="border-l border-t py-2 px-5 text-left">Name</th>
							<th class="border-l border-t py-2 px-5 text-center">Action</th>
						</tr>
						@empty($todos)
							<tr>
								<td class="border-l border-t py-2 px-5">No Todo</td>
							</tr>
						@else
							@foreach($todos as $todo)
								<tr>
									<td class="border-l border-t py-2 px-5">{{$todo->name}}</td>
									<td class="border-l border-t py-2 px-5 text-center"><a href="{{route('todo.edit', $todo->id)}}">Edit</a></td>
								</tr>
							@endforeach
					</table>
					@endempty
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
