<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="{{ $kategori === 'semua' ? '6' : '5' }}"
                    style="font-size: 16pt; font-weight: bold; text-align: center;">
                    {{ $kategoriLabel }} PPID
                </th>
            </tr>
            <tr>
                <th style="font-weight: bold; text-align: center; border: 1px solid #000; background-color: #f1f5f9;">No
                </th>
                <th
                    style="font-weight: bold; text-align: center; border: 1px solid #000; background-color: #f1f5f9; width: 400px;">
                    Judul Informasi</th>
                <th
                    style="font-weight: bold; text-align: center; border: 1px solid #000; background-color: #f1f5f9; width: 200px;">
                    Penanggung Jawab</th>
                <th
                    style="font-weight: bold; text-align: center; border: 1px solid #000; background-color: #f1f5f9; width: 400px;">
                    Keterangan Singkat</th>
                @if($kategori === 'semua')
                    <th
                        style="font-weight: bold; text-align: center; border: 1px solid #000; background-color: #f1f5f9; width: 200px;">
                        Kategori</th>
                @endif
                <th
                    style="font-weight: bold; text-align: center; border: 1px solid #000; background-color: #f1f5f9; width: 150px;">
                    Akses Informasi</th>
            </tr>
        </thead>
        <tbody>
            @php $currentGroup = null;
            $no = 1; @endphp
            @foreach($informations as $info)
                @if(in_array($kategori, ['berkala', 'setiap_saat']))
                    @php 
                        $groupName = $info->group_name ?: 'Tanpa Kelompok';
                    @endphp
                    @if($currentGroup !== $groupName)
                        <tr>
                            <td colspan="{{ $kategori === 'semua' ? 6 : 5 }}"
                                style="background-color: #172554; color: white; font-weight: bold; padding: 10px; border: 1px solid #000;">
                                {{ $groupName }}
                            </td>
                        </tr>
                        @php 
                                                            $currentGroup = $groupName;
                            $no = 1; // Reset number per group
                        @endphp
                    @endif
                @endif
                <tr>
                    <td style="text-align: center; vertical-align: top; border: 1px solid #000;">{{ $no++ }}</td>
                    <td style="vertical-align: top; border: 1px solid #000;">
                        <strong>{{ $info->title }}</strong>
                        @if($info->published_year)
                            ({{ $info->published_year }})
                        @endif
                    </td>
                    <td style="vertical-align: top; border: 1px solid #000;">{{ $info->penanggung_jawab ?: '-' }}</td>
                    <td style="vertical-align: top; border: 1px solid #000;">
                        {{ \Illuminate\Support\Str::limit(strip_tags($info->description), 150) }}
                    </td>
                    @if($kategori === 'semua')
                        <td style="text-align: center; vertical-align: top; border: 1px solid #000;">
                            {{ ucwords(str_replace('_', ' ', $info->category)) }}
                        </td>
                    @endif
                    <td style="text-align: center; vertical-align: top; border: 1px solid #000;">
                        @if($info->visibility == 'public')
                            TERBUKA
                        @else
                            DIKECUALIKAN
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>