<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $activation_code;

    /**
     * RegisterUser constructor.
     * @param $name
     * @param $activation_code
     */
    public function __construct($name, $activation_code)
    {
        $this->name = $name;
        $this->activation_code = $activation_code;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link = $_ENV['APP_URL'] . '/activation/' . $this->activation_code;

        return $this
            ->subject('Активация аккаунта')
            ->view('register_user', [
            'username' => $this->name,
            'link' => $link
            ]);
    }
}
