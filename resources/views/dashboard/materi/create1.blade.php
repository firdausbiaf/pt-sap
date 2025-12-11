@extends('layout.dashboard.main')
@section('content')
   
<div class="container col-lg-8 mx-5 mt-4">
  <h2>Tambah Materi</h2>
  <form method="post" action="/admin/materi" class="mb-5" enctype="multipart/form-data">
    @csrf
    <div class="form-group-row">
        <table class="table">
        <thead>
        <tr>
            <th>Judul</th>
            <th>Materi</th>
            <th><a href="javasritp:;" class="btn btn-info addRow">Tambah</a> </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <input type="hidden" name="course_id" id="course_id" value="{{ $course_id }}">
            <td><input type="text" class="form-control" id="subject" name="subject[]"></td>
            <td><input class="form-control" type="file" id="pdf" name="pdf[]" ></td>
            <td><a href="javasritp:;" class="btn btn-danger deleteRow">Hapus</a> </td>
        </tr>
        </tbody>
        </table>
    </div>
    <button type="submit" class="btn btn-primary" >Submit</button>
  </form>

  
</div>

<script>
    $('thead').on('click', '.addRow', function(){
        var tr = '<tr>'+
        '<input type="hidden" name="course_id" id="course_id" value="{{ $course_id }}">'+
        '<td><input type="text" class="form-control" id="subject" name="subject[]"></td>'+
        '<td><input class="form-control" type="file" id="pdf" name="pdf[]" ></td>'+
        '<td><a href="javasritp:;" class="btn btn-danger deleteRow">Hapus</a> </td>'+
      '</tr>';

      $('tbody').append(tr);

    });

    $('tbody').on('click', '.deleteRow', function(){
        $(this).parent().parent().remove();
    })
</script>

@endsection