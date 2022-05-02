<?php

namespace App\Actions;

use App\Models\Order;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

use Session, Stripe;

class SendToStripe
{
    use AsAction;

    public function handle(ActionRequest $request, Order $order)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $order->amount,
            "currency" => 'usd',
            "source" => $request->stripeToken,
            "description" => sprintf("Order #%i from Andak Media", $order->id),
        ]);
    }

    public function asController(ActionRequest $request, Order $order)
    {
        try {
            $this->handle($request, $order);
        } catch (\Throwable $th) {
            //throw $th;
        }

        Session::flash('success', 'Payment Sucessful');
        return back();
    }
}
