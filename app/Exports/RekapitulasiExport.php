// app/Exports/RekapitulasiExport.php
namespace App\Exports;

use App\Models\Rekapitulasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapitulasiExport implements FromCollection, WithHeadings
{
    protected $bulan, $tahun, $hari;

    public function __construct($bulan, $tahun, $hari)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->hari = $hari;
    }

    public function collection()
    {
        return Rekapitulasi::whereMonth('borrowed_date', $this->bulan)
            ->whereYear('borrowed_date', $this->tahun)
            ->when($this->hari, function ($query) {
                return $query->whereDay('borrowed_date', $this->hari);
            })
            ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Event Name', 'Borrower Name', 'Item Name', 'Quantity', 'Borrowed Date', 'Returned Date'];
    }
}
