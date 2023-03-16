<?php

namespace App\Console\Commands;

use App\Abstract\Elogo;
use App\Models\EInvoice;
use elogo_api\elogo_api;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Elogoinvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * php artisan invoice:elogo EINVOICEDETAIL OUT 1
     */
    protected $signature = 'invoice:elogo {type} {sort} {company}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    public $connector;


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->argument('type');
        $sort = $this->argument('sort');
        $company = $this->argument('company');

        $this->connector = new Elogo();
        $result = $this->connector->elogo->get_documents_list(null, null, $sort, $type);
        if (count((array)$result['message']) > 0) {
            //$result = $this->connector->elogo->get_documents_data("0fab21b4-82e1-4ea8-8d20-361300773dc6",'EINVOICE','XML');
            //$unzip = $this->connector->elogo->unzip("0fab21b4-82e1-4ea8-8d20-361300773dc6",$result['message']->binaryData->Value);
            $document = $result['message']->Document;
            foreach ($document as $item) {
                $x = json_decode($item->docInfo->string, true);
                $user = EInvoice::firstOrCreate(
                    ['company_id' => $company, 'Uuid' => $x['Uuid']],
                    [
                        'user_id' => 1,
                        'InvoiceType' => $x['InvoiceType'],
                        'IssueDate' => $x['IssueDate'],
                        'ElementId' => $x['ElementId'],
                        'InvoiceTotal' => $x['InvoiceTotal'],
                        'SupplierVknTckn' => $x['SupplierVknTckn'],
                        'SupplierPartyName' => $x['SupplierPartyName'],
                        'CustomerPartyName' => $x['CustomerPartyName'],
                        'CustomerVknTckn' => $x['CustomerVknTckn'],
                        'Description' => $x['Description'],
                        'ProfileID' => $x['ProfileID'],
                        'CurrencyUnit' => $x['CurrencyUnit'],
                        'TaxAmount' => $x['TaxAmount'],
                        'PayableAmount' => $x['PayableAmount'],
                        'AllowanceTotalAmount' => $x['AllowanceTotalAmount'],
                        'TaxInclusiveAmount' => $x['TaxInclusiveAmount'],
                        'TaxExclusiveAmount' => $x['TaxExclusiveAmount'],
                        'LineExtensionAmount' => $x['LineExtensionAmount'],
                        'PKAlias' => $x['PKAlias'],
                        'GBAlias' => $x['GBAlias'],
                        'EnvelopeId' => $x['EnvelopeId'],
                        'CurrentDate' => $x['CurrentDate'],
                    ]
                );

            }
        } else {
            Log::info("Fatura Bulunamadı");
        }

    }
}
