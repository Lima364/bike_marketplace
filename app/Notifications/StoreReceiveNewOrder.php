<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class StoreReceiveNewOrder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];

        // return ['database', 'mail', 'nexmo'];
        // nexmo = sms
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Novo pedido pra voce')
                    ->greeting('Olá, tudo bem?')
                    ->line('Voce recebeu um novo pedido na Loja!')
                    ->action('Ver Pedido', route('admin.orders.my'))
                    // ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Voce tem um novo pedido solicitado'
        ];
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                    ->content('Voce recebeu um novo pedido em nosso site.')
                    ->from('5511999415551')
                    -unicode()
                    ;
                    
    }

    // public function toDataBase()
    // {
    //     return 
    //     [
    //         //
    //     ];
    // }
}
