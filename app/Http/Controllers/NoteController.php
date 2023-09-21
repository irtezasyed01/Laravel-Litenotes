<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
//@return \Illuminate\Http\Response;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userid = Auth::id();
        //$notes =  Note::where('user_id', $userid)->get();
        //$notes =  Note::where('user_id', $userid)->latest('updated_at')->get(); // To get latest 
       /* $notes->each(function($note){
            dump($note->title);
        });
        */
       // $notes =  Note::where('user_id', $userid)->latest('updated_at')->paginate(5); // Pagination 

     //  $notes =  Auth::user()->notes()->latest('updated_at')->paginate(5);
       $notes =  Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
        return view('notes.index')->with('notes',$notes);

        //dd($notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $request->validate([
            'title' => 'required|max:120',
            'text'  =>  'required'
        ]);

        $note = new Note([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'text'  =>  $request->text
        ]);

        $note->save();

        return to_route('notes.index');

        //dd($request);
    }

    /**
     * Display the specified resource.
     */
    /*public function show(string $id)
    {
        $note = Note::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('notes.show')->with('note', $note);
    }
    */
    // --- Function change with Route Model Binding ..............
    public function show(Note $note)
    {
        if($note->user_id != Auth::id()){
            return abort(403);
        }
        return view('notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if($note->user_id != Auth::id()){
            return abort(403);
        }
        return view('notes.edit')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if($note->user_id != Auth::id()){
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text'  =>  'required'
        ]);

       $note->update([
            'title' => $request->title,
            'text'  =>  $request->text
        ]); 

        return to_route('notes.show', $note)->with('success','Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if($note->user_id != Auth::id()){
            return abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('success','Note Deleted successfully.');
    }
}
