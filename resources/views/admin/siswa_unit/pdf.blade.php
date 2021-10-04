<html>

<head>

    <style type="text/css">
        span.cls_002 {
            font-family: Arial, serif;
            font-size: 29.1px;
            color: rgb(152, 0, 0);
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
        }

        div.cls_002 {
            font-family: Arial, serif;
            font-size: 26.1px;
            color: rgb(152, 0, 0);
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
        }

        span.cls_003 {
            font-family: Arial, serif;
            font-size: 20.1px;
            color: rgb(0, 0, 0);
            font-weight: normal;
            font-style: normal;
            text-decoration: none
        }

        div.cls_003 {
            font-family: Arial, serif;
            font-size: 20.1px;
            color: rgb(0, 0, 0);
            font-weight: normal;
            font-style: normal;
            text-decoration: none;
        }

        span.cls_004 {
            font-family: Arial, serif;
            font-size: 34.0px;
            color: rgb(152, 0, 0);
            font-weight: bold;
            font-style: normal;
            text-decoration: none
        }

        div.cls_004 {
            font-family: Arial, serif;
            font-size: 34.0px;
            color: rgb(152, 0, 0);
            font-weight: bold;
            font-style: normal;
            text-decoration: none
        }

        span.cls_005 {
            font-family: Arial, serif;
            font-size: 16px;
            color: rgb(0, 0, 0);
            font-weight: normal;
            font-style: normal;
            text-decoration: none
        }

        div.cls_005 {
            font-family: Arial, serif;
            font-size: 13.1px;
            color: rgb(0, 0, 0);
            font-weight: normal;
            font-style: normal;
            text-decoration: none
        }

        span.cls_006 {
            font-family: Arial, serif;
            font-size: 13.1px;
            color: rgb(0, 0, 0);
            font-weight: bold;
            font-style: normal;
            text-decoration: none
        }

        div.cls_006 {
            font-family: Arial, serif;
            font-size: 13.1px;
            color: rgb(0, 0, 0);
            font-weight: bold;
            font-style: normal;
            text-decoration: none
        }

        span.cls_007 {
            font-family: Arial, serif;
            font-size: 16.1px;
            color: rgb(0, 0, 0);
            font-weight: bold;
            font-style: normal;
            text-decoration: none
        }

        div.cls_007 {
            font-family: Arial, serif;
            font-size: 16.1px;
            color: rgb(0, 0, 0);
            font-weight: bold;
            font-style: normal;
            text-decoration: none
        }

        span.cls_008 {
            font-family: Arial, serif;
            font-size: 15.1px;
            color: rgb(0, 0, 0);
            font-weight: normal;
            font-style: normal;
            text-decoration: none
        }

        div.cls_008 {
            font-family: Arial, serif;
            font-size: 15.1px;
            color: rgb(0, 0, 0);
            font-weight: normal;
            font-style: normal;
            text-decoration: none
        }

    </style>
    <script type="text/javascript"
        src="5d75e948-250b-11ec-a980-0cc47a792c0a_id_5d75e948-250b-11ec-a980-0cc47a792c0a_files/wz_jsgraphics.js">
    </script>
</head>

<body>
    <div
        style="position:absolute;left:50%;margin-left:-421px;top:0px;width:842px;height:596px;border-style:outset;overflow:hidden">
        <div style="position:absolute;left:0px;top:0px">
            <img src="{{ public_path('assets/images/background1.png') }}" width="842" height="596">
        </div>
        <div style="position:absolute;left:240.47px;top:135.63px" class="cls_002"><span class="cls_002">Sertifikat
                Penyelesaian Kursus</span></div>
        <div style="position:absolute;left:290.53px;top:180.66px" class="cls_003"><span class="cls_003">
                dengan bangga diberikan kepada
            </span></div>
        <div style="position:absolute;left:320.49px;top:212.99px; text-align: center" class="cls_004"><span
                class="cls_004">{{ $data->siswa->nama_siswa }} </span></div>
        <div style="position:absolute;left:209.81px;top:270.97px" class="cls_005"><span class="cls_005">telah berhasil
                menyelesaikan kursus</span><span class="cls_006">
                {{ $data->kursus_unit->kursus->nama_kursus }}</span><span class="cls_005">.</span></div>
        <div style="position:absolute;left:175.79px;top:292.34px" class="cls_005"><span class="cls_005">Bimble adalah
                platform kursus offline yang update dengan perkembangan teknologi</span></div>

        <div style="position:absolute;left:345.43px;top:361.34px" class="cls_005"><span class="cls_005">{{
        $data->updated_at->format('d F Y') }}</span></div>
        <div style="position:absolute;left:357.71px;top:455.00px" class="cls_007"><span class="cls_007">LPPK
                Unuja</span></div>
        <div style="position:absolute;left:336.46px;top:487.54px" class="cls_008"><span class="cls_008">Bimble
                Course Lead,</span></div>
        <div style="position:absolute;left:330.58px;top:506.29px" class="cls_008"><span class="cls_008">
                Universitas Nurul Jadid
            </span></div>
    </div>

</body>

</html>
