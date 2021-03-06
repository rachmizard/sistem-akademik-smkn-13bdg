<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left circle-img img-circle">
          <img <?php if(Auth::user()->photo == 'Not Setting' || Auth::user()->photo == ''): ?> src="https://s17.postimg.org/bfpk18wcv/default.jpg" <?php else: ?> src="<?php echo e(url('uploadgambar')); ?>/<?php echo e(Auth::user()->photo); ?>" <?php endif; ?> alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo e(Auth::user()->name); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <?php if(Auth()->user()->role == '1'): ?>
        <li class="header">STUDENT AREA</li>
        <li class="treeview <?php echo e((Request::is('/lihat-datasaya') ? 'class=active' : '')); ?>">
          <a href="#">
            <i class="fa fa-user"></i> <span>Nilai saya</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo e((Request::is('/lihat-datasaya') ? 'class=active' : '')); ?>><a href="/lihat-datasaya/lihat-nilai/<?php echo e(str_slug(Auth::user()->name)); ?>"><i class="fa fa-book"></i> Lihat nilai saya
            </a></li>
          </ul>
        </li>
        <?php endif; ?>

        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview <?php echo e((Request::is('home') ? 'active' : '')); ?> <?php echo e((Request::is('home/timeline') ? 'active' : '')); ?> ">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo e((Request::is('home') ? 'class=active' : '')); ?>><a href="/home"><i class="fa fa-circle-o"></i> Home Page</a></li>
            <li <?php echo e((Request::is('home/discuss-group') ? 'class=active' : '')); ?>><a href="/home/discuss-group"><i class="fa fa-circle-o"></i> Grup Diskusi</a>
            <li <?php echo e((Request::is('home/timeline') ? 'class=active' : '')); ?>><a href="<?php echo e(url('home/timeline')); ?>"><i class="fa fa-circle-o"></i> Timeline</a>
          </ul>
        </li>
        <?php if(Auth()->user()): ?>
        <?php if(Auth()->user()->role != '1'): ?>
        <li class="treeview <?php echo e((Request::is('siswa') ? 'active' : '')); ?> <?php echo e((Request::is('rekapnilai') ? 'active' : '')); ?>">
          <a href="#">
            <i class="fa fa-user text-green"></i> <span>Data Siswa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo e((Request::is('siswa') ? 'clas=active' : '')); ?>><a href="/siswa"><i class="fa fa-circle-o"></i> Lihat Data Siswa</a></li>
            <?php if(Auth()->user()->role == '2' || Auth()->user()->role == '3'): ?>
            <li <?php echo e((Request::is('rekapnilai') ? 'class=active' : '')); ?>><a href="/rekapnilai"><i class="fa fa-circle-o"></i> Input & Rekap Nilai Siswa</a></li>
            <?php endif; ?>
          </ul>
        </li>
        <li class="treeview <?php echo e((Request::is('guru') ? 'active' : '')); ?>">
          <a href="#">
            <i class="fa fa-table text-blue"></i> <span>Data Guru</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
              <ul class="treeview-menu">
                <li <?php echo e((Request::is('guru') ? 'class=active' : '')); ?>><a href="/guru"><i class="fa fa-circle-o"></i> Lihat Data Guru</a></li>
             </ul>
        </li>
        <?php endif; ?>
        <li class="treeview <?php echo e((Request::is('kelas') ? 'active' : '')); ?>">
          <a href="#">
            <i class="fa fa-university text-yellow"></i> <span>Kelas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo e((Request::is('kelas') ? 'class=active' : '')); ?>><a href="/kelas"><i class="fa fa-circle-o"></i> Lihat Data Kelas</a></li>
          </ul>
        </li>
        <li class="treeview <?php echo e((Request::is('mapel') ? 'active' : '')); ?> <?php echo e((Request::is('mapel-produktif') ? 'active' : '')); ?>">
          <a href="#">
            <i class="fa fa-book text-aqua"></i> <span>Mata Pelajaran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo e((Request::is('mapel-produktif') ? 'class=active' : '')); ?>><a href="mapel-produktif"><i class="fa fa-circle-o"></i> Produktif</a></li>
            <li <?php echo e((Request::is('mapel') ? 'class=active' : '')); ?>><a href="/mapel"><i class="fa fa-circle-o"></i> Non-Produktif</a></li>
          </ul>
        </li>
        <?php if(Auth::user()->role == '2' || Auth::user()->role == '3'): ?>
        <li class="treeview <?php echo e((Request::is('rekapnilai') ? 'active' : '')); ?> <?php echo e((Request::is('rekapnilai') ? 'active' : '')); ?>">
          <a href="#">
            <i class="fa fa-database text-purple"></i> <span>Input Nilai</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo e((Request::is('importnilai') ? 'class=active' : '')); ?>><a href="/importnilai"><i class="fa fa-file-excel-o"></i> Import nilai</a></li>
            <li <?php echo e((Request::is('rekapnilai') ? 'class=active' : '')); ?>><a href="/rekapnilai"><i class="fa fa-pencil"></i> Input Nilai Siswa</a></li>
          </ul>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <?php if(Auth()->user()->role == '2'): ?>
        <li>
        <li class="header">ADMIN COMMAND AREA</li>
        <li <?php echo e((Request::is('account') ? 'class=active' : '')); ?>><a href="/account"><i class="fa fa-group text-red"></i> <span>Account users</span></a></li>
        <li <?php echo e((Request::is('tahun-ajaran') ? 'class=active' : '')); ?>><a href="/tahun-ajaran"><i class="fa fa-pencil text-yellow"></i> <span>Tahun Ajaran</span></a></li>
        <li <?php echo e((Request::is('jurusan') ? 'class=active' : '')); ?>><a href="/jurusan"><i class="fa fa-university text-blue"></i> <span>Jurusan</span></a></li>
        </li>
        <li <?php echo e((Request::is('reports') ? 'class=active' : '')); ?>><a href="/reports"><i class="fa fa-table text-red"></i> <span>Reports</span>
        <?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($notification->type == 'App\Notifications\ReportNotification'): ?>
          <span class="pull-right-container"><span class="label label-danger pull-right">New</span></span>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </a>
        </li>
        <?php endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
