<?php

namespace App\Services\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Pessoa;

class Email extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $pessoa; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

     /**
     * Build the message.
     * from: endereço de e-mail e nome do remetente;
     * subject: assunto do e-mail (caso não seja especificado por default pega o nome da própria classe).
     * replyTo: configurar e-mail de resposta diferente;
     * text: texto puro para caso o usuário não consiga renderizar o html ou para acessibilidade;
     * with: para enviar variaveis para o blade;
     * attach: caminho do anexo;
     * view: view responsável pelo texto;
     * Onservação: TEM COMO COLOCAR ALIAS NO ARQUIVO
     * ->attach('edicoes/' . $this->edicao->ano . '/' . $this->edicao->numero . '.pdf', [
     * 'as' => 'ultima-edicao.pdf',
     * 'mime' => 'application/pdf',
     * ]);
     * @return $this
     */
    public function build()
    {
        return $this->from('xicotadaexau@gmail.com', 'Xicotada')
                    ->subject('Teste de Email')
                    ->replyTo('marlon.aelson.gomes@gmail.com', 'Marlon')
                    ->text('email-texto')
                    ->with([
                        'pessoa' => $this->pessoa
                    ])
                    //->attach('edicoes/' . $this->user->name .'.pdf')
                    ->view('email');
                    
    }
}
