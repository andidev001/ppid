<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            line-height: 1.5;
            margin: 0;
            padding: 2rem;
            background: #fff;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #334155;
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.25rem;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0 0 0.5rem 0;
        }

        .header p {
            margin: 0;
            color: #475569;
            font-size: 0.875rem;
        }

        .filters {
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            color: #64748b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8125rem;
            margin-bottom: 2rem;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 0.5rem 0.75rem;
            text-align: left;
        }

        th {
            background-color: #f8fafc;
            font-weight: 600;
            color: #334155;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .status-badge {
            display: inline-block;
            padding: 0.125rem 0.375rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.025em;
            text-transform: uppercase;
        }

        .text-center {
            text-align: center;
        }

        /* Print Styles */
        @media print {
            @page {
                margin: 1.5cm;
                size: landscape;
            }

            body {
                padding: 0;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="no-print"
        style="margin-bottom: 20px; text-align: right; background: #f1f5f9; padding: 16px; border-bottom: 1px solid #cbd5e1; position: sticky; top: 0; display: flex; justify-content: flex-end; align-items: center; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);">
        <button onclick="window.print()"
            style="padding: 10px 24px; background: #e11d48; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                </path>
            </svg>
            Cetak / Save PDF
        </button>
    </div>

    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Pejabat Pengelola Informasi dan Dokumentasi (PPID)</p>
    </div>

    <div class="filters">
        <strong>Periode:</strong> {{ \Carbon\Carbon::parse($request->start_date)->translatedFormat('d F Y') }} -
        {{ \Carbon\Carbon::parse($request->end_date)->translatedFormat('d F Y') }} <br>
        <strong>Total Data:</strong> {{ $data->count() }}
    </div>

    <table>
        <thead>
            @if($type === 'permohonan')
                <tr>
                    <th class="text-center" style="width: 5%">No</th>
                    <th style="width: 15%">ID Register</th>
                    <th style="width: 15%">Tanggal</th>
                    <th style="width: 20%">Nama Pemohon</th>
                    <th style="width: 15%">Kategori</th>
                    <th style="width: 20%">Tujuan</th>
                    <th class="text-center" style="width: 10%">Status</th>
                </tr>
            @elseif($type === 'keberatan')
                <tr>
                    <th class="text-center" style="width: 5%">No</th>
                    <th style="width: 15%">ID Keberatan</th>
                    <th style="width: 15%">Tanggal</th>
                    <th style="width: 20%">Nama Pemohon</th>
                    <th style="width: 15%">ID Permohonan</th>
                    <th style="width: 20%">Alasan</th>
                    <th class="text-center" style="width: 10%">Status</th>
                </tr>
            @elseif($type === 'bukutamu')
                <tr>
                    <th class="text-center" style="width: 5%">No</th>
                    <th style="width: 15%">Tanggal</th>
                    <th style="width: 15%">Nama</th>
                    <th style="width: 20%">Instansi</th>
                    <th style="width: 15%">Telepon</th>
                    <th style="width: 30%">Tujuan Kunjungan</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @forelse($data as $index => $row)
                @if($type === 'permohonan')
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $row->tracking_code }}</td>
                        <td>{{ $row->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $row->user->name ?? 'Anonim' }}</td>
                        <td>{{ $row->category }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($row->purpose, 50) }}</td>
                        <td class="text-center">{{ strtoupper($row->status) }}</td>
                    </tr>
                @elseif($type === 'keberatan')
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $row->tracking_code }}</td>
                        <td>{{ $row->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $row->user->name ?? '-' }}</td>
                        <td>{{ $row->request->tracking_code ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($row->reason, 50) }}</td>
                        <td class="text-center">{{ strtoupper($row->status) }}</td>
                    </tr>
                @elseif($type === 'bukutamu')
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $row->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->institution ?? '-' }}</td>
                        <td>{{ $row->phone ?? '-' }}</td>
                        <td>{{ $row->purpose }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 2rem;">Tidak ada data pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>