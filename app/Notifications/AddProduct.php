<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class AddProduct extends Notification
{
    use Queueable;
    private $product;

    /**
     * Create a new notification instance.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->product->id,
            'title' => __('site.add_product'),
            'user' => Auth::user()->first_name,
            'url' => route('products.index'),
        ];
    }
}
