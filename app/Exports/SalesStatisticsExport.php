<?php

namespace App\Exports;

use App\Models\SalesStatistics;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesStatisticsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $statistics;
    protected $orderDetails;
    protected $period;

    public function __construct($statistics, $orderDetails, $period)
    {
        $this->statistics = $statistics;
        $this->orderDetails = $orderDetails;
        $this->period = $period;
    }

    public function collection()  
    {  
        // Prepare data for Excel  
        $data = [];  

        // Add statistics summary  
        $data[] = ['Total Products', $this->statistics->total_products ?? 0];  
        $data[] = ['Total Revenue', number_format($this->statistics->total_revenue ?? 0) . ' VND'];  
        $data[] = ['Period', ucfirst($this->period)];  
        $data[] = []; // Empty row for separation  

        // Add headings for order details  
        $data[] = ['ID Thú Cưng', 'Số lượng', 'Giá', 'Trạng thái', 'Ngày đặt hàng'];  

        // Add order details  
        foreach ($this->orderDetails as $order) {  
            $data[] = [  
                $this->getSafeValue($order, 'pet_id'),  
                $this->getSafeValue($order, 'quantity'),  
                number_format($this->getSafeValue($order, 'price')) . ' đ',  
                $this->getSafeValue($order, 'status'),  
                $this->getSafeValue($order, 'order_date', 'N/A') // Đảm bảo rằng order_date có trong order  
            ];  
        }

        return collect($data);  
    }  
    private function getSafeValue($object, $property, $default = 'N/A')  
    {  
        return $object->$property ?? $default; // Trả về giá trị nếu tồn tại, nếu không thì trả về giá trị mặc định  
    }  
    public function headings(): array  
    {  
        return ['Statistic Name', 'Statistic Value'];  
    }  
}

