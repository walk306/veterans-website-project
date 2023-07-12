<!DOCTYPE html>
<html>
<head>
  <?php
    header("Content-type: text/html; charset:UTF-8");
    //connection variables
    $servername = "localhost";
    $dbname = "manchester_veterans_memorial_database";
    $uname = "phpmyadmin";
    $psword = "Y4VnqfDCz2vvMkv";
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>repl.it</title>
  <!-- <link href="css/stylea.css" rel="stylesheet" type="text/css" /> -->
  <?php
    //variables actually needed for the css
    $unitNum = (isset($_REQUEST['id']) ? $_REQUEST['id'] : null);
    $gridTemplateAreasId = (isset($_REQUEST['gridTemplateAreasId']) ? $_REQUEST['gridTemplateAreasId'] : null);
    $p = '"';
    // $idIndex = 0;
    function isItANewBrick($num){ 
      try{
        $isIt = 0;
        $servernameagain = "localhost";
        $dbnameagain = "manchester_veterans_memorial_database";
        $unameagain = "phpmyadmin";
        $pswordagain = "Y4VnqfDCz2vvMkv";
        $prep = new PDO("mysql:host=$servernameagain;port=3306;dbname=$dbnameagain", $unameagain, $pswordagain);
        $prep->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety
        $test = null;
        $test = $prep->prepare("SELECT startsNewBrick FROM a_brick_group");
        $test->execute();
        $answer = $test->fetchAll(PDO::FETCH_COLUMN);
        $isIt = $answer[$num];
        return $isIt;
      }
      catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    function toCommentOrNot($brickStatus, $pos){
      if ($brickStatus == 0){
        if($pos == 1){
          echo("<!--");
        }
        else{
          echo("-->");
        }
      }
      else if($brickStatus == 1 && $pos == 2){
        tickUp(1);
      }
    }
    $idIndex = 0;
    function tickUp($placeholder){
      global $idIndex;
      if ($placeholder == 0){
        $idIndex = $idIndex;
      }
      else{
        $idIndex += 1;
      }
    }
    function idGen($unitId){//, $hasThisBrickStyleBeenUsed){
      try{
        $servernameagainagain = "localhost";
        $dbnameagainagain = "manchester_veterans_memorial_database";
        $unameagainagain = "phpmyadmin";
        $pswordagainagain = "Y4VnqfDCz2vvMkv";
        $prepconn = new PDO("mysql:host=$servernameagainagain;port=3306;dbname=$dbnameagainagain", $unameagainagain, $pswordagainagain);
        $prepconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prepconn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety
        $teststmt = null;
        $teststmt = $prepconn->prepare("SELECT brickNum FROM a_brick_group");
        $teststmt->execute();
        $answerresult = $teststmt->fetchAll(PDO::FETCH_COLUMN);
        // var_dump($answerresult);
        //if ($hasThisBrickStyleBeenUsed == false){
        if ($answerresult[$unitId] !== NULL){
          $id = $answerresult[$unitId];
          $id = strval($id);
          while (strlen($id) < 3){
            $id = "0" . $id;
          }
          $id = "'" . "a" . $id . "'";
          return $id;
        }
        //}
      }
      // function isThisBrickMultiLines()
      catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
        // $id = "'" . "a" . $id . "'";
        // return $id;
        // $idIndex = $howManyNow;
      }

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
    $newStyle = 0;
    // function isThisStyleNew($number){
    //   global $newStyle;
    //   if ($result[$number] == $result[$number - 1]){
        
    //   }
    // }
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
            <?php tickUp(0); ?>
            <!-- Row 1 -->
            <?php toCommentOrNot(isItANewBrick(0), 1); echo('<div class="brickStyle ' . $result[0] . '" id=' . idGen(0) . 'onclick="brickClicked(' . idGen(0) . ')"></div>'); toCommentOrNot(isItANewBrick(0), 2); ?>
            <?php toCommentOrNot(isItANewBrick(1), 1); echo('<div class="brickStyle ' . $result[1] . '" id=' . idGen(1) . 'onclick="brickClicked(' . idGen(1) . ')"></div>'); toCommentOrNot(isItANewBrick(1), 2); ?>
            <?php toCommentOrNot(isItANewBrick(2), 1); echo('<div class="brickStyle ' . $result[2] . '" id=' . idGen(2) . 'onclick="brickClicked(' . idGen(2) . ')"></div>'); toCommentOrNot(isItANewBrick(2), 2); ?>
            <?php toCommentOrNot(isItANewBrick(3), 1); echo('<div class="brickStyle ' . $result[3] . '" id=' . idGen(3) . 'onclick="brickClicked(' . idGen(3) . ')"></div>'); toCommentOrNot(isItANewBrick(3), 2); ?>
            <?php toCommentOrNot(isItANewBrick(4), 1); echo('<div class="brickStyle ' . $result[4] . '" id=' . idGen(4) . 'onclick="brickClicked(' . idGen(4) . ')"></div>'); toCommentOrNot(isItANewBrick(4), 2); ?>
            <?php toCommentOrNot(isItANewBrick(5), 1); echo('<div class="brickStyle ' . $result[5] . '" id=' . idGen(5) . 'onclick="brickClicked(' . idGen(5) . ')"></div>'); toCommentOrNot(isItANewBrick(5), 2); ?>
            <?php toCommentOrNot(isItANewBrick(6), 1); echo('<div class="brickStyle ' . $result[6] . '" id=' . idGen(6) . 'onclick="brickClicked(' . idGen(6) . ')"></div>'); toCommentOrNot(isItANewBrick(6), 2); ?>
            <?php toCommentOrNot(isItANewBrick(7), 1); echo('<div class="brickStyle ' . $result[7] . '" id=' . idGen(7) . 'onclick="brickClicked(' . idGen(7) . ')"></div>'); toCommentOrNot(isItANewBrick(7), 2); ?>
            <?php toCommentOrNot(isItANewBrick(8), 1); echo('<div class="brickStyle ' . $result[8] . '" id=' . idGen(8) . 'onclick="brickClicked(' . idGen(8) . ')"></div>'); toCommentOrNot(isItANewBrick(8), 2); ?>
            <?php toCommentOrNot(isItANewBrick(9), 1); echo('<div class="brickStyle ' . $result[9] . '" id=' . idGen(9) . 'onclick="brickClicked(' . idGen(9) . ')"></div>'); toCommentOrNot(isItANewBrick(9), 2); ?>
            <?php toCommentOrNot(isItANewBrick(10), 1); echo('<div class="brickStyle ' . $result[10] . '" id=' . idGen(10) . 'onclick="brickClicked(' . idGen(10) . ')"></div>'); toCommentOrNot(isItANewBrick(10), 2); ?>
            <?php toCommentOrNot(isItANewBrick(11), 1); echo('<div class="brickStyle ' . $result[11] . '" id=' . idGen(11) . 'onclick="brickClicked(' . idGen(11) . ')"></div>'); toCommentOrNot(isItANewBrick(11), 2); ?>
            <?php toCommentOrNot(isItANewBrick(12), 1); echo('<div class="brickStyle ' . $result[12] . '" id=' . idGen(12) . 'onclick="brickClicked(' . idGen(12) . ')"></div>'); toCommentOrNot(isItANewBrick(12), 2); ?>
            <?php toCommentOrNot(isItANewBrick(13), 1); echo('<div class="brickStyle ' . $result[13] . '" id=' . idGen(13) . 'onclick="brickClicked(' . idGen(13) . ')"></div>'); toCommentOrNot(isItANewBrick(13), 2); ?>
            <?php toCommentOrNot(isItANewBrick(14), 1); echo('<div class="brickStyle ' . $result[14] . '" id=' . idGen(14) . 'onclick="brickClicked(' . idGen(14) . ')"></div>'); toCommentOrNot(isItANewBrick(14), 2); ?>
            <?php toCommentOrNot(isItANewBrick(15), 1); echo('<div class="brickStyle ' . $result[15] . '" id=' . idGen(15) . 'onclick="brickClicked(' . idGen(15) . ')"></div>'); toCommentOrNot(isItANewBrick(15), 2); ?>
            <?php toCommentOrNot(isItANewBrick(16), 1); echo('<div class="brickStyle ' . $result[16] . '" id=' . idGen(16) . 'onclick="brickClicked(' . idGen(16) . ')"></div>'); toCommentOrNot(isItANewBrick(16), 2); ?>
            <?php toCommentOrNot(isItANewBrick(17), 1); echo('<div class="brickStyle ' . $result[17] . '" id=' . idGen(17) . 'onclick="brickClicked(' . idGen(17) . ')"></div>'); toCommentOrNot(isItANewBrick(17), 2); ?>
            <!-- Row 2 -->
            <?php toCommentOrNot(isItANewBrick(18), 1); echo('<div class="brickStyle ' . $result[18] . '" id=' . idGen(18) . 'onclick="brickClicked(' . idGen(18) . ')"></div>'); toCommentOrNot(isItANewBrick(18), 2); ?>
            <?php toCommentOrNot(isItANewBrick(19), 1); echo('<div class="brickStyle ' . $result[19] . '" id=' . idGen(19) . 'onclick="brickClicked(' . idGen(19) . ')"></div>'); toCommentOrNot(isItANewBrick(19), 2); ?>
            <?php toCommentOrNot(isItANewBrick(20), 1); echo('<div class="brickStyle ' . $result[20] . '" id=' . idGen(20) . 'onclick="brickClicked(' . idGen(20) . ')"></div>'); toCommentOrNot(isItANewBrick(20), 2); ?>
            <?php toCommentOrNot(isItANewBrick(21), 1); echo('<div class="brickStyle ' . $result[21] . '" id=' . idGen(21) . 'onclick="brickClicked(' . idGen(21) . ')"></div>'); toCommentOrNot(isItANewBrick(21), 2); ?>
            <?php toCommentOrNot(isItANewBrick(22), 1); echo('<div class="brickStyle ' . $result[22] . '" id=' . idGen(22) . 'onclick="brickClicked(' . idGen(22) . ')"></div>'); toCommentOrNot(isItANewBrick(22), 2); ?>
            <?php toCommentOrNot(isItANewBrick(23), 1); echo('<div class="brickStyle ' . $result[23] . '" id=' . idGen(23) . 'onclick="brickClicked(' . idGen(23) . ')"></div>'); toCommentOrNot(isItANewBrick(23), 2); ?>
            <?php toCommentOrNot(isItANewBrick(24), 1); echo('<div class="brickStyle ' . $result[24] . '" id=' . idGen(24) . 'onclick="brickClicked(' . idGen(24) . ')"></div>'); toCommentOrNot(isItANewBrick(24), 2); ?>
            <?php toCommentOrNot(isItANewBrick(25), 1); echo('<div class="brickStyle ' . $result[25] . '" id=' . idGen(25) . 'onclick="brickClicked(' . idGen(25) . ')"></div>'); toCommentOrNot(isItANewBrick(25), 2); ?>
            <?php toCommentOrNot(isItANewBrick(26), 1); echo('<div class="brickStyle ' . $result[26] . '" id=' . idGen(26) . 'onclick="brickClicked(' . idGen(26) . ')"></div>'); toCommentOrNot(isItANewBrick(26), 2); ?>
            <?php toCommentOrNot(isItANewBrick(27), 1); echo('<div class="brickStyle ' . $result[27] . '" id=' . idGen(27) . 'onclick="brickClicked(' . idGen(27) . ')"></div>'); toCommentOrNot(isItANewBrick(27), 2); ?>
            <?php toCommentOrNot(isItANewBrick(28), 1); echo('<div class="brickStyle ' . $result[28] . '" id=' . idGen(28) . 'onclick="brickClicked(' . idGen(28) . ')"></div>'); toCommentOrNot(isItANewBrick(28), 2); ?>
            <?php toCommentOrNot(isItANewBrick(29), 1); echo('<div class="brickStyle ' . $result[29] . '" id=' . idGen(29) . 'onclick="brickClicked(' . idGen(29) . ')"></div>'); toCommentOrNot(isItANewBrick(29), 2); ?>
            <?php toCommentOrNot(isItANewBrick(30), 1); echo('<div class="brickStyle ' . $result[30] . '" id=' . idGen(30) . 'onclick="brickClicked(' . idGen(30) . ')"></div>'); toCommentOrNot(isItANewBrick(30), 2); ?>
            <?php toCommentOrNot(isItANewBrick(31), 1); echo('<div class="brickStyle ' . $result[31] . '" id=' . idGen(31) . 'onclick="brickClicked(' . idGen(31) . ')"></div>'); toCommentOrNot(isItANewBrick(31), 2); ?>
            <?php toCommentOrNot(isItANewBrick(32), 1); echo('<div class="brickStyle ' . $result[32] . '" id=' . idGen(32) . 'onclick="brickClicked(' . idGen(32) . ')"></div>'); toCommentOrNot(isItANewBrick(32), 2); ?>
            <?php toCommentOrNot(isItANewBrick(33), 1); echo('<div class="brickStyle ' . $result[33] . '" id=' . idGen(33) . 'onclick="brickClicked(' . idGen(33) . ')"></div>'); toCommentOrNot(isItANewBrick(33), 2); ?>
            <?php toCommentOrNot(isItANewBrick(34), 1); echo('<div class="brickStyle ' . $result[34] . '" id=' . idGen(34) . 'onclick="brickClicked(' . idGen(34) . ')"></div>'); toCommentOrNot(isItANewBrick(34), 2); ?>
            <?php toCommentOrNot(isItANewBrick(35), 1); echo('<div class="brickStyle ' . $result[35] . '" id=' . idGen(35) . 'onclick="brickClicked(' . idGen(35) . ')"></div>'); toCommentOrNot(isItANewBrick(35), 2); ?>
            <!-- Row 3 -->
            <?php toCommentOrNot(isItANewBrick(36), 1); echo('<div class="brickStyle ' . $result[36] . '" id=' . idGen(36) . 'onclick="brickClicked(' . idGen(36) . ')"></div>'); toCommentOrNot(isItANewBrick(36), 2); ?>
            <?php toCommentOrNot(isItANewBrick(37), 1); echo('<div class="brickStyle ' . $result[37] . '" id=' . idGen(37) . 'onclick="brickClicked(' . idGen(37) . ')"></div>'); toCommentOrNot(isItANewBrick(37), 2); ?>
            <?php toCommentOrNot(isItANewBrick(38), 1); echo('<div class="brickStyle ' . $result[38] . '" id=' . idGen(38) . 'onclick="brickClicked(' . idGen(38) . ')"></div>'); toCommentOrNot(isItANewBrick(38), 2); ?>
            <?php toCommentOrNot(isItANewBrick(39), 1); echo('<div class="brickStyle ' . $result[39] . '" id=' . idGen(39) . 'onclick="brickClicked(' . idGen(39) . ')"></div>'); toCommentOrNot(isItANewBrick(39), 2); ?>
            <?php toCommentOrNot(isItANewBrick(40), 1); echo('<div class="brickStyle ' . $result[40] . '" id=' . idGen(40) . 'onclick="brickClicked(' . idGen(40) . ')"></div>'); toCommentOrNot(isItANewBrick(40), 2); ?>
            <?php toCommentOrNot(isItANewBrick(41), 1); echo('<div class="brickStyle ' . $result[41] . '" id=' . idGen(41) . 'onclick="brickClicked(' . idGen(41) . ')"></div>'); toCommentOrNot(isItANewBrick(41), 2); ?>
            <?php toCommentOrNot(isItANewBrick(42), 1); echo('<div class="brickStyle ' . $result[42] . '" id=' . idGen(42) . 'onclick="brickClicked(' . idGen(42) . ')"></div>'); toCommentOrNot(isItANewBrick(42), 2); ?>
            <?php toCommentOrNot(isItANewBrick(43), 1); echo('<div class="brickStyle ' . $result[43] . '" id=' . idGen(43) . 'onclick="brickClicked(' . idGen(43) . ')"></div>'); toCommentOrNot(isItANewBrick(43), 2); ?>
            <?php toCommentOrNot(isItANewBrick(44), 1); echo('<div class="brickStyle ' . $result[44] . '" id=' . idGen(44) . 'onclick="brickClicked(' . idGen(44) . ')"></div>'); toCommentOrNot(isItANewBrick(44), 2); ?>
            <?php toCommentOrNot(isItANewBrick(45), 1); echo('<div class="brickStyle ' . $result[45] . '" id=' . idGen(45) . 'onclick="brickClicked(' . idGen(45) . ')"></div>'); toCommentOrNot(isItANewBrick(45), 2); ?>
            <?php toCommentOrNot(isItANewBrick(46), 1); echo('<div class="brickStyle ' . $result[46] . '" id=' . idGen(46) . 'onclick="brickClicked(' . idGen(46) . ')"></div>'); toCommentOrNot(isItANewBrick(46), 2); ?>
            <?php toCommentOrNot(isItANewBrick(47), 1); echo('<div class="brickStyle ' . $result[47] . '" id=' . idGen(47) . 'onclick="brickClicked(' . idGen(47) . ')"></div>'); toCommentOrNot(isItANewBrick(47), 2); ?>
            <?php toCommentOrNot(isItANewBrick(48), 1); echo('<div class="brickStyle ' . $result[48] . '" id=' . idGen(48) . 'onclick="brickClicked(' . idGen(48) . ')"></div>'); toCommentOrNot(isItANewBrick(48), 2); ?>
            <?php toCommentOrNot(isItANewBrick(49), 1); echo('<div class="brickStyle ' . $result[49] . '" id=' . idGen(49) . 'onclick="brickClicked(' . idGen(49) . ')"></div>'); toCommentOrNot(isItANewBrick(49), 2); ?>
            <?php toCommentOrNot(isItANewBrick(50), 1); echo('<div class="brickStyle ' . $result[50] . '" id=' . idGen(50) . 'onclick="brickClicked(' . idGen(50) . ')"></div>'); toCommentOrNot(isItANewBrick(50), 2); ?>
            <?php toCommentOrNot(isItANewBrick(51), 1); echo('<div class="brickStyle ' . $result[51] . '" id=' . idGen(51) . 'onclick="brickClicked(' . idGen(51) . ')"></div>'); toCommentOrNot(isItANewBrick(51), 2); ?>
            <?php toCommentOrNot(isItANewBrick(52), 1); echo('<div class="brickStyle ' . $result[52] . '" id=' . idGen(52) . 'onclick="brickClicked(' . idGen(52) . ')"></div>'); toCommentOrNot(isItANewBrick(52), 2); ?>
            <?php toCommentOrNot(isItANewBrick(53), 1); echo('<div class="brickStyle ' . $result[53] . '" id=' . idGen(53) . 'onclick="brickClicked(' . idGen(53) . ')"></div>'); toCommentOrNot(isItANewBrick(53), 2); ?>
            <!-- Row 4 -->
            <?php toCommentOrNot(isItANewBrick(54), 1); echo('<div class="brickStyle ' . $result[54] . '" id=' . idGen(54) . 'onclick="brickClicked(' . idGen(54) . ')"></div>'); toCommentOrNot(isItANewBrick(54), 2); ?>
            <?php toCommentOrNot(isItANewBrick(55), 1); echo('<div class="brickStyle ' . $result[55] . '" id=' . idGen(55) . 'onclick="brickClicked(' . idGen(55) . ')"></div>'); toCommentOrNot(isItANewBrick(55), 2); ?>
            <?php toCommentOrNot(isItANewBrick(56), 1); echo('<div class="brickStyle ' . $result[56] . '" id=' . idGen(56) . 'onclick="brickClicked(' . idGen(56) . ')"></div>'); toCommentOrNot(isItANewBrick(56), 2); ?>
            <?php toCommentOrNot(isItANewBrick(57), 1); echo('<div class="brickStyle ' . $result[57] . '" id=' . idGen(57) . 'onclick="brickClicked(' . idGen(57) . ')"></div>'); toCommentOrNot(isItANewBrick(57), 2); ?>
            <?php toCommentOrNot(isItANewBrick(58), 1); echo('<div class="brickStyle ' . $result[58] . '" id=' . idGen(58) . 'onclick="brickClicked(' . idGen(58) . ')"></div>'); toCommentOrNot(isItANewBrick(58), 2); ?>
            <?php toCommentOrNot(isItANewBrick(59), 1); echo('<div class="brickStyle ' . $result[59] . '" id=' . idGen(59) . 'onclick="brickClicked(' . idGen(59) . ')"></div>'); toCommentOrNot(isItANewBrick(59), 2); ?>
            <?php toCommentOrNot(isItANewBrick(60), 1); echo('<div class="brickStyle ' . $result[60] . '" id=' . idGen(60) . 'onclick="brickClicked(' . idGen(60) . ')"></div>'); toCommentOrNot(isItANewBrick(60), 2); ?>
            <?php toCommentOrNot(isItANewBrick(61), 1); echo('<div class="brickStyle ' . $result[61] . '" id=' . idGen(61) . 'onclick="brickClicked(' . idGen(61) . ')"></div>'); toCommentOrNot(isItANewBrick(61), 2); ?>
            <?php toCommentOrNot(isItANewBrick(62), 1); echo('<div class="brickStyle ' . $result[62] . '" id=' . idGen(62) . 'onclick="brickClicked(' . idGen(62) . ')"></div>'); toCommentOrNot(isItANewBrick(62), 2); ?>
            <?php toCommentOrNot(isItANewBrick(63), 1); echo('<div class="brickStyle ' . $result[63] . '" id=' . idGen(63) . 'onclick="brickClicked(' . idGen(63) . ')"></div>'); toCommentOrNot(isItANewBrick(63), 2); ?>
            <?php toCommentOrNot(isItANewBrick(64), 1); echo('<div class="brickStyle ' . $result[64] . '" id=' . idGen(64) . 'onclick="brickClicked(' . idGen(64) . ')"></div>'); toCommentOrNot(isItANewBrick(64), 2); ?>
            <?php toCommentOrNot(isItANewBrick(65), 1); echo('<div class="brickStyle ' . $result[65] . '" id=' . idGen(65) . 'onclick="brickClicked(' . idGen(65) . ')"></div>'); toCommentOrNot(isItANewBrick(65), 2); ?>
            <?php toCommentOrNot(isItANewBrick(66), 1); echo('<div class="brickStyle ' . $result[66] . '" id=' . idGen(66) . 'onclick="brickClicked(' . idGen(66) . ')"></div>'); toCommentOrNot(isItANewBrick(66), 2); ?>
            <?php toCommentOrNot(isItANewBrick(67), 1); echo('<div class="brickStyle ' . $result[67] . '" id=' . idGen(67) . 'onclick="brickClicked(' . idGen(67) . ')"></div>'); toCommentOrNot(isItANewBrick(67), 2); ?>
            <?php toCommentOrNot(isItANewBrick(68), 1); echo('<div class="brickStyle ' . $result[68] . '" id=' . idGen(68) . 'onclick="brickClicked(' . idGen(68) . ')"></div>'); toCommentOrNot(isItANewBrick(68), 2); ?>
            <?php toCommentOrNot(isItANewBrick(69), 1); echo('<div class="brickStyle ' . $result[69] . '" id=' . idGen(69) . 'onclick="brickClicked(' . idGen(69) . ')"></div>'); toCommentOrNot(isItANewBrick(69), 2); ?>
            <?php toCommentOrNot(isItANewBrick(70), 1); echo('<div class="brickStyle ' . $result[70] . '" id=' . idGen(70) . 'onclick="brickClicked(' . idGen(70) . ')"></div>'); toCommentOrNot(isItANewBrick(70), 2); ?>
            <?php toCommentOrNot(isItANewBrick(71), 1); echo('<div class="brickStyle ' . $result[71] . '" id=' . idGen(71) . 'onclick="brickClicked(' . idGen(71) . ')"></div>'); toCommentOrNot(isItANewBrick(71), 2); ?>
            <!-- Row 5 -->
            <?php toCommentOrNot(isItANewBrick(72), 1); echo('<div class="brickStyle ' . $result[72] . '" id=' . idGen(72) . 'onclick="brickClicked(' . idGen(72) . ')"></div>'); toCommentOrNot(isItANewBrick(72), 2); ?>
            <?php toCommentOrNot(isItANewBrick(73), 1); echo('<div class="brickStyle ' . $result[73] . '" id=' . idGen(73) . 'onclick="brickClicked(' . idGen(73) . ')"></div>'); toCommentOrNot(isItANewBrick(73), 2); ?>
            <?php toCommentOrNot(isItANewBrick(74), 1); echo('<div class="brickStyle ' . $result[74] . '" id=' . idGen(74) . 'onclick="brickClicked(' . idGen(74) . ')"></div>'); toCommentOrNot(isItANewBrick(74), 2); ?>
            <?php toCommentOrNot(isItANewBrick(75), 1); echo('<div class="brickStyle ' . $result[75] . '" id=' . idGen(75) . 'onclick="brickClicked(' . idGen(75) . ')"></div>'); toCommentOrNot(isItANewBrick(75), 2); ?>
            <?php toCommentOrNot(isItANewBrick(76), 1); echo('<div class="brickStyle ' . $result[76] . '" id=' . idGen(76) . 'onclick="brickClicked(' . idGen(76) . ')"></div>'); toCommentOrNot(isItANewBrick(76), 2); ?>
            <?php toCommentOrNot(isItANewBrick(77), 1); echo('<div class="brickStyle ' . $result[77] . '" id=' . idGen(77) . 'onclick="brickClicked(' . idGen(77) . ')"></div>'); toCommentOrNot(isItANewBrick(77), 2); ?>
            <?php toCommentOrNot(isItANewBrick(78), 1); echo('<div class="brickStyle ' . $result[78] . '" id=' . idGen(78) . 'onclick="brickClicked(' . idGen(78) . ')"></div>'); toCommentOrNot(isItANewBrick(78), 2); ?>
            <?php toCommentOrNot(isItANewBrick(79), 1); echo('<div class="brickStyle ' . $result[79] . '" id=' . idGen(79) . 'onclick="brickClicked(' . idGen(79) . ')"></div>'); toCommentOrNot(isItANewBrick(79), 2); ?>
            <?php toCommentOrNot(isItANewBrick(80), 1); echo('<div class="brickStyle ' . $result[80] . '" id=' . idGen(80) . 'onclick="brickClicked(' . idGen(80) . ')"></div>'); toCommentOrNot(isItANewBrick(80), 2); ?>
            <?php toCommentOrNot(isItANewBrick(81), 1); echo('<div class="brickStyle ' . $result[81] . '" id=' . idGen(81) . 'onclick="brickClicked(' . idGen(81) . ')"></div>'); toCommentOrNot(isItANewBrick(81), 2); ?>
            <?php toCommentOrNot(isItANewBrick(82), 1); echo('<div class="brickStyle ' . $result[82] . '" id=' . idGen(82) . 'onclick="brickClicked(' . idGen(82) . ')"></div>'); toCommentOrNot(isItANewBrick(82), 2); ?>
            <?php toCommentOrNot(isItANewBrick(83), 1); echo('<div class="brickStyle ' . $result[83] . '" id=' . idGen(83) . 'onclick="brickClicked(' . idGen(83) . ')"></div>'); toCommentOrNot(isItANewBrick(83), 2); ?>
            <?php toCommentOrNot(isItANewBrick(84), 1); echo('<div class="brickStyle ' . $result[84] . '" id=' . idGen(84) . 'onclick="brickClicked(' . idGen(84) . ')"></div>'); toCommentOrNot(isItANewBrick(84), 2); ?>
            <?php toCommentOrNot(isItANewBrick(85), 1); echo('<div class="brickStyle ' . $result[85] . '" id=' . idGen(85) . 'onclick="brickClicked(' . idGen(85) . ')"></div>'); toCommentOrNot(isItANewBrick(85), 2); ?>
            <?php toCommentOrNot(isItANewBrick(86), 1); echo('<div class="brickStyle ' . $result[86] . '" id=' . idGen(86) . 'onclick="brickClicked(' . idGen(86) . ')"></div>'); toCommentOrNot(isItANewBrick(86), 2); ?>
            <?php toCommentOrNot(isItANewBrick(87), 1); echo('<div class="brickStyle ' . $result[87] . '" id=' . idGen(87) . 'onclick="brickClicked(' . idGen(87) . ')"></div>'); toCommentOrNot(isItANewBrick(87), 2); ?>
            <?php toCommentOrNot(isItANewBrick(88), 1); echo('<div class="brickStyle ' . $result[88] . '" id=' . idGen(88) . 'onclick="brickClicked(' . idGen(88) . ')"></div>'); toCommentOrNot(isItANewBrick(88), 2); ?>
            <?php toCommentOrNot(isItANewBrick(89), 1); echo('<div class="brickStyle ' . $result[89] . '" id=' . idGen(89) . 'onclick="brickClicked(' . idGen(89) . ')"></div>'); toCommentOrNot(isItANewBrick(89), 2); ?>
            <!-- Row 6 -->
            <?php toCommentOrNot(isItANewBrick(90), 1); echo('<div class="brickStyle ' . $result[90] . '" id=' . idGen(90) . 'onclick="brickClicked(' . idGen(90) . ')"></div>'); toCommentOrNot(isItANewBrick(90), 2); ?>
            <?php toCommentOrNot(isItANewBrick(91), 1); echo('<div class="brickStyle ' . $result[91] . '" id=' . idGen(91) . 'onclick="brickClicked(' . idGen(91) . ')"></div>'); toCommentOrNot(isItANewBrick(91), 2); ?>
            <?php toCommentOrNot(isItANewBrick(92), 1); echo('<div class="brickStyle ' . $result[92] . '" id=' . idGen(92) . 'onclick="brickClicked(' . idGen(92) . ')"></div>'); toCommentOrNot(isItANewBrick(92), 2); ?>
            <?php toCommentOrNot(isItANewBrick(93), 1); echo('<div class="brickStyle ' . $result[93] . '" id=' . idGen(93) . 'onclick="brickClicked(' . idGen(93) . ')"></div>'); toCommentOrNot(isItANewBrick(93), 2); ?>
            <?php toCommentOrNot(isItANewBrick(94), 1); echo('<div class="brickStyle ' . $result[94] . '" id=' . idGen(94) . 'onclick="brickClicked(' . idGen(94) . ')"></div>'); toCommentOrNot(isItANewBrick(94), 2); ?>
            <?php toCommentOrNot(isItANewBrick(95), 1); echo('<div class="brickStyle ' . $result[95] . '" id=' . idGen(95) . 'onclick="brickClicked(' . idGen(95) . ')"></div>'); toCommentOrNot(isItANewBrick(95), 2); ?>
            <?php toCommentOrNot(isItANewBrick(96), 1); echo('<div class="brickStyle ' . $result[96] . '" id=' . idGen(96) . 'onclick="brickClicked(' . idGen(96) . ')"></div>'); toCommentOrNot(isItANewBrick(96), 2); ?>
            <?php toCommentOrNot(isItANewBrick(97), 1); echo('<div class="brickStyle ' . $result[97] . '" id=' . idGen(97) . 'onclick="brickClicked(' . idGen(97) . ')"></div>'); toCommentOrNot(isItANewBrick(97), 2); ?>
            <?php toCommentOrNot(isItANewBrick(98), 1); echo('<div class="brickStyle ' . $result[98] . '" id=' . idGen(98) . 'onclick="brickClicked(' . idGen(98) . ')"></div>'); toCommentOrNot(isItANewBrick(98), 2); ?>
            <?php toCommentOrNot(isItANewBrick(99), 1); echo('<div class="brickStyle ' . $result[99] . '" id=' . idGen(99) . 'onclick="brickClicked(' . idGen(99) . ')"></div>'); toCommentOrNot(isItANewBrick(99), 2); ?>
            <?php toCommentOrNot(isItANewBrick(100), 1); echo('<div class="brickStyle ' . $result[100] . '" id=' . idGen(100) . 'onclick="brickClicked(' . idGen(100) . ')"></div>'); toCommentOrNot(isItANewBrick(100), 2); ?>
            <?php toCommentOrNot(isItANewBrick(101), 1); echo('<div class="brickStyle ' . $result[101] . '" id=' . idGen(101) . 'onclick="brickClicked(' . idGen(101) . ')"></div>'); toCommentOrNot(isItANewBrick(101), 2); ?>
            <?php toCommentOrNot(isItANewBrick(102), 1); echo('<div class="brickStyle ' . $result[102] . '" id=' . idGen(102) . 'onclick="brickClicked(' . idGen(102) . ')"></div>'); toCommentOrNot(isItANewBrick(102), 2); ?>
            <?php toCommentOrNot(isItANewBrick(103), 1); echo('<div class="brickStyle ' . $result[103] . '" id=' . idGen(103) . 'onclick="brickClicked(' . idGen(103) . ')"></div>'); toCommentOrNot(isItANewBrick(103), 2); ?>
            <?php toCommentOrNot(isItANewBrick(104), 1); echo('<div class="brickStyle ' . $result[104] . '" id=' . idGen(104) . 'onclick="brickClicked(' . idGen(104) . ')"></div>'); toCommentOrNot(isItANewBrick(104), 2); ?>
            <?php toCommentOrNot(isItANewBrick(105), 1); echo('<div class="brickStyle ' . $result[105] . '" id=' . idGen(105) . 'onclick="brickClicked(' . idGen(105) . ')"></div>'); toCommentOrNot(isItANewBrick(105), 2); ?>
            <?php toCommentOrNot(isItANewBrick(106), 1); echo('<div class="brickStyle ' . $result[106] . '" id=' . idGen(106) . 'onclick="brickClicked(' . idGen(106) . ')"></div>'); toCommentOrNot(isItANewBrick(106), 2); ?>
            <?php toCommentOrNot(isItANewBrick(107), 1); echo('<div class="brickStyle ' . $result[107] . '" id=' . idGen(107) . 'onclick="brickClicked(' . idGen(107) . ')"></div>'); toCommentOrNot(isItANewBrick(107), 2); ?>
            <!-- Row 7 -->
            <?php toCommentOrNot(isItANewBrick(108), 1); echo('<div class="brickStyle ' . $result[108] . '" id=' . idGen(108) . 'onclick="brickClicked(' . idGen(108) . ')"></div>'); toCommentOrNot(isItANewBrick(108), 2); ?>
            <?php toCommentOrNot(isItANewBrick(109), 1); echo('<div class="brickStyle ' . $result[109] . '" id=' . idGen(109) . 'onclick="brickClicked(' . idGen(109) . ')"></div>'); toCommentOrNot(isItANewBrick(109), 2); ?>
            <?php toCommentOrNot(isItANewBrick(110), 1); echo('<div class="brickStyle ' . $result[110] . '" id=' . idGen(110) . 'onclick="brickClicked(' . idGen(110) . ')"></div>'); toCommentOrNot(isItANewBrick(110), 2); ?>
            <?php toCommentOrNot(isItANewBrick(111), 1); echo('<div class="brickStyle ' . $result[111] . '" id=' . idGen(111) . 'onclick="brickClicked(' . idGen(111) . ')"></div>'); toCommentOrNot(isItANewBrick(111), 2); ?>
            <?php toCommentOrNot(isItANewBrick(112), 1); echo('<div class="brickStyle ' . $result[112] . '" id=' . idGen(112) . 'onclick="brickClicked(' . idGen(112) . ')"></div>'); toCommentOrNot(isItANewBrick(112), 2); ?>
            <?php toCommentOrNot(isItANewBrick(113), 1); echo('<div class="brickStyle ' . $result[113] . '" id=' . idGen(113) . 'onclick="brickClicked(' . idGen(113) . ')"></div>'); toCommentOrNot(isItANewBrick(113), 2); ?>
            <?php toCommentOrNot(isItANewBrick(114), 1); echo('<div class="brickStyle ' . $result[114] . '" id=' . idGen(114) . 'onclick="brickClicked(' . idGen(114) . ')"></div>'); toCommentOrNot(isItANewBrick(114), 2); ?>
            <?php toCommentOrNot(isItANewBrick(115), 1); echo('<div class="brickStyle ' . $result[115] . '" id=' . idGen(115) . 'onclick="brickClicked(' . idGen(115) . ')"></div>'); toCommentOrNot(isItANewBrick(115), 2); ?>
            <?php toCommentOrNot(isItANewBrick(116), 1); echo('<div class="brickStyle ' . $result[116] . '" id=' . idGen(116) . 'onclick="brickClicked(' . idGen(116) . ')"></div>'); toCommentOrNot(isItANewBrick(116), 2); ?>
            <?php toCommentOrNot(isItANewBrick(117), 1); echo('<div class="brickStyle ' . $result[117] . '" id=' . idGen(117) . 'onclick="brickClicked(' . idGen(117) . ')"></div>'); toCommentOrNot(isItANewBrick(117), 2); ?>
            <?php toCommentOrNot(isItANewBrick(118), 1); echo('<div class="brickStyle ' . $result[118] . '" id=' . idGen(118) . 'onclick="brickClicked(' . idGen(118) . ')"></div>'); toCommentOrNot(isItANewBrick(118), 2); ?>
            <?php toCommentOrNot(isItANewBrick(119), 1); echo('<div class="brickStyle ' . $result[119] . '" id=' . idGen(119) . 'onclick="brickClicked(' . idGen(119) . ')"></div>'); toCommentOrNot(isItANewBrick(119), 2); ?>
            <?php toCommentOrNot(isItANewBrick(120), 1); echo('<div class="brickStyle ' . $result[120] . '" id=' . idGen(120) . 'onclick="brickClicked(' . idGen(120) . ')"></div>'); toCommentOrNot(isItANewBrick(120), 2); ?>
            <?php toCommentOrNot(isItANewBrick(121), 1); echo('<div class="brickStyle ' . $result[121] . '" id=' . idGen(121) . 'onclick="brickClicked(' . idGen(121) . ')"></div>'); toCommentOrNot(isItANewBrick(121), 2); ?>
            <?php toCommentOrNot(isItANewBrick(122), 1); echo('<div class="brickStyle ' . $result[122] . '" id=' . idGen(122) . 'onclick="brickClicked(' . idGen(122) . ')"></div>'); toCommentOrNot(isItANewBrick(122), 2); ?>
            <?php toCommentOrNot(isItANewBrick(123), 1); echo('<div class="brickStyle ' . $result[123] . '" id=' . idGen(123) . 'onclick="brickClicked(' . idGen(123) . ')"></div>'); toCommentOrNot(isItANewBrick(123), 2); ?>
            <?php toCommentOrNot(isItANewBrick(124), 1); echo('<div class="brickStyle ' . $result[124] . '" id=' . idGen(124) . 'onclick="brickClicked(' . idGen(124) . ')"></div>'); toCommentOrNot(isItANewBrick(124), 2); ?>
            <?php toCommentOrNot(isItANewBrick(125), 1); echo('<div class="brickStyle ' . $result[125] . '" id=' . idGen(125) . 'onclick="brickClicked(' . idGen(125) . ')"></div>'); toCommentOrNot(isItANewBrick(125), 2); ?>
            <!-- Row 8 -->
            <?php toCommentOrNot(isItANewBrick(126), 1); echo('<div class="brickStyle ' . $result[126] . '" id=' . idGen(126) . 'onclick="brickClicked(' . idGen(126) . ')"></div>'); toCommentOrNot(isItANewBrick(126), 2); ?>
            <?php toCommentOrNot(isItANewBrick(127), 1); echo('<div class="brickStyle ' . $result[127] . '" id=' . idGen(127) . 'onclick="brickClicked(' . idGen(127) . ')"></div>'); toCommentOrNot(isItANewBrick(127), 2); ?>
            <?php toCommentOrNot(isItANewBrick(128), 1); echo('<div class="brickStyle ' . $result[128] . '" id=' . idGen(128) . 'onclick="brickClicked(' . idGen(128) . ')"></div>'); toCommentOrNot(isItANewBrick(128), 2); ?>
            <?php toCommentOrNot(isItANewBrick(129), 1); echo('<div class="brickStyle ' . $result[129] . '" id=' . idGen(129) . 'onclick="brickClicked(' . idGen(129) . ')"></div>'); toCommentOrNot(isItANewBrick(129), 2); ?>
            <?php toCommentOrNot(isItANewBrick(130), 1); echo('<div class="brickStyle ' . $result[130] . '" id=' . idGen(130) . 'onclick="brickClicked(' . idGen(130) . ')"></div>'); toCommentOrNot(isItANewBrick(130), 2); ?>
            <?php toCommentOrNot(isItANewBrick(131), 1); echo('<div class="brickStyle ' . $result[131] . '" id=' . idGen(131) . 'onclick="brickClicked(' . idGen(131) . ')"></div>'); toCommentOrNot(isItANewBrick(131), 2); ?>
            <?php toCommentOrNot(isItANewBrick(132), 1); echo('<div class="brickStyle ' . $result[132] . '" id=' . idGen(132) . 'onclick="brickClicked(' . idGen(132) . ')"></div>'); toCommentOrNot(isItANewBrick(132), 2); ?>
            <?php toCommentOrNot(isItANewBrick(133), 1); echo('<div class="brickStyle ' . $result[133] . '" id=' . idGen(133) . 'onclick="brickClicked(' . idGen(133) . ')"></div>'); toCommentOrNot(isItANewBrick(133), 2); ?>
            <?php toCommentOrNot(isItANewBrick(134), 1); echo('<div class="brickStyle ' . $result[134] . '" id=' . idGen(134) . 'onclick="brickClicked(' . idGen(134) . ')"></div>'); toCommentOrNot(isItANewBrick(134), 2); ?>
            <?php toCommentOrNot(isItANewBrick(135), 1); echo('<div class="brickStyle ' . $result[135] . '" id=' . idGen(135) . 'onclick="brickClicked(' . idGen(135) . ')"></div>'); toCommentOrNot(isItANewBrick(135), 2); ?>
            <?php toCommentOrNot(isItANewBrick(136), 1); echo('<div class="brickStyle ' . $result[136] . '" id=' . idGen(136) . 'onclick="brickClicked(' . idGen(136) . ')"></div>'); toCommentOrNot(isItANewBrick(136), 2); ?>
            <?php toCommentOrNot(isItANewBrick(137), 1); echo('<div class="brickStyle ' . $result[137] . '" id=' . idGen(137) . 'onclick="brickClicked(' . idGen(137) . ')"></div>'); toCommentOrNot(isItANewBrick(137), 2); ?>
            <?php toCommentOrNot(isItANewBrick(138), 1); echo('<div class="brickStyle ' . $result[138] . '" id=' . idGen(138) . 'onclick="brickClicked(' . idGen(138) . ')"></div>'); toCommentOrNot(isItANewBrick(138), 2); ?>
            <?php toCommentOrNot(isItANewBrick(139), 1); echo('<div class="brickStyle ' . $result[139] . '" id=' . idGen(139) . 'onclick="brickClicked(' . idGen(139) . ')"></div>'); toCommentOrNot(isItANewBrick(139), 2); ?>
            <?php toCommentOrNot(isItANewBrick(140), 1); echo('<div class="brickStyle ' . $result[140] . '" id=' . idGen(140) . 'onclick="brickClicked(' . idGen(140) . ')"></div>'); toCommentOrNot(isItANewBrick(140), 2); ?>
            <?php toCommentOrNot(isItANewBrick(141), 1); echo('<div class="brickStyle ' . $result[141] . '" id=' . idGen(141) . 'onclick="brickClicked(' . idGen(141) . ')"></div>'); toCommentOrNot(isItANewBrick(141), 2); ?>
            <?php toCommentOrNot(isItANewBrick(142), 1); echo('<div class="brickStyle ' . $result[142] . '" id=' . idGen(142) . 'onclick="brickClicked(' . idGen(142) . ')"></div>'); toCommentOrNot(isItANewBrick(142), 2); ?>
            <?php toCommentOrNot(isItANewBrick(143), 1); echo('<div class="brickStyle ' . $result[143] . '" id=' . idGen(143) . 'onclick="brickClicked(' . idGen(143) . ')"></div>'); toCommentOrNot(isItANewBrick(143), 2); ?>
            <!-- Row 9 -->
            <?php toCommentOrNot(isItANewBrick(144), 1); echo('<div class="brickStyle ' . $result[144] . '" id=' . idGen(144) . 'onclick="brickClicked(' . idGen(144) . ')"></div>'); toCommentOrNot(isItANewBrick(144), 2); ?>
            <?php toCommentOrNot(isItANewBrick(145), 1); echo('<div class="brickStyle ' . $result[145] . '" id=' . idGen(145) . 'onclick="brickClicked(' . idGen(145) . ')"></div>'); toCommentOrNot(isItANewBrick(145), 2); ?>
            <?php toCommentOrNot(isItANewBrick(146), 1); echo('<div class="brickStyle ' . $result[146] . '" id=' . idGen(146) . 'onclick="brickClicked(' . idGen(146) . ')"></div>'); toCommentOrNot(isItANewBrick(146), 2); ?>
            <?php toCommentOrNot(isItANewBrick(147), 1); echo('<div class="brickStyle ' . $result[147] . '" id=' . idGen(147) . 'onclick="brickClicked(' . idGen(147) . ')"></div>'); toCommentOrNot(isItANewBrick(147), 2); ?>
            <?php toCommentOrNot(isItANewBrick(148), 1); echo('<div class="brickStyle ' . $result[148] . '" id=' . idGen(148) . 'onclick="brickClicked(' . idGen(148) . ')"></div>'); toCommentOrNot(isItANewBrick(148), 2); ?>
            <?php toCommentOrNot(isItANewBrick(149), 1); echo('<div class="brickStyle ' . $result[149] . '" id=' . idGen(149) . 'onclick="brickClicked(' . idGen(149) . ')"></div>'); toCommentOrNot(isItANewBrick(149), 2); ?>
            <?php toCommentOrNot(isItANewBrick(150), 1); echo('<div class="brickStyle ' . $result[150] . '" id=' . idGen(150) . 'onclick="brickClicked(' . idGen(150) . ')"></div>'); toCommentOrNot(isItANewBrick(150), 2); ?>
            <?php toCommentOrNot(isItANewBrick(151), 1); echo('<div class="brickStyle ' . $result[151] . '" id=' . idGen(151) . 'onclick="brickClicked(' . idGen(151) . ')"></div>'); toCommentOrNot(isItANewBrick(151), 2); ?>
            <?php toCommentOrNot(isItANewBrick(152), 1); echo('<div class="brickStyle ' . $result[152] . '" id=' . idGen(152) . 'onclick="brickClicked(' . idGen(152) . ')"></div>'); toCommentOrNot(isItANewBrick(152), 2); ?>
            <?php toCommentOrNot(isItANewBrick(153), 1); echo('<div class="brickStyle ' . $result[153] . '" id=' . idGen(153) . 'onclick="brickClicked(' . idGen(153) . ')"></div>'); toCommentOrNot(isItANewBrick(153), 2); ?>
            <?php toCommentOrNot(isItANewBrick(154), 1); echo('<div class="brickStyle ' . $result[154] . '" id=' . idGen(154) . 'onclick="brickClicked(' . idGen(154) . ')"></div>'); toCommentOrNot(isItANewBrick(154), 2); ?>
            <?php toCommentOrNot(isItANewBrick(155), 1); echo('<div class="brickStyle ' . $result[155] . '" id=' . idGen(155) . 'onclick="brickClicked(' . idGen(155) . ')"></div>'); toCommentOrNot(isItANewBrick(155), 2); ?>
            <?php toCommentOrNot(isItANewBrick(156), 1); echo('<div class="brickStyle ' . $result[156] . '" id=' . idGen(156) . 'onclick="brickClicked(' . idGen(156) . ')"></div>'); toCommentOrNot(isItANewBrick(156), 2); ?>
            <?php toCommentOrNot(isItANewBrick(157), 1); echo('<div class="brickStyle ' . $result[157] . '" id=' . idGen(157) . 'onclick="brickClicked(' . idGen(157) . ')"></div>'); toCommentOrNot(isItANewBrick(157), 2); ?>
            <?php toCommentOrNot(isItANewBrick(158), 1); echo('<div class="brickStyle ' . $result[158] . '" id=' . idGen(158) . 'onclick="brickClicked(' . idGen(158) . ')"></div>'); toCommentOrNot(isItANewBrick(158), 2); ?>
            <?php toCommentOrNot(isItANewBrick(159), 1); echo('<div class="brickStyle ' . $result[159] . '" id=' . idGen(159) . 'onclick="brickClicked(' . idGen(159) . ')"></div>'); toCommentOrNot(isItANewBrick(159), 2); ?>
            <?php toCommentOrNot(isItANewBrick(160), 1); echo('<div class="brickStyle ' . $result[160] . '" id=' . idGen(160) . 'onclick="brickClicked(' . idGen(160) . ')"></div>'); toCommentOrNot(isItANewBrick(160), 2); ?>
            <?php toCommentOrNot(isItANewBrick(161), 1); echo('<div class="brickStyle ' . $result[161] . '" id=' . idGen(161) . 'onclick="brickClicked(' . idGen(161) . ')"></div>'); toCommentOrNot(isItANewBrick(161), 2); ?>
            <!-- Row 10 -->
            <?php toCommentOrNot(isItANewBrick(162), 1); echo('<div class="brickStyle ' . $result[162] . '" id=' . idGen(162) . 'onclick="brickClicked(' . idGen(162) . ')"></div>'); toCommentOrNot(isItANewBrick(162), 2); ?>
            <?php toCommentOrNot(isItANewBrick(163), 1); echo('<div class="brickStyle ' . $result[163] . '" id=' . idGen(163) . 'onclick="brickClicked(' . idGen(163) . ')"></div>'); toCommentOrNot(isItANewBrick(163), 2); ?>
            <?php toCommentOrNot(isItANewBrick(164), 1); echo('<div class="brickStyle ' . $result[164] . '" id=' . idGen(164) . 'onclick="brickClicked(' . idGen(164) . ')"></div>'); toCommentOrNot(isItANewBrick(164), 2); ?>
            <?php toCommentOrNot(isItANewBrick(165), 1); echo('<div class="brickStyle ' . $result[165] . '" id=' . idGen(165) . 'onclick="brickClicked(' . idGen(165) . ')"></div>'); toCommentOrNot(isItANewBrick(165), 2); ?>
            <?php toCommentOrNot(isItANewBrick(166), 1); echo('<div class="brickStyle ' . $result[166] . '" id=' . idGen(166) . 'onclick="brickClicked(' . idGen(166) . ')"></div>'); toCommentOrNot(isItANewBrick(166), 2); ?>
            <?php toCommentOrNot(isItANewBrick(167), 1); echo('<div class="brickStyle ' . $result[167] . '" id=' . idGen(167) . 'onclick="brickClicked(' . idGen(167) . ')"></div>'); toCommentOrNot(isItANewBrick(167), 2); ?>
            <?php toCommentOrNot(isItANewBrick(168), 1); echo('<div class="brickStyle ' . $result[168] . '" id=' . idGen(168) . 'onclick="brickClicked(' . idGen(168) . ')"></div>'); toCommentOrNot(isItANewBrick(168), 2); ?>
            <?php toCommentOrNot(isItANewBrick(169), 1); echo('<div class="brickStyle ' . $result[169] . '" id=' . idGen(169) . 'onclick="brickClicked(' . idGen(169) . ')"></div>'); toCommentOrNot(isItANewBrick(169), 2); ?>
            <?php toCommentOrNot(isItANewBrick(170), 1); echo('<div class="brickStyle ' . $result[170] . '" id=' . idGen(170) . 'onclick="brickClicked(' . idGen(170) . ')"></div>'); toCommentOrNot(isItANewBrick(170), 2); ?>
            <?php toCommentOrNot(isItANewBrick(171), 1); echo('<div class="brickStyle ' . $result[171] . '" id=' . idGen(171) . 'onclick="brickClicked(' . idGen(171) . ')"></div>'); toCommentOrNot(isItANewBrick(171), 2); ?>
            <?php toCommentOrNot(isItANewBrick(172), 1); echo('<div class="brickStyle ' . $result[172] . '" id=' . idGen(172) . 'onclick="brickClicked(' . idGen(172) . ')"></div>'); toCommentOrNot(isItANewBrick(172), 2); ?>
            <?php toCommentOrNot(isItANewBrick(173), 1); echo('<div class="brickStyle ' . $result[173] . '" id=' . idGen(173) . 'onclick="brickClicked(' . idGen(173) . ')"></div>'); toCommentOrNot(isItANewBrick(173), 2); ?>
            <?php toCommentOrNot(isItANewBrick(174), 1); echo('<div class="brickStyle ' . $result[174] . '" id=' . idGen(174) . 'onclick="brickClicked(' . idGen(174) . ')"></div>'); toCommentOrNot(isItANewBrick(174), 2); ?>
            <?php toCommentOrNot(isItANewBrick(175), 1); echo('<div class="brickStyle ' . $result[175] . '" id=' . idGen(175) . 'onclick="brickClicked(' . idGen(175) . ')"></div>'); toCommentOrNot(isItANewBrick(175), 2); ?>
            <?php toCommentOrNot(isItANewBrick(176), 1); echo('<div class="brickStyle ' . $result[176] . '" id=' . idGen(176) . 'onclick="brickClicked(' . idGen(176) . ')"></div>'); toCommentOrNot(isItANewBrick(176), 2); ?>
            <?php toCommentOrNot(isItANewBrick(177), 1); echo('<div class="brickStyle ' . $result[177] . '" id=' . idGen(177) . 'onclick="brickClicked(' . idGen(177) . ')"></div>'); toCommentOrNot(isItANewBrick(177), 2); ?>
            <?php toCommentOrNot(isItANewBrick(178), 1); echo('<div class="brickStyle ' . $result[178] . '" id=' . idGen(178) . 'onclick="brickClicked(' . idGen(178) . ')"></div>'); toCommentOrNot(isItANewBrick(178), 2); ?>
            <?php toCommentOrNot(isItANewBrick(179), 1); echo('<div class="brickStyle ' . $result[179] . '" id=' . idGen(179) . 'onclick="brickClicked(' . idGen(179) . ')"></div>'); toCommentOrNot(isItANewBrick(179), 2); ?>
            <!-- Row 11 -->
            <?php toCommentOrNot(isItANewBrick(180), 1); echo('<div class="brickStyle ' . $result[180] . '" id=' . idGen(180) . 'onclick="brickClicked(' . idGen(180) . ')"></div>'); toCommentOrNot(isItANewBrick(180), 2); ?>
            <?php toCommentOrNot(isItANewBrick(181), 1); echo('<div class="brickStyle ' . $result[181] . '" id=' . idGen(181) . 'onclick="brickClicked(' . idGen(181) . ')"></div>'); toCommentOrNot(isItANewBrick(181), 2); ?>
            <?php toCommentOrNot(isItANewBrick(182), 1); echo('<div class="brickStyle ' . $result[182] . '" id=' . idGen(182) . 'onclick="brickClicked(' . idGen(182) . ')"></div>'); toCommentOrNot(isItANewBrick(182), 2); ?>
            <?php toCommentOrNot(isItANewBrick(183), 1); echo('<div class="brickStyle ' . $result[183] . '" id=' . idGen(183) . 'onclick="brickClicked(' . idGen(183) . ')"></div>'); toCommentOrNot(isItANewBrick(183), 2); ?>
            <?php toCommentOrNot(isItANewBrick(184), 1); echo('<div class="brickStyle ' . $result[184] . '" id=' . idGen(184) . 'onclick="brickClicked(' . idGen(184) . ')"></div>'); toCommentOrNot(isItANewBrick(184), 2); ?>
            <?php toCommentOrNot(isItANewBrick(185), 1); echo('<div class="brickStyle ' . $result[185] . '" id=' . idGen(185) . 'onclick="brickClicked(' . idGen(185) . ')"></div>'); toCommentOrNot(isItANewBrick(185), 2); ?>
            <?php toCommentOrNot(isItANewBrick(186), 1); echo('<div class="brickStyle ' . $result[186] . '" id=' . idGen(186) . 'onclick="brickClicked(' . idGen(186) . ')"></div>'); toCommentOrNot(isItANewBrick(186), 2); ?>
            <?php toCommentOrNot(isItANewBrick(187), 1); echo('<div class="brickStyle ' . $result[187] . '" id=' . idGen(187) . 'onclick="brickClicked(' . idGen(187) . ')"></div>'); toCommentOrNot(isItANewBrick(187), 2); ?>
            <?php toCommentOrNot(isItANewBrick(188), 1); echo('<div class="brickStyle ' . $result[188] . '" id=' . idGen(188) . 'onclick="brickClicked(' . idGen(188) . ')"></div>'); toCommentOrNot(isItANewBrick(188), 2); ?>
            <?php toCommentOrNot(isItANewBrick(189), 1); echo('<div class="brickStyle ' . $result[189] . '" id=' . idGen(189) . 'onclick="brickClicked(' . idGen(189) . ')"></div>'); toCommentOrNot(isItANewBrick(189), 2); ?>
            <?php toCommentOrNot(isItANewBrick(190), 1); echo('<div class="brickStyle ' . $result[190] . '" id=' . idGen(190) . 'onclick="brickClicked(' . idGen(190) . ')"></div>'); toCommentOrNot(isItANewBrick(190), 2); ?>
            <?php toCommentOrNot(isItANewBrick(191), 1); echo('<div class="brickStyle ' . $result[191] . '" id=' . idGen(191) . 'onclick="brickClicked(' . idGen(191) . ')"></div>'); toCommentOrNot(isItANewBrick(191), 2); ?>
            <?php toCommentOrNot(isItANewBrick(192), 1); echo('<div class="brickStyle ' . $result[192] . '" id=' . idGen(192) . 'onclick="brickClicked(' . idGen(192) . ')"></div>'); toCommentOrNot(isItANewBrick(192), 2); ?>
            <?php toCommentOrNot(isItANewBrick(193), 1); echo('<div class="brickStyle ' . $result[193] . '" id=' . idGen(193) . 'onclick="brickClicked(' . idGen(193) . ')"></div>'); toCommentOrNot(isItANewBrick(193), 2); ?>
            <?php toCommentOrNot(isItANewBrick(194), 1); echo('<div class="brickStyle ' . $result[194] . '" id=' . idGen(194) . 'onclick="brickClicked(' . idGen(194) . ')"></div>'); toCommentOrNot(isItANewBrick(194), 2); ?>
            <?php toCommentOrNot(isItANewBrick(195), 1); echo('<div class="brickStyle ' . $result[195] . '" id=' . idGen(195) . 'onclick="brickClicked(' . idGen(195) . ')"></div>'); toCommentOrNot(isItANewBrick(195), 2); ?>
            <?php toCommentOrNot(isItANewBrick(196), 1); echo('<div class="brickStyle ' . $result[196] . '" id=' . idGen(196) . 'onclick="brickClicked(' . idGen(196) . ')"></div>'); toCommentOrNot(isItANewBrick(196), 2); ?>
            <?php toCommentOrNot(isItANewBrick(197), 1); echo('<div class="brickStyle ' . $result[197] . '" id=' . idGen(197) . 'onclick="brickClicked(' . idGen(197) . ')"></div>'); toCommentOrNot(isItANewBrick(197), 2); ?>
            <!-- Row 12 -->
            <?php toCommentOrNot(isItANewBrick(198), 1); echo('<div class="brickStyle ' . $result[198] . '" id=' . idGen(198) . 'onclick="brickClicked(' . idGen(198) . ')"></div>'); toCommentOrNot(isItANewBrick(198), 2); ?>
            <?php toCommentOrNot(isItANewBrick(199), 1); echo('<div class="brickStyle ' . $result[199] . '" id=' . idGen(199) . 'onclick="brickClicked(' . idGen(199) . ')"></div>'); toCommentOrNot(isItANewBrick(199), 2); ?>
            <?php toCommentOrNot(isItANewBrick(200), 1); echo('<div class="brickStyle ' . $result[200] . '" id=' . idGen(200) . 'onclick="brickClicked(' . idGen(200) . ')"></div>'); toCommentOrNot(isItANewBrick(200), 2); ?>
            <?php toCommentOrNot(isItANewBrick(201), 1); echo('<div class="brickStyle ' . $result[201] . '" id=' . idGen(201) . 'onclick="brickClicked(' . idGen(201) . ')"></div>'); toCommentOrNot(isItANewBrick(201), 2); ?>
            <?php toCommentOrNot(isItANewBrick(202), 1); echo('<div class="brickStyle ' . $result[202] . '" id=' . idGen(202) . 'onclick="brickClicked(' . idGen(202) . ')"></div>'); toCommentOrNot(isItANewBrick(202), 2); ?>
            <?php toCommentOrNot(isItANewBrick(203), 1); echo('<div class="brickStyle ' . $result[203] . '" id=' . idGen(203) . 'onclick="brickClicked(' . idGen(203) . ')"></div>'); toCommentOrNot(isItANewBrick(203), 2); ?>
            <?php toCommentOrNot(isItANewBrick(204), 1); echo('<div class="brickStyle ' . $result[204] . '" id=' . idGen(204) . 'onclick="brickClicked(' . idGen(204) . ')"></div>'); toCommentOrNot(isItANewBrick(204), 2); ?>
            <?php toCommentOrNot(isItANewBrick(205), 1); echo('<div class="brickStyle ' . $result[205] . '" id=' . idGen(205) . 'onclick="brickClicked(' . idGen(205) . ')"></div>'); toCommentOrNot(isItANewBrick(205), 2); ?>
            <?php toCommentOrNot(isItANewBrick(206), 1); echo('<div class="brickStyle ' . $result[206] . '" id=' . idGen(206) . 'onclick="brickClicked(' . idGen(206) . ')"></div>'); toCommentOrNot(isItANewBrick(206), 2); ?>
            <?php toCommentOrNot(isItANewBrick(207), 1); echo('<div class="brickStyle ' . $result[207] . '" id=' . idGen(207) . 'onclick="brickClicked(' . idGen(207) . ')"></div>'); toCommentOrNot(isItANewBrick(207), 2); ?>
            <?php toCommentOrNot(isItANewBrick(208), 1); echo('<div class="brickStyle ' . $result[208] . '" id=' . idGen(208) . 'onclick="brickClicked(' . idGen(208) . ')"></div>'); toCommentOrNot(isItANewBrick(208), 2); ?>
            <?php toCommentOrNot(isItANewBrick(209), 1); echo('<div class="brickStyle ' . $result[209] . '" id=' . idGen(209) . 'onclick="brickClicked(' . idGen(209) . ')"></div>'); toCommentOrNot(isItANewBrick(209), 2); ?>
            <?php toCommentOrNot(isItANewBrick(210), 1); echo('<div class="brickStyle ' . $result[210] . '" id=' . idGen(210) . 'onclick="brickClicked(' . idGen(210) . ')"></div>'); toCommentOrNot(isItANewBrick(210), 2); ?>
            <?php toCommentOrNot(isItANewBrick(211), 1); echo('<div class="brickStyle ' . $result[211] . '" id=' . idGen(211) . 'onclick="brickClicked(' . idGen(211) . ')"></div>'); toCommentOrNot(isItANewBrick(211), 2); ?>
            <?php toCommentOrNot(isItANewBrick(212), 1); echo('<div class="brickStyle ' . $result[212] . '" id=' . idGen(212) . 'onclick="brickClicked(' . idGen(212) . ')"></div>'); toCommentOrNot(isItANewBrick(212), 2); ?>
            <?php toCommentOrNot(isItANewBrick(213), 1); echo('<div class="brickStyle ' . $result[213] . '" id=' . idGen(213) . 'onclick="brickClicked(' . idGen(213) . ')"></div>'); toCommentOrNot(isItANewBrick(213), 2); ?>
            <?php toCommentOrNot(isItANewBrick(214), 1); echo('<div class="brickStyle ' . $result[214] . '" id=' . idGen(214) . 'onclick="brickClicked(' . idGen(214) . ')"></div>'); toCommentOrNot(isItANewBrick(214), 2); ?>
            <?php toCommentOrNot(isItANewBrick(215), 1); echo('<div class="brickStyle ' . $result[215] . '" id=' . idGen(215) . 'onclick="brickClicked(' . idGen(215) . ')"></div>'); toCommentOrNot(isItANewBrick(215), 2); ?>
            <!-- Row 13 -->
            <?php toCommentOrNot(isItANewBrick(216), 1); echo('<div class="brickStyle ' . $result[216] . '" id=' . idGen(216) . 'onclick="brickClicked(' . idGen(216) . ')"></div>'); toCommentOrNot(isItANewBrick(216), 2); ?>
            <?php toCommentOrNot(isItANewBrick(217), 1); echo('<div class="brickStyle ' . $result[217] . '" id=' . idGen(217) . 'onclick="brickClicked(' . idGen(217) . ')"></div>'); toCommentOrNot(isItANewBrick(217), 2); ?>
            <?php toCommentOrNot(isItANewBrick(218), 1); echo('<div class="brickStyle ' . $result[218] . '" id=' . idGen(218) . 'onclick="brickClicked(' . idGen(218) . ')"></div>'); toCommentOrNot(isItANewBrick(218), 2); ?>
            <?php toCommentOrNot(isItANewBrick(219), 1); echo('<div class="brickStyle ' . $result[219] . '" id=' . idGen(219) . 'onclick="brickClicked(' . idGen(219) . ')"></div>'); toCommentOrNot(isItANewBrick(219), 2); ?>
            <?php toCommentOrNot(isItANewBrick(220), 1); echo('<div class="brickStyle ' . $result[220] . '" id=' . idGen(220) . 'onclick="brickClicked(' . idGen(220) . ')"></div>'); toCommentOrNot(isItANewBrick(220), 2); ?>
            <?php toCommentOrNot(isItANewBrick(221), 1); echo('<div class="brickStyle ' . $result[221] . '" id=' . idGen(221) . 'onclick="brickClicked(' . idGen(221) . ')"></div>'); toCommentOrNot(isItANewBrick(221), 2); ?>
            <?php toCommentOrNot(isItANewBrick(222), 1); echo('<div class="brickStyle ' . $result[222] . '" id=' . idGen(222) . 'onclick="brickClicked(' . idGen(222) . ')"></div>'); toCommentOrNot(isItANewBrick(222), 2); ?>
            <?php toCommentOrNot(isItANewBrick(223), 1); echo('<div class="brickStyle ' . $result[223] . '" id=' . idGen(223) . 'onclick="brickClicked(' . idGen(223) . ')"></div>'); toCommentOrNot(isItANewBrick(223), 2); ?>
            <?php toCommentOrNot(isItANewBrick(224), 1); echo('<div class="brickStyle ' . $result[224] . '" id=' . idGen(224) . 'onclick="brickClicked(' . idGen(224) . ')"></div>'); toCommentOrNot(isItANewBrick(224), 2); ?>
            <?php toCommentOrNot(isItANewBrick(225), 1); echo('<div class="brickStyle ' . $result[225] . '" id=' . idGen(225) . 'onclick="brickClicked(' . idGen(225) . ')"></div>'); toCommentOrNot(isItANewBrick(225), 2); ?>
            <?php toCommentOrNot(isItANewBrick(226), 1); echo('<div class="brickStyle ' . $result[226] . '" id=' . idGen(226) . 'onclick="brickClicked(' . idGen(226) . ')"></div>'); toCommentOrNot(isItANewBrick(226), 2); ?>
            <?php toCommentOrNot(isItANewBrick(227), 1); echo('<div class="brickStyle ' . $result[227] . '" id=' . idGen(227) . 'onclick="brickClicked(' . idGen(227) . ')"></div>'); toCommentOrNot(isItANewBrick(227), 2); ?>
            <?php toCommentOrNot(isItANewBrick(228), 1); echo('<div class="brickStyle ' . $result[228] . '" id=' . idGen(228) . 'onclick="brickClicked(' . idGen(228) . ')"></div>'); toCommentOrNot(isItANewBrick(228), 2); ?>
            <?php toCommentOrNot(isItANewBrick(229), 1); echo('<div class="brickStyle ' . $result[229] . '" id=' . idGen(229) . 'onclick="brickClicked(' . idGen(229) . ')"></div>'); toCommentOrNot(isItANewBrick(229), 2); ?>
            <?php toCommentOrNot(isItANewBrick(230), 1); echo('<div class="brickStyle ' . $result[230] . '" id=' . idGen(230) . 'onclick="brickClicked(' . idGen(230) . ')"></div>'); toCommentOrNot(isItANewBrick(230), 2); ?>
            <?php toCommentOrNot(isItANewBrick(231), 1); echo('<div class="brickStyle ' . $result[231] . '" id=' . idGen(231) . 'onclick="brickClicked(' . idGen(231) . ')"></div>'); toCommentOrNot(isItANewBrick(231), 2); ?>
            <?php toCommentOrNot(isItANewBrick(232), 1); echo('<div class="brickStyle ' . $result[232] . '" id=' . idGen(232) . 'onclick="brickClicked(' . idGen(232) . ')"></div>'); toCommentOrNot(isItANewBrick(232), 2); ?>
            <?php toCommentOrNot(isItANewBrick(233), 1); echo('<div class="brickStyle ' . $result[233] . '" id=' . idGen(233) . 'onclick="brickClicked(' . idGen(233) . ')"></div>'); toCommentOrNot(isItANewBrick(233), 2); ?>
            <!-- Row 14 -->
            <?php toCommentOrNot(isItANewBrick(234), 1); echo('<div class="brickStyle ' . $result[234] . '" id=' . idGen(234) . 'onclick="brickClicked(' . idGen(234) . ')"></div>'); toCommentOrNot(isItANewBrick(234), 2); ?>
            <?php toCommentOrNot(isItANewBrick(235), 1); echo('<div class="brickStyle ' . $result[235] . '" id=' . idGen(235) . 'onclick="brickClicked(' . idGen(235) . ')"></div>'); toCommentOrNot(isItANewBrick(235), 2); ?>
            <?php toCommentOrNot(isItANewBrick(236), 1); echo('<div class="brickStyle ' . $result[236] . '" id=' . idGen(236) . 'onclick="brickClicked(' . idGen(236) . ')"></div>'); toCommentOrNot(isItANewBrick(236), 2); ?>
            <?php toCommentOrNot(isItANewBrick(237), 1); echo('<div class="brickStyle ' . $result[237] . '" id=' . idGen(237) . 'onclick="brickClicked(' . idGen(237) . ')"></div>'); toCommentOrNot(isItANewBrick(237), 2); ?>
            <?php toCommentOrNot(isItANewBrick(238), 1); echo('<div class="brickStyle ' . $result[238] . '" id=' . idGen(238) . 'onclick="brickClicked(' . idGen(238) . ')"></div>'); toCommentOrNot(isItANewBrick(238), 2); ?>
            <?php toCommentOrNot(isItANewBrick(239), 1); echo('<div class="brickStyle ' . $result[239] . '" id=' . idGen(239) . 'onclick="brickClicked(' . idGen(239) . ')"></div>'); toCommentOrNot(isItANewBrick(239), 2); ?>
            <?php toCommentOrNot(isItANewBrick(240), 1); echo('<div class="brickStyle ' . $result[240] . '" id=' . idGen(240) . 'onclick="brickClicked(' . idGen(240) . ')"></div>'); toCommentOrNot(isItANewBrick(240), 2); ?>
            <?php toCommentOrNot(isItANewBrick(241), 1); echo('<div class="brickStyle ' . $result[241] . '" id=' . idGen(241) . 'onclick="brickClicked(' . idGen(241) . ')"></div>'); toCommentOrNot(isItANewBrick(241), 2); ?>
            <?php toCommentOrNot(isItANewBrick(242), 1); echo('<div class="brickStyle ' . $result[242] . '" id=' . idGen(242) . 'onclick="brickClicked(' . idGen(242) . ')"></div>'); toCommentOrNot(isItANewBrick(242), 2); ?>
            <?php toCommentOrNot(isItANewBrick(243), 1); echo('<div class="brickStyle ' . $result[243] . '" id=' . idGen(243) . 'onclick="brickClicked(' . idGen(243) . ')"></div>'); toCommentOrNot(isItANewBrick(243), 2); ?>
            <?php toCommentOrNot(isItANewBrick(244), 1); echo('<div class="brickStyle ' . $result[244] . '" id=' . idGen(244) . 'onclick="brickClicked(' . idGen(244) . ')"></div>'); toCommentOrNot(isItANewBrick(244), 2); ?>
            <?php toCommentOrNot(isItANewBrick(245), 1); echo('<div class="brickStyle ' . $result[245] . '" id=' . idGen(245) . 'onclick="brickClicked(' . idGen(245) . ')"></div>'); toCommentOrNot(isItANewBrick(245), 2); ?>
            <?php toCommentOrNot(isItANewBrick(246), 1); echo('<div class="brickStyle ' . $result[246] . '" id=' . idGen(246) . 'onclick="brickClicked(' . idGen(246) . ')"></div>'); toCommentOrNot(isItANewBrick(246), 2); ?>
            <?php toCommentOrNot(isItANewBrick(247), 1); echo('<div class="brickStyle ' . $result[247] . '" id=' . idGen(247) . 'onclick="brickClicked(' . idGen(247) . ')"></div>'); toCommentOrNot(isItANewBrick(247), 2); ?>
            <?php toCommentOrNot(isItANewBrick(248), 1); echo('<div class="brickStyle ' . $result[248] . '" id=' . idGen(248) . 'onclick="brickClicked(' . idGen(248) . ')"></div>'); toCommentOrNot(isItANewBrick(248), 2); ?>
            <?php toCommentOrNot(isItANewBrick(249), 1); echo('<div class="brickStyle ' . $result[249] . '" id=' . idGen(249) . 'onclick="brickClicked(' . idGen(249) . ')"></div>'); toCommentOrNot(isItANewBrick(249), 2); ?>
            <?php toCommentOrNot(isItANewBrick(250), 1); echo('<div class="brickStyle ' . $result[250] . '" id=' . idGen(250) . 'onclick="brickClicked(' . idGen(250) . ')"></div>'); toCommentOrNot(isItANewBrick(250), 2); ?>
            <?php toCommentOrNot(isItANewBrick(251), 1); echo('<div class="brickStyle ' . $result[251] . '" id=' . idGen(251) . 'onclick="brickClicked(' . idGen(251) . ')"></div>'); toCommentOrNot(isItANewBrick(251), 2); ?>
            <!-- Row 15 -->
            <?php toCommentOrNot(isItANewBrick(252), 1); echo('<div class="brickStyle ' . $result[252] . '" id=' . idGen(252) . 'onclick="brickClicked(' . idGen(252) . ')"></div>'); toCommentOrNot(isItANewBrick(252), 2); ?>
            <?php toCommentOrNot(isItANewBrick(253), 1); echo('<div class="brickStyle ' . $result[253] . '" id=' . idGen(253) . 'onclick="brickClicked(' . idGen(253) . ')"></div>'); toCommentOrNot(isItANewBrick(253), 2); ?>
            <?php toCommentOrNot(isItANewBrick(254), 1); echo('<div class="brickStyle ' . $result[254] . '" id=' . idGen(254) . 'onclick="brickClicked(' . idGen(254) . ')"></div>'); toCommentOrNot(isItANewBrick(254), 2); ?>
            <?php toCommentOrNot(isItANewBrick(255), 1); echo('<div class="brickStyle ' . $result[255] . '" id=' . idGen(255) . 'onclick="brickClicked(' . idGen(255) . ')"></div>'); toCommentOrNot(isItANewBrick(255), 2); ?>
            <?php toCommentOrNot(isItANewBrick(256), 1); echo('<div class="brickStyle ' . $result[256] . '" id=' . idGen(256) . 'onclick="brickClicked(' . idGen(256) . ')"></div>'); toCommentOrNot(isItANewBrick(256), 2); ?>
            <?php toCommentOrNot(isItANewBrick(257), 1); echo('<div class="brickStyle ' . $result[257] . '" id=' . idGen(257) . 'onclick="brickClicked(' . idGen(257) . ')"></div>'); toCommentOrNot(isItANewBrick(257), 2); ?>
            <?php toCommentOrNot(isItANewBrick(258), 1); echo('<div class="brickStyle ' . $result[258] . '" id=' . idGen(258) . 'onclick="brickClicked(' . idGen(258) . ')"></div>'); toCommentOrNot(isItANewBrick(258), 2); ?>
            <?php toCommentOrNot(isItANewBrick(259), 1); echo('<div class="brickStyle ' . $result[259] . '" id=' . idGen(259) . 'onclick="brickClicked(' . idGen(259) . ')"></div>'); toCommentOrNot(isItANewBrick(259), 2); ?>
            <?php toCommentOrNot(isItANewBrick(260), 1); echo('<div class="brickStyle ' . $result[260] . '" id=' . idGen(260) . 'onclick="brickClicked(' . idGen(260) . ')"></div>'); toCommentOrNot(isItANewBrick(260), 2); ?>
            <?php toCommentOrNot(isItANewBrick(261), 1); echo('<div class="brickStyle ' . $result[261] . '" id=' . idGen(261) . 'onclick="brickClicked(' . idGen(261) . ')"></div>'); toCommentOrNot(isItANewBrick(261), 2); ?>
            <?php toCommentOrNot(isItANewBrick(262), 1); echo('<div class="brickStyle ' . $result[262] . '" id=' . idGen(262) . 'onclick="brickClicked(' . idGen(262) . ')"></div>'); toCommentOrNot(isItANewBrick(262), 2); ?>
            <?php toCommentOrNot(isItANewBrick(263), 1); echo('<div class="brickStyle ' . $result[263] . '" id=' . idGen(263) . 'onclick="brickClicked(' . idGen(263) . ')"></div>'); toCommentOrNot(isItANewBrick(263), 2); ?>
            <?php toCommentOrNot(isItANewBrick(264), 1); echo('<div class="brickStyle ' . $result[264] . '" id=' . idGen(264) . 'onclick="brickClicked(' . idGen(264) . ')"></div>'); toCommentOrNot(isItANewBrick(264), 2); ?>
            <?php toCommentOrNot(isItANewBrick(265), 1); echo('<div class="brickStyle ' . $result[265] . '" id=' . idGen(265) . 'onclick="brickClicked(' . idGen(265) . ')"></div>'); toCommentOrNot(isItANewBrick(265), 2); ?>
            <?php toCommentOrNot(isItANewBrick(266), 1); echo('<div class="brickStyle ' . $result[266] . '" id=' . idGen(266) . 'onclick="brickClicked(' . idGen(266) . ')"></div>'); toCommentOrNot(isItANewBrick(266), 2); ?>
            <?php toCommentOrNot(isItANewBrick(267), 1); echo('<div class="brickStyle ' . $result[267] . '" id=' . idGen(267) . 'onclick="brickClicked(' . idGen(267) . ')"></div>'); toCommentOrNot(isItANewBrick(267), 2); ?>
            <?php toCommentOrNot(isItANewBrick(268), 1); echo('<div class="brickStyle ' . $result[268] . '" id=' . idGen(268) . 'onclick="brickClicked(' . idGen(268) . ')"></div>'); toCommentOrNot(isItANewBrick(268), 2); ?>
            <?php toCommentOrNot(isItANewBrick(269), 1); echo('<div class="brickStyle ' . $result[269] . '" id=' . idGen(269) . 'onclick="brickClicked(' . idGen(269) . ')"></div>'); toCommentOrNot(isItANewBrick(269), 2); ?>
            <!-- Row 16 -->
            <?php toCommentOrNot(isItANewBrick(270), 1); echo('<div class="brickStyle ' . $result[270] . '" id=' . idGen(270) . 'onclick="brickClicked(' . idGen(270) . ')"></div>'); toCommentOrNot(isItANewBrick(270), 2); ?>
            <?php toCommentOrNot(isItANewBrick(271), 1); echo('<div class="brickStyle ' . $result[271] . '" id=' . idGen(271) . 'onclick="brickClicked(' . idGen(271) . ')"></div>'); toCommentOrNot(isItANewBrick(271), 2); ?>
            <?php toCommentOrNot(isItANewBrick(272), 1); echo('<div class="brickStyle ' . $result[272] . '" id=' . idGen(272) . 'onclick="brickClicked(' . idGen(272) . ')"></div>'); toCommentOrNot(isItANewBrick(272), 2); ?>
            <?php toCommentOrNot(isItANewBrick(273), 1); echo('<div class="brickStyle ' . $result[273] . '" id=' . idGen(273) . 'onclick="brickClicked(' . idGen(273) . ')"></div>'); toCommentOrNot(isItANewBrick(273), 2); ?>
            <?php toCommentOrNot(isItANewBrick(274), 1); echo('<div class="brickStyle ' . $result[274] . '" id=' . idGen(274) . 'onclick="brickClicked(' . idGen(274) . ')"></div>'); toCommentOrNot(isItANewBrick(274), 2); ?>
            <?php toCommentOrNot(isItANewBrick(275), 1); echo('<div class="brickStyle ' . $result[275] . '" id=' . idGen(275) . 'onclick="brickClicked(' . idGen(275) . ')"></div>'); toCommentOrNot(isItANewBrick(275), 2); ?>
            <?php toCommentOrNot(isItANewBrick(276), 1); echo('<div class="brickStyle ' . $result[276] . '" id=' . idGen(276) . 'onclick="brickClicked(' . idGen(276) . ')"></div>'); toCommentOrNot(isItANewBrick(276), 2); ?>
            <?php toCommentOrNot(isItANewBrick(277), 1); echo('<div class="brickStyle ' . $result[277] . '" id=' . idGen(277) . 'onclick="brickClicked(' . idGen(277) . ')"></div>'); toCommentOrNot(isItANewBrick(277), 2); ?>
            <?php toCommentOrNot(isItANewBrick(278), 1); echo('<div class="brickStyle ' . $result[278] . '" id=' . idGen(278) . 'onclick="brickClicked(' . idGen(278) . ')"></div>'); toCommentOrNot(isItANewBrick(278), 2); ?>
            <?php toCommentOrNot(isItANewBrick(279), 1); echo('<div class="brickStyle ' . $result[279] . '" id=' . idGen(279) . 'onclick="brickClicked(' . idGen(279) . ')"></div>'); toCommentOrNot(isItANewBrick(279), 2); ?>
            <?php toCommentOrNot(isItANewBrick(280), 1); echo('<div class="brickStyle ' . $result[280] . '" id=' . idGen(280) . 'onclick="brickClicked(' . idGen(280) . ')"></div>'); toCommentOrNot(isItANewBrick(280), 2); ?>
            <?php toCommentOrNot(isItANewBrick(281), 1); echo('<div class="brickStyle ' . $result[281] . '" id=' . idGen(281) . 'onclick="brickClicked(' . idGen(281) . ')"></div>'); toCommentOrNot(isItANewBrick(281), 2); ?>
            <?php toCommentOrNot(isItANewBrick(282), 1); echo('<div class="brickStyle ' . $result[282] . '" id=' . idGen(282) . 'onclick="brickClicked(' . idGen(282) . ')"></div>'); toCommentOrNot(isItANewBrick(282), 2); ?>
            <?php toCommentOrNot(isItANewBrick(283), 1); echo('<div class="brickStyle ' . $result[283] . '" id=' . idGen(283) . 'onclick="brickClicked(' . idGen(283) . ')"></div>'); toCommentOrNot(isItANewBrick(283), 2); ?>
            <?php toCommentOrNot(isItANewBrick(284), 1); echo('<div class="brickStyle ' . $result[284] . '" id=' . idGen(284) . 'onclick="brickClicked(' . idGen(284) . ')"></div>'); toCommentOrNot(isItANewBrick(284), 2); ?>
            <?php toCommentOrNot(isItANewBrick(285), 1); echo('<div class="brickStyle ' . $result[285] . '" id=' . idGen(285) . 'onclick="brickClicked(' . idGen(285) . ')"></div>'); toCommentOrNot(isItANewBrick(285), 2); ?>
            <?php toCommentOrNot(isItANewBrick(286), 1); echo('<div class="brickStyle ' . $result[286] . '" id=' . idGen(286) . 'onclick="brickClicked(' . idGen(286) . ')"></div>'); toCommentOrNot(isItANewBrick(286), 2); ?>
            <?php toCommentOrNot(isItANewBrick(287), 1); echo('<div class="brickStyle ' . $result[287] . '" id=' . idGen(287) . 'onclick="brickClicked(' . idGen(287) . ')"></div>'); toCommentOrNot(isItANewBrick(287), 2); ?>
            <!-- Row 17 -->
            <?php toCommentOrNot(isItANewBrick(288), 1); echo('<div class="brickStyle ' . $result[288] . '" id=' . idGen(288) . 'onclick="brickClicked(' . idGen(288) . ')"></div>'); toCommentOrNot(isItANewBrick(288), 2); ?>
            <?php toCommentOrNot(isItANewBrick(289), 1); echo('<div class="brickStyle ' . $result[289] . '" id=' . idGen(289) . 'onclick="brickClicked(' . idGen(289) . ')"></div>'); toCommentOrNot(isItANewBrick(289), 2); ?>
            <?php toCommentOrNot(isItANewBrick(290), 1); echo('<div class="brickStyle ' . $result[290] . '" id=' . idGen(290) . 'onclick="brickClicked(' . idGen(290) . ')"></div>'); toCommentOrNot(isItANewBrick(290), 2); ?>
            <?php toCommentOrNot(isItANewBrick(291), 1); echo('<div class="brickStyle ' . $result[291] . '" id=' . idGen(291) . 'onclick="brickClicked(' . idGen(291) . ')"></div>'); toCommentOrNot(isItANewBrick(291), 2); ?>
            <?php toCommentOrNot(isItANewBrick(292), 1); echo('<div class="brickStyle ' . $result[292] . '" id=' . idGen(292) . 'onclick="brickClicked(' . idGen(292) . ')"></div>'); toCommentOrNot(isItANewBrick(292), 2); ?>
            <?php toCommentOrNot(isItANewBrick(293), 1); echo('<div class="brickStyle ' . $result[293] . '" id=' . idGen(293) . 'onclick="brickClicked(' . idGen(293) . ')"></div>'); toCommentOrNot(isItANewBrick(293), 2); ?>
            <?php toCommentOrNot(isItANewBrick(294), 1); echo('<div class="brickStyle ' . $result[294] . '" id=' . idGen(294) . 'onclick="brickClicked(' . idGen(294) . ')"></div>'); toCommentOrNot(isItANewBrick(294), 2); ?>
            <?php toCommentOrNot(isItANewBrick(295), 1); echo('<div class="brickStyle ' . $result[295] . '" id=' . idGen(295) . 'onclick="brickClicked(' . idGen(295) . ')"></div>'); toCommentOrNot(isItANewBrick(295), 2); ?>
            <?php toCommentOrNot(isItANewBrick(296), 1); echo('<div class="brickStyle ' . $result[296] . '" id=' . idGen(296) . 'onclick="brickClicked(' . idGen(296) . ')"></div>'); toCommentOrNot(isItANewBrick(296), 2); ?>
            <?php toCommentOrNot(isItANewBrick(297), 1); echo('<div class="brickStyle ' . $result[297] . '" id=' . idGen(297) . 'onclick="brickClicked(' . idGen(297) . ')"></div>'); toCommentOrNot(isItANewBrick(297), 2); ?>
            <?php toCommentOrNot(isItANewBrick(298), 1); echo('<div class="brickStyle ' . $result[298] . '" id=' . idGen(298) . 'onclick="brickClicked(' . idGen(298) . ')"></div>'); toCommentOrNot(isItANewBrick(298), 2); ?>
            <?php toCommentOrNot(isItANewBrick(299), 1); echo('<div class="brickStyle ' . $result[299] . '" id=' . idGen(299) . 'onclick="brickClicked(' . idGen(299) . ')"></div>'); toCommentOrNot(isItANewBrick(299), 2); ?>
            <?php toCommentOrNot(isItANewBrick(300), 1); echo('<div class="brickStyle ' . $result[300] . '" id=' . idGen(300) . 'onclick="brickClicked(' . idGen(300) . ')"></div>'); toCommentOrNot(isItANewBrick(300), 2); ?>
            <?php toCommentOrNot(isItANewBrick(301), 1); echo('<div class="brickStyle ' . $result[301] . '" id=' . idGen(301) . 'onclick="brickClicked(' . idGen(301) . ')"></div>'); toCommentOrNot(isItANewBrick(301), 2); ?>
            <?php toCommentOrNot(isItANewBrick(302), 1); echo('<div class="brickStyle ' . $result[302] . '" id=' . idGen(302) . 'onclick="brickClicked(' . idGen(302) . ')"></div>'); toCommentOrNot(isItANewBrick(302), 2); ?>
            <?php toCommentOrNot(isItANewBrick(303), 1); echo('<div class="brickStyle ' . $result[303] . '" id=' . idGen(303) . 'onclick="brickClicked(' . idGen(303) . ')"></div>'); toCommentOrNot(isItANewBrick(303), 2); ?>
            <?php toCommentOrNot(isItANewBrick(304), 1); echo('<div class="brickStyle ' . $result[304] . '" id=' . idGen(304) . 'onclick="brickClicked(' . idGen(304) . ')"></div>'); toCommentOrNot(isItANewBrick(304), 2); ?>
            <?php toCommentOrNot(isItANewBrick(305), 1); echo('<div class="brickStyle ' . $result[305] . '" id=' . idGen(305) . 'onclick="brickClicked(' . idGen(305) . ')"></div>'); toCommentOrNot(isItANewBrick(305), 2); ?>
            <!-- Row 18 -->
            <?php toCommentOrNot(isItANewBrick(306), 1); echo('<div class="brickStyle ' . $result[306] . '" id=' . idGen(306) . 'onclick="brickClicked(' . idGen(306) . ')"></div>'); toCommentOrNot(isItANewBrick(306), 2); ?>
            <?php toCommentOrNot(isItANewBrick(307), 1); echo('<div class="brickStyle ' . $result[307] . '" id=' . idGen(307) . 'onclick="brickClicked(' . idGen(307) . ')"></div>'); toCommentOrNot(isItANewBrick(307), 2); ?>
            <?php toCommentOrNot(isItANewBrick(308), 1); echo('<div class="brickStyle ' . $result[308] . '" id=' . idGen(308) . 'onclick="brickClicked(' . idGen(308) . ')"></div>'); toCommentOrNot(isItANewBrick(308), 2); ?>
            <?php toCommentOrNot(isItANewBrick(309), 1); echo('<div class="brickStyle ' . $result[309] . '" id=' . idGen(309) . 'onclick="brickClicked(' . idGen(309) . ')"></div>'); toCommentOrNot(isItANewBrick(309), 2); ?>
            <?php toCommentOrNot(isItANewBrick(310), 1); echo('<div class="brickStyle ' . $result[310] . '" id=' . idGen(310) . 'onclick="brickClicked(' . idGen(310) . ')"></div>'); toCommentOrNot(isItANewBrick(310), 2); ?>
            <?php toCommentOrNot(isItANewBrick(311), 1); echo('<div class="brickStyle ' . $result[311] . '" id=' . idGen(311) . 'onclick="brickClicked(' . idGen(311) . ')"></div>'); toCommentOrNot(isItANewBrick(311), 2); ?>
            <?php toCommentOrNot(isItANewBrick(312), 1); echo('<div class="brickStyle ' . $result[312] . '" id=' . idGen(312) . 'onclick="brickClicked(' . idGen(312) . ')"></div>'); toCommentOrNot(isItANewBrick(312), 2); ?>
            <?php toCommentOrNot(isItANewBrick(313), 1); echo('<div class="brickStyle ' . $result[313] . '" id=' . idGen(313) . 'onclick="brickClicked(' . idGen(313) . ')"></div>'); toCommentOrNot(isItANewBrick(313), 2); ?>
            <?php toCommentOrNot(isItANewBrick(314), 1); echo('<div class="brickStyle ' . $result[314] . '" id=' . idGen(314) . 'onclick="brickClicked(' . idGen(314) . ')"></div>'); toCommentOrNot(isItANewBrick(314), 2); ?>
            <?php toCommentOrNot(isItANewBrick(315), 1); echo('<div class="brickStyle ' . $result[315] . '" id=' . idGen(315) . 'onclick="brickClicked(' . idGen(315) . ')"></div>'); toCommentOrNot(isItANewBrick(315), 2); ?>
            <?php toCommentOrNot(isItANewBrick(316), 1); echo('<div class="brickStyle ' . $result[316] . '" id=' . idGen(316) . 'onclick="brickClicked(' . idGen(316) . ')"></div>'); toCommentOrNot(isItANewBrick(316), 2); ?>
            <?php toCommentOrNot(isItANewBrick(317), 1); echo('<div class="brickStyle ' . $result[317] . '" id=' . idGen(317) . 'onclick="brickClicked(' . idGen(317) . ')"></div>'); toCommentOrNot(isItANewBrick(317), 2); ?>
            <?php toCommentOrNot(isItANewBrick(318), 1); echo('<div class="brickStyle ' . $result[318] . '" id=' . idGen(318) . 'onclick="brickClicked(' . idGen(318) . ')"></div>'); toCommentOrNot(isItANewBrick(318), 2); ?>
            <?php toCommentOrNot(isItANewBrick(319), 1); echo('<div class="brickStyle ' . $result[319] . '" id=' . idGen(319) . 'onclick="brickClicked(' . idGen(319) . ')"></div>'); toCommentOrNot(isItANewBrick(319), 2); ?>
            <?php toCommentOrNot(isItANewBrick(320), 1); echo('<div class="brickStyle ' . $result[320] . '" id=' . idGen(320) . 'onclick="brickClicked(' . idGen(320) . ')"></div>'); toCommentOrNot(isItANewBrick(320), 2); ?>
            <?php toCommentOrNot(isItANewBrick(321), 1); echo('<div class="brickStyle ' . $result[321] . '" id=' . idGen(321) . 'onclick="brickClicked(' . idGen(321) . ')"></div>'); toCommentOrNot(isItANewBrick(321), 2); ?>
            <?php toCommentOrNot(isItANewBrick(322), 1); echo('<div class="brickStyle ' . $result[322] . '" id=' . idGen(322) . 'onclick="brickClicked(' . idGen(322) . ')"></div>'); toCommentOrNot(isItANewBrick(322), 2); ?>
            <?php toCommentOrNot(isItANewBrick(323), 1); echo('<div class="brickStyle ' . $result[323] . '" id=' . idGen(323) . 'onclick="brickClicked(' . idGen(323) . ')"></div>'); toCommentOrNot(isItANewBrick(323), 2); ?>
            <!-- Row 19 -->
            <?php toCommentOrNot(isItANewBrick(324), 1); echo('<div class="brickStyle ' . $result[324] . '" id=' . idGen(324) . 'onclick="brickClicked(' . idGen(324) . ')"></div>'); toCommentOrNot(isItANewBrick(324), 2); ?>
            <?php toCommentOrNot(isItANewBrick(325), 1); echo('<div class="brickStyle ' . $result[325] . '" id=' . idGen(325) . 'onclick="brickClicked(' . idGen(325) . ')"></div>'); toCommentOrNot(isItANewBrick(325), 2); ?>
            <?php toCommentOrNot(isItANewBrick(326), 1); echo('<div class="brickStyle ' . $result[326] . '" id=' . idGen(326) . 'onclick="brickClicked(' . idGen(326) . ')"></div>'); toCommentOrNot(isItANewBrick(326), 2); ?>
            <?php toCommentOrNot(isItANewBrick(327), 1); echo('<div class="brickStyle ' . $result[327] . '" id=' . idGen(327) . 'onclick="brickClicked(' . idGen(327) . ')"></div>'); toCommentOrNot(isItANewBrick(327), 2); ?>
            <?php toCommentOrNot(isItANewBrick(328), 1); echo('<div class="brickStyle ' . $result[328] . '" id=' . idGen(328) . 'onclick="brickClicked(' . idGen(328) . ')"></div>'); toCommentOrNot(isItANewBrick(328), 2); ?>
            <?php toCommentOrNot(isItANewBrick(329), 1); echo('<div class="brickStyle ' . $result[329] . '" id=' . idGen(329) . 'onclick="brickClicked(' . idGen(329) . ')"></div>'); toCommentOrNot(isItANewBrick(329), 2); ?>
            <?php toCommentOrNot(isItANewBrick(330), 1); echo('<div class="brickStyle ' . $result[330] . '" id=' . idGen(330) . 'onclick="brickClicked(' . idGen(330) . ')"></div>'); toCommentOrNot(isItANewBrick(330), 2); ?>
            <?php toCommentOrNot(isItANewBrick(331), 1); echo('<div class="brickStyle ' . $result[331] . '" id=' . idGen(331) . 'onclick="brickClicked(' . idGen(331) . ')"></div>'); toCommentOrNot(isItANewBrick(331), 2); ?>
            <?php toCommentOrNot(isItANewBrick(332), 1); echo('<div class="brickStyle ' . $result[332] . '" id=' . idGen(332) . 'onclick="brickClicked(' . idGen(332) . ')"></div>'); toCommentOrNot(isItANewBrick(332), 2); ?>
            <?php toCommentOrNot(isItANewBrick(333), 1); echo('<div class="brickStyle ' . $result[333] . '" id=' . idGen(333) . 'onclick="brickClicked(' . idGen(333) . ')"></div>'); toCommentOrNot(isItANewBrick(333), 2); ?>
            <?php toCommentOrNot(isItANewBrick(334), 1); echo('<div class="brickStyle ' . $result[334] . '" id=' . idGen(334) . 'onclick="brickClicked(' . idGen(334) . ')"></div>'); toCommentOrNot(isItANewBrick(334), 2); ?>
            <?php toCommentOrNot(isItANewBrick(335), 1); echo('<div class="brickStyle ' . $result[335] . '" id=' . idGen(335) . 'onclick="brickClicked(' . idGen(335) . ')"></div>'); toCommentOrNot(isItANewBrick(335), 2); ?>
            <?php toCommentOrNot(isItANewBrick(336), 1); echo('<div class="brickStyle ' . $result[336] . '" id=' . idGen(336) . 'onclick="brickClicked(' . idGen(336) . ')"></div>'); toCommentOrNot(isItANewBrick(336), 2); ?>
            <?php toCommentOrNot(isItANewBrick(337), 1); echo('<div class="brickStyle ' . $result[337] . '" id=' . idGen(337) . 'onclick="brickClicked(' . idGen(337) . ')"></div>'); toCommentOrNot(isItANewBrick(337), 2); ?>
            <?php toCommentOrNot(isItANewBrick(338), 1); echo('<div class="brickStyle ' . $result[338] . '" id=' . idGen(338) . 'onclick="brickClicked(' . idGen(338) . ')"></div>'); toCommentOrNot(isItANewBrick(338), 2); ?>
            <?php toCommentOrNot(isItANewBrick(339), 1); echo('<div class="brickStyle ' . $result[339] . '" id=' . idGen(339) . 'onclick="brickClicked(' . idGen(339) . ')"></div>'); toCommentOrNot(isItANewBrick(339), 2); ?>
            <?php toCommentOrNot(isItANewBrick(340), 1); echo('<div class="brickStyle ' . $result[340] . '" id=' . idGen(340) . 'onclick="brickClicked(' . idGen(340) . ')"></div>'); toCommentOrNot(isItANewBrick(340), 2); ?>
            <?php toCommentOrNot(isItANewBrick(341), 1); echo('<div class="brickStyle ' . $result[341] . '" id=' . idGen(341) . 'onclick="brickClicked(' . idGen(341) . ')"></div>'); toCommentOrNot(isItANewBrick(341), 2); ?>
            <!-- Row 20 -->
            <?php toCommentOrNot(isItANewBrick(342), 1); echo('<div class="brickStyle ' . $result[342] . '" id=' . idGen(342) . 'onclick="brickClicked(' . idGen(342) . ')"></div>'); toCommentOrNot(isItANewBrick(342), 2); ?>
            <?php toCommentOrNot(isItANewBrick(343), 1); echo('<div class="brickStyle ' . $result[343] . '" id=' . idGen(343) . 'onclick="brickClicked(' . idGen(343) . ')"></div>'); toCommentOrNot(isItANewBrick(343), 2); ?>
            <?php toCommentOrNot(isItANewBrick(344), 1); echo('<div class="brickStyle ' . $result[344] . '" id=' . idGen(344) . 'onclick="brickClicked(' . idGen(344) . ')"></div>'); toCommentOrNot(isItANewBrick(344), 2); ?>
            <?php toCommentOrNot(isItANewBrick(345), 1); echo('<div class="brickStyle ' . $result[345] . '" id=' . idGen(345) . 'onclick="brickClicked(' . idGen(345) . ')"></div>'); toCommentOrNot(isItANewBrick(345), 2); ?>
            <?php toCommentOrNot(isItANewBrick(346), 1); echo('<div class="brickStyle ' . $result[346] . '" id=' . idGen(346) . 'onclick="brickClicked(' . idGen(346) . ')"></div>'); toCommentOrNot(isItANewBrick(346), 2); ?>
            <?php toCommentOrNot(isItANewBrick(347), 1); echo('<div class="brickStyle ' . $result[347] . '" id=' . idGen(347) . 'onclick="brickClicked(' . idGen(347) . ')"></div>'); toCommentOrNot(isItANewBrick(347), 2); ?>
            <?php toCommentOrNot(isItANewBrick(348), 1); echo('<div class="brickStyle ' . $result[348] . '" id=' . idGen(348) . 'onclick="brickClicked(' . idGen(348) . ')"></div>'); toCommentOrNot(isItANewBrick(348), 2); ?>
            <?php toCommentOrNot(isItANewBrick(349), 1); echo('<div class="brickStyle ' . $result[349] . '" id=' . idGen(349) . 'onclick="brickClicked(' . idGen(349) . ')"></div>'); toCommentOrNot(isItANewBrick(349), 2); ?>
            <?php toCommentOrNot(isItANewBrick(350), 1); echo('<div class="brickStyle ' . $result[350] . '" id=' . idGen(350) . 'onclick="brickClicked(' . idGen(350) . ')"></div>'); toCommentOrNot(isItANewBrick(350), 2); ?>
            <?php toCommentOrNot(isItANewBrick(351), 1); echo('<div class="brickStyle ' . $result[351] . '" id=' . idGen(351) . 'onclick="brickClicked(' . idGen(351) . ')"></div>'); toCommentOrNot(isItANewBrick(351), 2); ?>
            <?php toCommentOrNot(isItANewBrick(352), 1); echo('<div class="brickStyle ' . $result[352] . '" id=' . idGen(352) . 'onclick="brickClicked(' . idGen(352) . ')"></div>'); toCommentOrNot(isItANewBrick(352), 2); ?>
            <?php toCommentOrNot(isItANewBrick(353), 1); echo('<div class="brickStyle ' . $result[353] . '" id=' . idGen(353) . 'onclick="brickClicked(' . idGen(353) . ')"></div>'); toCommentOrNot(isItANewBrick(353), 2); ?>
            <?php toCommentOrNot(isItANewBrick(354), 1); echo('<div class="brickStyle ' . $result[354] . '" id=' . idGen(354) . 'onclick="brickClicked(' . idGen(354) . ')"></div>'); toCommentOrNot(isItANewBrick(354), 2); ?>
            <?php toCommentOrNot(isItANewBrick(355), 1); echo('<div class="brickStyle ' . $result[355] . '" id=' . idGen(355) . 'onclick="brickClicked(' . idGen(355) . ')"></div>'); toCommentOrNot(isItANewBrick(355), 2); ?>
            <?php toCommentOrNot(isItANewBrick(356), 1); echo('<div class="brickStyle ' . $result[356] . '" id=' . idGen(356) . 'onclick="brickClicked(' . idGen(356) . ')"></div>'); toCommentOrNot(isItANewBrick(356), 2); ?>
            <?php toCommentOrNot(isItANewBrick(357), 1); echo('<div class="brickStyle ' . $result[357] . '" id=' . idGen(357) . 'onclick="brickClicked(' . idGen(357) . ')"></div>'); toCommentOrNot(isItANewBrick(357), 2); ?>
            <?php toCommentOrNot(isItANewBrick(358), 1); echo('<div class="brickStyle ' . $result[358] . '" id=' . idGen(358) . 'onclick="brickClicked(' . idGen(358) . ')"></div>'); toCommentOrNot(isItANewBrick(358), 2); ?>
            <?php toCommentOrNot(isItANewBrick(359), 1); echo('<div class="brickStyle ' . $result[359] . '" id=' . idGen(359) . 'onclick="brickClicked(' . idGen(359) . ')"></div>'); toCommentOrNot(isItANewBrick(359), 2); ?>
            <!-- Row 21 -->
            <?php toCommentOrNot(isItANewBrick(360), 1); echo('<div class="brickStyle ' . $result[360] . '" id=' . idGen(360) . 'onclick="brickClicked(' . idGen(360) . ')"></div>'); toCommentOrNot(isItANewBrick(360), 2); ?>
            <?php toCommentOrNot(isItANewBrick(361), 1); echo('<div class="brickStyle ' . $result[361] . '" id=' . idGen(361) . 'onclick="brickClicked(' . idGen(361) . ')"></div>'); toCommentOrNot(isItANewBrick(361), 2); ?>
            <?php toCommentOrNot(isItANewBrick(362), 1); echo('<div class="brickStyle ' . $result[362] . '" id=' . idGen(362) . 'onclick="brickClicked(' . idGen(362) . ')"></div>'); toCommentOrNot(isItANewBrick(362), 2); ?>
            <?php toCommentOrNot(isItANewBrick(363), 1); echo('<div class="brickStyle ' . $result[363] . '" id=' . idGen(363) . 'onclick="brickClicked(' . idGen(363) . ')"></div>'); toCommentOrNot(isItANewBrick(363), 2); ?>
            <?php toCommentOrNot(isItANewBrick(364), 1); echo('<div class="brickStyle ' . $result[364] . '" id=' . idGen(364) . 'onclick="brickClicked(' . idGen(364) . ')"></div>'); toCommentOrNot(isItANewBrick(364), 2); ?>
            <?php toCommentOrNot(isItANewBrick(365), 1); echo('<div class="brickStyle ' . $result[365] . '" id=' . idGen(365) . 'onclick="brickClicked(' . idGen(365) . ')"></div>'); toCommentOrNot(isItANewBrick(365), 2); ?>
            <?php toCommentOrNot(isItANewBrick(366), 1); echo('<div class="brickStyle ' . $result[366] . '" id=' . idGen(366) . 'onclick="brickClicked(' . idGen(366) . ')"></div>'); toCommentOrNot(isItANewBrick(366), 2); ?>
            <?php toCommentOrNot(isItANewBrick(367), 1); echo('<div class="brickStyle ' . $result[367] . '" id=' . idGen(367) . 'onclick="brickClicked(' . idGen(367) . ')"></div>'); toCommentOrNot(isItANewBrick(367), 2); ?>
            <?php toCommentOrNot(isItANewBrick(368), 1); echo('<div class="brickStyle ' . $result[368] . '" id=' . idGen(368) . 'onclick="brickClicked(' . idGen(368) . ')"></div>'); toCommentOrNot(isItANewBrick(368), 2); ?>
            <?php toCommentOrNot(isItANewBrick(369), 1); echo('<div class="brickStyle ' . $result[369] . '" id=' . idGen(369) . 'onclick="brickClicked(' . idGen(369) . ')"></div>'); toCommentOrNot(isItANewBrick(369), 2); ?>
            <?php toCommentOrNot(isItANewBrick(370), 1); echo('<div class="brickStyle ' . $result[370] . '" id=' . idGen(370) . 'onclick="brickClicked(' . idGen(370) . ')"></div>'); toCommentOrNot(isItANewBrick(370), 2); ?>
            <?php toCommentOrNot(isItANewBrick(371), 1); echo('<div class="brickStyle ' . $result[371] . '" id=' . idGen(371) . 'onclick="brickClicked(' . idGen(371) . ')"></div>'); toCommentOrNot(isItANewBrick(371), 2); ?>
            <?php toCommentOrNot(isItANewBrick(372), 1); echo('<div class="brickStyle ' . $result[372] . '" id=' . idGen(372) . 'onclick="brickClicked(' . idGen(372) . ')"></div>'); toCommentOrNot(isItANewBrick(372), 2); ?>
            <?php toCommentOrNot(isItANewBrick(373), 1); echo('<div class="brickStyle ' . $result[373] . '" id=' . idGen(373) . 'onclick="brickClicked(' . idGen(373) . ')"></div>'); toCommentOrNot(isItANewBrick(373), 2); ?>
            <?php toCommentOrNot(isItANewBrick(374), 1); echo('<div class="brickStyle ' . $result[374] . '" id=' . idGen(374) . 'onclick="brickClicked(' . idGen(374) . ')"></div>'); toCommentOrNot(isItANewBrick(374), 2); ?>
            <?php toCommentOrNot(isItANewBrick(375), 1); echo('<div class="brickStyle ' . $result[375] . '" id=' . idGen(375) . 'onclick="brickClicked(' . idGen(375) . ')"></div>'); toCommentOrNot(isItANewBrick(375), 2); ?>
            <?php toCommentOrNot(isItANewBrick(376), 1); echo('<div class="brickStyle ' . $result[376] . '" id=' . idGen(376) . 'onclick="brickClicked(' . idGen(376) . ')"></div>'); toCommentOrNot(isItANewBrick(376), 2); ?>
            <?php toCommentOrNot(isItANewBrick(377), 1); echo('<div class="brickStyle ' . $result[377] . '" id=' . idGen(377) . 'onclick="brickClicked(' . idGen(377) . ')"></div>'); toCommentOrNot(isItANewBrick(377), 2); ?>
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