<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Счет</title>

    <style>
        * {
            font-family: "DejaVu Sans", sans-serif;
        }
        .main {
            width: 978px;
            margin: 0 auto;
            font-size: 17px;
        }
    </style>
</head>
<body>

<div class="main">
    <table width="100%">
        <tr >
            <td style="width: 68%; padding: 20px 0;">
                <div style="text-align: justify; font-size: 11pt;">Внимание! Оплата данного счета означает согласие с условиями поставки товара. Счет действителен в течение 5 (пяти) банковских дней, не считая дня выписки счета.</div>
            </td>
            <td style="width: 32%; text-align: center;">
                @if ($logo_path)
                    <img src="{{$logo_path}}"style="width: 200px; height: auto;">
                @else
                    <img src="https://static.vecteezy.com/system/resources/previews/008/214/517/original/abstract-geometric-logo-or-infinity-line-logo-for-your-company-free-vector.jpg" style="width: 200px; height: auto;">
                @endif
            </td>
        </tr>

    </table>


    <table width="100%" border="2" style="border-collapse: collapse; width: 100%;" cellpadding="2" cellspacing="2">
        <tr style="">
            <td colspan="2" rowspan="2" style="min-height:13mm; width: 105mm;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="height: 13mm;">
                    <tr>
                        <td valign="bottom" style="height: 3mm;">
                            <div style="font-size:10pt;">Банк получателя</div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <div>МОСКОВСКИЙ БАНК ВЫСОКИХ ТЕХНОЛОГИЙ</div>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="min-height:7mm;height:auto; width: 25mm;">
                <div>БИK</div>
            </td>
            <td rowspan="2" style="vertical-align: top; width: 60mm;">
                <div style=" height: 7mm; line-height: 7mm; vertical-align: middle;">0440000000</div>
                <div>404300320203402042304234</div>
            </td>
        </tr>
        <tr>
            <td style="width: 25mm;">
                <div>к/c</div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="min-height:13mm; height:auto;">

                <table border="0" cellpadding="0" cellspacing="0" style="height: 13mm; width: 105mm;">
                    <tr>
                        <td valign="top">
                            <div>ООО "{{ $name }}"</div>
                        </td>
                    </tr>
                </table>

            </td>
            <td rowspan="2" style="min-height:19mm; height:auto; vertical-align: top; width: 25mm;">
                <div>р/c</div>
            </td>
            <td style="min-height:19mm; height:auto; vertical-align: top; width: 60mm;">
                <div>23329423043024320422</div>
            </td>
        </tr>
    </table>
    <br/>

    <div style="font-weight: bold; font-size: 25pt; padding-left:5px;">
                Счет № {{ $invoice_number }} от {{ $date }}</div>
    <br/>

    <div style="background-color:#000000; width:100%; font-size:1px; height:2px;">&nbsp;</div>

    <table width="100%">
        <tr>
            <td style="width: 30mm; vertical-align: top;">
                <div style=" padding-left:2px; ">Поставщик:</div>
            </td>
            <td>
                <div style="font-weight:bold;  padding-left:2px;">
                    ООО "{{ $name }}" ИНН {{ $inn}}, КПП {{ $kpp }}<br>
                    <span style="font-weight: normal;">
{{--                        {{ адрес поставщика }}--}}
                    </span>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 30mm; vertical-align: top;">
                <div style=" padding-left:2px;">Покупатель:</div>
            </td>
            <td>
                <div style="font-weight:bold;  padding-left:2px;">
                    ИП {{ $shopper['fio'] }}, ИНН {{ $shopper['inn'] }}<br><span style="font-weight: normal;">
{{--                        {{ адрес покупателя }}--}}
                    </span>
                </div>
            </td>
        </tr>
    </table>


    <table border="2" width="100%" cellpadding="2" cellspacing="2" style="border-collapse: collapse; width: 100%;">
        <thead>
        <tr>
            <th style="width:13mm; ">№</th>
            <th>Товары (работы, услуги)</th>
            <th style="width:20mm;">Кол-во</th>
            <th style="width:17mm;">Ед.</th>
            <th style="width:27mm;">Цена</th>
            <th style="width:27mm;">Сумма</th>
        </tr>
        </thead>
        <tbody >
        @foreach ($products as $key=>$product)
            <tr>
                <td style="width:13mm;">
                    {{ $key + 1 }}
                </td>
                <td>
                    {{ $product['name'] }}
                </td>
                <td style="width:20mm; white-space: nowrap;">
                    {{ $product['quantity'] }}
                </td>
                <td style="width:17mm;  white-space: nowrap;">
                    шт.
                </td>
                <td style="width:27mm; text-align: center;  white-space: nowrap; ">
                    {{ number_format($product['price'], 2) }}
                </td>
                <td style="width:27mm; text-align: center;  white-space: nowrap;">
                    {{ number_format($product['summ'], 2) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table border="0" width="100%" cellpadding="1" cellspacing="1">
        <tr>
            <td></td>
            <td style="width:37mm; font-weight:bold;  text-align:right;">Всего к оплате:</td>
            <td style="width:27mm; font-weight:bold;  text-align: center; ">
                {{ number_format($total_summ, 2) }} руб.
            </td>
        </tr>
    </table>

    <br />
    <div>
        Всего наименований {{ $total_quantity }} на сумму {{ number_format($total_summ, 2) }} руб.<br />
    </div>
    <hr style="margin-bottom: 25px; margin-top: 25px;">
    <div>
        <div>Руководитель ______________________ </div>
        <br/>  <br /><br />
        <div>Главный бухгалтер ______________________</div>
        <br/>
        <div style="width: 85mm;text-align:center;">М.П.</div><br/>
    </div>
</div>


</body>
</html>
