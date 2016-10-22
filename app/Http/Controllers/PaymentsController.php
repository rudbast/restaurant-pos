<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Payment;

class PaymentsController extends Controller
{
    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = [
        'name'         => 'required|max:15',
        'customer_fee' => 'required|numeric|min:0',
        'provider_fee' => 'required|numeric|min:0',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('can:admin');
    }

    /**
     * Show the manage menus' page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.payments', [
            'payments' => Payment::get(),
        ]);
    }

    /**
     * Show details of certain Menu.
     *
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return response()->json($payment);
    }

    /**
     * Store submitted menu details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $payment = Payment::create($request->all());

        return response()->json(['success' => ! empty($payment)]);
    }

    /**
     * Update menu information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $this->validate($request, $this->rules);

        try {
            $payment->update($request->all());

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            abort(409, $e->getMessage());
        }
    }

    /**
     * Delete user.
     *
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        return response()->json(['success' => $payment->delete()]);
    }
}
