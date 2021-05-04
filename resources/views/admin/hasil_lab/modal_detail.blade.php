<style>
    .judul{
        display: inline-block;
        width: 35%;
        font-weight: bold;
    }
    .isi::before{
        content: ':';
        font-weight: bold;
        padding-right: 5px;
    }
    .ket{
        width: 25%;
    }
    .tab{
        display: inline;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="detailModalLabel">Modal title</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td style="width: 50%">
                            <span class="judul">Pemeriksaan</span>
                            <span class="isi" id="pemeriksaan"></span>
                        </td>
                        <td style="width: 50%">
                            <span class="judul">Nama Hasil</span>
                            <span class="isi" id="nm_hasil"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="judul">Level</span>
                            <span class="isi" id="level_hasil"></span>
                        </td>
                        <td>
                            <span class="judul">Tipe Hasil</span>
                            <span class="isi" id="tipe_hasil"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="judul">Jumlah Koma</span>
                            <span class="isi" id="jml_koma"></span>
                        </td>
                        <td>
                            <span class="judul">Kesimpulan</span>
                            <span class="isi" id="is_kesimpulan"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="judul ket">Keterangan Tambahan </span><span class="isi" id="ket_tambahan"></span>
                        </td>
                    </tr>
                    <tr id="rumus">
                        <td colspan="2">
                            <span class="judul ket">Keterangan Rumus  </span><span class="isi" id="ket_rumus"></span>
                        </td>
                    </tr>
                </table>
            </div>
            <table class="table table-striped table-bordered">
                <tr>
                    <th colspan="3" class="text-center">Jenis Hasil</th>
                </tr>
                <tr class="text-center">
                    <td>Normal</td>
                    <td>Teks</td>
                    <td>Judul</td>
                </tr>
                <tr class="text-center">
                    <td id="is_nilai_normal"></td>
                    <td id="is_teks"></td>
                    <td id="is_judul"></td>
                </tr>
            </table>
            <div class="table-responsive">
                <table id="nilai_normal" class="table table-striped table-bordered">
                    <tr class="text-center">
                        <th colspan="4">Nilai Normal</th>
                    </tr>
                    <tr>
                        <td><span class="judul tab">Min Pria</span><span id="min_p" class="isi">22</span></td>
                        <td><span class="judul tab">Max Pria</span><span id="max_p" class="isi">33</span></td>
                        <td><span class="judul tab">Min Wanita</span><span id="min_w" class="isi">23</span></td>
                        <td><span class="judul tab">Max Wanita</span><span id="max_w" class="isi">32</span></td>
                    </tr>
                    <tr class="text-center">
                        <th colspan="4">Nilai Normal Bayi dan Anak</th>
                    </tr>
                    <tr>
                        <td><span class="judul tab">Min Anak</span><span id="min_a" class="isi">22</span></td>
                        <td><span class="judul tab">Max Anak</span><span id="max_a" class="isi">33</span></td>
                        <td><span class="judul tab">Min Bayi</span><span id="min_b" class="isi">23</span></td>
                        <td><span class="judul tab">Max Bayi</span><span id="max_b" class="isi">32</span></td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <span class="judul" style="width: 10%">Satuan </span><span class="isi" id="satuan"></span>
                        </th>
                    </tr>
                </table>
            </div>
            <table class="table table-striped table-bordered" id="nilai_biasa">
                 <tr>
                     <th><span class="judul">Nilai Normal</span><span class="isi" id="id_tiper"></span></th>
                 </tr>
            </table>
        </div>
        <div class="modal-footer">
            <a href="" type="button" class="btn btn-success" id="edit">Edit</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
</div>
