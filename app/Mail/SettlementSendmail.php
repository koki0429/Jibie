<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SettlementSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $sum;
    private $name;
    private $karts;
    private $products;
    private $date;
    private $time;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datas)
    {
        $this->email = $datas['email'];
        $this->sum = $datas['sum'];
        $this->name = $datas['name'];
        $this->karts = $datas['karts'];
        $this->products = $datas['products'];
        $this->date = $datas['date'];
        $this->time = $datas['time'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('japanesebrothers@gmail.com')
            ->subject('「商品購入のお礼」と「注文内容の確認」')
            ->view('contact.mailSettlement')
            ->with([
                'email' => $this->email,
                'sum' => $this->sum,
                'name' => $this->name,
                'karts' => $this->karts,
                'products' => $this->products,
                'date' => $this->date,
                'time' => $this->time
            ]);
    }
}
