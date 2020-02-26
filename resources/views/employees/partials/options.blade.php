<a href="#" style="margin-bottom: 10px;" class="btn btn-info" onclick="showInfo({{$employee->id}})">
    Ver
</a>

@if($employee->status)
    <a href="#" class="btn btn-danger cli" data-toggle="tooltip" title="Desactivar" onclick="changeStatus({{$employee->id}})">
        Desactivar
    </a>
@else
    <a href="#" class="btn btn-success cli" data-toggle="tooltip" title="Activar" onclick="changeStatus({{$employee->id}})">
        Activar
    </a>
@endif

<script>
function changeStatus(id)
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "employees/"+ id,
        method: 'delete',
    }).done(function(response) {
        console.log("Response button:",response);
        dtTable.ajax.reload();
    });
}
</script>
