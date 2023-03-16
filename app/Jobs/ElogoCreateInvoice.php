<?php

namespace App\Jobs;

use App\Abstract\Elogo;
use elogo_api\elogo_api;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ElogoCreateInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Elogo $connector;
    protected $type;
    protected $array;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type, $array)
    {
        $this->connector = new Elogo();
        $this->type = $type;
        $this->array = $array;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dd($this);
        if ($this->type == 'create') {
            $this->create($this->array);
        }
    }

    public function create()
    {
        //FATURA KESEN FİRMA BİLGİLERİ
        $this->connector->my_company = [
            'websitesi' => 'www.hayatikodla.net',
            'ticari_sicil_no' => '999999',
            'vergi_no' => '9999999999',
            'vergi_dairesi' => 'Vergi Dairesi Adı',
            'mersis_no' => 'xxxx xxxx xxxx xxxx',
            'unvan' => 'Hasan Yüksektepe A.Ş',
            'tel' => '90 541 423 35 58',
            'mail' => 'hasanhasokeyk@hotmail.com',
            'adres' => [
                'acik_adres' => 'Tam adresi girin',
                'bina_adi' => '',
                'bina_no' => '',
                'mahalle_ilce' => 'Mahalle/İlçe',
                'il' => 'İstanbul',
                'posta_kodu' => '34600',
                'ulke' => 'Türkiye',
                'ulke_kodu' => 'TR',
            ],
        ];
        //FATURA KESEN FİRMA BİLGİLERİ

        //FATURA KESİLEN FİRMA BİLGİLERİ
        $this->connector->customer_company = [
            'yetkili_adi' => 'Hasan',
            'yetkili_soyadi' => 'Yüksektepe',
            'unvan' => 'Hasan Yüksektepe',
            'websitesi' => '',
            'firma_turu' => 'sahis', //firma , sahis
            'vergi_no_tckn' => 'xxxxxxxxxxx',
            'vergi_dairesi' => '',
            'tel' => '',
            'fax' => '',
            'email' => 'hasanhasokeyk@hotmail.com',
            'adres' => [
                'acik_adres' => 'Tam adresi girin',
                'bina_adi' => '',
                'bina_no' => '',
                'mahalle_ilce' => 'Mahalle/İlçe',
                'il' => 'İstanbul',
                'posta_kodu' => '34600',
                'ulke' => 'Türkiye',
                'ulke_kodu' => 'TR',
            ],
        ];
        //FATURA KESİLEN FİRMA BİLGİLERİ

        //FATURA BİLGİLERİ
        $this->connector->invoice = [
            'urun_hizmet' => [
                [
                    'hizmet_adi' => 'Hizmet adı',
                    'hizmet_aciklama' => 'Hizmet Açıklama',
                    'adet' => 1,
                    'tutar' => 1000.00,
                    'kdv_tutar' => 180.00,
                    'kdv_oran' => 18.00,
                ],
                [
                    'hizmet_adi' => 'Hizmet adı',
                    'hizmet_aciklama' => 'Hizmet Açıklama',
                    'adet' => 1,
                    'tutar' => 1000.00,
                    'kdv_tutar' => 180.00,
                    'kdv_oran' => 18.00,
                ],
            ],
            'genel_toplam' => 2360.00,
            'toplam_tutar' => 2000.00,
            'kdv_tutar' => 360.00,
            'kdv_oran' => 18.00,
            //'kdv_muhafiyet_kodu' => 223,
        ];
        //FATURA BİLGİLERİ

        $result = $this->connector->elogo->send_einvoice();
        print_r($result);
    }
}
