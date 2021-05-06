<!-- Modal -->
<div class="modal fade" id="alatLabDetail" tabindex="-1" aria-labelledby="alatLabDetailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alatLabDetailLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nama Alat</th>
                        <td id="d_nm_alat"></td>
                    </tr>
                    <tr>
                        <th>Uraian</th>
                        <td id="d_uraian"></td>
                    </tr>
                    <tr>
                        <th>Aktif</th>
                        <td id="d_is_active"></td>
                    </tr>
                </table>
                <table class="table table-bordered table-striped text-center">
                    <tr>
                        <th colspan="4">RS-232</th>
                    </tr>
                    <tr>
                        <th>Com</th>
                        <th>TimeOut</th>
                        <th>Buffer</th>
                        <th>BaudRate</th>
                    </tr>
                    <tr>
                        <td id="d_com"></td>
                        <td id="d_timeout"></td>
                        <td id="d_buffer"></td>
                        <td id="d_baudrate"></td>
                    </tr>
                    <tr>
                        <th>DataBits</th>
                        <th>Parity</th>
                        <th>StopBits</th>
                        <th>Timer</th>
                    </tr>
                    <tr>
                        <td id="d_databits"></td>
                        <td id="d_parity"></td>
                        <td id="d_stopbits"></td>
                        <td id="d_timer"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
