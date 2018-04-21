<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="{{ public_path('css/bootstrap.css') }}">
        <style>
            *{ 
                font-family: DejaVu Sans !important;
                font-size: 8px !important;
            }
            @page{
                margin: 5px 5px 5px 5px !important;
                padding: 5px 5px 5px 5px !important;
                width: 100% !important; 
                height: 100% !important;
            }
            body{
                margin: 0 0 0 0 !important;
                padding: 0 0 0 0 !important;
                width: 100% !important; 
                height: 100% !important;
            }
            table{ 
                width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            td{
                padding: 0 0 0 0 !important;
                margin: 0 0 0 0 !important;
            }
            th{
                padding: 0 0 0 0 !important;
                margin: 0 0 0 0 !important;
                font-size: 8px !important;
            }
            .fixed {
                max-width: 20px !important;
                min-width: 20px !important;
            }
            .fixed2 {
                max-width: 20px !important;
                min-width: 20px !important;
            }
            .fixed3 {
                max-width: 260px !important;
                min-width: 260px !important;
            }
            p{
                padding: 0 0 0 0 !important;
                margin: 0 0 0 0 !important;
                font-size: 7px !important;
            }
        </style>
    </head>
    <body>
        <p>
            Slovenská technická univerzita Bratislava, Fakulta elektrotechniky a informatiky
        </p>
        <p>
            Pracovisko: Ústav automobilovej mechatroniky
        </p>
        <h5 class="text-center">
            EVIDENCIA DOCHÁDZKY
        </h5>
        <table class="table table-bordered">
                <tr>
                    <td colspan="2">Za mesiac: {{ $mesiace[$mesiac - 1] }} &nbsp; {{ $rok }}</td>
                    <td colspan="44">
                        <p>Vysvetlivky: A - neospravedlnená absencia, D - dovolenka, CH - choroba, O - Ošetrenie člena rodiny, P - prekážky v práci s náhradou mzdy (§138,§140,§141ZP)</p>
                        <p>S - sviatky, Šk - školenie, Sc - služobná cesta, Pv - pracovné voľno s náhradou mzdy, V - Voľno bez náhrady mzdy<p>
                        <p>
                            X - ostatné (súkromné záležitosti a pod.)
                        </p>
                    </td>
                </tr>
                <tr>
                    <td rowspan="3">
                        Os.č.
                    </td>
                    <th rowspan="3" class="fixed3">
                        Priezvisko, meno, titul
                    </th>
                    <td colspan="31">
                        Dni v mesiaci        
                        <td class="text-center">Poč</td>     
                        <td colspan="12">&nbsp;</td>      
                        <tr>
                            @for($i = 1; $i < 32; $i++ )
                                @if(date('N',strtotime($rok.'-'.$mesiac.'-'.$i)) >= 6)
                                    <td class="text-center fixed" style="background-color: lightgray;">@if($i <= $num_days) {{ $i }} @else &nbsp; @endif</td>
                                @else
                                    <td class="text-center fixed">@if($i <= $num_days) {{ $i }} @else &nbsp; @endif</td>
                                @endif
                            @endfor
                            <td class="text-center">odpr.</td>
                            <td colspan="12" class="text-center">Počet neodpracovaných hodín</td>      
                        </tr>
                        <tr>
                            @for($i = 1; $i < 32; $i++ )
                                @if(date('N',strtotime($rok.'-'.$mesiac.'-'.$i)) >= 6)
                                    <td style="background-color: lightgray;">&nbsp;</td>
                                @else
                                    <td>&nbsp;</td>
                                @endif
                            @endfor
                            <td></td>
                            <td class="text-center fixed2">A</td>
                            <td class="text-center fixed2">D</td>
                            <td class="text-center fixed2">CH</td>
                            <td class="text-center fixed2">O</td>
                            <td class="text-center fixed2">P</td>
                            <td class="text-center fixed2">S</td>
                            <td class="text-center fixed2">Šk</td>
                            <td class="text-center fixed2">Sc</td>
                            <td class="text-center fixed2">Pv</td>
                            <td class="text-center fixed2">V</td>
                            <td class="text-center fixed2">X</td>
                            <td class="text-center">Spolu</td>
                        </tr> 
                       
                    </td>
                </tr>
                @foreach($staff as $ks => $s)
                    <tr>
                        <td>&nbsp;</td>
                        <th class="fixed3">{{ $s->title1 }}&nbsp;{{ $s->name }}&nbsp;{{ $s->surname }}&nbsp;{{ $s->title2 }}</th>
                        @for($i = 1; $i < 32; $i++ )
                            @if(date('N',strtotime($rok.'-'.$mesiac.'-'.$i)) >= 6)
                                <td style="background-color: lightgray;">&nbsp;</td>
                            @else
                                @if(isset($s->att['skratky'][$i]))
                                    <td class="text-center fixed" id="{{ $s->s_id }}" style="" >{{ strtoupper($s->att['skratky'][$i]) }}</td>
                                @else
                                    <td class="text-center fixed" id="{{ $s->s_id }}"></td>
                                @endif
                            @endif
                        @endfor
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endforeach
        </table>
        <small style="position:absolute;left:60px;bottom:140px;">
            * skrátený pracovný úväzok
        </small>
        <span style="position:absolute;left:60px;bottom:100px;">
            Vypracoval: Beringerová
        </span>

        <span style="position:absolute;left:600px;bottom:100px;">
            <p>
                dotiahnut z DB 
            </p>
            <p>
                riaditeľ ÚAMT
            </p>
        </span>
                
        
        
    </body>
</html>

