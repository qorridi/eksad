@extends('layouts.frontend')


@section('head_and_title')
    <meta name="description" content="EKSAD, Technology">
    <meta name="subject" content="EKSAD, Technology">
    <meta name="author" content="EKSAD">
    <title>EKSAD Technology</title>
@endsection

@section('content')

    <!-- Banner -->
    <section class="py-5 martop">
        <div class="container">
            <div class="row pb-5">
                <div class="col-12">
                    <p class="txt-banner fw-bold text-dark text-center">Kebijakan Privasi</p>
                    <div class="border-title"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pb-5">
                    <p class="txt-body1 text-dark fw-bold m-0 pt-3">Pendahuluan</p>
                    <p class="txt-body3 text-dark m-0 pt-3">
                        Kebijakan Privasi ini menjelaskan bagaimana informasi pribadi Anda dikumpulkan, digunakan, dan dibagikan ketika Anda mengunjungi http://infinit.id.
                        <br>
                        Informasi pribadi yang kami kumpulkan saat Anda mengunjungi Situs, kami secara otomatis mengumpulkan informasi tertentu tentang perangkat Anda,
                        termasuk informasi tentang browser web Anda, alamat IP, zona waktu, dan beberapa cookie yang diinstal pada perangkat Anda.
                        Selain itu, saat Anda menjelajahi Situs, kami mengumpulkan informasi tentang halaman web individu yang Anda lihat,
                        situs web atau istilah pencarian apa yang mengarahkan Anda ke Situs, dan informasi tentang bagaimana Anda berinteraksi dengan Situs.
                        Kami menyebut informasi yang dikumpulkan secara otomatis ini sebagai "Informasi Perangkat".
                    </p>
                </div>
                <div class="col-md-12 pb-5">
                    <p class="txt-body1 text-dark fw-bold m-0 pt-3">Kami mengumpulkan Informasi Perangkat menggunakan teknologi berikut:</p>
                    <p class="txt-body3 text-dark m-0 pt-3">
                        - "Cookies" adalah file data yang ditempatkan di perangkat atau komputer Anda dan sering kali menyertakan pengenal unik anonim. Untuk informasi lebih lanjut tentang cookie, dan cara menonaktifkan cookie, kunjungi http://www.allaboutcookies.org.
                        <br>
                        - "File log" melacak tindakan yang terjadi di Situs, dan mengumpulkan data termasuk alamat IP Anda, jenis browser, penyedia layanan Internet, halaman rujukan / keluar, dan stempel tanggal / waktu.
                        <br>
                        - "Web beacon", "tag", dan "piksel" adalah file elektronik yang digunakan untuk merekam informasi tentang cara Anda menjelajahi Situs.
                        <br>
                        Saat kita berbicara tentang "Informasi Pribadi" dalam Kebijakan Privasi ini, kita berbicara tentang Informasi Perangkat dan Informasi Pemesanan.
                    </p>
                </div>
                <div class="col-md-12 pb-5">
                    <p class="txt-body1 text-dark fw-bold m-0 pt-3">Jangan lacak</p>
                    <p class="txt-body3 text-dark m-0 pt-3">
                        Harap perhatikan bahwa kami tidak mengubah pengumpulan data dan praktik penggunaan Situs kami saat kami melihat sinyal Jangan Lacak dari browser Anda.
                    </p>
                </div>
                <div class="col-md-12 pb-5">
                    <p class="txt-body1 text-dark fw-bold m-0 pt-3">Hak Anda</p>
                    <p class="txt-body3 text-dark m-0 pt-3">
                        Jika Anda adalah penduduk Eropa, Anda memiliki hak untuk mengakses informasi pribadi yang kami miliki tentang Anda dan meminta agar informasi pribadi Anda diperbaiki, diperbarui, atau dihapus. Jika Anda ingin menggunakan hak ini, silakan hubungi kami melalui informasi kontak di bawah ini.
                        <br>
                        Selain itu, jika Anda adalah penduduk Eropa, kami mencatat bahwa kami memproses informasi Anda untuk memenuhi kontrak yang mungkin kami miliki dengan Anda (misalnya jika Anda memesan melalui Situs), atau untuk mengejar kepentingan bisnis sah kami yang tercantum di atas. Selain itu, harap diperhatikan bahwa informasi Anda akan ditransfer ke luar Eropa, termasuk ke Kanada dan Amerika Serikat.
                    </p>
                </div>
                <div class="col-md-12 pb-5">
                    <p class="txt-body1 text-dark fw-bold m-0 pt-3">Perubahan</p>
                    <p class="txt-body3 text-dark m-0 pt-3">
                        Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu untuk mencerminkan, misalnya, perubahan pada praktik kami atau untuk alasan operasional, hukum atau peraturan lainnya
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Scroll [to top] -->
    <div id="scroll-to-top" class="scroll-to-top">
        <a href="#header" class="smooth-anchor">
            <i class="icon-arrow-up"></i>
        </a>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <style>

        .icon-team-socmed{
            width:25px;
        }
        .img-vision{
            width: 100px;
        }
        .img-mission{
            width: 65px;
        }
        .bg-vision{
            background-image: url('{{asset('images/infinit/about/about - vision.png')}}');
            background-repeat: no-repeat;
            background-position: bottom;
            background-size: cover;
            width: 100%;
            height: 43vh;
            position: relative;
            margin-top: -1px;
        }
        .bg-mission{
            background-image: url('{{asset('images/infinit/about/about - mission.png')}}');
            background-repeat: no-repeat;
            background-position: bottom;
            background-size: cover;
            width: 100%;
            height: 43vh;
            position: relative;
            margin-top: -1px;
        }
        .img-core{
            width:75px;
        }
        .slick-slide{
            height: auto;
        }
        .martop{
            margin-top: 9vh;
        }
        .txt-card{
            color:#331d5e;
        }
        .odd:not(.custom) .card:not(.no-hover):not(:hover){
            background-color: #184d47;
        }

        .card{
            border-color: black;
        }

        .odd h4, .body-mode-dark h4{
            color: #000;
        }
        .bg-banner{
            background-color: #1b1b1b;
        }
        .img-banner{
            width:100%;
        }
        .border-title{
            border-bottom: 5px solid red;
            width:100px;
            margin:0 auto;
            margin-top: -25px;
        }
        .border-title-2{
            border-bottom: 5px solid red;
            width:100px;
            margin-top: -25px;
        }
        p{
            margin-bottom: 1em;
        }

        @media(min-width: 576px){
            .img-banner{
                width:100%;
            }
        }
        @media(min-width: 1900px){
            .img-banner{
                width:100%;
            }
            .bg-vision{
                height:57vh;
            }
            .bg-mission{
                height:57vh;
            }
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(".partners-slider").slick({
            dots: true,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        slidesToShow: 2,
                        slidesToScroll:2
                    }
                }
            ]
        });
        $(".services-slider").slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        slidesToShow: 1,
                        slidesToScroll:1
                    }
                }
            ]
        });
    </script>

@endsection
