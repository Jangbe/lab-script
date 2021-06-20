<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Total Biaya</th>
            <th>Dokter Pengirim</th>
            <th>Fee</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item['tanggal']}}</td>
                <td>{{$item['nama']}}</td>
                <td>{{$item['total_biaya']}}</td>
                <td>{{$item['nama_dokter']}}</td>
                <td>{{$item['fee']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
