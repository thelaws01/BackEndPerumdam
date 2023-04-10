<!DOCTYPE html><html><head
lang="en"><meta
charset="UTF-8"><meta
name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"><meta
http-equiv="x-ua-compatible" content="ie=edge"><title>Selamat Datang di E-Aduan Perumdam Tirta Kencana Samarinda</title>
<link rel="icon" type="image/png" href="https://perumdamtirtakencana.id/sites/images/logo-page.png">
<style type="text/css">
    @import url("//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css");
    @import url("//cdn.enterwind.com/webfonts/geomantist/geomantist.min.css");
    .login-block{background:url({{asset('bg.png')}}) no-repeat center center fixed!important;
        -webkit-background-size:cover!important;
        -moz-background-size:cover!important;
        -o-background-size:cover!important;
        background-size:cover!important
    }
    html
    {   
        height:100%;width:100%;overflow:hidden
    }
    body
    {
        height:100%;padding:0;overflow:auto;margin:0;-webkit-overflow-scrolling:touch;font-family:'Lato',sans-serif}b{font-family:'Lato',sans-serif}
        .login-sec
        h2{font-family:'Lato',sans-serif}
        .login-block{
            float:left;width:100%;height:100vh;padding:15vh 0}
            .banner-sec{background:url(https://perumdamtirtakencana.id/banner/slide1.jpg) no-repeat left bottom;background-size:cover;min-height:500px;border-radius:0 2px 2px 0;padding:0}.container{background:#fff;border-radius:2px;box-shadow:5px 5px 0px rgba(0,0,0,0.1)}.login-sec{padding:50px
            30px;position:relative;text-align:center}.login-sec .copy-text{position:absolute;width:80%;bottom:20px;font-size:10px;text-align:center;color:#d0d0d0}.login-sec .copy-text
            a{color:#d0d0d0}.login-sec
            .logo{height:100px;margin-bottom:10px}.login-sec
        h2{margin-bottom:15px;font-weight:800;font-size:30px;color:#0fa4f7}.login-sec h2:after{content:" ";width:100px;height:5px;background:#ffca03;display:block;margin-top:10px;border-radius:3px;margin-left:auto;margin-right:auto}.btn-login{background:#0fa4f7;color:#fff;font-weight:500}.error-list{font-size:75%}.swal2-modal .swal2-content{font-family:'Lato',sans-serif}</style></head><body
        class="bg">
        <section class="login-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 login-sec">
        <img src="https://perumdamtirtakencana.id/sites/images/logo-2.jpg" class="logo">
        <h2 class="text-center">Hai, Selamat Datang!</h2>
        <p class="small text-muted">Silahkan login website melalui halaman ini</p>
        <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf

                        <div class="form-group">
                                <input id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Nama Pengguna" name="email" type="text" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group">
                            <input class="form-control" placeholder="Kata Sandi" required name="password" type="password" value="">
                        </div>  

                        <button class="btn btn-login float-right" type="submit">Masuk</button>

                    </form>
    </div>
    <div class="col-md-8 banner-sec"></div></div></div>
</section></body></html>