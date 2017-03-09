<?php

namespace App\Console\Commands;

use App\Mail\InStock;
use Mail;
use App\Product;
use Carbon\Carbon;
use App\Support\DOMParser;
use App\Support\PhantomJSClient;
use Illuminate\Console\Command;

class CheckStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stockcheck:checkstock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks all stock';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $products = Product::whereNull('sent_at')->get();

        $products->each(function ($product) {
            $dom   = PhantomJSClient::getDOMString($product->url);
            $stock = DOMParser::asos($dom);

            $product->image = $stock['image'];

            if ($stock['inStock']->contains($product->size)) {
                $product->sent_at = Carbon::now()->toDateTimeString();
                Mail::to($product->user->email)->queue(new InStock($product));
            }

            $product->save();
        });
    }
}
