<button onclick="createVisitor({{ $akomodasi_id }})"
        class="btn btn-info btn-sm float-end">
    Tambah Data Pengunjung
</button>
<table id="table1" class="table table-striped">
    <thead>
        <tr>
            <th style="width:20%">Periode</th>
            <th>Jumlah Pengunjung</th>
            <th style="width:20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($visitors as $i => $a)
            <tr>
                <td>{{ $a->periode }}</td>
                <td>{{ number_format($a->visitor) }}</td>
                <td>
                    <button onclick="editVisitor({{ $a->akomodasi_id }}, {{ $a->id }})"
                        style="width:40px; margin-top:5px" class="btn btn-info btn-sm"><i
                            class="fas fa-edit"></i></button>
                    <button onclick="hapus('<?= $a->id ?>')" style="width:40px; margin-top:5px"
                        class="btn btn-info btn-sm"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    async function editVisitor(akomodasi, id) {
        $('#visitorsEditModal #title').text("Tambah Data Pengunjung");
        $('#visitorsEditModal .modal-body').load("{{ url('/') }}/admin/akomodasi/"+akomodasi+"/visitor/"+id+"/form");
        $('#visitorsEditModal').modal('show');
    }
    async function createVisitor(akomodasi) {
        $('#visitorsEditModal #title').text("Tambah Data Pengunjung");
        $('#visitorsEditModal .modal-body').load("{{ url('/') }}/admin/akomodasi/"+akomodasi+"/visitor/form");
        $('#visitorsEditModal').modal('show');
    }

</script>
