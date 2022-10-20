<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmed;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Omnipay\Omnipay;

class BookingController extends Controller
{
    //

    public function form(Request $request)
    {
        $schedule = ScheduleService::findOrFail($request->id);

        $service = Schedule::findOrFail($schedule->schedule_id);

        if (Auth::check()) {
            return view('booking', compact('schedule', 'service'));
        } else {
            return view('auth.login');
        }

    }

    public function save(Request $request)
    {

        //get available seats
        $services = ScheduleService::where('id', $request->id)->first();

        //get destination

        $schedules = Schedule::where('id', $services->schedule_id)->first();

        //update available seats
        if ($services->seat_available != 0) {

            //save booking
            $booking = Booking::create([
                'schedule_service_id' => $request->id,
                'user_id' => Auth::user()->id,
                'payment_amount' => $request->price,
            ]);

            return $this->beginPayment($booking);

        } else {
            return redirect(route('home'))->withErrors(['The bus is fully booked']);
        }

    }

    public function getGateway()
    {
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->initialize([
            'username' => env('PAYPAL_USERNAME'),
            'password' => env('PAYPAL_PASSWORD'),
            'signature' => env('PAYPAL_SIGNATURE'),
            'testMode' => env('PAYPAL_TESTMODE'),
        ]);

        return $gateway;
    }

    public function getPayload($booking)
    {
        return [
            'amount' => sprintf('%.2f', $booking->payment_amount),
            'currency' => 'MYR',
        ];
    }

    public function beginPayment(Booking $booking)
    {
        $gateway = $this->getGateway();

        $response = $gateway->purchase(
            [
                ...$this->getPayload($booking),
                'returnUrl' => route('book.return', ['booking' => $booking]),
                'cancelUrl' => route('book.cancel', ['booking' => $booking]),
            ]
        )->send();

        // Process response
        if ($response->isSuccessful()) {

            // Payment was successful
            return $this->_success($booking);

        } elseif ($response->isRedirect()) {

            // Redirect to offsite payment gateway
            $response->redirect();

        } else {

            dd($response);
            return $this->_failed($booking, $response->getMessage());
        }

    }

    public function paymentCancel(Booking $booking)
    {
        return $this->_failed($booking, 'User Cancelled');
    }

    public function paymentReturn(Request $request, Booking $booking)
    {
        $gateway = $this->getGateway();
        $response = $gateway->completePurchase(
            [
                ...$request->input(),
                ...$this->getPayload($booking),
            ]
        )->send();

        $booking->payment_gateway_status = json_encode($response->getData());
        $booking->save();

        if ($response->isSuccessful()) {
            return $this->_success($booking);
        } else {

            return $this->_failed($booking, $response->getMessage());
        }
    }

    public function _success(Booking $booking)
    {
        //update status
        Mail::to(Auth::user()->email)
            ->send(new BookingConfirmed($booking));
        return redirect(route('book.success', ['booking' => $booking]));

    }

    public function success(Booking $booking)
    {
        return view('book.success', compact('booking'));
    }

    public function _failed(Booking $booking, $reason)
    {
        $booking->update(['status' => 'Cancelled']);
        return redirect(route('book.failed', ['booking' => $booking, 'reason' => $reason]));

    }

    public function failed(Request $request, Booking $booking)
    {
        return view('book.failed', compact('booking'));
    }

}
