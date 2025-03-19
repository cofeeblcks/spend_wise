<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                "name" => "Afganistán",
                "code" => "AF",
                "phone_code" => "+93",
                "flag" => "🇦🇫"
            ],
            [
                "name" => "Albania",
                "code" => "AL",
                "phone_code" => "+355",
                "flag" => "🇦🇱"
            ],
            [
                "name" => "Alemania",
                "code" => "DE",
                "phone_code" => "+49",
                "flag" => "🇩🇪"
            ],
            [
                "name" => "Andorra",
                "code" => "AD",
                "phone_code" => "+376",
                "flag" => "🇦🇩"
            ],
            [
                "name" => "Angola",
                "code" => "AO",
                "phone_code" => "+244",
                "flag" => "🇦🇴"
            ],
            [
                "name" => "Anguila",
                "code" => "AI",
                "phone_code" => "+1264",
                "flag" => "🇦🇮"
            ],
            [
                "name" => "Antártida",
                "code" => "AQ",
                "phone_code" => "+672",
                "flag" => "🇦🇶"
            ],
            [
                "name" => "Antigua y Barbuda",
                "code" => "AG",
                "phone_code" => "+1268",
                "flag" => "🇦🇬"
            ],
            [
                "name" => "Antillas Holandesas",
                "code" => "AN",
                "phone_code" => "+599",
                "flag" => "🇧🇶"
            ],
            [
                "name" => "Arabia Saudita",
                "code" => "SA",
                "phone_code" => "+966",
                "flag" => "🇸🇦"
            ],
            [
                "name" => "Argelia",
                "code" => "DZ",
                "phone_code" => "+213",
                "flag" => "🇩🇿"
            ],
            [
                "name" => "Argentina",
                "code" => "AR",
                "phone_code" => "+54",
                "flag" => "🇦🇷"
            ],
            [
                "name" => "Armenia",
                "code" => "AM",
                "phone_code" => "+374",
                "flag" => "🇦🇲"
            ],
            [
                "name" => "Aruba",
                "code" => "AW",
                "phone_code" => "+297",
                "flag" => "🇦🇼"
            ],
            [
                "name" => "Australia",
                "code" => "AU",
                "phone_code" => "+61",
                "flag" => "🇦🇺"
            ],
            [
                "name" => "Austria",
                "code" => "AT",
                "phone_code" => "+43",
                "flag" => "🇦🇹"
            ],
            [
                "name" => "Azerbaiyán",
                "code" => "AZ",
                "phone_code" => "+994",
                "flag" => "🇦🇿"
            ],
            [
                "name" => "Bahamas",
                "code" => "BS",
                "phone_code" => "+1242",
                "flag" => "🇧🇸"
            ],
            [
                "name" => "Bahrein",
                "code" => "BH",
                "phone_code" => "+973",
                "flag" => "🇧🇭"
            ],
            [
                "name" => "Bangladesh",
                "code" => "BD",
                "phone_code" => "+880",
                "flag" => "🇧🇩"
            ],
            [
                "name" => "Barbados",
                "code" => "BB",
                "phone_code" => "+1246",
                "flag" => "🇧🇧"
            ],
            [
                "name" => "Bélgica",
                "code" => "BE",
                "phone_code" => "+32",
                "flag" => "🇧🇪"
            ],
            [
                "name" => "Belice",
                "code" => "BZ",
                "phone_code" => "+501",
                "flag" => "🇧🇿"
            ],
            [
                "name" => "Benín",
                "code" => "BJ",
                "phone_code" => "+229",
                "flag" => "🇧🇯"
            ],
            [
                "name" => "Bhután",
                "code" => "BT",
                "phone_code" => "+975",
                "flag" => "🇧🇹"
            ],
            [
                "name" => "Bielorrusia",
                "code" => "BY",
                "phone_code" => "+375",
                "flag" => "🇧🇾"
            ],
            [
                "name" => "Birmania",
                "code" => "MM",
                "phone_code" => "+95",
                "flag" => "🇲🇲"
            ],
            [
                "name" => "Bolivia",
                "code" => "BO",
                "phone_code" => "+591",
                "flag" => "🇧🇴"
            ],
            [
                "name" => "Bosnia y Herzegovina",
                "code" => "BA",
                "phone_code" => "+387",
                "flag" => "🇧🇦"
            ],
            [
                "name" => "Botsuana",
                "code" => "BW",
                "phone_code" => "+267",
                "flag" => "🇧🇼"
            ],
            [
                "name" => "Brasil",
                "code" => "BR",
                "phone_code" => "+55",
                "flag" => "🇧🇷"
            ],
            [
                "name" => "Brunéi",
                "code" => "BN",
                "phone_code" => "+673",
                "flag" => "🇧🇳"
            ],
            [
                "name" => "Bulgaria",
                "code" => "BG",
                "phone_code" => "+359",
                "flag" => "🇧🇬"
            ],
            [
                "name" => "Burkina Faso",
                "code" => "BF",
                "phone_code" => "+226",
                "flag" => "🇧🇫"
            ],
            [
                "name" => "Burundi",
                "code" => "BI",
                "phone_code" => "+257",
                "flag" => "🇧🇮"
            ],
            [
                "name" => "Cabo Verde",
                "code" => "CV",
                "phone_code" => "+238",
                "flag" => "🇨🇻"
            ],
            [
                "name" => "Camboya",
                "code" => "KH",
                "phone_code" => "+855",
                "flag" => "🇰🇭"
            ],
            [
                "name" => "Camerún",
                "code" => "CM",
                "phone_code" => "+237",
                "flag" => "🇨🇲"
            ],
            [
                "name" => "Canadá",
                "code" => "CA",
                "phone_code" => "+1",
                "flag" => "🇨🇦"
            ],
            [
                "name" => "Chad",
                "code" => "TD",
                "phone_code" => "+235",
                "flag" => "🇹🇩"
            ],
            [
                "name" => "Chile",
                "code" => "CL",
                "phone_code" => "+56",
                "flag" => "🇨🇱"
            ],
            [
                "name" => "China",
                "code" => "CN",
                "phone_code" => "+86",
                "flag" => "🇨🇳"
            ],
            [
                "name" => "Chipre",
                "code" => "CY",
                "phone_code" => "+357",
                "flag" => "🇨🇾"
            ],
            [
                "name" => "Ciudad del Vaticano",
                "code" => "VA",
                "phone_code" => "+379",
                "flag" => "🇻🇦"
            ],
            [
                "name" => "Colombia",
                "code" => "CO",
                "phone_code" => "+57",
                "flag" => "🇨🇴"
            ],
            [
                "name" => "Comoras",
                "code" => "KM",
                "phone_code" => "+269",
                "flag" => "🇰🇲"
            ],
            [
                "name" => "Corea del Norte",
                "code" => "KP",
                "phone_code" => "+850",
                "flag" => "🇰🇵"
            ],
            [
                "name" => "Corea del Sur",
                "code" => "KR",
                "phone_code" => "+82",
                "flag" => "🇰🇷"
            ],
            [
                "name" => "Costa de Marfil",
                "code" => "CI",
                "phone_code" => "+225",
                "flag" => "🇨🇮"
            ],
            [
                "name" => "Costa Rica",
                "code" => "CR",
                "phone_code" => "+506",
                "flag" => "🇨🇷"
            ],
            [
                "name" => "Croacia",
                "code" => "HR",
                "phone_code" => "+385",
                "flag" => "🇭🇷"
            ],
            [
                "name" => "Cuba",
                "code" => "CU",
                "phone_code" => "+53",
                "flag" => "🇨🇺"
            ],
            [
                "name" => "Dinamarca",
                "code" => "DK",
                "phone_code" => "+45",
                "flag" => "🇩🇰"
            ],
            [
                "name" => "Dominica",
                "code" => "DM",
                "phone_code" => "+1767",
                "flag" => "🇩🇲"
            ],
            [
                "name" => "Ecuador",
                "code" => "EC",
                "phone_code" => "+593",
                "flag" => "🇪🇨"
            ],
            [
                "name" => "Egipto",
                "code" => "EG",
                "phone_code" => "+20",
                "flag" => "🇪🇬"
            ],
            [
                "name" => "El Salvador",
                "code" => "SV",
                "phone_code" => "+503",
                "flag" => "🇸🇻"
            ],
            [
                "name" => "Emiratos Árabes Unidos",
                "code" => "AE",
                "phone_code" => "+971",
                "flag" => "🇦🇪"
            ],
            [
                "name" => "Eritrea",
                "code" => "ER",
                "phone_code" => "+291",
                "flag" => "🇪🇷"
            ],
            [
                "name" => "Eslovaquia",
                "code" => "SK",
                "phone_code" => "+421",
                "flag" => "🇸🇰"
            ],
            [
                "name" => "Eslovenia",
                "code" => "SI",
                "phone_code" => "+386",
                "flag" => "🇸🇮"
            ],
            [
                "name" => "España",
                "code" => "ES",
                "phone_code" => "+34",
                "flag" => "🇪🇸"
            ],
            [
                "name" => "Estados Unidos de América",
                "code" => "US",
                "phone_code" => "+1",
                "flag" => "🇺🇸"
            ],
            [
                "name" => "Estonia",
                "code" => "EE",
                "phone_code" => "+372",
                "flag" => "🇪🇪"
            ],
            [
                "name" => "Etiopía",
                "code" => "ET",
                "phone_code" => "+251",
                "flag" => "🇪🇹"
            ],
            [
                "name" => "Filipinas",
                "code" => "PH",
                "phone_code" => "+63",
                "flag" => "🇵🇭"
            ],
            [
                "name" => "Finlandia",
                "code" => "FI",
                "phone_code" => "+358",
                "flag" => "🇫🇮"
            ],
            [
                "name" => "Fiyi",
                "code" => "FJ",
                "phone_code" => "+679",
                "flag" => "🇫🇯"
            ],
            [
                "name" => "Francia",
                "code" => "FR",
                "phone_code" => "+33",
                "flag" => "🇫🇷"
            ],
            [
                "name" => "Gabón",
                "code" => "GA",
                "phone_code" => "+241",
                "flag" => "🇬🇦"
            ],
            [
                "name" => "Gambia",
                "code" => "GM",
                "phone_code" => "+220",
                "flag" => "🇬🇲"
            ],
            [
                "name" => "Georgia",
                "code" => "GE",
                "phone_code" => "+995",
                "flag" => "🇬🇪"
            ],
            [
                "name" => "Ghana",
                "code" => "GH",
                "phone_code" => "+233",
                "flag" => "🇬🇭"
            ],
            [
                "name" => "Gibraltar",
                "code" => "GI",
                "phone_code" => "+350",
                "flag" => "🇬🇮"
            ],
            [
                "name" => "Granada",
                "code" => "GD",
                "phone_code" => "+1473",
                "flag" => "🇬🇩"
            ],
            [
                "name" => "Grecia",
                "code" => "GR",
                "phone_code" => "+30",
                "flag" => "🇬🇷"
            ],
            [
                "name" => "Groenlandia",
                "code" => "GL",
                "phone_code" => "+299",
                "flag" => "🇬🇱"
            ],
            [
                "name" => "Guadalupe",
                "code" => "GP",
                "phone_code" => "+590",
                "flag" => "🇬🇵"
            ],
            [
                "name" => "Guam",
                "code" => "GU",
                "phone_code" => "+1671",
                "flag" => "🇬🇺"
            ],
            [
                "name" => "Guatemala",
                "code" => "GT",
                "phone_code" => "+502",
                "flag" => "🇬🇹"
            ],
            [
                "name" => "Guayana Francesa",
                "code" => "GF",
                "phone_code" => "+594",
                "flag" => "🇬🇫"
            ],
            [
                "name" => "Guernsey",
                "code" => "GG",
                "phone_code" => "+44",
                "flag" => "🇬🇬"
            ],
            [
                "name" => "Guinea",
                "code" => "GN",
                "phone_code" => "+224",
                "flag" => "🇬🇳"
            ],
            [
                "name" => "Guinea Ecuatorial",
                "code" => "GQ",
                "phone_code" => "+240",
                "flag" => "🇬🇶"
            ],
            [
                "name" => "Guinea-Bissau",
                "code" => "GW",
                "phone_code" => "+245",
                "flag" => "🇬🇼"
            ],
            [
                "name" => "Guyana",
                "code" => "GY",
                "phone_code" => "+595",
                "flag" => "🇬🇾"
            ],
            [
                "name" => "Haití",
                "code" => "HT",
                "phone_code" => "+509",
                "flag" => "🇭🇹"
            ],
            [
                "name" => "Honduras",
                "code" => "HN",
                "phone_code" => "+504",
                "flag" => "🇭🇳"
            ],
            [
                "name" => "Hong kong",
                "code" => "HK",
                "phone_code" => "+852",
                "flag" => "🇭🇰"
            ],
            [
                "name" => "Hungría",
                "code" => "HU",
                "phone_code" => "+36",
                "flag" => "🇭🇺"
            ],
            [
                "name" => "India",
                "code" => "IN",
                "phone_code" => "+91",
                "flag" => "🇮🇳"
            ],
            [
                "name" => "Indonesia",
                "code" => "ID",
                "phone_code" => "+62",
                "flag" => "🇮🇩"
            ],
            [
                "name" => "Irak",
                "code" => "IQ",
                "phone_code" => "+964",
                "flag" => "🇮🇷"
            ],
            [
                "name" => "Irán",
                "code" => "IR",
                "phone_code" => "+98",
                "flag" => "🇮🇷"
            ],
            [
                "name" => "Irlanda",
                "code" => "IE",
                "phone_code" => "+353",
                "flag" => "🇮🇪"
            ],
            [
                "name" => "Isla de Man",
                "code" => "IM",
                "phone_code" => "+44",
                "flag" => "🇮🇲"
            ],
            [
                "name" => "Isla de Navidad",
                "code" => "CX",
                "phone_code" => "+61",
                "flag" => "🇨🇽"
            ],
            [
                "name" => "Isla Norfolk",
                "code" => "NF",
                "phone_code" => "+672",
                "flag" => "🇳🇫"
            ],
            [
                "name" => "Islandia",
                "code" => "IS",
                "phone_code" => "+354",
                "flag" => "🇮🇸"
            ],
            [
                "name" => "Islas Bermudas",
                "code" => "BM",
                "phone_code" => "+1441",
                "flag" => "🇧🇲"
            ],
            [
                "name" => "Islas Caimán",
                "code" => "KY",
                "phone_code" => "+345",
                "flag" => "🇰🇾"
            ],
            [
                "name" => "Islas Cocos (Keeling)",
                "code" => "CC",
                "phone_code" => "+61",
                "flag" => "🇨🇨"
            ],
            [
                "name" => "Islas Cook",
                "code" => "CK",
                "phone_code" => "+682",
                "flag" => "🇨🇰"
            ],
            [
                "name" => "Islas de Åland",
                "code" => "AX",
                "phone_code" => "+358",
                "flag" => "🇦🇽"
            ],
            [
                "name" => "Islas Feroe",
                "code" => "FO",
                "phone_code" => "+298",
                "flag" => "🇫🇴"
            ],
            [
                "name" => "Islas Georgias del Sur y Sandwich del Sur",
                "code" => "GS",
                "phone_code" => "+500",
                "flag" => "🇬🇸"
            ],
            [
                "name" => "Islas Maldivas",
                "code" => "MV",
                "phone_code" => "+960",
                "flag" => "🇲🇻"
            ],
            [
                "name" => "Islas Malvinas",
                "code" => "FK",
                "phone_code" => "+500",
                "flag" => "🇫🇰"
            ],
            [
                "name" => "Islas Marianas del Norte",
                "code" => "MP",
                "phone_code" => "+1670",
                "flag" => "🇲🇵"
            ],
            [
                "name" => "Islas Marshall",
                "code" => "MH",
                "phone_code" => "+692",
                "flag" => "🇲🇭"
            ],
            [
                "name" => "Islas Pitcairn",
                "code" => "PN",
                "phone_code" => "+872",
                "flag" => "🇵🇳"
            ],
            [
                "name" => "Islas Salomón",
                "code" => "SB",
                "phone_code" => "+677",
                "flag" => "🇸🇧"
            ],
            [
                "name" => "Islas Turcas y Caicos",
                "code" => "TC",
                "phone_code" => "+1649",
                "flag" => "🇹🇨"
            ],
            [
                "name" => "Islas Vírgenes Británicas",
                "code" => "VG",
                "phone_code" => "+1284",
                "flag" => "🇻🇬"
            ],
            [
                "name" => "Islas Vírgenes de los Estados Unidos",
                "code" => "VI",
                "phone_code" => "+1340",
                "flag" => "🇻🇮"
            ],
            [
                "name" => "Israel",
                "code" => "IL",
                "phone_code" => "+972",
                "flag" => "🇮🇱"
            ],
            [
                "name" => "Italia",
                "code" => "IT",
                "phone_code" => "+39",
                "flag" => "🇮🇹"
            ],
            [
                "name" => "Jamaica",
                "code" => "JM",
                "phone_code" => "+1876",
                "flag" => "🇯🇲"
            ],
            [
                "name" => "Japón",
                "code" => "JP",
                "phone_code" => "+81",
                "flag" => "🇯🇵"
            ],
            [
                "name" => "Jersey",
                "code" => "JE",
                "phone_code" => "+44",
                "flag" => "🇯🇪"
            ],
            [
                "name" => "Jordania",
                "code" => "JO",
                "phone_code" => "+962",
                "flag" => "🇯🇴"
            ],
            [
                "name" => "Kazajistán",
                "code" => "KZ",
                "phone_code" => "+77",
                "flag" => "🇰🇿"
            ],
            [
                "name" => "Kenia",
                "code" => "KE",
                "phone_code" => "+254",
                "flag" => "🇰🇪"
            ],
            [
                "name" => "Kirguistán",
                "code" => "KG",
                "phone_code" => "+996",
                "flag" => "🇰🇬"
            ],
            [
                "name" => "Kiribati",
                "code" => "KI",
                "phone_code" => "+686",
                "flag" => "🇰🇮"
            ],
            [
                "name" => "Kuwait",
                "code" => "KW",
                "phone_code" => "+965",
                "flag" => "🇰🇼"
            ],
            [
                "name" => "Laos",
                "code" => "LA",
                "phone_code" => "+856",
                "flag" => "🇱🇦"
            ],
            [
                "name" => "Lesoto",
                "code" => "LS",
                "phone_code" => "+266",
                "flag" => "🇱🇸"
            ],
            [
                "name" => "Letonia",
                "code" => "LV",
                "phone_code" => "+371",
                "flag" => "🇱🇻"
            ],
            [
                "name" => "Líbano",
                "code" => "LB",
                "phone_code" => "+961",
                "flag" => "🇱🇧"
            ],
            [
                "name" => "Liberia",
                "code" => "LR",
                "phone_code" => "+231",
                "flag" => "🇱🇷"
            ],
            [
                "name" => "Libia",
                "code" => "LY",
                "phone_code" => "+218",
                "flag" => "🇱🇾"
            ],
            [
                "name" => "Liechtenstein",
                "code" => "LI",
                "phone_code" => "+423",
                "flag" => "🇱🇮"
            ],
            [
                "name" => "Lituania",
                "code" => "LT",
                "phone_code" => "+370",
                "flag" => "🇱🇹"
            ],
            [
                "name" => "Luxemburgo",
                "code" => "LU",
                "phone_code" => "+352",
                "flag" => "🇱🇺"
            ],
            [
                "name" => "Macao",
                "code" => "MO",
                "phone_code" => "+853",
                "flag" => "🇲🇴"
            ],
            [
                "name" => "Macedonia del Norte",
                "code" => "MK",
                "phone_code" => "+389",
                "flag" => "🇲🇰"
            ],
            [
                "name" => "Madagascar",
                "code" => "MG",
                "phone_code" => "+261",
                "flag" => "🇲🇬"
            ],
            [
                "name" => "Malasia",
                "code" => "MY",
                "phone_code" => "+60",
                "flag" => "🇲🇾"
            ],
            [
                "name" => "Malawi",
                "code" => "MW",
                "phone_code" => "+265",
                "flag" => "🇲🇼"
            ],
            [
                "name" => "Mali",
                "code" => "ML",
                "phone_code" => "+223",
                "flag" => "🇲🇱"
            ],
            [
                "name" => "Malta",
                "code" => "MT",
                "phone_code" => "+356",
                "flag" => "🇲🇹"
            ],
            [
                "name" => "Marruecos",
                "code" => "MA",
                "phone_code" => "+212",
                "flag" => "🇲🇦"
            ],
            [
                "name" => "Martinica",
                "code" => "MQ",
                "phone_code" => "+596",
                "flag" => "🇲🇶"
            ],
            [
                "name" => "Mauricio",
                "code" => "MU",
                "phone_code" => "+230",
                "flag" => "🇲🇺"
            ],
            [
                "name" => "Mauritania",
                "code" => "MR",
                "phone_code" => "+222",
                "flag" => "🇲🇷"
            ],
            [
                "name" => "Mayotte",
                "code" => "YT",
                "phone_code" => "+262",
                "flag" => "🇾🇹"
            ],
            [
                "name" => "México",
                "code" => "MX",
                "phone_code" => "+52",
                "flag" => "🇲🇽"
            ],
            [
                "name" => "Micronesia",
                "code" => "FM",
                "phone_code" => "+691",
                "flag" => "🇫🇲"
            ],
            [
                "name" => "Moldavia",
                "code" => "MD",
                "phone_code" => "+373",
                "flag" => "🇲🇩"
            ],
            [
                "name" => "Mónaco",
                "code" => "MC",
                "phone_code" => "+377",
                "flag" => "🇲🇨"
            ],
            [
                "name" => "Mongolia",
                "code" => "MN",
                "phone_code" => "+976",
                "flag" => "🇲🇳"
            ],
            [
                "name" => "Montenegro",
                "code" => "ME",
                "phone_code" => "+382",
                "flag" => "🇲🇪"
            ],
            [
                "name" => "Montserrat",
                "code" => "MS",
                "phone_code" => "+1664",
                "flag" => "🇲🇸"
            ],
            [
                "name" => "Mozambique",
                "code" => "MZ",
                "phone_code" => "+258",
                "flag" => "🇲🇿"
            ],
            [
                "name" => "Namibia",
                "code" => "NA",
                "phone_code" => "+264",
                "flag" => "🇳🇦"
            ],
            [
                "name" => "Nauru",
                "code" => "NR",
                "phone_code" => "+674",
                "flag" => "🇳🇷"
            ],
            [
                "name" => "Nepal",
                "code" => "NP",
                "phone_code" => "+977",
                "flag" => "🇳🇵"
            ],
            [
                "name" => "Nicaragua",
                "code" => "NI",
                "phone_code" => "+505",
                "flag" => "🇳🇮"
            ],
            [
                "name" => "Niger",
                "code" => "NE",
                "phone_code" => "+227",
                "flag" => "🇳🇪"
            ],
            [
                "name" => "Nigeria",
                "code" => "NG",
                "phone_code" => "+234",
                "flag" => "🇳🇬"
            ],
            [
                "name" => "Niue",
                "code" => "NU",
                "phone_code" => "+683",
                "flag" => "🇳🇺"
            ],
            [
                "name" => "Noruega",
                "code" => "NO",
                "phone_code" => "+47",
                "flag" => "🇳🇴"
            ],
            [
                "name" => "Nueva Caledonia",
                "code" => "NC",
                "phone_code" => "+687",
                "flag" => "🇳🇨"
            ],
            [
                "name" => "Nueva Zelanda",
                "code" => "NZ",
                "phone_code" => "+64",
                "flag" => "🇳🇿"
            ],
            [
                "name" => "Omán",
                "code" => "OM",
                "phone_code" => "+968",
                "flag" => "🇴🇲"
            ],
            [
                "name" => "Países Bajos",
                "code" => "NL",
                "phone_code" => "+31",
                "flag" => "🇳🇱"
            ],
            [
                "name" => "Pakistán",
                "code" => "PK",
                "phone_code" => "+92",
                "flag" => "🇵🇰"
            ],
            [
                "name" => "Palau",
                "code" => "PW",
                "phone_code" => "+680",
                "flag" => "🇵🇼"
            ],
            [
                "name" => "Palestina",
                "code" => "PS",
                "phone_code" => "+970",
                "flag" => "🇵🇸"
            ],
            [
                "name" => "Panamá",
                "code" => "PA",
                "phone_code" => "+507",
                "flag" => "🇵🇦"
            ],
            [
                "name" => "Papúa Nueva Guinea",
                "code" => "PG",
                "phone_code" => "+675",
                "flag" => "🇵🇬"
            ],
            [
                "name" => "Paraguay",
                "code" => "PY",
                "phone_code" => "+595",
                "flag" => "🇵🇾"
            ],
            [
                "name" => "Perú",
                "code" => "PE",
                "phone_code" => "+51",
                "flag" => "🇵🇪"
            ],
            [
                "name" => "Polinesia Francesa",
                "code" => "PF",
                "phone_code" => "+689",
                "flag" => "🇵🇫"
            ],
            [
                "name" => "Polonia",
                "code" => "PL",
                "phone_code" => "+48",
                "flag" => "🇵🇱"
            ],
            [
                "name" => "Portugal",
                "code" => "PT",
                "phone_code" => "+351",
                "flag" => "🇵🇹"
            ],
            [
                "name" => "Puerto Rico",
                "code" => "PR",
                "phone_code" => "+1939",
                "flag" => "🇵🇷"
            ],
            [
                "name" => "Qatar",
                "code" => "QA",
                "phone_code" => "+974",
                "flag" => "🇶🇦"
            ],
            [
                "name" => "Reino Unido",
                "code" => "GB",
                "phone_code" => "+44",
                "flag" => "🇬🇧"
            ],
            [
                "name" => "República Centroafricana",
                "code" => "CF",
                "phone_code" => "+236",
                "flag" => "🇨🇫"
            ],
            [
                "name" => "República Checa",
                "code" => "CZ",
                "phone_code" => "+420",
                "flag" => "🇨🇿"
            ],
            [
                "name" => "República de Sudán del Sur",
                "code" => "SS",
                "phone_code" => "+211",
                "flag" => "🇸🇸"
            ],
            [
                "name" => "República del Congo",
                "code" => "CG",
                "phone_code" => "+242",
                "flag" => "🇨🇬"
            ],
            [
                "name" => "República Democrática del Congo",
                "code" => "CD",
                "phone_code" => "+243",
                "flag" => "🇨🇩"
            ],
            [
                "name" => "República Dominicana",
                "code" => "DO",
                "phone_code" => "+1849",
                "flag" => "🇩🇴"
            ],
            [
                "name" => "Reunión",
                "code" => "RE",
                "phone_code" => "+262",
                "flag" => "🇷🇪"
            ],
            [
                "name" => "Ruanda",
                "code" => "RW",
                "phone_code" => "+250",
                "flag" => "🇷🇼"
            ],
            [
                "name" => "Rumanía",
                "code" => "RO",
                "phone_code" => "+40",
                "flag" => "🇷🇴"
            ],
            [
                "name" => "Rusia",
                "code" => "RU",
                "phone_code" => "+7",
                "flag" => "🇷🇺"
            ],
            [
                "name" => "Samoa",
                "code" => "WS",
                "phone_code" => "+685",
                "flag" => "🇼🇸"
            ],
            [
                "name" => "Samoa Americana",
                "code" => "AS",
                "phone_code" => "+1684",
                "flag" => "🇦🇸"
            ],
            [
                "name" => "San Bartolomé",
                "code" => "BL",
                "phone_code" => "+590",
                "flag" => "🇧🇱"
            ],
            [
                "name" => "San Cristóbal y Nieves",
                "code" => "KN",
                "phone_code" => "+1869",
                "flag" => "🇰🇳"
            ],
            [
                "name" => "San Marino",
                "code" => "SM",
                "phone_code" => "+378",
                "flag" => "🇸🇲"
            ],
            [
                "name" => "San Martín (Francia)",
                "code" => "MF",
                "phone_code" => "+590",
                "flag" => "🇲🇫"
            ],
            [
                "name" => "San Pedro y Miquelón",
                "code" => "PM",
                "phone_code" => "+508",
                "flag" => "🇵🇲"
            ],
            [
                "name" => "San Vicente y las Granadinas",
                "code" => "VC",
                "phone_code" => "+1784",
                "flag" => "🇻🇨"
            ],
            [
                "name" => "Santa Elena",
                "code" => "SH",
                "phone_code" => "+290",
                "flag" => "🇸🇭"
            ],
            [
                "name" => "Santa Lucía",
                "code" => "LC",
                "phone_code" => "+1758",
                "flag" => "🇱🇨"
            ],
            [
                "name" => "Santo Tomé y Príncipe",
                "code" => "ST",
                "phone_code" => "+239",
                "flag" => "🇸🇹"
            ],
            [
                "name" => "Senegal",
                "code" => "SN",
                "phone_code" => "+221",
                "flag" => "🇸🇳"
            ],
            [
                "name" => "Serbia",
                "code" => "RS",
                "phone_code" => "+381",
                "flag" => "🇷🇸"
            ],
            [
                "name" => "Seychelles",
                "code" => "SC",
                "phone_code" => "+248",
                "flag" => "🇸🇨"
            ],
            [
                "name" => "Sierra Leona",
                "code" => "SL",
                "phone_code" => "+232",
                "flag" => "🇸🇱"
            ],
            [
                "name" => "Singapur",
                "code" => "SG",
                "phone_code" => "+65",
                "flag" => "🇸🇬"
            ],
            [
                "name" => "Siria",
                "code" => "SY",
                "phone_code" => "+963",
                "flag" => "🇸🇾"
            ],
            [
                "name" => "Somalia",
                "code" => "SO",
                "phone_code" => "+252",
                "flag" => "🇸🇴"
            ],
            [
                "name" => "Sri lanka",
                "code" => "LK",
                "phone_code" => "+94",
                "flag" => "🇱🇰"
            ],
            [
                "name" => "Sudáfrica",
                "code" => "ZA",
                "phone_code" => "+27",
                "flag" => "🇿🇦"
            ],
            [
                "name" => "Sudán",
                "code" => "SD",
                "phone_code" => "+249",
                "flag" => "🇸🇩"
            ],
            [
                "name" => "Suecia",
                "code" => "SE",
                "phone_code" => "+46",
                "flag" => "🇸🇪"
            ],
            [
                "name" => "Suiza",
                "code" => "CH",
                "phone_code" => "+41",
                "flag" => "🇨🇭"
            ],
            [
                "name" => "Surinám",
                "code" => "SR",
                "phone_code" => "+597",
                "flag" => "🇸🇷"
            ],
            [
                "name" => "Svalbard y Jan Mayen",
                "code" => "SJ",
                "phone_code" => "+47",
                "flag" => "🇸🇯"
            ],
            [
                "name" => "Swazilandia",
                "code" => "SZ",
                "phone_code" => "+268",
                "flag" => "🇸🇿"
            ],
            [
                "name" => "Tailandia",
                "code" => "TH",
                "phone_code" => "+66",
                "flag" => "🇹🇭"
            ],
            [
                "name" => "Taiwán",
                "code" => "TW",
                "phone_code" => "+886",
                "flag" => "🇹🇼"
            ],
            [
                "name" => "Tanzania",
                "code" => "TZ",
                "phone_code" => "+255",
                "flag" => "🇹🇿"
            ],
            [
                "name" => "Tayikistán",
                "code" => "TJ",
                "phone_code" => "+992",
                "flag" => "🇹🇯"
            ],
            [
                "name" => "Territorio Británico del Océano Índico",
                "code" => "IO",
                "phone_code" => "+246",
                "flag" => "🇮🇴"
            ],
            [
                "name" => "Timor Oriental",
                "code" => "TL",
                "phone_code" => "+670",
                "flag" => "🇹🇱"
            ],
            [
                "name" => "Togo",
                "code" => "TG",
                "phone_code" => "+228",
                "flag" => "🇹🇬"
            ],
            [
                "name" => "Tokelau",
                "code" => "TK",
                "phone_code" => "+690",
                "flag" => "🇹🇰"
            ],
            [
                "name" => "Tonga",
                "code" => "TO",
                "phone_code" => "+676",
                "flag" => "🇹🇴"
            ],
            [
                "name" => "Trinidad y Tobago",
                "code" => "TT",
                "phone_code" => "+1868",
                "flag" => "🇹🇹"
            ],
            [
                "name" => "Tunez",
                "code" => "TN",
                "phone_code" => "+216",
                "flag" => "🇹🇳"
            ],
            [
                "name" => "Turkmenistán",
                "code" => "TM",
                "phone_code" => "+993",
                "flag" => "🇹🇲"
            ],
            [
                "name" => "Turquía",
                "code" => "TR",
                "phone_code" => "+90",
                "flag" => "🇹🇷"
            ],
            [
                "name" => "Tuvalu",
                "code" => "TV",
                "phone_code" => "+688",
                "flag" => "🇹🇻"
            ],
            [
                "name" => "Ucrania",
                "code" => "UA",
                "phone_code" => "+380",
                "flag" => "🇺🇦"
            ],
            [
                "name" => "Uganda",
                "code" => "UG",
                "phone_code" => "+256",
                "flag" => "🇺🇬"
            ],
            [
                "name" => "Uruguay",
                "code" => "UY",
                "phone_code" => "+598",
                "flag" => "🇺🇾"
            ],
            [
                "name" => "Uzbekistán",
                "code" => "UZ",
                "phone_code" => "+998",
                "flag" => "🇺🇿"
            ],
            [
                "name" => "Vanuatu",
                "code" => "VU",
                "phone_code" => "+678",
                "flag" => "🇻🇺"
            ],
            [
                "name" => "Venezuela",
                "code" => "VE",
                "phone_code" => "+58",
                "flag" => "🇻🇪"
            ],
            [
                "name" => "Vietnam",
                "code" => "VN",
                "phone_code" => "+84",
                "flag" => "🇻🇳"
            ],
            [
                "name" => "Wallis y Futuna",
                "code" => "WF",
                "phone_code" => "+681",
                "flag" => "🇼🇫"
            ],
            [
                "name" => "Yemen",
                "code" => "YE",
                "phone_code" => "+967",
                "flag" => "🇾🇪"
            ],
            [
                "name" => "Yibuti",
                "code" => "DJ",
                "phone_code" => "+253",
                "flag" => "🇩🇯"
            ],
            [
                "name" => "Zambia",
                "code" => "ZM",
                "phone_code" => "+260",
                "flag" => "🇿🇲"
            ],
            [
                "name" => "Zimbabue",
                "code" => "ZW",
                "phone_code" => "+263",
                "flag" => "🇿🇼"
            ],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
