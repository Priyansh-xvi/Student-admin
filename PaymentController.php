<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\Payment;
use App\Models\Enrollment;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::all();
        return view('payments.index')->with('payments', $payments);
    }

    public function create()
    {
       $enrollments = Enrollment::pluck('enroll_no','id');
       return view('payments.create', compact('enrollments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Payment::create($input);
        return redirect('payments')->with('flash_message', 'Payment Addedd!');
    }


    public function show(string $id): View
    {
        $payments = Payment::find($id);
        return view('payments.show')->with('payments', $payments);
    }
    
    public function edit(string $id): View
    {
        $payments = Payment::find($id);
        return view('payments.edit')->with('payments', $payments);
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        $payments = Payment::find($id);
        $input = $request->all();
        $payments->update($input);
        return redirect('payments')->with('flash_message', 'Payment Updated!');  
    }

    public function destroy(string $id): RedirectResponse
    {
        Payment::destroy($id);
        return redirect('payments')->with('flash_message', 'Payment deleted!'); 
    }
}
