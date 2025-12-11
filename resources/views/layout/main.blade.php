<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Djagad Land Group</title>
    <link rel="shortcut icon" href="images/logologo.png" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gambar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carduser.css') }}">
     {{-- Bootstrp Icons --}}
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/new/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/new/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
      /* Ganti ukuran slide gambar progress sesuai kebutuhan Anda */
      #progressPhotoCarousel .carousel-inner img {
          width: 100%;
          height: 200px;
          object-fit: cover;
      }
  
      /* Ganti gaya tombol kontrol slide sesuai kebutuhan Anda */
      .custom-carousel-prev,
      .custom-carousel-next {
          background-color: rgba(0, 0, 0, 0.8);
          border: none;
          border-radius: 50%;
          color: white;
      }
  
      /* Ganti gaya ikon tombol kontrol slide */
      .custom-carousel-prev-icon,
      .custom-carousel-next-icon {
          font-size: 1.5rem;
      }
  </style>
  

    <style>
      /* Warna garis panah carousel sebelumnya dan sesudahnya */
      .custom-carousel-prev-icon,
      .custom-carousel-next-icon {
          background-color: #507cad7e; Ganti dengan warna yang Anda inginkan
          border-color: #507cad7e; /* Ganti dengan warna yang Anda inginkan */
      }
  
      /* Warna garis panah carousel saat dihover */
      .custom-carousel-prev:hover .custom-carousel-prev-icon,
      .custom-carousel-next:hover .custom-carousel-next-icon {
          background-color: #507cad7e; /* Ganti dengan warna yang Anda inginkan */
          border-color: #507cad7e; /* Ganti dengan warna yang Anda inginkan */
      }
  </style>
  <style>
    .icon-large {
        font-size: 25px; /* Atur ukuran sesuai keinginan Anda */
    }
    .table {
    border-collapse: separate;
    border-spacing: 0 20px; /* Atur jarak antar baris sesuai kebutuhan Anda */
    }

    .table td,
    .table th {
        font-size: 18px; /* Atur ukuran teks sesuai kebutuhan Anda */
    }


  </style>
  

  </head>
<style>
  body{
    background-image: url("images/bg-user2.jpg");
  }
</style>
  <body>

    @include('layout.navbar')

  <div class="container">
   
        @yield('content')
        <script>

          function previewImage(){
            const image = document.querySelector('#bukti');
            const imgPreview = document.querySelector('.img-preview');
        
            imgPreview.style.display = 'block';
        
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
        
            oFReader.onload = function(oFREvent){
              imgPreview.src = oFREvent.target.result;
            }
        
          }
          
        </script>
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
  </div>

  @include('layout.footer')
  </body>
</html>

