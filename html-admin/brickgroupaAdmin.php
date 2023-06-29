<!DOCTYPE html>
<html>

<head>
  <?php
    header("Content-type: text/html; charset:UTF-8");
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>repl.it</title>
  <!-- <link href="css/stylea.css" rel="stylesheet" type="text/css" /> -->
  <?php
    //makes this functionally a css document that happens to be able to run php code
    header("Content-type: text/html; charset: UTF-8");
    //connection variables
    $servername = "localhost";
    $dbname = "manchester_veterans_memorial_database";
    $uname = "phpmyadmin";
    $psword = "Y4VnqfDCz2vvMkv";
    //variables actually needed for the css
    $brickNum = (isset($_REQUEST['brickNum']) ? $_REQUEST['brickNum'] : null);
    $gridTemplateAreasId = (isset($_REQUEST['gridTemplateAreasId']) ? $_REQUEST['gridTemplateAreasId'] : null);
    $p = '"';

    try {
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $uname, $psword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety
        $stmt = null;
        $stmt = $conn->prepare("SELECT gridTemplateAreasId FROM a_brick_group");
        // $stmt->bindParam(1, $brickNum, PDO::PARAM_INT, 3);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  ?>
  <script src="js/brickclicked.js"></script>
</head>
<body>
  <style>
    body {
    margin: 0px;
    background-color: orange;
    }

    .mainBody{
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    min-height: 75%;
    }

    .wrapper {
    --frame-max-height: 40rem;
    --frame-ratio-w: 7;
    --frame-ratio-h: 6;
    background-color: orange;
    width: 100%;
    height: 100%;
    max-width: 100%;
    max-height: var(--frame-max-height);
    margin: 0 auto;
    }

    .bodyFrame {
        /* Padding is width/height, since % padding is based off the element's width */
        --ratio: calc(var(--frame-ratio-h, 1) / var(--frame-ratio-w, 1) * 100%);
        /**
        * The height of the frame is either the calculated padding value, or a maximum
        * passed in (using --frame-max-height). This effectively clamps the height.echo
        */
        --frame-height: min(var(--ratio), var(--frame-max-height));
        position: relative;
        padding-bottom: var(--frame-height);
        /** 
        * The width should be 100% where possible, but should maintain aspect ratio
        * first and foremost. In order to do so we can take the calculated height
        * and reverse engineer the width.
        */
        width: min(calc(var(--frame-height, 0) * (var(--frame-ratio-w) / var(--frame-ratio-h))), 100%);
        height: 0;
        
        /**
        * Irrelevant
        */
        background-color: orange;
        margin: 0 auto;
    }

    .gridParent{
    width: 100%;
    height: 100%;
    position: absolute;
    }

    .parent {
    display: grid;
    grid-template-columns: repeat(18, 1fr);
    grid-template-rows: repeat(21, 1fr);
    grid-column-gap: 0px;
    grid-row-gap: 0px;
    width: inherit;
    height: inherit;
    padding: 0px; 
    margin: 0px;
    
    /*MODULAR INTERFACE WORKS!!!!*/
    grid-template-areas: 
    <?php echo($p . $result[0] . ' ' .$result[1] . ' ' .$result[2] . ' ' .$result[3] . ' ' .$result[4] . ' ' .$result[5] . ' ' .$result[6] . ' ' .$result[7] . ' ' .$result[8] . ' ' .$result[9] . ' ' .$result[10] . ' ' .$result[11] . ' ' .$result[12] . ' ' .$result[13] . ' ' .$result[14] . ' ' .$result[15] . ' ' .$result[16] . ' ' .$result[17] . $p);?>
    <?php echo($p . $result[18] . ' ' .$result[19] . ' ' .$result[20] . ' ' .$result[21] . ' ' .$result[22] . ' ' .$result[23] . ' ' .$result[24] . ' ' .$result[25] . ' ' .$result[26] . ' ' .$result[27] . ' ' .$result[28] . ' ' .$result[29] . ' ' .$result[30] . ' ' .$result[31] . ' ' .$result[32] . ' ' .$result[33] . ' ' .$result[34] . ' ' .$result[35] . $p);?>
    <?php echo($p . $result[36] . ' ' .$result[37] . ' ' .$result[38] . ' ' .$result[39] . ' ' .$result[40] . ' ' .$result[41] . ' ' .$result[42] . ' ' .$result[43] . ' ' .$result[44] . ' ' .$result[45] . ' ' .$result[46] . ' ' .$result[47] . ' ' .$result[48] . ' ' .$result[49] . ' ' .$result[50] . ' ' .$result[51] . ' ' .$result[52] . ' ' .$result[53] . $p);?>
    <?php echo($p . $result[54] . ' ' .$result[55] . ' ' .$result[56] . ' ' .$result[57] . ' ' .$result[58] . ' ' .$result[59] . ' ' .$result[60] . ' ' .$result[61] . ' ' .$result[62] . ' ' .$result[63] . ' ' .$result[64] . ' ' .$result[65] . ' ' .$result[66] . ' ' .$result[67] . ' ' .$result[68] . ' ' .$result[69] . ' ' .$result[70] . ' ' .$result[71] . $p);?>
    <?php echo($p . $result[72] . ' ' .$result[73] . ' ' .$result[74] . ' ' .$result[75] . ' ' .$result[76] . ' ' .$result[77] . ' ' .$result[78] . ' ' .$result[79] . ' ' .$result[80] . ' ' .$result[81] . ' ' .$result[82] . ' ' .$result[83] . ' ' .$result[84] . ' ' .$result[85] . ' ' .$result[86] . ' ' .$result[87] . ' ' .$result[88] . ' ' .$result[89] . $p);?>
    <?php echo($p . $result[90] . ' ' .$result[91] . ' ' .$result[92] . ' ' .$result[93] . ' ' .$result[94] . ' ' .$result[95] . ' ' .$result[96] . ' ' .$result[97] . ' ' .$result[98] . ' ' .$result[99] . ' ' .$result[100] . ' ' .$result[101] . ' ' .$result[102] . ' ' .$result[103] . ' ' .$result[104] . ' ' .$result[105] . ' ' .$result[106] . ' ' .$result[107] . $p);?>
    <?php echo($p . $result[108] . ' ' .$result[109] . ' ' .$result[110] . ' ' .$result[111] . ' ' .$result[112] . ' ' .$result[113] . ' ' .$result[114] . ' ' .$result[115] . ' ' .$result[116] . ' ' .$result[117] . ' ' .$result[118] . ' ' .$result[119] . ' ' .$result[120] . ' ' .$result[121] . ' ' .$result[122] . ' ' .$result[123] . ' ' .$result[124] . ' ' .$result[125] . $p);?>
    <?php echo($p . $result[126] . ' ' .$result[127] . ' ' .$result[128] . ' ' .$result[129] . ' ' .$result[130] . ' ' .$result[131] . ' ' .$result[132] . ' ' .$result[133] . ' ' .$result[134] . ' ' .$result[135] . ' ' .$result[136] . ' ' .$result[137] . ' ' .$result[138] . ' ' .$result[139] . ' ' .$result[140] . ' ' .$result[141] . ' ' .$result[142] . ' ' .$result[143] . $p);?>
    <?php echo($p . $result[144] . ' ' .$result[145] . ' ' .$result[146] . ' ' .$result[147] . ' ' .$result[148] . ' ' .$result[149] . ' ' .$result[150] . ' ' .$result[151] . ' ' .$result[152] . ' ' .$result[153] . ' ' .$result[154] . ' ' .$result[155] . ' ' .$result[156] . ' ' .$result[157] . ' ' .$result[158] . ' ' .$result[159] . ' ' .$result[160] . ' ' .$result[161] . $p);?>
    <?php echo($p . $result[162] . ' ' .$result[163] . ' ' .$result[164] . ' ' .$result[165] . ' ' .$result[166] . ' ' .$result[167] . ' ' .$result[168] . ' ' .$result[169] . ' ' .$result[170] . ' ' .$result[171] . ' ' .$result[172] . ' ' .$result[173] . ' ' .$result[174] . ' ' .$result[175] . ' ' .$result[176] . ' ' .$result[177] . ' ' .$result[178] . ' ' .$result[179] . $p);?>
    <?php echo($p . $result[180] . ' ' .$result[181] . ' ' .$result[182] . ' ' .$result[183] . ' ' .$result[184] . ' ' .$result[185] . ' ' .$result[186] . ' ' .$result[187] . ' ' .$result[188] . ' ' .$result[189] . ' ' .$result[190] . ' ' .$result[191] . ' ' .$result[192] . ' ' .$result[193] . ' ' .$result[194] . ' ' .$result[195] . ' ' .$result[196] . ' ' .$result[197] . $p);?>
    <?php echo($p . $result[198] . ' ' .$result[199] . ' ' .$result[200] . ' ' .$result[201] . ' ' .$result[202] . ' ' .$result[203] . ' ' .$result[204] . ' ' .$result[205] . ' ' .$result[206] . ' ' .$result[207] . ' ' .$result[208] . ' ' .$result[209] . ' ' .$result[210] . ' ' .$result[211] . ' ' .$result[212] . ' ' .$result[213] . ' ' .$result[214] . ' ' .$result[215] . $p);?>
    <?php echo($p . $result[216] . ' ' .$result[217] . ' ' .$result[218] . ' ' .$result[219] . ' ' .$result[220] . ' ' .$result[221] . ' ' .$result[222] . ' ' .$result[223] . ' ' .$result[224] . ' ' .$result[225] . ' ' .$result[226] . ' ' .$result[227] . ' ' .$result[228] . ' ' .$result[229] . ' ' .$result[230] . ' ' .$result[231] . ' ' .$result[232] . ' ' .$result[233] . $p);?>
    <?php echo($p . $result[234] . ' ' .$result[235] . ' ' .$result[236] . ' ' .$result[237] . ' ' .$result[238] . ' ' .$result[239] . ' ' .$result[240] . ' ' .$result[241] . ' ' .$result[242] . ' ' .$result[243] . ' ' .$result[244] . ' ' .$result[245] . ' ' .$result[246] . ' ' .$result[247] . ' ' .$result[248] . ' ' .$result[249] . ' ' .$result[250] . ' ' .$result[251] . $p);?>
    <?php echo($p . $result[252] . ' ' .$result[253] . ' ' .$result[254] . ' ' .$result[255] . ' ' .$result[256] . ' ' .$result[257] . ' ' .$result[258] . ' ' .$result[259] . ' ' .$result[260] . ' ' .$result[261] . ' ' .$result[262] . ' ' .$result[263] . ' ' .$result[264] . ' ' .$result[265] . ' ' .$result[266] . ' ' .$result[267] . ' ' .$result[268] . ' ' .$result[269] . $p);?>
    <?php echo($p . $result[270] . ' ' .$result[271] . ' ' .$result[272] . ' ' .$result[273] . ' ' .$result[274] . ' ' .$result[275] . ' ' .$result[276] . ' ' .$result[277] . ' ' .$result[278] . ' ' .$result[279] . ' ' .$result[280] . ' ' .$result[281] . ' ' .$result[282] . ' ' .$result[283] . ' ' .$result[284] . ' ' .$result[285] . ' ' .$result[286] . ' ' .$result[287] . $p);?>
    <?php echo($p . $result[288] . ' ' .$result[289] . ' ' .$result[290] . ' ' .$result[291] . ' ' .$result[292] . ' ' .$result[293] . ' ' .$result[294] . ' ' .$result[295] . ' ' .$result[296] . ' ' .$result[297] . ' ' .$result[298] . ' ' .$result[299] . ' ' .$result[300] . ' ' .$result[301] . ' ' .$result[302] . ' ' .$result[303] . ' ' .$result[304] . ' ' .$result[305] . $p);?>
    <?php echo($p . $result[306] . ' ' .$result[307] . ' ' .$result[308] . ' ' .$result[309] . ' ' .$result[310] . ' ' .$result[311] . ' ' .$result[312] . ' ' .$result[313] . ' ' .$result[314] . ' ' .$result[315] . ' ' .$result[316] . ' ' .$result[317] . ' ' .$result[318] . ' ' .$result[319] . ' ' .$result[320] . ' ' .$result[321] . ' ' .$result[322] . ' ' .$result[323] . $p);?>
    <?php echo($p . $result[324] . ' ' .$result[325] . ' ' .$result[326] . ' ' .$result[327] . ' ' .$result[328] . ' ' .$result[329] . ' ' .$result[330] . ' ' .$result[331] . ' ' .$result[332] . ' ' .$result[333] . ' ' .$result[334] . ' ' .$result[335] . ' ' .$result[336] . ' ' .$result[337] . ' ' .$result[338] . ' ' .$result[339] . ' ' .$result[340] . ' ' .$result[341] . $p);?>
    <?php echo($p . $result[342] . ' ' .$result[343] . ' ' .$result[344] . ' ' .$result[345] . ' ' .$result[346] . ' ' .$result[347] . ' ' .$result[348] . ' ' .$result[349] . ' ' .$result[350] . ' ' .$result[351] . ' ' .$result[352] . ' ' .$result[353] . ' ' .$result[354] . ' ' .$result[355] . ' ' .$result[356] . ' ' .$result[357] . ' ' .$result[358] . ' ' .$result[359] . $p);?>
    <?php echo($p . $result[360] . ' ' .$result[361] . ' ' .$result[362] . ' ' .$result[363] . ' ' .$result[364] . ' ' .$result[365] . ' ' .$result[366] . ' ' .$result[367] . ' ' .$result[368] . ' ' .$result[369] . ' ' .$result[370] . ' ' .$result[371] . ' ' .$result[372] . ' ' .$result[373] . ' ' .$result[374] . ' ' .$result[375] . ' ' .$result[376] . ' ' .$result[377] . $p);?>
    }
    /* r20c16 was r20c15 */

    .brickStyle{
    border-color: blue;
    border-style: solid;
    border-width: 1px;
    font-size: 10px;
    }

    <?php echo("." . $result[0] . " { grid-area: " . $result[0] . "; }");?>
    <?php echo("." . $result[1] . " { grid-area: " . $result[1] . "; }");?>
    <?php echo("." . $result[2] . " { grid-area: " . $result[2] . "; }");?>
    <?php echo("." . $result[3] . " { grid-area: " . $result[3] . "; }");?>
    <?php echo("." . $result[4] . " { grid-area: " . $result[4] . "; }");?>
    <?php echo("." . $result[5] . " { grid-area: " . $result[5] . "; }");?>
    <?php echo("." . $result[6] . " { grid-area: " . $result[6] . "; }");?>
    <?php echo("." . $result[7] . " { grid-area: " . $result[7] . "; }");?>
    <?php echo("." . $result[8] . " { grid-area: " . $result[8] . "; }");?>
    <?php echo("." . $result[9] . " { grid-area: " . $result[9] . "; }");?>
    <?php echo("." . $result[10] . " { grid-area: " . $result[10] . "; }");?>
    <?php echo("." . $result[11] . " { grid-area: " . $result[11] . "; }");?>
    <?php echo("." . $result[12] . " { grid-area: " . $result[12] . "; }");?>
    <?php echo("." . $result[13] . " { grid-area: " . $result[13] . "; }");?>
    <?php echo("." . $result[14] . " { grid-area: " . $result[14] . "; }");?>
    <?php echo("." . $result[15] . " { grid-area: " . $result[15] . "; }");?>
    <?php echo("." . $result[16] . " { grid-area: " . $result[16] . "; }");?>
    <?php echo("." . $result[17] . " { grid-area: " . $result[17] . "; }");?>
    <?php echo("." . $result[18] . " { grid-area: " . $result[18] . "; }");?>
    <?php echo("." . $result[19] . " { grid-area: " . $result[19] . "; }");?>
    <?php echo("." . $result[20] . " { grid-area: " . $result[20] . "; }");?>
    <?php echo("." . $result[21] . " { grid-area: " . $result[21] . "; }");?>
    <?php echo("." . $result[22] . " { grid-area: " . $result[22] . "; }");?>
    <?php echo("." . $result[23] . " { grid-area: " . $result[23] . "; }");?>
    <?php echo("." . $result[24] . " { grid-area: " . $result[24] . "; }");?>
    <?php echo("." . $result[25] . " { grid-area: " . $result[25] . "; }");?>
    <?php echo("." . $result[26] . " { grid-area: " . $result[26] . "; }");?>
    <?php echo("." . $result[27] . " { grid-area: " . $result[27] . "; }");?>
    <?php echo("." . $result[28] . " { grid-area: " . $result[28] . "; }");?>
    <?php echo("." . $result[29] . " { grid-area: " . $result[29] . "; }");?>
    <?php echo("." . $result[30] . " { grid-area: " . $result[30] . "; }");?>
    <?php echo("." . $result[31] . " { grid-area: " . $result[31] . "; }");?>
    <?php echo("." . $result[32] . " { grid-area: " . $result[32] . "; }");?>
    <?php echo("." . $result[33] . " { grid-area: " . $result[33] . "; }");?>
    <?php echo("." . $result[34] . " { grid-area: " . $result[34] . "; }");?>
    <?php echo("." . $result[35] . " { grid-area: " . $result[35] . "; }");?>
    <?php echo("." . $result[36] . " { grid-area: " . $result[36] . "; }");?>
    <?php echo("." . $result[37] . " { grid-area: " . $result[37] . "; }");?>
    <?php echo("." . $result[38] . " { grid-area: " . $result[38] . "; }");?>
    <?php echo("." . $result[39] . " { grid-area: " . $result[39] . "; }");?>
    <?php echo("." . $result[40] . " { grid-area: " . $result[40] . "; }");?>
    <?php echo("." . $result[41] . " { grid-area: " . $result[41] . "; }");?>
    <?php echo("." . $result[42] . " { grid-area: " . $result[42] . "; }");?>
    <?php echo("." . $result[43] . " { grid-area: " . $result[43] . "; }");?>
    <?php echo("." . $result[44] . " { grid-area: " . $result[44] . "; }");?>
    <?php echo("." . $result[45] . " { grid-area: " . $result[45] . "; }");?>
    <?php echo("." . $result[46] . " { grid-area: " . $result[46] . "; }");?>
    <?php echo("." . $result[47] . " { grid-area: " . $result[47] . "; }");?>
    <?php echo("." . $result[48] . " { grid-area: " . $result[48] . "; }");?>
    <?php echo("." . $result[49] . " { grid-area: " . $result[49] . "; }");?>
    <?php echo("." . $result[50] . " { grid-area: " . $result[50] . "; }");?>
    <?php echo("." . $result[51] . " { grid-area: " . $result[51] . "; }");?>
    <?php echo("." . $result[52] . " { grid-area: " . $result[52] . "; }");?>
    <?php echo("." . $result[53] . " { grid-area: " . $result[53] . "; }");?>
    <?php echo("." . $result[54] . " { grid-area: " . $result[54] . "; }");?>
    <?php echo("." . $result[55] . " { grid-area: " . $result[55] . "; }");?>
    <?php echo("." . $result[56] . " { grid-area: " . $result[56] . "; }");?>
    <?php echo("." . $result[57] . " { grid-area: " . $result[57] . "; }");?>
    <?php echo("." . $result[58] . " { grid-area: " . $result[58] . "; }");?>
    <?php echo("." . $result[59] . " { grid-area: " . $result[59] . "; }");?>
    <?php echo("." . $result[60] . " { grid-area: " . $result[60] . "; }");?>
    <?php echo("." . $result[61] . " { grid-area: " . $result[61] . "; }");?>
    <?php echo("." . $result[62] . " { grid-area: " . $result[62] . "; }");?>
    <?php echo("." . $result[63] . " { grid-area: " . $result[63] . "; }");?>
    <?php echo("." . $result[64] . " { grid-area: " . $result[64] . "; }");?>
    <?php echo("." . $result[65] . " { grid-area: " . $result[65] . "; }");?>
    <?php echo("." . $result[66] . " { grid-area: " . $result[66] . "; }");?>
    <?php echo("." . $result[67] . " { grid-area: " . $result[67] . "; }");?>
    <?php echo("." . $result[68] . " { grid-area: " . $result[68] . "; }");?>
    <?php echo("." . $result[69] . " { grid-area: " . $result[69] . "; }");?>
    <?php echo("." . $result[70] . " { grid-area: " . $result[70] . "; }");?>
    <?php echo("." . $result[71] . " { grid-area: " . $result[71] . "; }");?>
    <?php echo("." . $result[72] . " { grid-area: " . $result[72] . "; }");?>
    <?php echo("." . $result[73] . " { grid-area: " . $result[73] . "; }");?>
    <?php echo("." . $result[74] . " { grid-area: " . $result[74] . "; }");?>
    <?php echo("." . $result[75] . " { grid-area: " . $result[75] . "; }");?>
    <?php echo("." . $result[76] . " { grid-area: " . $result[76] . "; }");?>
    <?php echo("." . $result[77] . " { grid-area: " . $result[77] . "; }");?>
    <?php echo("." . $result[78] . " { grid-area: " . $result[78] . "; }");?>
    <?php echo("." . $result[79] . " { grid-area: " . $result[79] . "; }");?>
    <?php echo("." . $result[80] . " { grid-area: " . $result[80] . "; }");?>
    <?php echo("." . $result[81] . " { grid-area: " . $result[81] . "; }");?>
    <?php echo("." . $result[82] . " { grid-area: " . $result[82] . "; }");?>
    <?php echo("." . $result[83] . " { grid-area: " . $result[83] . "; }");?>
    <?php echo("." . $result[84] . " { grid-area: " . $result[84] . "; }");?>
    <?php echo("." . $result[85] . " { grid-area: " . $result[85] . "; }");?>
    <?php echo("." . $result[86] . " { grid-area: " . $result[86] . "; }");?>
    <?php echo("." . $result[87] . " { grid-area: " . $result[87] . "; }");?>
    <?php echo("." . $result[88] . " { grid-area: " . $result[88] . "; }");?>
    <?php echo("." . $result[89] . " { grid-area: " . $result[89] . "; }");?>
    <?php echo("." . $result[90] . " { grid-area: " . $result[90] . "; }");?>
    <?php echo("." . $result[91] . " { grid-area: " . $result[91] . "; }");?>
    <?php echo("." . $result[92] . " { grid-area: " . $result[92] . "; }");?>
    <?php echo("." . $result[93] . " { grid-area: " . $result[93] . "; }");?>
    <?php echo("." . $result[94] . " { grid-area: " . $result[94] . "; }");?>
    <?php echo("." . $result[95] . " { grid-area: " . $result[95] . "; }");?>
    <?php echo("." . $result[96] . " { grid-area: " . $result[96] . "; }");?>
    <?php echo("." . $result[97] . " { grid-area: " . $result[97] . "; }");?>
    <?php echo("." . $result[98] . " { grid-area: " . $result[98] . "; }");?>
    <?php echo("." . $result[99] . " { grid-area: " . $result[99] . "; }");?>
    <?php echo("." . $result[100] . " { grid-area: " . $result[100] . "; }");?>
    <?php echo("." . $result[101] . " { grid-area: " . $result[101] . "; }");?>
    <?php echo("." . $result[102] . " { grid-area: " . $result[102] . "; }");?>
    <?php echo("." . $result[103] . " { grid-area: " . $result[103] . "; }");?>
    <?php echo("." . $result[104] . " { grid-area: " . $result[104] . "; }");?>
    <?php echo("." . $result[105] . " { grid-area: " . $result[105] . "; }");?>
    <?php echo("." . $result[106] . " { grid-area: " . $result[106] . "; }");?>
    <?php echo("." . $result[107] . " { grid-area: " . $result[107] . "; }");?>
    <?php echo("." . $result[108] . " { grid-area: " . $result[108] . "; }");?>
    <?php echo("." . $result[109] . " { grid-area: " . $result[109] . "; }");?>
    <?php echo("." . $result[110] . " { grid-area: " . $result[110] . "; }");?>
    <?php echo("." . $result[111] . " { grid-area: " . $result[111] . "; }");?>
    <?php echo("." . $result[112] . " { grid-area: " . $result[112] . "; }");?>
    <?php echo("." . $result[113] . " { grid-area: " . $result[113] . "; }");?>
    <?php echo("." . $result[114] . " { grid-area: " . $result[114] . "; }");?>
    <?php echo("." . $result[115] . " { grid-area: " . $result[115] . "; }");?>
    <?php echo("." . $result[116] . " { grid-area: " . $result[116] . "; }");?>
    <?php echo("." . $result[117] . " { grid-area: " . $result[117] . "; }");?>
    <?php echo("." . $result[118] . " { grid-area: " . $result[118] . "; }");?>
    <?php echo("." . $result[119] . " { grid-area: " . $result[119] . "; }");?>
    <?php echo("." . $result[120] . " { grid-area: " . $result[120] . "; }");?>
    <?php echo("." . $result[121] . " { grid-area: " . $result[121] . "; }");?>
    <?php echo("." . $result[122] . " { grid-area: " . $result[122] . "; }");?>
    <?php echo("." . $result[123] . " { grid-area: " . $result[123] . "; }");?>
    <?php echo("." . $result[124] . " { grid-area: " . $result[124] . "; }");?>
    <?php echo("." . $result[125] . " { grid-area: " . $result[125] . "; }");?>
    <?php echo("." . $result[126] . " { grid-area: " . $result[126] . "; }");?>
    <?php echo("." . $result[127] . " { grid-area: " . $result[127] . "; }");?>
    <?php echo("." . $result[128] . " { grid-area: " . $result[128] . "; }");?>
    <?php echo("." . $result[129] . " { grid-area: " . $result[129] . "; }");?>
    <?php echo("." . $result[130] . " { grid-area: " . $result[130] . "; }");?>
    <?php echo("." . $result[131] . " { grid-area: " . $result[131] . "; }");?>
    <?php echo("." . $result[132] . " { grid-area: " . $result[132] . "; }");?>
    <?php echo("." . $result[133] . " { grid-area: " . $result[133] . "; }");?>
    <?php echo("." . $result[134] . " { grid-area: " . $result[134] . "; }");?>
    <?php echo("." . $result[135] . " { grid-area: " . $result[135] . "; }");?>
    <?php echo("." . $result[136] . " { grid-area: " . $result[136] . "; }");?>
    <?php echo("." . $result[137] . " { grid-area: " . $result[137] . "; }");?>
    <?php echo("." . $result[138] . " { grid-area: " . $result[138] . "; }");?>
    <?php echo("." . $result[139] . " { grid-area: " . $result[139] . "; }");?>
    <?php echo("." . $result[140] . " { grid-area: " . $result[140] . "; }");?>
    <?php echo("." . $result[141] . " { grid-area: " . $result[141] . "; }");?>
    <?php echo("." . $result[142] . " { grid-area: " . $result[142] . "; }");?>
    <?php echo("." . $result[143] . " { grid-area: " . $result[143] . "; }");?>
    <?php echo("." . $result[144] . " { grid-area: " . $result[144] . "; }");?>
    <?php echo("." . $result[145] . " { grid-area: " . $result[145] . "; }");?>
    <?php echo("." . $result[146] . " { grid-area: " . $result[146] . "; }");?>
    <?php echo("." . $result[147] . " { grid-area: " . $result[147] . "; }");?>
    <?php echo("." . $result[148] . " { grid-area: " . $result[148] . "; }");?>
    <?php echo("." . $result[149] . " { grid-area: " . $result[149] . "; }");?>
    <?php echo("." . $result[150] . " { grid-area: " . $result[150] . "; }");?>
    <?php echo("." . $result[151] . " { grid-area: " . $result[151] . "; }");?>
    <?php echo("." . $result[152] . " { grid-area: " . $result[152] . "; }");?>
    <?php echo("." . $result[153] . " { grid-area: " . $result[153] . "; }");?>
    <?php echo("." . $result[154] . " { grid-area: " . $result[154] . "; }");?>
    <?php echo("." . $result[155] . " { grid-area: " . $result[155] . "; }");?>
    <?php echo("." . $result[156] . " { grid-area: " . $result[156] . "; }");?>
    <?php echo("." . $result[157] . " { grid-area: " . $result[157] . "; }");?>
    <?php echo("." . $result[158] . " { grid-area: " . $result[158] . "; }");?>
    <?php echo("." . $result[159] . " { grid-area: " . $result[159] . "; }");?>
    <?php echo("." . $result[160] . " { grid-area: " . $result[160] . "; }");?>
    <?php echo("." . $result[161] . " { grid-area: " . $result[161] . "; }");?>
    <?php echo("." . $result[162] . " { grid-area: " . $result[162] . "; }");?>
    <?php echo("." . $result[163] . " { grid-area: " . $result[163] . "; }");?>
    <?php echo("." . $result[164] . " { grid-area: " . $result[164] . "; }");?>
    <?php echo("." . $result[165] . " { grid-area: " . $result[165] . "; }");?>
    <?php echo("." . $result[166] . " { grid-area: " . $result[166] . "; }");?>
    <?php echo("." . $result[167] . " { grid-area: " . $result[167] . "; }");?>
    <?php echo("." . $result[168] . " { grid-area: " . $result[168] . "; }");?>
    <?php echo("." . $result[169] . " { grid-area: " . $result[169] . "; }");?>
    <?php echo("." . $result[170] . " { grid-area: " . $result[170] . "; }");?>
    <?php echo("." . $result[171] . " { grid-area: " . $result[171] . "; }");?>
    <?php echo("." . $result[172] . " { grid-area: " . $result[172] . "; }");?>
    <?php echo("." . $result[173] . " { grid-area: " . $result[173] . "; }");?>
    <?php echo("." . $result[174] . " { grid-area: " . $result[174] . "; }");?>
    <?php echo("." . $result[175] . " { grid-area: " . $result[175] . "; }");?>
    <?php echo("." . $result[176] . " { grid-area: " . $result[176] . "; }");?>
    <?php echo("." . $result[177] . " { grid-area: " . $result[177] . "; }");?>
    <?php echo("." . $result[178] . " { grid-area: " . $result[178] . "; }");?>
    <?php echo("." . $result[179] . " { grid-area: " . $result[179] . "; }");?>
    <?php echo("." . $result[180] . " { grid-area: " . $result[180] . "; }");?>
    <?php echo("." . $result[181] . " { grid-area: " . $result[181] . "; }");?>
    <?php echo("." . $result[182] . " { grid-area: " . $result[182] . "; }");?>
    <?php echo("." . $result[183] . " { grid-area: " . $result[183] . "; }");?>
    <?php echo("." . $result[184] . " { grid-area: " . $result[184] . "; }");?>
    <?php echo("." . $result[185] . " { grid-area: " . $result[185] . "; }");?>
    <?php echo("." . $result[186] . " { grid-area: " . $result[186] . "; }");?>
    <?php echo("." . $result[187] . " { grid-area: " . $result[187] . "; }");?>
    <?php echo("." . $result[188] . " { grid-area: " . $result[188] . "; }");?>
    <?php echo("." . $result[189] . " { grid-area: " . $result[189] . "; }");?>
    <?php echo("." . $result[190] . " { grid-area: " . $result[190] . "; }");?>
    <?php echo("." . $result[191] . " { grid-area: " . $result[191] . "; }");?>
    <?php echo("." . $result[192] . " { grid-area: " . $result[192] . "; }");?>
    <?php echo("." . $result[193] . " { grid-area: " . $result[193] . "; }");?>
    <?php echo("." . $result[194] . " { grid-area: " . $result[194] . "; }");?>
    <?php echo("." . $result[195] . " { grid-area: " . $result[195] . "; }");?>
    <?php echo("." . $result[196] . " { grid-area: " . $result[196] . "; }");?>
    <?php echo("." . $result[197] . " { grid-area: " . $result[197] . "; }");?>
    <?php echo("." . $result[198] . " { grid-area: " . $result[198] . "; }");?>
    <?php echo("." . $result[199] . " { grid-area: " . $result[199] . "; }");?>
    <?php echo("." . $result[200] . " { grid-area: " . $result[200] . "; }");?>
    <?php echo("." . $result[201] . " { grid-area: " . $result[201] . "; }");?>
    <?php echo("." . $result[202] . " { grid-area: " . $result[202] . "; }");?>
    <?php echo("." . $result[203] . " { grid-area: " . $result[203] . "; }");?>
    <?php echo("." . $result[204] . " { grid-area: " . $result[204] . "; }");?>
    <?php echo("." . $result[205] . " { grid-area: " . $result[205] . "; }");?>
    <?php echo("." . $result[206] . " { grid-area: " . $result[206] . "; }");?>
    <?php echo("." . $result[207] . " { grid-area: " . $result[207] . "; }");?>
    <?php echo("." . $result[208] . " { grid-area: " . $result[208] . "; }");?>
    <?php echo("." . $result[209] . " { grid-area: " . $result[209] . "; }");?>
    <?php echo("." . $result[210] . " { grid-area: " . $result[210] . "; }");?>
    <?php echo("." . $result[211] . " { grid-area: " . $result[211] . "; }");?>
    <?php echo("." . $result[212] . " { grid-area: " . $result[212] . "; }");?>
    <?php echo("." . $result[213] . " { grid-area: " . $result[213] . "; }");?>
    <?php echo("." . $result[214] . " { grid-area: " . $result[214] . "; }");?>
    <?php echo("." . $result[215] . " { grid-area: " . $result[215] . "; }");?>
    <?php echo("." . $result[216] . " { grid-area: " . $result[216] . "; }");?>
    <?php echo("." . $result[217] . " { grid-area: " . $result[217] . "; }");?>
    <?php echo("." . $result[218] . " { grid-area: " . $result[218] . "; }");?>
    <?php echo("." . $result[219] . " { grid-area: " . $result[219] . "; }");?>
    <?php echo("." . $result[220] . " { grid-area: " . $result[220] . "; }");?>
    <?php echo("." . $result[221] . " { grid-area: " . $result[221] . "; }");?>
    <?php echo("." . $result[222] . " { grid-area: " . $result[222] . "; }");?>
    <?php echo("." . $result[223] . " { grid-area: " . $result[223] . "; }");?>
    <?php echo("." . $result[224] . " { grid-area: " . $result[224] . "; }");?>
    <?php echo("." . $result[225] . " { grid-area: " . $result[225] . "; }");?>
    <?php echo("." . $result[226] . " { grid-area: " . $result[226] . "; }");?>
    <?php echo("." . $result[227] . " { grid-area: " . $result[227] . "; }");?>
    <?php echo("." . $result[228] . " { grid-area: " . $result[228] . "; }");?>
    <?php echo("." . $result[229] . " { grid-area: " . $result[229] . "; }");?>
    <?php echo("." . $result[230] . " { grid-area: " . $result[230] . "; }");?>
    <?php echo("." . $result[231] . " { grid-area: " . $result[231] . "; }");?>
    <?php echo("." . $result[232] . " { grid-area: " . $result[232] . "; }");?>
    <?php echo("." . $result[233] . " { grid-area: " . $result[233] . "; }");?>
    <?php echo("." . $result[234] . " { grid-area: " . $result[234] . "; }");?>
    <?php echo("." . $result[235] . " { grid-area: " . $result[235] . "; }");?>
    <?php echo("." . $result[236] . " { grid-area: " . $result[236] . "; }");?>
    <?php echo("." . $result[237] . " { grid-area: " . $result[237] . "; }");?>
    <?php echo("." . $result[238] . " { grid-area: " . $result[238] . "; }");?>
    <?php echo("." . $result[239] . " { grid-area: " . $result[239] . "; }");?>
    <?php echo("." . $result[240] . " { grid-area: " . $result[240] . "; }");?>
    <?php echo("." . $result[241] . " { grid-area: " . $result[241] . "; }");?>
    <?php echo("." . $result[242] . " { grid-area: " . $result[242] . "; }");?>
    <?php echo("." . $result[243] . " { grid-area: " . $result[243] . "; }");?>
    <?php echo("." . $result[244] . " { grid-area: " . $result[244] . "; }");?>
    <?php echo("." . $result[245] . " { grid-area: " . $result[245] . "; }");?>
    <?php echo("." . $result[246] . " { grid-area: " . $result[246] . "; }");?>
    <?php echo("." . $result[247] . " { grid-area: " . $result[247] . "; }");?>
    <?php echo("." . $result[248] . " { grid-area: " . $result[248] . "; }");?>
    <?php echo("." . $result[249] . " { grid-area: " . $result[249] . "; }");?>
    <?php echo("." . $result[250] . " { grid-area: " . $result[250] . "; }");?>
    <?php echo("." . $result[251] . " { grid-area: " . $result[251] . "; }");?>
    <?php echo("." . $result[252] . " { grid-area: " . $result[252] . "; }");?>
    <?php echo("." . $result[253] . " { grid-area: " . $result[253] . "; }");?>
    <?php echo("." . $result[254] . " { grid-area: " . $result[254] . "; }");?>
    <?php echo("." . $result[255] . " { grid-area: " . $result[255] . "; }");?>
    <?php echo("." . $result[256] . " { grid-area: " . $result[256] . "; }");?>
    <?php echo("." . $result[257] . " { grid-area: " . $result[257] . "; }");?>
    <?php echo("." . $result[258] . " { grid-area: " . $result[258] . "; }");?>
    <?php echo("." . $result[259] . " { grid-area: " . $result[259] . "; }");?>
    <?php echo("." . $result[260] . " { grid-area: " . $result[260] . "; }");?>
    <?php echo("." . $result[261] . " { grid-area: " . $result[261] . "; }");?>
    <?php echo("." . $result[262] . " { grid-area: " . $result[262] . "; }");?>
    <?php echo("." . $result[263] . " { grid-area: " . $result[263] . "; }");?>
    <?php echo("." . $result[264] . " { grid-area: " . $result[264] . "; }");?>
    <?php echo("." . $result[265] . " { grid-area: " . $result[265] . "; }");?>
    <?php echo("." . $result[266] . " { grid-area: " . $result[266] . "; }");?>
    <?php echo("." . $result[267] . " { grid-area: " . $result[267] . "; }");?>
    <?php echo("." . $result[268] . " { grid-area: " . $result[268] . "; }");?>
    <?php echo("." . $result[269] . " { grid-area: " . $result[269] . "; }");?>
    <?php echo("." . $result[270] . " { grid-area: " . $result[270] . "; }");?>
    <?php echo("." . $result[271] . " { grid-area: " . $result[271] . "; }");?>
    <?php echo("." . $result[272] . " { grid-area: " . $result[272] . "; }");?>
    <?php echo("." . $result[273] . " { grid-area: " . $result[273] . "; }");?>
    <?php echo("." . $result[274] . " { grid-area: " . $result[274] . "; }");?>
    <?php echo("." . $result[275] . " { grid-area: " . $result[275] . "; }");?>
    <?php echo("." . $result[276] . " { grid-area: " . $result[276] . "; }");?>
    <?php echo("." . $result[277] . " { grid-area: " . $result[277] . "; }");?>
    <?php echo("." . $result[278] . " { grid-area: " . $result[278] . "; }");?>
    <?php echo("." . $result[279] . " { grid-area: " . $result[279] . "; }");?>
    <?php echo("." . $result[280] . " { grid-area: " . $result[280] . "; }");?>
    <?php echo("." . $result[281] . " { grid-area: " . $result[281] . "; }");?>
    <?php echo("." . $result[282] . " { grid-area: " . $result[282] . "; }");?>
    <?php echo("." . $result[283] . " { grid-area: " . $result[283] . "; }");?>
    <?php echo("." . $result[284] . " { grid-area: " . $result[284] . "; }");?>
    <?php echo("." . $result[285] . " { grid-area: " . $result[285] . "; }");?>
    <?php echo("." . $result[286] . " { grid-area: " . $result[286] . "; }");?>
    <?php echo("." . $result[287] . " { grid-area: " . $result[287] . "; }");?>
    <?php echo("." . $result[288] . " { grid-area: " . $result[288] . "; }");?>
    <?php echo("." . $result[289] . " { grid-area: " . $result[289] . "; }");?>
    <?php echo("." . $result[290] . " { grid-area: " . $result[290] . "; }");?>
    <?php echo("." . $result[291] . " { grid-area: " . $result[291] . "; }");?>
    <?php echo("." . $result[292] . " { grid-area: " . $result[292] . "; }");?>
    <?php echo("." . $result[293] . " { grid-area: " . $result[293] . "; }");?>
    <?php echo("." . $result[294] . " { grid-area: " . $result[294] . "; }");?>
    <?php echo("." . $result[295] . " { grid-area: " . $result[295] . "; }");?>
    <?php echo("." . $result[296] . " { grid-area: " . $result[296] . "; }");?>
    <?php echo("." . $result[297] . " { grid-area: " . $result[297] . "; }");?>
    <?php echo("." . $result[298] . " { grid-area: " . $result[298] . "; }");?>
    <?php echo("." . $result[299] . " { grid-area: " . $result[299] . "; }");?>
    <?php echo("." . $result[300] . " { grid-area: " . $result[300] . "; }");?>
    <?php echo("." . $result[301] . " { grid-area: " . $result[301] . "; }");?>
    <?php echo("." . $result[302] . " { grid-area: " . $result[302] . "; }");?>
    <?php echo("." . $result[303] . " { grid-area: " . $result[303] . "; }");?>
    <?php echo("." . $result[304] . " { grid-area: " . $result[304] . "; }");?>
    <?php echo("." . $result[305] . " { grid-area: " . $result[305] . "; }");?>
    <?php echo("." . $result[306] . " { grid-area: " . $result[306] . "; }");?>
    <?php echo("." . $result[307] . " { grid-area: " . $result[307] . "; }");?>
    <?php echo("." . $result[308] . " { grid-area: " . $result[308] . "; }");?>
    <?php echo("." . $result[309] . " { grid-area: " . $result[309] . "; }");?>
    <?php echo("." . $result[310] . " { grid-area: " . $result[310] . "; }");?>
    <?php echo("." . $result[311] . " { grid-area: " . $result[311] . "; }");?>
    <?php echo("." . $result[312] . " { grid-area: " . $result[312] . "; }");?>
    <?php echo("." . $result[313] . " { grid-area: " . $result[313] . "; }");?>
    <?php echo("." . $result[314] . " { grid-area: " . $result[314] . "; }");?>
    <?php echo("." . $result[315] . " { grid-area: " . $result[315] . "; }");?>
    <?php echo("." . $result[316] . " { grid-area: " . $result[316] . "; }");?>
    <?php echo("." . $result[317] . " { grid-area: " . $result[317] . "; }");?>
    <?php echo("." . $result[318] . " { grid-area: " . $result[318] . "; }");?>
    <?php echo("." . $result[319] . " { grid-area: " . $result[319] . "; }");?>
    <?php echo("." . $result[320] . " { grid-area: " . $result[320] . "; }");?>
    <?php echo("." . $result[321] . " { grid-area: " . $result[321] . "; }");?>
    <?php echo("." . $result[322] . " { grid-area: " . $result[322] . "; }");?>
    <?php echo("." . $result[323] . " { grid-area: " . $result[323] . "; }");?>
    <?php echo("." . $result[324] . " { grid-area: " . $result[324] . "; }");?>
    <?php echo("." . $result[325] . " { grid-area: " . $result[325] . "; }");?>
    <?php echo("." . $result[326] . " { grid-area: " . $result[326] . "; }");?>
    <?php echo("." . $result[327] . " { grid-area: " . $result[327] . "; }");?>
    <?php echo("." . $result[328] . " { grid-area: " . $result[328] . "; }");?>
    <?php echo("." . $result[329] . " { grid-area: " . $result[329] . "; }");?>
    <?php echo("." . $result[330] . " { grid-area: " . $result[330] . "; }");?>
    <?php echo("." . $result[331] . " { grid-area: " . $result[331] . "; }");?>
    <?php echo("." . $result[332] . " { grid-area: " . $result[332] . "; }");?>
    <?php echo("." . $result[333] . " { grid-area: " . $result[333] . "; }");?>
    <?php echo("." . $result[334] . " { grid-area: " . $result[334] . "; }");?>
    <?php echo("." . $result[335] . " { grid-area: " . $result[335] . "; }");?>
    <?php echo("." . $result[336] . " { grid-area: " . $result[336] . "; }");?>
    <?php echo("." . $result[337] . " { grid-area: " . $result[337] . "; }");?>
    <?php echo("." . $result[338] . " { grid-area: " . $result[338] . "; }");?>
    <?php echo("." . $result[339] . " { grid-area: " . $result[339] . "; }");?>
    <?php echo("." . $result[340] . " { grid-area: " . $result[340] . "; }");?>
    <?php echo("." . $result[341] . " { grid-area: " . $result[341] . "; }");?>
    <?php echo("." . $result[342] . " { grid-area: " . $result[342] . "; }");?>
    <?php echo("." . $result[343] . " { grid-area: " . $result[343] . "; }");?>
    <?php echo("." . $result[344] . " { grid-area: " . $result[344] . "; }");?>
    <?php echo("." . $result[345] . " { grid-area: " . $result[345] . "; }");?>
    <?php echo("." . $result[346] . " { grid-area: " . $result[346] . "; }");?>
    <?php echo("." . $result[347] . " { grid-area: " . $result[347] . "; }");?>
    <?php echo("." . $result[348] . " { grid-area: " . $result[348] . "; }");?>
    <?php echo("." . $result[349] . " { grid-area: " . $result[349] . "; }");?>
    <?php echo("." . $result[350] . " { grid-area: " . $result[350] . "; }");?>
    <?php echo("." . $result[351] . " { grid-area: " . $result[351] . "; }");?>
    <?php echo("." . $result[352] . " { grid-area: " . $result[352] . "; }");?>
    <?php echo("." . $result[353] . " { grid-area: " . $result[353] . "; }");?>
    <?php echo("." . $result[354] . " { grid-area: " . $result[354] . "; }");?>
    <?php echo("." . $result[355] . " { grid-area: " . $result[355] . "; }");?>
    <?php echo("." . $result[356] . " { grid-area: " . $result[356] . "; }");?>
    <?php echo("." . $result[357] . " { grid-area: " . $result[357] . "; }");?>
    <?php echo("." . $result[358] . " { grid-area: " . $result[358] . "; }");?>
    <?php echo("." . $result[359] . " { grid-area: " . $result[359] . "; }");?>
    <?php echo("." . $result[360] . " { grid-area: " . $result[360] . "; }");?>
    <?php echo("." . $result[361] . " { grid-area: " . $result[361] . "; }");?>
    <?php echo("." . $result[362] . " { grid-area: " . $result[362] . "; }");?>
    <?php echo("." . $result[363] . " { grid-area: " . $result[363] . "; }");?>
    <?php echo("." . $result[364] . " { grid-area: " . $result[364] . "; }");?>
    <?php echo("." . $result[365] . " { grid-area: " . $result[365] . "; }");?>
    <?php echo("." . $result[366] . " { grid-area: " . $result[366] . "; }");?>
    <?php echo("." . $result[367] . " { grid-area: " . $result[367] . "; }");?>
    <?php echo("." . $result[368] . " { grid-area: " . $result[368] . "; }");?>
    <?php echo("." . $result[369] . " { grid-area: " . $result[369] . "; }");?>
    <?php echo("." . $result[370] . " { grid-area: " . $result[370] . "; }");?>
    <?php echo("." . $result[371] . " { grid-area: " . $result[371] . "; }");?>
    <?php echo("." . $result[372] . " { grid-area: " . $result[372] . "; }");?>
    <?php echo("." . $result[373] . " { grid-area: " . $result[373] . "; }");?>
    <?php echo("." . $result[374] . " { grid-area: " . $result[374] . "; }");?>
    <?php echo("." . $result[375] . " { grid-area: " . $result[375] . "; }");?>
    <?php echo("." . $result[376] . " { grid-area: " . $result[376] . "; }");?>
    <?php echo("." . $result[377] . " { grid-area: " . $result[377] . "; }");?>
    
    @media (max-aspect-ratio: 7/6) {
    .parent {

        width: 98vh;
        height: 84vh; 

    }
    }

    /* Popup container */
    .popup {
    position: fixed;
    /* display: none; */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    border: 3px solid #f1f1f1;
    z-index: 9;
    display: none;

    /*position: relative;
    float: center;
    display: inline-block;
    cursor: pointer;
    */
    }

    #myCoolerPopup {
    text-align: center;
    border: 3px dotted fuchsia;
    background-color: khaki;
    }

    /* The actual popup (appears on top) */
    .popup .popuptext {
    /*by changing this to visible it works every time but no animation - thoughts?*/
    visibility: visible;
    max-width: 400px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -80px;
    }

    /* The popup form - hidden by default
    .form-popup {
    display: none;
    position: fixed;
    bottom: 0;
    right: 15px;
    border: 3px solid #f1f1f1;
    z-index: 9;
    } */

    form {
    display: block;
    margin-top: 0em;
    box-sizing: border-box;
    }

    /* Add styles to the form container */
    .form-container {
    max-width: 100%;
    padding: 10px;
    background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=text] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
    box-sizing: border-box;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus {
    background-color: #ddd;
    outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
    background-color: #04AA6D;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom:10px;
    opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
    background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
    opacity: 1;
    }
  </style>
  <div class="mainBody">
    <div class="wrapper">
      <div class="bodyFrame">
        <div class="gridParent">
          <div class="parent">
            <!-- Row 1 -->
            <div class="brickStyle brickR1C1" id="a001" onclick="brickClicked('a001')"></div>
            <div class="brickStyle brickR1C3" id="a002" onclick="brickClicked('a002')"></div>
            <div class="brickStyle brickR1C5" id="a003" onclick="brickClicked('a003')"></div>
            <div class="brickStyle brickR1C7" id="a004" onclick="brickClicked('a004')"></div>
            <div class="brickStyle brickR1C9" id="a005" onclick="brickClicked('a005')"></div>
            <div class="brickStyle brickR1C11" id="a006" onclick="brickClicked('a006')"></div>
            <div class="brickStyle brickR1C13" id="a007" onclick="brickClicked('a007')"></div>
            <div class="brickStyle brickR1C15" id="a008" onclick="brickClicked('a008')"></div>
            <div class="brickStyle brickR1C17" id="a009" onclick="brickClicked('a009')"></div>
            <!-- Row 2 -->
            <div class="brickStyle brickR2C1" id="a010" onclick="brickClicked('a010')"></div>
            <div class="brickStyle brickR2C2" id="a011" onclick="brickClicked('a011')"></div>
            <div class="brickStyle brickR2C4" id="a012" onclick="brickClicked('a012')"></div>
            <div class="brickStyle brickR2C6" id="a013" onclick="brickClicked('a013')"></div>
            <div class="brickStyle brickR2C8" id="a014" onclick="brickClicked('a014')"></div>
            <div class="brickStyle brickR2C10" id="a015" onclick="brickClicked('a015')"></div>
            <div class="brickStyle brickR2C12" id="a016" onclick="brickClicked('a016')"></div>
            <div class="brickStyle brickR2C14" id="a017" onclick="brickClicked('a017')"></div>
            <div class="brickStyle brickR2C16" id="a018" onclick="brickClicked('a018')"></div>
            <div class="brickStyle brickR2C18" id="a019" onclick="brickClicked('a019')"></div>
            <!-- Row 3 -->
            <div class="brickStyle brickR3C1" id="a020" onclick="brickClicked('a020')"></div>
            <div class="brickStyle brickR3C3" id="a021" onclick="brickClicked('a021')"></div>
            <div class="brickStyle brickR3C5" id="a022" onclick="brickClicked('a022')"></div>
            <div class="brickStyle brickR3C6" id="a023" onclick="brickClicked('a023')"></div>
            <div class="brickStyle brickR3C8" id="a024" onclick="brickClicked('a024')"></div>
            <div class="brickStyle brickR3C9" id="a025" onclick="brickClicked('a025')"></div>
            <div class="brickStyle brickR3C11" id="a026" onclick="brickClicked('a026')"></div>
            <div class="brickStyle brickR3C13" id="a027" onclick="brickClicked('a027')"></div>
            <div class="brickStyle brickR3C15" id="a028" onclick="brickClicked('a028')"></div>
            <div class="brickStyle brickR3C16" id="a029" onclick="brickClicked('a029')"></div>
            <div class="brickStyle brickR3C18" id="a030" onclick="brickClicked('a030')"></div>
            <!-- Row 4 -->
            <div class="brickStyle brickR4C1" id="a031" onclick="brickClicked('a031')"></div>
            <div class="brickStyle brickR4C2" id="a032" onclick="brickClicked('a032')"></div>
            <div class="brickStyle brickR4C4" id="a033" onclick="brickClicked('a033')"></div>
            <div class="brickStyle brickR4C8" id="a034" onclick="brickClicked('a034')"></div>
            <div class="brickStyle brickR4C10" id="a035" onclick="brickClicked('a035')"></div>
            <div class="brickStyle brickR4C12" id="a036" onclick="brickClicked('a036')"></div>
            <div class="brickStyle brickR4C14" id="a037" onclick="brickClicked('a037')"></div>
            <div class="brickStyle brickR4C18" id="a038" onclick="brickClicked('a038')"></div>
            <!-- Row 5 -->
            <div class="brickStyle brickR5C1" id="a039" onclick="brickClicked('a039')"></div>
            <div class="brickStyle brickR5C3" id="a040" onclick="brickClicked('a040')"></div>
            <div class="brickStyle brickR5C5" id="a041" onclick="brickClicked('a041')"></div>
            <div class="brickStyle brickR5C7" id="a042" onclick="brickClicked('a042')"></div>
            <div class="brickStyle brickR5C9" id="a043" onclick="brickClicked('a043')"></div>
            <div class="brickStyle brickR5C11" id="a044" onclick="brickClicked('a044')"></div>
            <div class="brickStyle brickR5C13" id="a045" onclick="brickClicked('a045')"></div>
            <div class="brickStyle brickR5C15" id="a046" onclick="brickClicked('a046')"></div>
            <div class="brickStyle brickR5C17" id="a047" onclick="brickClicked('a047')"></div>
            <!-- Row 6 -->
            <div class="brickStyle brickR6C1" id="a048" onclick="brickClicked('a048')"></div>
            <div class="brickStyle brickR6C2" id="a049" onclick="brickClicked('a049')"></div>
            <div class="brickStyle brickR6C4" id="a050" onclick="brickClicked('a050')"></div>
            <div class="brickStyle brickR6C5" id="a051" onclick="brickClicked('a051')"></div>
            <div class="brickStyle brickR6C7" id="a052" onclick="brickClicked('a052')"></div>
            <div class="brickStyle brickR6C8" id="a053" onclick="brickClicked('a053')"></div>
            <div class="brickStyle brickR6C10" id="a054" onclick="brickClicked('a054')"></div>
            <div class="brickStyle brickR6C12" id="a055" onclick="brickClicked('a055')"></div>
            <div class="brickStyle brickR6C14" id="a056" onclick="brickClicked('a056')"></div>
            <div class="brickStyle brickR6C16" id="a057" onclick="brickClicked('a057')"></div>
            <div class="brickStyle brickR6C18" id="a058" onclick="brickClicked('a058')"></div>
            <!-- Row 7 -->
            <div class="brickStyle brickR7C1" id="a059" onclick="brickClicked('a059')"></div>
            <div class="brickStyle brickR7C3" id="a060" onclick="brickClicked('a060')"></div>
            <div class="brickStyle brickR7C7" id="a061" onclick="brickClicked('a061')"></div>
            <div class="brickStyle brickR7C9" id="a062" onclick="brickClicked('a062')"></div>
            <div class="brickStyle brickR7C11" id="a063" onclick="brickClicked('a063')"></div>
            <div class="brickStyle brickR7C13" id="a064" onclick="brickClicked('a064')"></div>
            <div class="brickStyle brickR7C14" id="a065" onclick="brickClicked('a065')"></div>
            <div class="brickStyle brickR7C16" id="a066" onclick="brickClicked('a066')"></div>
            <div class="brickStyle brickR7C17" id="a067" onclick="brickClicked('a067')"></div>
            <!-- Row 8 -->
            <div class="brickStyle brickR8C1" id="a068" onclick="brickClicked('a068')"></div>
            <div class="brickStyle brickR8C2" id="a069" onclick="brickClicked('a069')"></div>
            <div class="brickStyle brickR8C4" id="a070" onclick="brickClicked('a070')"></div>
            <div class="brickStyle brickR8C6" id="a071" onclick="brickClicked('a071')"></div>
            <div class="brickStyle brickR8C8" id="a072" onclick="brickClicked('a072')"></div>
            <div class="brickStyle brickR8C10" id="a073" onclick="brickClicked('a073')"></div>
            <div class="brickStyle brickR8C12" id="a074" onclick="brickClicked('a074')"></div>
            <div class="brickStyle brickR8C16" id="a075" onclick="brickClicked('a075')"></div>
            <div class="brickStyle brickR8C18" id="a076" onclick="brickClicked('a076')"></div>
            <!-- Row 9 -->
            <div class="brickStyle brickR9C1" id="a077" onclick="brickClicked('a077')"></div>
            <div class="brickStyle brickR9C3" id="a078" onclick="brickClicked('a078')"></div>
            <div class="brickStyle brickR9C5" id="a079" onclick="brickClicked('a079')"></div>
            <div class="brickStyle brickR9C7" id="a080" onclick="brickClicked('a080')"></div>
            <div class="brickStyle brickR9C9" id="a081" onclick="brickClicked('a081')"></div>
            <div class="brickStyle brickR9C11" id="a082" onclick="brickClicked('a082')"></div>
            <div class="brickStyle brickR9C13" id="a083" onclick="brickClicked('a083')"></div>
            <div class="brickStyle brickR9C15" id="a084" onclick="brickClicked('a084')"></div>
            <div class="brickStyle brickR9C17" id="a085" onclick="brickClicked('a085')"></div>
            <!-- Row 10 -->
            <div class="brickStyle brickR10C1" id="a086" onclick="brickClicked('a086')"></div>
            <div class="brickStyle brickR10C2" id="a087" onclick="brickClicked('a087')"></div>
            <div class="brickStyle brickR10C4" id="a088" onclick="brickClicked('a088')"></div>
            <div class="brickStyle brickR10C6" id="a089" onclick="brickClicked('a089')"></div>
            <div class="brickStyle brickR10C8" id="a090" onclick="brickClicked('a090')"></div>
            <div class="brickStyle brickR10C10" id="a091" onclick="brickClicked('a091')"></div>
            <div class="brickStyle brickR10C12" id="a092" onclick="brickClicked('a092')"></div>
            <div class="brickStyle brickR10C14" id="a093" onclick="brickClicked('a093')"></div>
            <div class="brickStyle brickR10C16" id="a094" onclick="brickClicked('a094')"></div>
            <div class="brickStyle brickR10C18" id="a095" onclick="brickClicked('a095')"></div>
            <!-- Row 11 -->
            <div class="brickStyle brickR11C1" id="a096" onclick="brickClicked('a096')"></div>
            <div class="brickStyle brickR11C3" id="a097" onclick="brickClicked('a097')"></div>
            <div class="brickStyle brickR11C5" id="a098" onclick="brickClicked('a098')"></div>
            <div class="brickStyle brickR11C7" id="a099" onclick="brickClicked('a099')"></div>
            <div class="brickStyle brickR11C9" id="a100" onclick="brickClicked('a100')"></div>
            <div class="brickStyle brickR11C11" id="a101" onclick="brickClicked('a101')"></div>
            <div class="brickStyle brickR11C13" id="a102" onclick="brickClicked('a102')"></div>
            <div class="brickStyle brickR11C15" id="a103" onclick="brickClicked('a103')"></div>
            <div class="brickStyle brickR11C16" id="a104" onclick="brickClicked('a104')"></div>
            <div class="brickStyle brickR11C18" id="a105" onclick="brickClicked('a105')"></div>
            <!-- Row 12 -->
            <div class="brickStyle brickR12C1" id="a106" onclick="brickClicked('a106')"></div>
            <div class="brickStyle brickR12C2" id="a107" onclick="brickClicked('a107')"></div>
            <div class="brickStyle brickR12C3" id="a108" onclick="brickClicked('a108')"></div>
            <div class="brickStyle brickR12C5" id="a109" onclick="brickClicked('a109')"></div>
            <div class="brickStyle brickR12C6" id="a110" onclick="brickClicked('a110')"></div>
            <div class="brickStyle brickR12C8" id="a111" onclick="brickClicked('a111')"></div>
            <div class="brickStyle brickR12C10" id="a112" onclick="brickClicked('a112')"></div>
            <div class="brickStyle brickR12C12" id="a113" onclick="brickClicked('a113')"></div>
            <div class="brickStyle brickR12C14" id="a114" onclick="brickClicked('a114')"></div>
            <div class="brickStyle brickR12C16" id="a115" onclick="brickClicked('a115')"></div>
            <div class="brickStyle brickR12C18" id="a116" onclick="brickClicked('a116')"></div>
            <!-- Row 13 -->
            <div class="brickStyle brickR13C1" id="a117" onclick="brickClicked('a117')"></div>
            <div class="brickStyle brickR13C5" id="a118" onclick="brickClicked('a118')"></div>
            <div class="brickStyle brickR13C7" id="a119" onclick="brickClicked('a119')"></div>
            <div class="brickStyle brickR13C9" id="a120" onclick="brickClicked('a120')"></div>
            <div class="brickStyle brickR13C11" id="a121" onclick="brickClicked('a121')"></div>
            <div class="brickStyle brickR13C13" id="a122" onclick="brickClicked('a122')"></div>
            <div class="brickStyle brickR13C15" id="a123" onclick="brickClicked('a123')"></div>
            <div class="brickStyle brickR13C17" id="a124" onclick="brickClicked('a124')"></div>
            <!-- Row 14 -->
            <div class="brickStyle brickR14C1" id="a125" onclick="brickClicked('a125')"></div>
            <div class="brickStyle brickR14C2" id="a126" onclick="brickClicked('a126')"></div>
            <div class="brickStyle brickR14C4" id="a127" onclick="brickClicked('a127')"></div>
            <div class="brickStyle brickR14C6" id="a128" onclick="brickClicked('a128')"></div>
            <div class="brickStyle brickR14C8" id="a129" onclick="brickClicked('a129')"></div>
            <div class="brickStyle brickR14C10" id="a130" onclick="brickClicked('a130')"></div>
            <div class="brickStyle brickR14C12" id="a131" onclick="brickClicked('a131')"></div>
            <div class="brickStyle brickR14C14" id="a132" onclick="brickClicked('a132')"></div>
            <div class="brickStyle brickR14C16" id="a133" onclick="brickClicked('a133')"></div>
            <div class="brickStyle brickR14C18" id="a134" onclick="brickClicked('a134')"></div>
            <!-- Row 15 -->
            <div class="brickStyle brickR15C1" id="a135" onclick="brickClicked('a135')"></div>
            <div class="brickStyle brickR15C3" id="a136" onclick="brickClicked('a136')"></div>
            <div class="brickStyle brickR15C5" id="a137" onclick="brickClicked('a137')"></div>
            <div class="brickStyle brickR15C7" id="a138" onclick="brickClicked('a138')"></div>
            <div class="brickStyle brickR15C8" id="a139" onclick="brickClicked('a139')"></div>
            <div class="brickStyle brickR15C10" id="a140" onclick="brickClicked('a140')"></div>
            <div class="brickStyle brickR15C11" id="a141" onclick="brickClicked('a141')"></div>
            <div class="brickStyle brickR15C13" id="a142" onclick="brickClicked('a142')"></div>
            <div class="brickStyle brickR15C15" id="a143" onclick="brickClicked('a143')"></div>
            <div class="brickStyle brickR15C17" id="a144" onclick="brickClicked('a144')"></div>
            <!-- Row 16 -->
            <div class="brickStyle brickR16C1" id="a145" onclick="brickClicked('a145')"></div>
            <div class="brickStyle brickR16C2" id="a146" onclick="brickClicked('a146')"></div>
            <div class="brickStyle brickR16C4" id="a147" onclick="brickClicked('a147')"></div>
            <div class="brickStyle brickR16C6" id="a148" onclick="brickClicked('a148')"></div>
            <div class="brickStyle brickR16C10" id="a149" onclick="brickClicked('a149')"></div>
            <div class="brickStyle brickR16C12" id="a150" onclick="brickClicked('a150')"></div>
            <div class="brickStyle brickR16C14" id="a151" onclick="brickClicked('a151')"></div>
            <div class="brickStyle brickR16C16" id="a152" onclick="brickClicked('a152')"></div>
            <div class="brickStyle brickR16C18" id="a153" onclick="brickClicked('a153')"></div>
            <!-- Row 17 -->
            <div class="brickStyle brickR17C1" id="a154" onclick="brickClicked('a154')"></div>
            <div class="brickStyle brickR17C3" id="a155" onclick="brickClicked('a155')"></div>
            <div class="brickStyle brickR17C5" id="a156" onclick="brickClicked('a156')"></div>
            <div class="brickStyle brickR17C7" id="a157" onclick="brickClicked('a157')"></div>
            <div class="brickStyle brickR17C9" id="a158" onclick="brickClicked('a158')"></div>
            <div class="brickStyle brickR17C11" id="a159" onclick="brickClicked('a159')"></div>
            <div class="brickStyle brickR17C13" id="a160" onclick="brickClicked('a160')"></div>
            <div class="brickStyle brickR17C15" id="a161" onclick="brickClicked('a161')"></div>
            <div class="brickStyle brickR17C17" id="a162" onclick="brickClicked('a162')"></div>
            <!-- Row 18 -->
            <div class="brickStyle brickR18C1" id="a163" onclick="brickClicked('a163')"></div>
            <div class="brickStyle brickR18C2" id="a164" onclick="brickClicked('a164')"></div>
            <div class="brickStyle brickR18C4" id="a165" onclick="brickClicked('a165')"></div>
            <div class="brickStyle brickR18C6" id="a166" onclick="brickClicked('a166')"></div>
            <div class="brickStyle brickR18C8" id="a167" onclick="brickClicked('a167')"></div>
            <div class="brickStyle brickR18C10" id="a168" onclick="brickClicked('a168')"></div>
            <div class="brickStyle brickR18C12" id="a169" onclick="brickClicked('a169')"></div>
            <div class="brickStyle brickR18C14" id="a170" onclick="brickClicked('a170')"></div>
            <div class="brickStyle brickR18C16" id="a171" onclick="brickClicked('a171')"></div>
            <div class="brickStyle brickR18C18" id="a172" onclick="brickClicked('a172')"></div>
            <!-- Row 19 -->
            <div class="brickStyle brickR19C1" id="a173" onclick="brickClicked('a173')"></div>
            <div class="brickStyle brickR19C3" id="a174" onclick="brickClicked('a174')"></div>
            <div class="brickStyle brickR19C5" id="a175" onclick="brickClicked('a175')"></div>
            <div class="brickStyle brickR19C7" id="a176" onclick="brickClicked('a176')"></div>
            <div class="brickStyle brickR19C9" id="a177" onclick="brickClicked('a177')"></div>
            <div class="brickStyle brickR19C11" id="a178" onclick="brickClicked('a178')"></div>
            <div class="brickStyle brickR19C12" id="a179" onclick="brickClicked('a179')"></div>
            <div class="brickStyle brickR19C14" id="a180" onclick="brickClicked('a180')"></div>
            <div class="brickStyle brickR19C15" id="a181" onclick="brickClicked('a181')"></div>
            <div class="brickStyle brickR19C17" id="a182" onclick="brickClicked('a182')"></div>
            <!-- Row 20 -->
            <div class="brickStyle brickR20C1" id="a183" onclick="brickClicked('a183')"></div>
            <div class="brickStyle brickR20C2" id="a184" onclick="brickClicked('a184')"></div>
            <div class="brickStyle brickR20C4" id="a185" onclick="brickClicked('a185')"></div>
            <div class="brickStyle brickR20C6" id="a186" onclick="brickClicked('a186')"></div>
            <div class="brickStyle brickR20C8" id="a187" onclick="brickClicked('a187')"></div>
            <div class="brickStyle brickR20C10" id="a188" onclick="brickClicked('a188')"></div>
            <div class="brickStyle brickR20C14" id="a189" onclick="brickClicked('a189')"></div>
            <div class="brickStyle brickR20C16" id="a190" onclick="brickClicked('a190')"></div>
            <div class="brickStyle brickR20C18" id="a191" onclick="brickClicked('a191')"></div>
            <!-- Row 21 -->
            <div class="brickStyle brickR21C1" id="a192" onclick="brickClicked('a192')"></div>
            <div class="brickStyle brickR21C3" id="a193" onclick="brickClicked('a193')"></div>
            <div class="brickStyle brickR21C5" id="a194" onclick="brickClicked('a194')"></div>
            <div class="brickStyle brickR21C7" id="a195" onclick="brickClicked('a195')"></div>
            <div class="brickStyle brickR21C9" id="a196" onclick="brickClicked('a196')"></div>
            <div class="brickStyle brickR21C11" id="a197" onclick="brickClicked('a197')"></div>
            <div class="brickStyle brickR21C13" id="a198" onclick="brickClicked('a198')"></div>
            <div class="brickStyle brickR21C15" id="a199" onclick="brickClicked('a199')"></div>
            <div class="brickStyle brickR21C17" id="a200" onclick="brickClicked('a200')"></div>
            <!-- <div class="brickStyle brickR21C18" id="a378" onclick="brickClicked('a378')"></div> -->
          </div>
        </div>
      </div>
    </div>
    <div class="popup" id="myPopup">
      <form action="/veterans-website-project/html-admin/updateDB.php" class="form-container">
        <h1>Brick Editor</h1>
    
        <label for="firstName"><b>First Name</b></label>
        <input type="text" id="firstInputBox" placeholder="Enter Veteran First Name" name="firstName" required>
        <label for="lastName"><b>Last Name</b></label>
        <input type="text" id="lastInputBox" placeholder="Enter Veteran Last Name" name="lastName" required>
        <label for="brickDescription"> Brick Description (all text on the brick, including first and last name):</label>
        <textarea id="brickDescription" name="brickDescription" rows="4" cols="35"></textarea>
        <input type="hidden" id="groupName" name="groupName" />
        <input type="hidden" id="brickNumber" name="brickNumber" />
        <button type="button" class="btn" onClick="updateBrick()">Save</button>
        <button type="button" class="btn cancel" onclick="closeEditPopup()">Cancel</button>
      </form>
    </div>
    <div class="popup" id="myCoolerPopup">
      <span class="popuptext"></span>
    </div>
  </div>
</body>
</html>