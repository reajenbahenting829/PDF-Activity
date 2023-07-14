<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Clients/Index',[
            'clients' => Client::orderBy('last_name')->orderBy('first_name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->load('transactions');
        return inertia('Clients/Show',[
            'client'=>$client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }

    public function email(Client $client){
        //create a pdf of the statement of account
        $pdf = Pdf::loadView('pdf.client-summary',[
            'client' =>$client
        ]);

        $filename = 'statements/' . $client->last_name . " " . $client->id . ".pdf";
        $pdf->save($filename);

        Mail::send('email.soa' ,['client'=>$client], function($message) use ($client, $filename){
            $message->to($client->email);
            $message->subject('Statement of Account');
            $message->attach($filename);
        });

        return back();
    }
}
