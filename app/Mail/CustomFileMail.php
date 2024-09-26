<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;


class CustomFileMail extends Mailable
{
    protected $base64File;
    protected $fileUrl;
    public $subject;
    public $invoice;
    public $user;
    public $purchase_order;

    public function __construct(string $base64File,string $fileUrl,object $user , array $invoice)
    {
        $this->base64File = $base64File;
        $this->fileUrl = $fileUrl;
        $this->user =$user;
        $this->invoice =$invoice;
        $this->purchase_order =isset($invoice['mkpOrder'])
                            ?(string)$invoice['mkpOrder']['purchase_order']
                            :(string)$invoice['cpOrder']['purchase_order'];
    }
    private function getXmlInvoice(){
        $fileContents = file_get_contents($this->fileUrl);
        
        
        $tempPath = tempnam(sys_get_temp_dir(), 'mailattachment');
        file_put_contents($tempPath, $fileContents);
 
        $fileName ='factura-'.$this->invoice['folio'].'.xml' ;

        $data["tempPath"] =$tempPath; 
        $data["options"] =['as'=>$fileName,'mime' => mime_content_type($tempPath),]; 
        return $data;
    }

    public function build()
    {   
        $temporalFile = $this->getXmlInvoice();
        
        return $this->from(config('mail.mailers.smtp.username'), 'no-replay@daytech.com.mx')
                ->to('esponja_ray@hotmail.com', 'user')
                ->subject('DAYTECH - Envío de su Factura - Pedido ['.$this->purchase_order.']')     
                ->view('mail.invoice')
                ->with(['user'=>$this->user,'invoice'=>$this->invoice])
                ->attachData(base64_decode($this->base64File), 'factura-'.$this->invoice['folio'].'.pdf', [
                        'mime' => 'application/pdf',
                    ])
                ->attach($temporalFile['tempPath'], $temporalFile['options']);
    }
}
