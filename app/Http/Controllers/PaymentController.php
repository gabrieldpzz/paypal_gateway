<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Payment;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use Session;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'), 
                env('PAYPAL_SECRET')
            )
        );
        $this->apiContext->setConfig(['mode' => env('PAYPAL_MODE')]);
    }

    public function processPayment(Request $request)
    {
        $total = $request->input('total');
        $productos = $request->input('productos');

        // Crear el objeto de pago de PayPal
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $items = [];
        foreach ($productos as $producto) {
            $item = new Item();
            $item->setName($producto['name'])
                ->setCurrency('USD')
                ->setQuantity($producto['quantity'])
                ->setPrice($producto['price']);
            $items[] = $item;
        }

        $itemList = new ItemList();
        $itemList->setItems($items);

        // Configurar los detalles y el monto total
        $details = new Details();
        $details->setSubtotal($total);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Pago del carrito de compras");

        // URLs de redirección
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.success'))
            ->setCancelUrl(route('payment.cancel'));

        // Crear el pago
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->apiContext);
            return redirect($payment->getApprovalLink());
        } catch (\Exception $ex) {
            return redirect()->route('cart.show')->withErrors(['error' => 'Error en el pago: ' . $ex->getMessage()]);
        }
    }

    public function paymentSuccess(Request $request)
    {
        // Lógica para el éxito del pago
        return view('payment.success');
    }

    public function paymentCancel()
    {
        // Lógica para la cancelación del pago
        return view('payment.cancel');
    }
}
