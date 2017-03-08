<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InStock extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The product instance.
     *
     * @var Product
     */
    public $product;

    /**
     * Create a new message instance.
     *
     * @param \App\Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('donotreply@stockcheck.mubeen-inamdar.com')
                    ->view('emails.in-stock');
    }
}
