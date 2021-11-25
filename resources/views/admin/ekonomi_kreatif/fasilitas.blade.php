@foreach($fasilitas as  $i => $a)
    <tr>
        <td>{{$i+1}}</td>
        <td>{{$a->nama_akomodasi}}</td>
        <td>{{$a->nama_fasilitas_akomodasi}}</td>
        <td><img src="{{ $a->icon_fasilitas_akomodasi }}" alt="{{ $a->nama_fasilitas_akomodasi }}" class="img-fluid" width="60px"></td>
        <td>
            <button style="width:80px;color:white" type="button" class="btn btn-warning p-1" >Edit</button>
            <button style="width:80px" type="button" class="btn btn-danger p-1">Hapus</button>
        </td>
    </tr>
@endforeach
