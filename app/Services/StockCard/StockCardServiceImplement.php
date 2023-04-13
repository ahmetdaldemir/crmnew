<?php

namespace App\Services\StockCard;

use App\Models\StockCardMovement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SN;
use LaravelEasyRepository\Service;
use App\Repositories\StockCard\StockCardRepository;

class StockCardServiceImplement extends Service implements StockCardService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected StockCardRepository $mainRepository;

    public function __construct(StockCardRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function all(): ?Collection
    {
        try {
            return $this->mainRepository->all();
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
            return [];
        }
    }

    public function get(): ?Collection
    {
        try {
            return $this->mainRepository->get();
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
            return [];
        }
    }


    public function find($id)
    {
        try {
            return $this->mainRepository->find($id);
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
            return [];
        }
    }

    public function delete($id)
    {
        try {
            return $this->mainRepository->delete($id);
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
            return [];
        }
    }

    public function update($id, $data)
    {
        try {
            return $this->mainRepository->update($id, $data);
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
            return [];
        }
    }

    public function create($data)
    {

        try {
            return $this->mainRepository->create($data);
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
            return [];
        }
    }

    public function add_movement($request, $invoiceID, $type)
    {
        $stockmovents = StockCardMovement::where('invoice_id', $invoiceID->id)->first();
        if ($stockmovents) {
            StockCardMovement::where('invoice_id', $invoiceID->id)->delete();
        }
        foreach ($request as $item) {
            for ($i = 0; $i < $item['quantity']; $i++) {
                $data = array(
                    'stock_card_id' => $item['stock_card_id'],
                    'user_id' => Auth::user()->id,
                    'invoice_id' => $invoiceID->id,
                    'color_id' => $item['color_id'],
                    'warehouse_id' => $item['warehouse_id'],
                    'seller_id' => $item['seller_id'],
                    'reason_id' => $item['reason_id'],
                    'type' => $type,
                    'quantity' => 1,
                    'imei' => $item['imei'],
                    'assigned' => isset($item['assigned']) and $item['assigned'] == 'on' ? 1 : 0,
                    'serial_number' => $item['serial'] ??  SN::generate(),
                    'tax' => $item['tax'],
                    'cost_price' => $item['cost_price'],
                    'base_cost_price' => $item['base_cost_price'],
                    'sale_price' => $item['sale_price'],
                    'description' => $item['description'],
                    'discount' => $item['discount'],
                );
                if (empty($request->id) || isset($request->id)) {
                    StockCardMovement::create($data);
                } else {
                    StockCardMovement::update($request->id, $data);
                }
            }

        }
        return response()->json("Kayıt Başarılı", 200);
    }

    public function filter($arg)
    {
        return $this->mainRepository->filter($arg);
    }

    public function getInvoiceForSerial($arg)
    {
        return $this->mainRepository->getInvoiceForSerial($arg);
    }


}
