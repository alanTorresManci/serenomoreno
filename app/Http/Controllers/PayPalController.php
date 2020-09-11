<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;


// use to process billing agreements
use PayPal\Api\Agreement;
use PayPal\Api\AgreementStateDescriptor;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\ShippingAddress;

class PayPalController extends Controller
{
    //
    private $apiContext;
    private $mode;
    private $client_id;
    private $secret;
    private $plan_id;

    // Create a new instance with our paypal credentials
    public function __construct()
    {
        // Detect if we are running in live mode or sandbox
        if(config('paypal.settings.mode') == 'live'){
            $this->client_id = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        } else {
            $this->client_id = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }

        // Set the Paypal API Context/Credentials
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function pay(Request $request){
        $rules = [
            'total' => 'required'
        ];
        $request->validate($request);
        $user = \Auth::user();
        $client = $user->client;
        // Create a new billing plan
        $plan = new Plan();
        $plan->setName('Suscripción a Sereno Moreno café')
          ->setDescription('Suscripción mensual a Sereno Moreno café')
          ->setType('infinite');

        // Set billing plan definitions
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Pagos mensuales')
          ->setType('REGULAR')
          ->setFrequency('Month')
          ->setFrequencyInterval('1')
          ->setCycles('0')
          ->setAmount(new Currency(array('value' => $request->total, 'currency' => 'MXN')));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl(route('payments.success'))
            ->setCancelUrl(route('payments.show'))
            ->setAutoBillAmount('yes')
            ->setInitialFailAmountAction('CONTINUE')
            ->setMaxFailAttempts('0');

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        //create the plan
        try {
            $createdPlan = $plan->create($this->apiContext);
            try {
                $patch = new Patch();
                $value = new PayPalModel('{"state":"ACTIVE"}');
                $patch->setOp('replace')
                  ->setPath('/')
                  ->setValue($value);
                $patchRequest = new PatchRequest();
                $patchRequest->addPatch($patch);
                $createdPlan->update($patchRequest, $this->apiContext);
                $plan = Plan::get($createdPlan->getId(), $this->apiContext);

                // Create new agreement
                $agreement = new Agreement();
                $agreement->setName('Suscripción a Sereno Moreno café')
                    ->setDescription('Suscripción mensual a Sereno Moreno café')
                    ->setStartDate(\Carbon\Carbon::now()->addMinutes(5)->toIso8601String());
                $plan = new Plan();
                $plan->setId($createdPlan->getId());
                $agreement->setPlan($plan);

                // Add payer type
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');
                $agreement->setPayer($payer);

                try {
                    // Create agreement
                    $agreement = $agreement->create($this->apiContext);
                    // Extract approval URL to redirect user
                    $approvalUrl = $agreement->getApprovalLink();

                    return redirect($approvalUrl);
                } catch (PayPal\Exception\PayPalConnectionException $ex) {
                        echo $ex->getCode();
                        echo $ex->getData();
                        die($ex);
                } catch (Exception $ex) {
                    die($ex);
                }
            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode();
                echo $ex->getData();
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }

    }

    public function paypalReturn(Request $request)
    {

        $token = $request->token;
        $agreement = new \PayPal\Api\Agreement();

        try {
            // Execute agreement
            $result = $agreement->execute($token, $this->apiContext);
            $user = \Auth::user();
            $user->client->paypal = 1;
            if(isset($result->id)){
                $user->client->paypal_agreement_id = $result->id;
            }
            $user->client->save();
            return redirect()->route('clients.profile');

        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo 'You have either cancelled the request or your session has expired';
        }
    }

    public function cancel(Request $request)
    {
        //Create an Agreement State Descriptor, explaining the reason to suspend.
        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Suspending the agreement");

        $agreement = new \PayPal\Api\Agreement();
        $createdAgreement = $agreement->get($request->token, $this->apiContext);

        try {
            $createdAgreement->suspend($agreementStateDescriptor, $this->apiContext);


            $agreement = Agreement::get($createdAgreement->getId(), $this->apiContext);
        } catch (Exception $ex) {
            return redirect()->route('home');
        }

        return redirect()->route('home');
    }
}
