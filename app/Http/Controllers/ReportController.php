<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformationRequest;
use App\Models\Objection;
use App\Models\Guestbook;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type', 'permohonan');
        if (!in_array($type, ['permohonan', 'keberatan', 'bukutamu'])) {
            $type = 'permohonan';
        }

        $titleMap = [
            'permohonan' => 'Laporan Permohonan Informasi Publik',
            'keberatan' => 'Laporan Pengajuan Keberatan',
            'bukutamu' => 'Laporan Buku Tamu / Pengunjung'
        ];

        $data = collect();
        if ($request->has('start_date') && $request->has('end_date')) {
            $start = $request->input('start_date') . ' 00:00:00';
            $end = $request->input('end_date') . ' 23:59:59';

            if ($type === 'permohonan') {
                $data = InformationRequest::with('user')->whereBetween('created_at', [$start, $end])->latest()->get();
            } elseif ($type === 'keberatan') {
                $data = Objection::with('user', 'request')->whereBetween('created_at', [$start, $end])->latest()->get();
            } elseif ($type === 'bukutamu') {
                $data = Guestbook::whereBetween('created_at', [$start, $end])->latest()->get();
            }
        }

        return view('admin.laporan.index', compact('type', 'titleMap', 'data', 'request'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'type' => 'required|in:permohonan,keberatan,bukutamu',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format' => 'required|in:pdf,excel'
        ]);

        $type = $request->input('type');
        $start = $request->input('start_date') . ' 00:00:00';
        $end = $request->input('end_date') . ' 23:59:59';
        $format = $request->input('format');

        $data = collect();
        $title = '';
        $fileName = '';

        if ($type === 'permohonan') {
            $data = InformationRequest::with('user')->whereBetween('created_at', [$start, $end])->latest()->get();
            $title = 'Laporan Permohonan Informasi Publik';
            $fileName = 'laporan-permohonan';
        } elseif ($type === 'keberatan') {
            $data = Objection::with('user', 'request')->whereBetween('created_at', [$start, $end])->latest()->get();
            $title = 'Laporan Pengajuan Keberatan';
            $fileName = 'laporan-keberatan';
        } elseif ($type === 'bukutamu') {
            $data = Guestbook::whereBetween('created_at', [$start, $end])->latest()->get();
            $title = 'Laporan Pengunjung / Buku Tamu';
            $fileName = 'laporan-bukutamu';
        }

        if ($format === 'excel') {
            return $this->exportExcelHTML($data, $type, $title, $fileName);
        }

        return view('admin.laporan.print', compact('data', 'title', 'type', 'request'));
    }

    private function exportExcelHTML($data, $type, $title, $fileName)
    {
        $fileName = $fileName . '-' . date('Ymd_His') . '.xls';

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
        $html .= '<head><meta charset="UTF-8"><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>Laporan</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head>';
        $html .= '<body>';
        $html .= '<h3>' . $title . '</h3>';
        $html .= '<table border="1">';

        $html .= '<thead><tr style="background-color: #f3f4f6; font-weight: bold;">';
        if ($type === 'permohonan') {
            $html .= '<th>No</th><th>ID Register</th><th>Tanggal</th><th>Nama Pemohon</th><th>Kategori</th><th>Tujuan</th><th>Status</th>';
        } elseif ($type === 'keberatan') {
            $html .= '<th>No</th><th>ID Keberatan</th><th>Tanggal</th><th>Nama Pemohon</th><th>ID Permohonan</th><th>Alasan</th><th>Status</th>';
        } elseif ($type === 'bukutamu') {
            $html .= '<th>No</th><th>Tanggal</th><th>Nama</th><th>Instansi</th><th>Telepon</th><th>Tujuan Kunjungan</th>';
        }
        $html .= '</tr></thead>';

        $html .= '<tbody>';
        foreach ($data as $index => $row) {
            $html .= '<tr>';
            if ($type === 'permohonan') {
                $html .= '<td>' . ($index + 1) . '</td>';
                $html .= '<td>' . $row->tracking_code . '</td>';
                $html .= '<td>' . $row->created_at->format('d-m-Y H:i') . '</td>';
                $html .= '<td>' . ($row->user->name ?? 'Anonim') . '</td>';
                $html .= '<td>' . $row->category . '</td>';
                $html .= '<td>' . htmlspecialchars($row->purpose) . '</td>';
                $html .= '<td>' . strtoupper($row->status) . '</td>';
            } elseif ($type === 'keberatan') {
                $html .= '<td>' . ($index + 1) . '</td>';
                $html .= '<td>' . $row->tracking_code . '</td>';
                $html .= '<td>' . $row->created_at->format('d-m-Y H:i') . '</td>';
                $html .= '<td>' . ($row->user->name ?? '-') . '</td>';
                $html .= '<td>' . ($row->request->tracking_code ?? '-') . '</td>';
                $html .= '<td>' . htmlspecialchars($row->reason) . '</td>';
                $html .= '<td>' . strtoupper($row->status) . '</td>';
            } elseif ($type === 'bukutamu') {
                $html .= '<td>' . ($index + 1) . '</td>';
                $html .= '<td>' . $row->created_at->format('d-m-Y H:i') . '</td>';
                $html .= '<td>' . htmlspecialchars($row->name) . '</td>';
                $html .= '<td>' . htmlspecialchars($row->institution ?? '-') . '</td>';
                $html .= '<td>' . htmlspecialchars($row->phone ?? '-') . '</td>';
                $html .= '<td>' . htmlspecialchars($row->purpose) . '</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</tbody></table></body></html>';

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}
