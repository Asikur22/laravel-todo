<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$todos = Todo::where( 'user_id', Auth::id() )->orderBy( 'created_at', 'DESC' )->paginate( 10 );
		
		return view( 'todo.index', [ 'todos' => $todos ] );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$request->validate( [
			'name' => 'required'
		] );
		
		Todo::create( [
			'name'    => $request->name,
			'user_id' => Auth::id(),
		] );
		
		return redirect( route( 'todo.index' ) )->with( [ 'message' => '<strong>' . $request->name . '</strong>' . ' Todo Added.' ] );
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int Todo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( Todo $todo ) {
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int Todo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Todo $todo ) {
		return view( 'todo.edit', [ 'category' => $todo ] );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int                      Todo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Todo $todo ) {
		$request->validate( [
			'name' => 'required',
		] );
		
		$todo->name = $request->name;
		$todo->done = $request->done == null ? 0 : 1;
		$todo->save();
		
		return redirect( route( 'todo.index' ) )->with( [ 'message' => '<strong>' . $todo->name . '</strong>' . ' Todo Updated.' ] );
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int Todo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Todo $todo ) {
		$todo->delete();
		
		return back()->with( [
			'message' => '<strong>' . $todo->name . '</strong>' . ' Todo Deleted.'
		] );
	}
	
	public function done( $id ) {
		$todo       = Todo::findOrFail( $id );
		$todo->done = ! $todo->done;
		$todo->save();
		
		return back()->with( [
			'message' => '<strong>' . $todo->name . '</strong>' . ' Todo updated.'
		] );
	}
}
