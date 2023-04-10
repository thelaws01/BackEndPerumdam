<div class="mobile-menu-left-overlay"></div>
<nav class="side-menu">
  @if(auth()->user()->akses_id == 1)
  <section>
    <header class="side-menu-title">Navigasi Menu</header>
    <ul class="side-menu-list">
      <li class="putih-manja">
        <a href="{{route('home')}}">
          <span class="fa fa-tachometer"></span>
          <span class="lbl">Beranda</span>
        </a>
      </li>

      <li class="putih-manja ">
        <a href="{{route('berita.index')}}">
          <span class="fa fa-newspaper-o"></span>
          <span class="lbl">Berita</span>
        </a>
      </li>

      <!--<li class="putih-manja ">-->
      <!--  <a href="{{route('agenda.index')}}">-->
      <!--    <span class="fa fa-calendar-o"></span>-->
      <!--    <span class="lbl">Agenda</span>-->
      <!--  </a>-->
      <!--</li>-->

      <!--<li class="putih-manja ">-->
      <!--  <a href="{{route('polsek.index')}}">-->
      <!--    <span class="fa fa-info-circle"></span>-->
      <!--    <span class="lbl">Polsek</span>-->
      <!--  </a>-->
      <!--</li>-->

      <li class="putih-manja ">
       <a href="{{route('operator.index')}}">
          <span class="fa fa-user"></span>
          <span class="lbl">Pengguna</span>
        </a>
      </li>
    </ul>

    <header class="side-menu-title">Menu Pengaduan</header>
    <ul class="side-menu-list">
      <li class="putih-manja ">
        <a href="{{route('pengaduan.index')}}">
          <span class="fa fa-inbox"></span>
          <span class="lbl">Pengaduan</span>
        </a>
      </li>
      <li class="putih-manja ">
        <a href="{{route('kategori.index')}}">
          <span class="fa fa-folder"></span>
          <span class="lbl">Kategori</span>
        </a>
      </li>
      <li class="putih-manja ">
        <a href="{{route('member.index')}}">
          <span class="fa fa-user-plus"></span>
          <span class="lbl">Masyarakat</span>
        </a>
      </li> 
    </ul>
  </section>
  @else
  <section>
    <header class="side-menu-title">Menu Pengaduan</header>
    <ul class="side-menu-list">
      <li class="putih-manja">
        <a href="{{route('home')}}">
          <span class="fa fa-tachometer"></span>
          <span class="lbl">Beranda</span>
        </a>
      </li>

      <li class="putih-manja ">
        <a href="{{route('pengaduan.index')}}">
          <span class="fa fa-inbox"></span>
          <span class="lbl">Pengaduan</span>
        </a>
      </li>

      <li class="putih-manja ">
        <a href="{{route('member.index')}}">
          <span class="fa fa-user-plus"></span>
          <span class="lbl">Masyarakat</span>
        </a>
      </li> 

    </ul>
  </section>

  @endif
</nav>

<div class="page-content">
</div>
