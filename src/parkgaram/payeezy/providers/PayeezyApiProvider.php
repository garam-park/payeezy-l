<?php namespace Parkgaram\Payeezy\Providers;

use Illuminate\Support\ServiceProvider;
use Parkgaram\Payeezy\Apis\CreditCardPayments as CardPayments;

class PayeezyApiProvider extends ServiceProvider
{

    public function boot()
    {
        #code ...
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app['payeezy.credit.payment'] = 
        $this->app->share(function ($app)
        {   
            $apiKey        = new config('payeezy.apikey' , '');
            $apiSecret     = new config('payeezy.apisecret', '');
            $merchantToken = new config('payeezy.merchantToken', '');

            return new CardPayments(
                          $this->apiKey,
                          $this->apiSecret,
                          $this->merchantToken);
        });
    }
}