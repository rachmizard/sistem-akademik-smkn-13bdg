@extends('master')

@section('content')
<!-- end messages session pop-up -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{  $siswa->username}} {{  $siswa->name}} - {{  $siswa->kelas['tingkat_kelas']}} {{  $siswa->jurusan['nama_jurusan']}} {{  $siswa->kelas['jumlah_kelas']}}
      </h1> 
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data Rekap Nilai Siswa</a></li>
        <li><a href="#">Cari Data Siswa</a></li>
        <li class="active">Data Nilai {{ $siswa->name }}</li>
      </ol>
    </section>

<!-- notification session -->
@if(session('message'))      
      <!-- sweet alert -->
    <link rel="stylesheet" href="/css/sweetalert.css">
    <!-- sweet alert -->
    <script src="/js/sweetalert.js"></script>
    <script>
        swal("{!! session('message') !!}", "Pastikan nilai lengkap dan sesuai yang di inputkan!", "success");
    </script>
@endif

@if(session('messageerror'))      
      <!-- sweet alert -->
    <link rel="stylesheet" href="/css/sweetalert.css">
    <!-- sweet alert -->
    <script src="/js/sweetalert.js"></script>
    <script>
        swal("{!! session('messageerror') !!}", "", "error");
    </script>
@endif
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('/images/jamanold.jpg') center center;">
              <h3 class="widget-user-username">{{  $siswa->name }}</h3>
              <h5 class="widget-user-desc">Siswa</h5>
            </div>
            <div class="widget-user-image">
              <img @if($siswa->photo == 'Not Setting') src="https://s17.postimg.org/bfpk18wcv/default.jpg" @else src="{{ url('uploadgambar') }}/{{ $siswa->photo }}" @endif class="img-circle img-responsive img-thumbnail" height="10" width="234" style="float:left;" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">NIS</h5>
                    <span class="description-text">{{ $siswa->username }}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 col-md-offset-4">
                  <div class="description-block">
                    <h5 class="description-header">KELAS</h5>
                    <span class="description-text">{{ $siswa->kelas['tingkat_kelas'] }} {{ $siswa->jurusan['nama_jurusan'] }} {{ $siswa->kelas['jumlah_kelas'] }}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
      </div>
      <!-- Default box --> 
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Cari Semester</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" id="1">
            
          <!-- searching -->
          <form action="/nilai/cari/{{ $siswa->id }}" method="GET">
            <div class="col-md-3">
              <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
              <select name="q" class="form-control">
                @if($q)
                <option value="{{ $q }}" selected disabled>Semester {{ $q }}</option>
                @endif
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
                <option value="4">Semester 4</option>
                <option value="5">Semester 5</option>
                <option value="6">Semester 6</option>
              </select>
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
            </div>
          </form>
        </div>
        
      </div>
      <!-- Default box --> 
      @if(count($hasil))
      <div class="box box-solid box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Hasil Nilai Semester {{ $q }}</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        @foreach($hasil as $in)
        <form action="{{ route('rekapnilai.destroy', $in->id) }}">
        @endforeach
            {{ csrf_field() }}
        <div class="box-body" id="1">
            <div>
                <input type="submit" id="actions" value="Hapus" hidden>
            </div>
            <table id="rekap" class="table table-striped table-bordered table-hover table-responsive">
              <thead>
                <tr>
                  <th><input type="checkbox" id="select_all" name="select_all" /></th>
                	<th>Mata Pelajaran</th>
                	<th>Tugas 1</th>
                	<th>Tugas 2</th>
                	<th>Tugas 3</th>
                	<th>Sikap</th>
                	<th>Pengetahuan</th>
                	<th>UTS</th>
                	<th>UAS</th>
                  <th>KKM</th>
                  <td>Edit Nilai</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                @foreach($hasil as $in)
                  <td>
                    <input type="checkbox" name="checked[]" data-id="checkbox" value="{{$in->id}}" />
                  </td>
                  <td>{{ $in->id_mapel }}</td>
                  <td>
                    @if($in->tugas1 < $in->kkm)
                      <span class="label label-danger">{{ $in->tugas1 }}</span>
                    @else
                      {{ $in->tugas1 }}
                    @endif
                  </td>
                  <td>
                    @if($in->tugas2 < $in->kkm)
                      <span class="label label-danger">{{ $in->tugas2 }}</span>
                    @else
                      {{ $in->tugas2 }}
                    @endif
                  </td>
                  <td>
                    @if($in->tugas3 < $in->kkm)
                      <span class="label label-danger">{{ $in->tugas3 }}</span>
                    @else
                      {{ $in->tugas3 }}
                    @endif
                  </td>
                  <td>
                    @if($in->nilai_sikap < $in->kkm)
                      <span class="label label-danger">{{ $in->nilai_sikap }}</span>
                    @else
                      {{ $in->nilai_sikap }}
                    @endif
                  </td>
                  <td>
                    @if($in->nilai_pengetahuan < $in->kkm)
                      <span class="label label-danger">{{ $in->nilai_pengetahuan }}</span>
                    @else
                      {{ $in->nilai_pengetahuan }}
                    @endif
                  </td>
                  <td>
                    @if($in->uts < $in->kkm)
                      <span class="label label-danger">{{ $in->uts }}</span>
                    @else
                      {{ $in->uts }}
                    @endif
                  </td>
                  <td>
                    @if($in->uas < $in->kkm)
                      <span class="label label-danger">{{ $in->uas }}</span>
                    @else
                      {{ $in->uas }}
                    @endif
                  </td>
                  <td>{{ $in->kkm }}</td>
                  <td><a href="{{ route('rekapnilai.edit', $in->id) }}" id="elementId" class="btn btn-xs btn-warning">Edit</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </form>
        <!-- /.box-body -->
        <div class="box-footer">
          <a class="btn btn-info" href="/inputnilai/siswa/{{ $siswa->id }}"><i class="fa fa-pencil"></i> Input Nilai Via Web</a>
          @if(count($hasil) > 0)
          <a class="btn btn-info" href="/rekapnilai/cetak-nilai/semester-{{ $q }}/{{ $siswa->id }}"><i class="fa fa-print"></i> Cetak</a>
          <a class="btn btn-info" href="/downloadHasilNilai/xlsx"><i class="fa fa-download"></i> Download Nilai</a>
          @endif
          <form action="/inputnilai/import-excel" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <p>Note :  Nilai bertanda merah nilai yang masih di bawah rata-rata.</p>
                <div class="col-md-6 col-md-offset-6">
                  <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                  <input type="hidden" name="id_kelas" value="{{ $siswa->id_kelas }}">
                  <input type="hidden" name="id_jurusan" value="{{ $siswa->id_jurusan }}">
                  <input type="file" class="form-control" name="imported-file" data-toggle="tooltip" title="Hanya wali kelas yang bisa meng-import semua nilai" required />
                  @if(Auth::user()->id == $siswa->kelas->nip)
                  <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i> Import Nilai</button>
                  @else
                  <button type="submit" class="btn btn-info" disabled><i class="fa fa-lock"></i> Import Nilai</button>
                  @endif
                      @if ($errors->has('nama_mapel'))
                          <span class="help-block">
                              <strong>{{ $errors->first('nama_mapel') }}</strong>
                          </span>
                      @endif
                </div>
          </form>
        </div>
        <!-- /.box-footer-->
      </div>
      @else
      <div class="box box-solid box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Hasil Nilai Semester {{ $q }}</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" id="1">
            <p class="text-center text-muted">Belum ada nilai di Semester {{ $q }}.</p>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a class="btn btn-info" href="/inputnilai/siswa/{{ $siswa->id }}"><i class="fa fa-pencil"></i> Input Nilai Via Web</a>
          <form action="/inputnilai/import-excel" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="col-md-6 col-md-offset-6">
                  <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                  <input type="hidden" name="id_kelas" value="{{ $siswa->id_kelas }}">
                  <input type="hidden" name="id_walikelas" value="{{ $siswa->kelas->nip }}">
                  <input type="hidden" name="id_jurusan" value="{{ $siswa->id_jurusan }}">
                  <input type="file" class="form-control" name="imported-file" data-toggle="tooltip" title="Hanya wali kelas yang bisa meng-import semua nilai" required />
                  <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i> Import Nilai</button>
                      @if ($errors->has('nama_mapel'))
                          <span class="help-block">
                              <strong>{{ $errors->first('nama_mapel') }}</strong>
                          </span>
                      @endif
                </div>
          </form>
        </div>
        <!-- /.box-footer-->
      </div>
      @endif
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
      $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
  </script>

@endsection
