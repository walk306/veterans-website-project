<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>repl.it</title>
  <script src="js/brickclicked.js"></script>
</head>
<body>
  <?php
    header("Content-type: text/html; charset:UTF-8");
    //connection variables
    $servername = "localhost";
    $dbname = "manchester_veterans_memorial_database";
    $uname = "phpmyadmin";
    $psword = "Y4VnqfDCz2vvMkv";
    //variables actually needed for the css
    $unitNum = (isset($_REQUEST['id']) ? $_REQUEST['id'] : null);
    $gridTemplateAreasId = (isset($_REQUEST['gridTemplateAreasId']) ? $_REQUEST['gridTemplateAreasId'] : null);
    $p = '"';
    // $idIndex = 0;
    function isItANewBrick($brickID){ 
      $tempID = substr($brickID, -3);
      $tempID = intval($tempID);
      $wasTheOneBeforeItNew;
      try{
        $servernameagain = "localhost";
        $dbnameagain = "manchester_veterans_memorial_database";
        $unameagain = "phpmyadmin";
        $pswordagain = "Y4VnqfDCz2vvMkv";
        $prep = new PDO("mysql:host=$servernameagain;port=3306;dbname=$dbnameagain", $unameagain, $pswordagain);
        $prep->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety
        $test = null;
        $test = $prep->prepare("SELECT width, brickID FROM allNames WHERE brickID = ?");
        $tempID -= 1;
        $tempID = strval($tempID);
        while (strlen($tempID) < 3){
          $tempID = "0" . $tempID;
        }
        $tempID = "a" . $tempID;
        $test->bindParam(1, $tempID, PDO::PARAM_STR, 4);
        $test->execute();
        $answer = $test->fetchAll(PDO::FETCH_COLUMN);
        if ($answer[0] > 1){
          return false;
          //TODO: adjust function toCommentOrNot to more effectively determine which bricks need to be visible. They could all be commented automatically, and uncommented as needed, or vice versa if an adequate solution can be found
        }
        else{
          return true;
        }
      }
      catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    function toCommentOrNot($pos, $brickStatus = 0){
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
    opacity: 1;
    border-style: solid;
    border-width: 1px;
    font-size: 10px;
    /* background-color: orange; */
    }

    /* .doodad:checked + .brickStyle{
      opacity: 0;
      background-color: purple;
    } */
    

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

    /*The popup form - hidden by default*/
    /* .form-popup {
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
            <?php toCommentOrNot(1, isItANewBrick("a001")); echo('<div class="brickStyle ' . $result[0] . '" id="a001" ' . 'onclick="brickClicked(' . "'a001'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a001")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a002")); echo('<div class="brickStyle ' . $result[1] . '" id="a002" ' . 'onclick="brickClicked(' . "'a002'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a002")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a003")); echo('<div class="brickStyle ' . $result[2] . '" id="a003" ' . 'onclick="brickClicked(' . "'a003'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a003")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a004")); echo('<div class="brickStyle ' . $result[3] . '" id="a004" ' . 'onclick="brickClicked(' . "'a004'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a004")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a005")); echo('<div class="brickStyle ' . $result[4] . '" id="a005" ' . 'onclick="brickClicked(' . "'a005'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a005")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a006")); echo('<div class="brickStyle ' . $result[5] . '" id="a006" ' . 'onclick="brickClicked(' . "'a006'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a006")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a007")); echo('<div class="brickStyle ' . $result[6] . '" id="a007" ' . 'onclick="brickClicked(' . "'a007'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a007")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a008")); echo('<div class="brickStyle ' . $result[7] . '" id="a008" ' . 'onclick="brickClicked(' . "'a008'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a008")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a009")); echo('<div class="brickStyle ' . $result[8] . '" id="a009" ' . 'onclick="brickClicked(' . "'a009'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a009")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a010")); echo('<div class="brickStyle ' . $result[9] . '" id="a010" ' . 'onclick="brickClicked(' . "'a010'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a010")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a011")); echo('<div class="brickStyle ' . $result[10] . '" id="a011" ' . 'onclick="brickClicked(' . "'a011'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a011")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a012")); echo('<div class="brickStyle ' . $result[11] . '" id="a012" ' . 'onclick="brickClicked(' . "'a012'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a012")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a013")); echo('<div class="brickStyle ' . $result[12] . '" id="a013" ' . 'onclick="brickClicked(' . "'a013'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a013")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a014")); echo('<div class="brickStyle ' . $result[13] . '" id="a014" ' . 'onclick="brickClicked(' . "'a014'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a014")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a015")); echo('<div class="brickStyle ' . $result[14] . '" id="a015" ' . 'onclick="brickClicked(' . "'a015'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a015")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a016")); echo('<div class="brickStyle ' . $result[15] . '" id="a016" ' . 'onclick="brickClicked(' . "'a016'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a016")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a017")); echo('<div class="brickStyle ' . $result[16] . '" id="a017" ' . 'onclick="brickClicked(' . "'a017'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a017")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a018")); echo('<div class="brickStyle ' . $result[17] . '" id="a018" ' . 'onclick="brickClicked(' . "'a018'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a018")); ?>
            <!-- Row 2 -->
            <?php toCommentOrNot(1, isItANewBrick("a019")); echo('<div class="brickStyle ' . $result[18] . '" id="a019" ' . 'onclick="brickClicked(' . "'a019'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a019")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a020")); echo('<div class="brickStyle ' . $result[19] . '" id="a020" ' . 'onclick="brickClicked(' . "'a020'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a020")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a021")); echo('<div class="brickStyle ' . $result[20] . '" id="a021" ' . 'onclick="brickClicked(' . "'a021'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a021")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a022")); echo('<div class="brickStyle ' . $result[21] . '" id="a022" ' . 'onclick="brickClicked(' . "'a022'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a022")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a023")); echo('<div class="brickStyle ' . $result[22] . '" id="a023" ' . 'onclick="brickClicked(' . "'a023'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a023")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a024")); echo('<div class="brickStyle ' . $result[23] . '" id="a024" ' . 'onclick="brickClicked(' . "'a024'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a024")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a025")); echo('<div class="brickStyle ' . $result[24] . '" id="a025" ' . 'onclick="brickClicked(' . "'a025'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a025")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a026")); echo('<div class="brickStyle ' . $result[25] . '" id="a026" ' . 'onclick="brickClicked(' . "'a026'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a026")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a027")); echo('<div class="brickStyle ' . $result[26] . '" id="a027" ' . 'onclick="brickClicked(' . "'a027'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a027")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a028")); echo('<div class="brickStyle ' . $result[27] . '" id="a028" ' . 'onclick="brickClicked(' . "'a028'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a028")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a029")); echo('<div class="brickStyle ' . $result[28] . '" id="a029" ' . 'onclick="brickClicked(' . "'a029'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a029")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a030")); echo('<div class="brickStyle ' . $result[29] . '" id="a030" ' . 'onclick="brickClicked(' . "'a030'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a030")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a031")); echo('<div class="brickStyle ' . $result[30] . '" id="a031" ' . 'onclick="brickClicked(' . "'a031'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a031")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a032")); echo('<div class="brickStyle ' . $result[31] . '" id="a032" ' . 'onclick="brickClicked(' . "'a032'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a032")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a033")); echo('<div class="brickStyle ' . $result[32] . '" id="a033" ' . 'onclick="brickClicked(' . "'a033'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a033")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a034")); echo('<div class="brickStyle ' . $result[33] . '" id="a034" ' . 'onclick="brickClicked(' . "'a034'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a034")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a035")); echo('<div class="brickStyle ' . $result[34] . '" id="a035" ' . 'onclick="brickClicked(' . "'a035'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a035")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a036")); echo('<div class="brickStyle ' . $result[35] . '" id="a036" ' . 'onclick="brickClicked(' . "'a036'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a036")); ?>
            <!-- Row 3 -->
            <?php toCommentOrNot(1, isItANewBrick("a037")); echo('<div class="brickStyle ' . $result[36] . '" id="a037" ' . 'onclick="brickClicked(' . "'a037'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a037")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a038")); echo('<div class="brickStyle ' . $result[37] . '" id="a038" ' . 'onclick="brickClicked(' . "'a038'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a038")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a039")); echo('<div class="brickStyle ' . $result[38] . '" id="a039" ' . 'onclick="brickClicked(' . "'a039'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a039")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a040")); echo('<div class="brickStyle ' . $result[39] . '" id="a040" ' . 'onclick="brickClicked(' . "'a040'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a040")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a041")); echo('<div class="brickStyle ' . $result[40] . '" id="a041" ' . 'onclick="brickClicked(' . "'a041'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a041")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a042")); echo('<div class="brickStyle ' . $result[41] . '" id="a042" ' . 'onclick="brickClicked(' . "'a042'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a042")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a043")); echo('<div class="brickStyle ' . $result[42] . '" id="a043" ' . 'onclick="brickClicked(' . "'a043'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a043")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a044")); echo('<div class="brickStyle ' . $result[43] . '" id="a044" ' . 'onclick="brickClicked(' . "'a044'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a044")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a045")); echo('<div class="brickStyle ' . $result[44] . '" id="a045" ' . 'onclick="brickClicked(' . "'a045'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a045")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a046")); echo('<div class="brickStyle ' . $result[45] . '" id="a046" ' . 'onclick="brickClicked(' . "'a046'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a046")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a047")); echo('<div class="brickStyle ' . $result[46] . '" id="a047" ' . 'onclick="brickClicked(' . "'a047'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a047")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a048")); echo('<div class="brickStyle ' . $result[47] . '" id="a048" ' . 'onclick="brickClicked(' . "'a048'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a048")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a049")); echo('<div class="brickStyle ' . $result[48] . '" id="a049" ' . 'onclick="brickClicked(' . "'a049'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a049")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a050")); echo('<div class="brickStyle ' . $result[49] . '" id="a050" ' . 'onclick="brickClicked(' . "'a050'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a050")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a051")); echo('<div class="brickStyle ' . $result[50] . '" id="a051" ' . 'onclick="brickClicked(' . "'a051'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a051")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a052")); echo('<div class="brickStyle ' . $result[51] . '" id="a052" ' . 'onclick="brickClicked(' . "'a052'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a052")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a053")); echo('<div class="brickStyle ' . $result[52] . '" id="a053" ' . 'onclick="brickClicked(' . "'a053'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a053")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a054")); echo('<div class="brickStyle ' . $result[53] . '" id="a054" ' . 'onclick="brickClicked(' . "'a054'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a054")); ?>
            <!-- Row 4 -->
            <?php toCommentOrNot(1, isItANewBrick("a055")); echo('<div class="brickStyle ' . $result[54] . '" id="a055" ' . 'onclick="brickClicked(' . "'a055'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a055")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a056")); echo('<div class="brickStyle ' . $result[55] . '" id="a056" ' . 'onclick="brickClicked(' . "'a056'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a056")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a057")); echo('<div class="brickStyle ' . $result[56] . '" id="a057" ' . 'onclick="brickClicked(' . "'a057'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a057")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a058")); echo('<div class="brickStyle ' . $result[57] . '" id="a058" ' . 'onclick="brickClicked(' . "'a058'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a058")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a059")); echo('<div class="brickStyle ' . $result[58] . '" id="a059" ' . 'onclick="brickClicked(' . "'a059'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a059")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a060")); echo('<div class="brickStyle ' . $result[59] . '" id="a060" ' . 'onclick="brickClicked(' . "'a060'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a060")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a061")); echo('<div class="brickStyle ' . $result[60] . '" id="a061" ' . 'onclick="brickClicked(' . "'a061'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a061")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a062")); echo('<div class="brickStyle ' . $result[61] . '" id="a062" ' . 'onclick="brickClicked(' . "'a062'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a062")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a063")); echo('<div class="brickStyle ' . $result[62] . '" id="a063" ' . 'onclick="brickClicked(' . "'a063'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a063")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a064")); echo('<div class="brickStyle ' . $result[63] . '" id="a064" ' . 'onclick="brickClicked(' . "'a064'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a064")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a065")); echo('<div class="brickStyle ' . $result[64] . '" id="a065" ' . 'onclick="brickClicked(' . "'a065'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a065")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a066")); echo('<div class="brickStyle ' . $result[65] . '" id="a066" ' . 'onclick="brickClicked(' . "'a066'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a066")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a067")); echo('<div class="brickStyle ' . $result[66] . '" id="a067" ' . 'onclick="brickClicked(' . "'a067'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a067")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a068")); echo('<div class="brickStyle ' . $result[67] . '" id="a068" ' . 'onclick="brickClicked(' . "'a068'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a068")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a069")); echo('<div class="brickStyle ' . $result[68] . '" id="a069" ' . 'onclick="brickClicked(' . "'a069'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a069")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a070")); echo('<div class="brickStyle ' . $result[69] . '" id="a070" ' . 'onclick="brickClicked(' . "'a070'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a070")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a071")); echo('<div class="brickStyle ' . $result[70] . '" id="a071" ' . 'onclick="brickClicked(' . "'a071'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a071")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a072")); echo('<div class="brickStyle ' . $result[71] . '" id="a072" ' . 'onclick="brickClicked(' . "'a072'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a072")); ?>
            <!-- Row 5 -->
            <?php toCommentOrNot(1, isItANewBrick("a073")); echo('<div class="brickStyle ' . $result[72] . '" id="a073" ' . 'onclick="brickClicked(' . "'a073'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a073")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a074")); echo('<div class="brickStyle ' . $result[73] . '" id="a074" ' . 'onclick="brickClicked(' . "'a074'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a074")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a075")); echo('<div class="brickStyle ' . $result[74] . '" id="a075" ' . 'onclick="brickClicked(' . "'a075'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a075")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a076")); echo('<div class="brickStyle ' . $result[75] . '" id="a076" ' . 'onclick="brickClicked(' . "'a076'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a076")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a077")); echo('<div class="brickStyle ' . $result[76] . '" id="a077" ' . 'onclick="brickClicked(' . "'a077'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a077")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a078")); echo('<div class="brickStyle ' . $result[77] . '" id="a078" ' . 'onclick="brickClicked(' . "'a078'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a078")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a079")); echo('<div class="brickStyle ' . $result[78] . '" id="a079" ' . 'onclick="brickClicked(' . "'a079'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a079")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a080")); echo('<div class="brickStyle ' . $result[79] . '" id="a080" ' . 'onclick="brickClicked(' . "'a080'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a080")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a081")); echo('<div class="brickStyle ' . $result[80] . '" id="a081" ' . 'onclick="brickClicked(' . "'a081'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a081")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a082")); echo('<div class="brickStyle ' . $result[81] . '" id="a082" ' . 'onclick="brickClicked(' . "'a082'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a082")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a083")); echo('<div class="brickStyle ' . $result[82] . '" id="a083" ' . 'onclick="brickClicked(' . "'a083'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a083")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a084")); echo('<div class="brickStyle ' . $result[83] . '" id="a084" ' . 'onclick="brickClicked(' . "'a084'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a084")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a085")); echo('<div class="brickStyle ' . $result[84] . '" id="a085" ' . 'onclick="brickClicked(' . "'a085'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a085")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a086")); echo('<div class="brickStyle ' . $result[85] . '" id="a086" ' . 'onclick="brickClicked(' . "'a086'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a086")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a087")); echo('<div class="brickStyle ' . $result[86] . '" id="a087" ' . 'onclick="brickClicked(' . "'a087'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a087")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a088")); echo('<div class="brickStyle ' . $result[87] . '" id="a088" ' . 'onclick="brickClicked(' . "'a088'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a088")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a089")); echo('<div class="brickStyle ' . $result[88] . '" id="a089" ' . 'onclick="brickClicked(' . "'a089'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a089")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a090")); echo('<div class="brickStyle ' . $result[89] . '" id="a090" ' . 'onclick="brickClicked(' . "'a090'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a090")); ?>
            <!-- Row 6 -->
            <?php toCommentOrNot(1, isItANewBrick("a091")); echo('<div class="brickStyle ' . $result[90] . '" id="a091" ' . 'onclick="brickClicked(' . "'a091'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a091")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a092")); echo('<div class="brickStyle ' . $result[91] . '" id="a092" ' . 'onclick="brickClicked(' . "'a092'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a092")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a093")); echo('<div class="brickStyle ' . $result[92] . '" id="a093" ' . 'onclick="brickClicked(' . "'a093'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a093")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a094")); echo('<div class="brickStyle ' . $result[93] . '" id="a094" ' . 'onclick="brickClicked(' . "'a094'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a094")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a095")); echo('<div class="brickStyle ' . $result[94] . '" id="a095" ' . 'onclick="brickClicked(' . "'a095'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a095")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a096")); echo('<div class="brickStyle ' . $result[95] . '" id="a096" ' . 'onclick="brickClicked(' . "'a096'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a096")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a097")); echo('<div class="brickStyle ' . $result[96] . '" id="a097" ' . 'onclick="brickClicked(' . "'a097'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a097")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a098")); echo('<div class="brickStyle ' . $result[97] . '" id="a098" ' . 'onclick="brickClicked(' . "'a098'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a098")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a099")); echo('<div class="brickStyle ' . $result[98] . '" id="a099" ' . 'onclick="brickClicked(' . "'a099'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a099")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a100")); echo('<div class="brickStyle ' . $result[99] . '" id="a100" ' . 'onclick="brickClicked(' . "'a100'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a100")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a101")); echo('<div class="brickStyle ' . $result[100] . '" id="a101" ' . 'onclick="brickClicked(' . "'a101'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a101")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a102")); echo('<div class="brickStyle ' . $result[101] . '" id="a102" ' . 'onclick="brickClicked(' . "'a102'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a102")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a103")); echo('<div class="brickStyle ' . $result[102] . '" id="a103" ' . 'onclick="brickClicked(' . "'a103'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a103")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a104")); echo('<div class="brickStyle ' . $result[103] . '" id="a104" ' . 'onclick="brickClicked(' . "'a104'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a104")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a105")); echo('<div class="brickStyle ' . $result[104] . '" id="a105" ' . 'onclick="brickClicked(' . "'a105'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a105")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a106")); echo('<div class="brickStyle ' . $result[105] . '" id="a106" ' . 'onclick="brickClicked(' . "'a106'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a106")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a107")); echo('<div class="brickStyle ' . $result[106] . '" id="a107" ' . 'onclick="brickClicked(' . "'a107'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a107")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a108")); echo('<div class="brickStyle ' . $result[107] . '" id="a108" ' . 'onclick="brickClicked(' . "'a108'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a108")); ?>
            <!-- Row 7 -->
            <?php toCommentOrNot(1, isItANewBrick("a109")); echo('<div class="brickStyle ' . $result[108] . '" id="a109" ' . 'onclick="brickClicked(' . "'a109'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a109")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a110")); echo('<div class="brickStyle ' . $result[109] . '" id="a110" ' . 'onclick="brickClicked(' . "'a110'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a110")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a111")); echo('<div class="brickStyle ' . $result[110] . '" id="a111" ' . 'onclick="brickClicked(' . "'a111'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a111")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a112")); echo('<div class="brickStyle ' . $result[111] . '" id="a112" ' . 'onclick="brickClicked(' . "'a112'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a112")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a113")); echo('<div class="brickStyle ' . $result[112] . '" id="a113" ' . 'onclick="brickClicked(' . "'a113'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a113")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a114")); echo('<div class="brickStyle ' . $result[113] . '" id="a114" ' . 'onclick="brickClicked(' . "'a114'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a114")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a115")); echo('<div class="brickStyle ' . $result[114] . '" id="a115" ' . 'onclick="brickClicked(' . "'a115'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a115")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a116")); echo('<div class="brickStyle ' . $result[115] . '" id="a116" ' . 'onclick="brickClicked(' . "'a116'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a116")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a117")); echo('<div class="brickStyle ' . $result[116] . '" id="a117" ' . 'onclick="brickClicked(' . "'a117'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a117")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a118")); echo('<div class="brickStyle ' . $result[117] . '" id="a118" ' . 'onclick="brickClicked(' . "'a118'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a118")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a119")); echo('<div class="brickStyle ' . $result[118] . '" id="a119" ' . 'onclick="brickClicked(' . "'a119'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a119")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a120")); echo('<div class="brickStyle ' . $result[119] . '" id="a120" ' . 'onclick="brickClicked(' . "'a120'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a120")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a121")); echo('<div class="brickStyle ' . $result[120] . '" id="a121" ' . 'onclick="brickClicked(' . "'a121'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a121")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a122")); echo('<div class="brickStyle ' . $result[121] . '" id="a122" ' . 'onclick="brickClicked(' . "'a122'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a122")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a123")); echo('<div class="brickStyle ' . $result[122] . '" id="a123" ' . 'onclick="brickClicked(' . "'a123'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a123")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a124")); echo('<div class="brickStyle ' . $result[123] . '" id="a124" ' . 'onclick="brickClicked(' . "'a124'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a124")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a125")); echo('<div class="brickStyle ' . $result[124] . '" id="a125" ' . 'onclick="brickClicked(' . "'a125'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a125")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a126")); echo('<div class="brickStyle ' . $result[125] . '" id="a126" ' . 'onclick="brickClicked(' . "'a126'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a126")); ?>
            <!-- Row 8 -->
            <?php toCommentOrNot(1, isItANewBrick("a127")); echo('<div class="brickStyle ' . $result[126] . '" id="a127" ' . 'onclick="brickClicked(' . "'a127'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a127")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a128")); echo('<div class="brickStyle ' . $result[127] . '" id="a128" ' . 'onclick="brickClicked(' . "'a128'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a128")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a129")); echo('<div class="brickStyle ' . $result[128] . '" id="a129" ' . 'onclick="brickClicked(' . "'a129'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a129")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a130")); echo('<div class="brickStyle ' . $result[129] . '" id="a130" ' . 'onclick="brickClicked(' . "'a130'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a130")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a131")); echo('<div class="brickStyle ' . $result[130] . '" id="a131" ' . 'onclick="brickClicked(' . "'a131'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a131")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a132")); echo('<div class="brickStyle ' . $result[131] . '" id="a132" ' . 'onclick="brickClicked(' . "'a132'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a132")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a133")); echo('<div class="brickStyle ' . $result[132] . '" id="a133" ' . 'onclick="brickClicked(' . "'a133'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a133")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a134")); echo('<div class="brickStyle ' . $result[133] . '" id="a134" ' . 'onclick="brickClicked(' . "'a134'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a134")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a135")); echo('<div class="brickStyle ' . $result[134] . '" id="a135" ' . 'onclick="brickClicked(' . "'a135'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a135")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a136")); echo('<div class="brickStyle ' . $result[135] . '" id="a136" ' . 'onclick="brickClicked(' . "'a136'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a136")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a137")); echo('<div class="brickStyle ' . $result[136] . '" id="a137" ' . 'onclick="brickClicked(' . "'a137'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a137")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a138")); echo('<div class="brickStyle ' . $result[137] . '" id="a138" ' . 'onclick="brickClicked(' . "'a138'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a138")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a139")); echo('<div class="brickStyle ' . $result[138] . '" id="a139" ' . 'onclick="brickClicked(' . "'a139'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a139")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a140")); echo('<div class="brickStyle ' . $result[139] . '" id="a140" ' . 'onclick="brickClicked(' . "'a140'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a140")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a141")); echo('<div class="brickStyle ' . $result[140] . '" id="a141" ' . 'onclick="brickClicked(' . "'a141'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a141")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a142")); echo('<div class="brickStyle ' . $result[141] . '" id="a142" ' . 'onclick="brickClicked(' . "'a142'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a142")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a143")); echo('<div class="brickStyle ' . $result[142] . '" id="a143" ' . 'onclick="brickClicked(' . "'a143'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a143")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a144")); echo('<div class="brickStyle ' . $result[143] . '" id="a144" ' . 'onclick="brickClicked(' . "'a144'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a144")); ?>
            <!-- Row 9 -->
            <?php toCommentOrNot(1, isItANewBrick("a145")); echo('<div class="brickStyle ' . $result[144] . '" id="a145" ' . 'onclick="brickClicked(' . "'a145'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a145")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a146")); echo('<div class="brickStyle ' . $result[145] . '" id="a146" ' . 'onclick="brickClicked(' . "'a146'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a146")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a147")); echo('<div class="brickStyle ' . $result[146] . '" id="a147" ' . 'onclick="brickClicked(' . "'a147'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a147")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a148")); echo('<div class="brickStyle ' . $result[147] . '" id="a148" ' . 'onclick="brickClicked(' . "'a148'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a148")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a149")); echo('<div class="brickStyle ' . $result[148] . '" id="a149" ' . 'onclick="brickClicked(' . "'a149'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a149")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a150")); echo('<div class="brickStyle ' . $result[149] . '" id="a150" ' . 'onclick="brickClicked(' . "'a150'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a150")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a151")); echo('<div class="brickStyle ' . $result[150] . '" id="a151" ' . 'onclick="brickClicked(' . "'a151'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a151")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a152")); echo('<div class="brickStyle ' . $result[151] . '" id="a152" ' . 'onclick="brickClicked(' . "'a152'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a152")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a153")); echo('<div class="brickStyle ' . $result[152] . '" id="a153" ' . 'onclick="brickClicked(' . "'a153'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a153")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a154")); echo('<div class="brickStyle ' . $result[153] . '" id="a154" ' . 'onclick="brickClicked(' . "'a154'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a154")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a155")); echo('<div class="brickStyle ' . $result[154] . '" id="a155" ' . 'onclick="brickClicked(' . "'a155'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a155")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a156")); echo('<div class="brickStyle ' . $result[155] . '" id="a156" ' . 'onclick="brickClicked(' . "'a156'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a156")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a157")); echo('<div class="brickStyle ' . $result[156] . '" id="a157" ' . 'onclick="brickClicked(' . "'a157'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a157")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a158")); echo('<div class="brickStyle ' . $result[157] . '" id="a158" ' . 'onclick="brickClicked(' . "'a158'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a158")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a159")); echo('<div class="brickStyle ' . $result[158] . '" id="a159" ' . 'onclick="brickClicked(' . "'a159'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a159")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a160")); echo('<div class="brickStyle ' . $result[159] . '" id="a160" ' . 'onclick="brickClicked(' . "'a160'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a160")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a161")); echo('<div class="brickStyle ' . $result[160] . '" id="a161" ' . 'onclick="brickClicked(' . "'a161'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a161")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a162")); echo('<div class="brickStyle ' . $result[161] . '" id="a162" ' . 'onclick="brickClicked(' . "'a162'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a162")); ?>
            <!-- Row 10 -->
            <?php toCommentOrNot(1, isItANewBrick("a163")); echo('<div class="brickStyle ' . $result[162] . '" id="a163" ' . 'onclick="brickClicked(' . "'a163'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a163")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a164")); echo('<div class="brickStyle ' . $result[163] . '" id="a164" ' . 'onclick="brickClicked(' . "'a164'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a164")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a165")); echo('<div class="brickStyle ' . $result[164] . '" id="a165" ' . 'onclick="brickClicked(' . "'a165'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a165")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a166")); echo('<div class="brickStyle ' . $result[165] . '" id="a166" ' . 'onclick="brickClicked(' . "'a166'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a166")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a167")); echo('<div class="brickStyle ' . $result[166] . '" id="a167" ' . 'onclick="brickClicked(' . "'a167'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a167")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a168")); echo('<div class="brickStyle ' . $result[167] . '" id="a168" ' . 'onclick="brickClicked(' . "'a168'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a168")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a169")); echo('<div class="brickStyle ' . $result[168] . '" id="a169" ' . 'onclick="brickClicked(' . "'a169'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a169")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a170")); echo('<div class="brickStyle ' . $result[169] . '" id="a170" ' . 'onclick="brickClicked(' . "'a170'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a170")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a171")); echo('<div class="brickStyle ' . $result[170] . '" id="a171" ' . 'onclick="brickClicked(' . "'a171'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a171")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a172")); echo('<div class="brickStyle ' . $result[171] . '" id="a172" ' . 'onclick="brickClicked(' . "'a172'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a172")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a173")); echo('<div class="brickStyle ' . $result[172] . '" id="a173" ' . 'onclick="brickClicked(' . "'a173'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a173")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a174")); echo('<div class="brickStyle ' . $result[173] . '" id="a174" ' . 'onclick="brickClicked(' . "'a174'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a174")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a175")); echo('<div class="brickStyle ' . $result[174] . '" id="a175" ' . 'onclick="brickClicked(' . "'a175'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a175")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a176")); echo('<div class="brickStyle ' . $result[175] . '" id="a176" ' . 'onclick="brickClicked(' . "'a176'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a176")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a177")); echo('<div class="brickStyle ' . $result[176] . '" id="a177" ' . 'onclick="brickClicked(' . "'a177'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a177")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a178")); echo('<div class="brickStyle ' . $result[177] . '" id="a178" ' . 'onclick="brickClicked(' . "'a178'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a178")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a179")); echo('<div class="brickStyle ' . $result[178] . '" id="a179" ' . 'onclick="brickClicked(' . "'a179'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a179")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a180")); echo('<div class="brickStyle ' . $result[179] . '" id="a180" ' . 'onclick="brickClicked(' . "'a180'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a180")); ?>
            <!-- Row 11 -->
            <?php toCommentOrNot(1, isItANewBrick("a181")); echo('<div class="brickStyle ' . $result[180] . '" id="a181" ' . 'onclick="brickClicked(' . "'a181'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a181")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a182")); echo('<div class="brickStyle ' . $result[181] . '" id="a182" ' . 'onclick="brickClicked(' . "'a182'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a182")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a183")); echo('<div class="brickStyle ' . $result[182] . '" id="a183" ' . 'onclick="brickClicked(' . "'a183'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a183")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a184")); echo('<div class="brickStyle ' . $result[183] . '" id="a184" ' . 'onclick="brickClicked(' . "'a184'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a184")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a185")); echo('<div class="brickStyle ' . $result[184] . '" id="a185" ' . 'onclick="brickClicked(' . "'a185'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a185")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a186")); echo('<div class="brickStyle ' . $result[185] . '" id="a186" ' . 'onclick="brickClicked(' . "'a186'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a186")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a187")); echo('<div class="brickStyle ' . $result[186] . '" id="a187" ' . 'onclick="brickClicked(' . "'a187'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a187")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a188")); echo('<div class="brickStyle ' . $result[187] . '" id="a188" ' . 'onclick="brickClicked(' . "'a188'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a188")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a189")); echo('<div class="brickStyle ' . $result[188] . '" id="a189" ' . 'onclick="brickClicked(' . "'a189'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a189")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a190")); echo('<div class="brickStyle ' . $result[189] . '" id="a190" ' . 'onclick="brickClicked(' . "'a190'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a190")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a191")); echo('<div class="brickStyle ' . $result[190] . '" id="a191" ' . 'onclick="brickClicked(' . "'a191'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a191")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a192")); echo('<div class="brickStyle ' . $result[191] . '" id="a192" ' . 'onclick="brickClicked(' . "'a192'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a192")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a193")); echo('<div class="brickStyle ' . $result[192] . '" id="a193" ' . 'onclick="brickClicked(' . "'a193'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a193")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a194")); echo('<div class="brickStyle ' . $result[193] . '" id="a194" ' . 'onclick="brickClicked(' . "'a194'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a194")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a195")); echo('<div class="brickStyle ' . $result[194] . '" id="a195" ' . 'onclick="brickClicked(' . "'a195'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a195")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a196")); echo('<div class="brickStyle ' . $result[195] . '" id="a196" ' . 'onclick="brickClicked(' . "'a196'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a196")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a197")); echo('<div class="brickStyle ' . $result[196] . '" id="a197" ' . 'onclick="brickClicked(' . "'a197'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a197")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a198")); echo('<div class="brickStyle ' . $result[197] . '" id="a198" ' . 'onclick="brickClicked(' . "'a198'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a198")); ?>
            <!-- Row 12 -->
            <?php toCommentOrNot(1, isItANewBrick("a199")); echo('<div class="brickStyle ' . $result[198] . '" id="a199" ' . 'onclick="brickClicked(' . "'a199'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a199")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a200")); echo('<div class="brickStyle ' . $result[199] . '" id="a200" ' . 'onclick="brickClicked(' . "'a200'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a200")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a201")); echo('<div class="brickStyle ' . $result[200] . '" id="a201" ' . 'onclick="brickClicked(' . "'a201'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a201")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a202")); echo('<div class="brickStyle ' . $result[201] . '" id="a202" ' . 'onclick="brickClicked(' . "'a202'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a202")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a203")); echo('<div class="brickStyle ' . $result[202] . '" id="a203" ' . 'onclick="brickClicked(' . "'a203'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a203")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a204")); echo('<div class="brickStyle ' . $result[203] . '" id="a204" ' . 'onclick="brickClicked(' . "'a204'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a204")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a205")); echo('<div class="brickStyle ' . $result[204] . '" id="a205" ' . 'onclick="brickClicked(' . "'a205'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a205")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a206")); echo('<div class="brickStyle ' . $result[205] . '" id="a206" ' . 'onclick="brickClicked(' . "'a206'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a206")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a207")); echo('<div class="brickStyle ' . $result[206] . '" id="a207" ' . 'onclick="brickClicked(' . "'a207'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a207")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a208")); echo('<div class="brickStyle ' . $result[207] . '" id="a208" ' . 'onclick="brickClicked(' . "'a208'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a208")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a209")); echo('<div class="brickStyle ' . $result[208] . '" id="a209" ' . 'onclick="brickClicked(' . "'a209'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a209")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a210")); echo('<div class="brickStyle ' . $result[209] . '" id="a210" ' . 'onclick="brickClicked(' . "'a210'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a210")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a211")); echo('<div class="brickStyle ' . $result[210] . '" id="a211" ' . 'onclick="brickClicked(' . "'a211'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a211")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a212")); echo('<div class="brickStyle ' . $result[211] . '" id="a212" ' . 'onclick="brickClicked(' . "'a212'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a212")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a213")); echo('<div class="brickStyle ' . $result[212] . '" id="a213" ' . 'onclick="brickClicked(' . "'a213'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a213")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a214")); echo('<div class="brickStyle ' . $result[213] . '" id="a214" ' . 'onclick="brickClicked(' . "'a214'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a214")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a215")); echo('<div class="brickStyle ' . $result[214] . '" id="a215" ' . 'onclick="brickClicked(' . "'a215'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a215")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a216")); echo('<div class="brickStyle ' . $result[215] . '" id="a216" ' . 'onclick="brickClicked(' . "'a216'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a216")); ?>
            <!-- Row 13 -->
            <?php toCommentOrNot(1, isItANewBrick("a217")); echo('<div class="brickStyle ' . $result[216] . '" id="a217" ' . 'onclick="brickClicked(' . "'a217'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a217")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a218")); echo('<div class="brickStyle ' . $result[217] . '" id="a218" ' . 'onclick="brickClicked(' . "'a218'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a218")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a219")); echo('<div class="brickStyle ' . $result[218] . '" id="a219" ' . 'onclick="brickClicked(' . "'a219'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a219")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a220")); echo('<div class="brickStyle ' . $result[219] . '" id="a220" ' . 'onclick="brickClicked(' . "'a220'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a220")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a221")); echo('<div class="brickStyle ' . $result[220] . '" id="a221" ' . 'onclick="brickClicked(' . "'a221'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a221")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a222")); echo('<div class="brickStyle ' . $result[221] . '" id="a222" ' . 'onclick="brickClicked(' . "'a222'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a222")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a223")); echo('<div class="brickStyle ' . $result[222] . '" id="a223" ' . 'onclick="brickClicked(' . "'a223'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a223")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a224")); echo('<div class="brickStyle ' . $result[223] . '" id="a224" ' . 'onclick="brickClicked(' . "'a224'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a224")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a225")); echo('<div class="brickStyle ' . $result[224] . '" id="a225" ' . 'onclick="brickClicked(' . "'a225'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a225")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a226")); echo('<div class="brickStyle ' . $result[225] . '" id="a226" ' . 'onclick="brickClicked(' . "'a226'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a226")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a227")); echo('<div class="brickStyle ' . $result[226] . '" id="a227" ' . 'onclick="brickClicked(' . "'a227'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a227")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a228")); echo('<div class="brickStyle ' . $result[227] . '" id="a228" ' . 'onclick="brickClicked(' . "'a228'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a228")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a229")); echo('<div class="brickStyle ' . $result[228] . '" id="a229" ' . 'onclick="brickClicked(' . "'a229'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a229")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a230")); echo('<div class="brickStyle ' . $result[229] . '" id="a230" ' . 'onclick="brickClicked(' . "'a230'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a230")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a231")); echo('<div class="brickStyle ' . $result[230] . '" id="a231" ' . 'onclick="brickClicked(' . "'a231'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a231")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a232")); echo('<div class="brickStyle ' . $result[231] . '" id="a232" ' . 'onclick="brickClicked(' . "'a232'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a232")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a233")); echo('<div class="brickStyle ' . $result[232] . '" id="a233" ' . 'onclick="brickClicked(' . "'a233'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a233")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a234")); echo('<div class="brickStyle ' . $result[233] . '" id="a234" ' . 'onclick="brickClicked(' . "'a234'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a234")); ?>
            <!-- Row 14 -->
            <?php toCommentOrNot(1, isItANewBrick("a235")); echo('<div class="brickStyle ' . $result[234] . '" id="a235" ' . 'onclick="brickClicked(' . "'a235'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a235")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a236")); echo('<div class="brickStyle ' . $result[235] . '" id="a236" ' . 'onclick="brickClicked(' . "'a236'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a236")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a237")); echo('<div class="brickStyle ' . $result[236] . '" id="a237" ' . 'onclick="brickClicked(' . "'a237'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a237")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a238")); echo('<div class="brickStyle ' . $result[237] . '" id="a238" ' . 'onclick="brickClicked(' . "'a238'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a238")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a239")); echo('<div class="brickStyle ' . $result[238] . '" id="a239" ' . 'onclick="brickClicked(' . "'a239'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a239")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a240")); echo('<div class="brickStyle ' . $result[239] . '" id="a240" ' . 'onclick="brickClicked(' . "'a240'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a240")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a241")); echo('<div class="brickStyle ' . $result[240] . '" id="a241" ' . 'onclick="brickClicked(' . "'a241'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a241")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a242")); echo('<div class="brickStyle ' . $result[241] . '" id="a242" ' . 'onclick="brickClicked(' . "'a242'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a242")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a243")); echo('<div class="brickStyle ' . $result[242] . '" id="a243" ' . 'onclick="brickClicked(' . "'a243'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a243")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a244")); echo('<div class="brickStyle ' . $result[243] . '" id="a244" ' . 'onclick="brickClicked(' . "'a244'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a244")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a245")); echo('<div class="brickStyle ' . $result[244] . '" id="a245" ' . 'onclick="brickClicked(' . "'a245'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a245")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a246")); echo('<div class="brickStyle ' . $result[245] . '" id="a246" ' . 'onclick="brickClicked(' . "'a246'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a246")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a247")); echo('<div class="brickStyle ' . $result[246] . '" id="a247" ' . 'onclick="brickClicked(' . "'a247'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a247")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a248")); echo('<div class="brickStyle ' . $result[247] . '" id="a248" ' . 'onclick="brickClicked(' . "'a248'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a248")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a249")); echo('<div class="brickStyle ' . $result[248] . '" id="a249" ' . 'onclick="brickClicked(' . "'a249'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a249")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a250")); echo('<div class="brickStyle ' . $result[249] . '" id="a250" ' . 'onclick="brickClicked(' . "'a250'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a250")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a251")); echo('<div class="brickStyle ' . $result[250] . '" id="a251" ' . 'onclick="brickClicked(' . "'a251'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a251")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a252")); echo('<div class="brickStyle ' . $result[251] . '" id="a252" ' . 'onclick="brickClicked(' . "'a252'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a252")); ?>
            <!-- Row 15 -->
            <?php toCommentOrNot(1, isItANewBrick("a253")); echo('<div class="brickStyle ' . $result[252] . '" id="a253" ' . 'onclick="brickClicked(' . "'a253'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a253")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a254")); echo('<div class="brickStyle ' . $result[253] . '" id="a254" ' . 'onclick="brickClicked(' . "'a254'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a254")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a255")); echo('<div class="brickStyle ' . $result[254] . '" id="a255" ' . 'onclick="brickClicked(' . "'a255'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a255")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a256")); echo('<div class="brickStyle ' . $result[255] . '" id="a256" ' . 'onclick="brickClicked(' . "'a256'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a256")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a257")); echo('<div class="brickStyle ' . $result[256] . '" id="a257" ' . 'onclick="brickClicked(' . "'a257'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a257")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a258")); echo('<div class="brickStyle ' . $result[257] . '" id="a258" ' . 'onclick="brickClicked(' . "'a258'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a258")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a259")); echo('<div class="brickStyle ' . $result[258] . '" id="a259" ' . 'onclick="brickClicked(' . "'a259'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a259")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a260")); echo('<div class="brickStyle ' . $result[259] . '" id="a260" ' . 'onclick="brickClicked(' . "'a260'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a260")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a261")); echo('<div class="brickStyle ' . $result[260] . '" id="a261" ' . 'onclick="brickClicked(' . "'a261'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a261")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a262")); echo('<div class="brickStyle ' . $result[261] . '" id="a262" ' . 'onclick="brickClicked(' . "'a262'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a262")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a263")); echo('<div class="brickStyle ' . $result[262] . '" id="a263" ' . 'onclick="brickClicked(' . "'a263'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a263")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a264")); echo('<div class="brickStyle ' . $result[263] . '" id="a264" ' . 'onclick="brickClicked(' . "'a264'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a264")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a265")); echo('<div class="brickStyle ' . $result[264] . '" id="a265" ' . 'onclick="brickClicked(' . "'a265'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a265")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a266")); echo('<div class="brickStyle ' . $result[265] . '" id="a266" ' . 'onclick="brickClicked(' . "'a266'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a266")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a267")); echo('<div class="brickStyle ' . $result[266] . '" id="a267" ' . 'onclick="brickClicked(' . "'a267'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a267")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a268")); echo('<div class="brickStyle ' . $result[267] . '" id="a268" ' . 'onclick="brickClicked(' . "'a268'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a268")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a269")); echo('<div class="brickStyle ' . $result[268] . '" id="a269" ' . 'onclick="brickClicked(' . "'a269'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a269")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a270")); echo('<div class="brickStyle ' . $result[269] . '" id="a270" ' . 'onclick="brickClicked(' . "'a270'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a270")); ?>
            <!-- Row 16 -->
            <?php toCommentOrNot(1, isItANewBrick("a271")); echo('<div class="brickStyle ' . $result[270] . '" id="a271" ' . 'onclick="brickClicked(' . "'a271'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a271")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a272")); echo('<div class="brickStyle ' . $result[271] . '" id="a272" ' . 'onclick="brickClicked(' . "'a272'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a272")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a273")); echo('<div class="brickStyle ' . $result[272] . '" id="a273" ' . 'onclick="brickClicked(' . "'a273'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a273")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a274")); echo('<div class="brickStyle ' . $result[273] . '" id="a274" ' . 'onclick="brickClicked(' . "'a274'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a274")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a275")); echo('<div class="brickStyle ' . $result[274] . '" id="a275" ' . 'onclick="brickClicked(' . "'a275'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a275")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a276")); echo('<div class="brickStyle ' . $result[275] . '" id="a276" ' . 'onclick="brickClicked(' . "'a276'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a276")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a277")); echo('<div class="brickStyle ' . $result[276] . '" id="a277" ' . 'onclick="brickClicked(' . "'a277'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a277")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a278")); echo('<div class="brickStyle ' . $result[277] . '" id="a278" ' . 'onclick="brickClicked(' . "'a278'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a278")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a279")); echo('<div class="brickStyle ' . $result[278] . '" id="a279" ' . 'onclick="brickClicked(' . "'a279'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a279")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a280")); echo('<div class="brickStyle ' . $result[279] . '" id="a280" ' . 'onclick="brickClicked(' . "'a280'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a280")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a281")); echo('<div class="brickStyle ' . $result[280] . '" id="a281" ' . 'onclick="brickClicked(' . "'a281'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a281")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a282")); echo('<div class="brickStyle ' . $result[281] . '" id="a282" ' . 'onclick="brickClicked(' . "'a282'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a282")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a283")); echo('<div class="brickStyle ' . $result[282] . '" id="a283" ' . 'onclick="brickClicked(' . "'a283'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a283")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a284")); echo('<div class="brickStyle ' . $result[283] . '" id="a284" ' . 'onclick="brickClicked(' . "'a284'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a284")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a285")); echo('<div class="brickStyle ' . $result[284] . '" id="a285" ' . 'onclick="brickClicked(' . "'a285'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a285")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a286")); echo('<div class="brickStyle ' . $result[285] . '" id="a286" ' . 'onclick="brickClicked(' . "'a286'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a286")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a287")); echo('<div class="brickStyle ' . $result[286] . '" id="a287" ' . 'onclick="brickClicked(' . "'a287'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a287")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a288")); echo('<div class="brickStyle ' . $result[287] . '" id="a288" ' . 'onclick="brickClicked(' . "'a288'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a288")); ?>
            <!-- Row 17 -->
            <?php toCommentOrNot(1, isItANewBrick("a289")); echo('<div class="brickStyle ' . $result[288] . '" id="a289" ' . 'onclick="brickClicked(' . "'a289'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a289")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a290")); echo('<div class="brickStyle ' . $result[289] . '" id="a290" ' . 'onclick="brickClicked(' . "'a290'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a290")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a291")); echo('<div class="brickStyle ' . $result[290] . '" id="a291" ' . 'onclick="brickClicked(' . "'a291'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a291")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a292")); echo('<div class="brickStyle ' . $result[291] . '" id="a292" ' . 'onclick="brickClicked(' . "'a292'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a292")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a293")); echo('<div class="brickStyle ' . $result[292] . '" id="a293" ' . 'onclick="brickClicked(' . "'a293'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a293")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a294")); echo('<div class="brickStyle ' . $result[293] . '" id="a294" ' . 'onclick="brickClicked(' . "'a294'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a294")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a295")); echo('<div class="brickStyle ' . $result[294] . '" id="a295" ' . 'onclick="brickClicked(' . "'a295'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a295")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a296")); echo('<div class="brickStyle ' . $result[295] . '" id="a296" ' . 'onclick="brickClicked(' . "'a296'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a296")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a297")); echo('<div class="brickStyle ' . $result[296] . '" id="a297" ' . 'onclick="brickClicked(' . "'a297'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a297")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a298")); echo('<div class="brickStyle ' . $result[297] . '" id="a298" ' . 'onclick="brickClicked(' . "'a298'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a298")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a299")); echo('<div class="brickStyle ' . $result[298] . '" id="a299" ' . 'onclick="brickClicked(' . "'a299'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a299")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a300")); echo('<div class="brickStyle ' . $result[299] . '" id="a300" ' . 'onclick="brickClicked(' . "'a300'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a300")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a301")); echo('<div class="brickStyle ' . $result[300] . '" id="a301" ' . 'onclick="brickClicked(' . "'a301'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a301")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a302")); echo('<div class="brickStyle ' . $result[301] . '" id="a302" ' . 'onclick="brickClicked(' . "'a302'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a302")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a303")); echo('<div class="brickStyle ' . $result[302] . '" id="a303" ' . 'onclick="brickClicked(' . "'a303'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a303")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a304")); echo('<div class="brickStyle ' . $result[303] . '" id="a304" ' . 'onclick="brickClicked(' . "'a304'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a304")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a305")); echo('<div class="brickStyle ' . $result[304] . '" id="a305" ' . 'onclick="brickClicked(' . "'a305'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a305")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a306")); echo('<div class="brickStyle ' . $result[305] . '" id="a306" ' . 'onclick="brickClicked(' . "'a306'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a306")); ?>
            <!-- Row 18 -->
            <?php toCommentOrNot(1, isItANewBrick("a307")); echo('<div class="brickStyle ' . $result[306] . '" id="a307" ' . 'onclick="brickClicked(' . "'a307'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a307")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a308")); echo('<div class="brickStyle ' . $result[307] . '" id="a308" ' . 'onclick="brickClicked(' . "'a308'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a308")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a309")); echo('<div class="brickStyle ' . $result[308] . '" id="a309" ' . 'onclick="brickClicked(' . "'a309'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a309")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a310")); echo('<div class="brickStyle ' . $result[309] . '" id="a310" ' . 'onclick="brickClicked(' . "'a310'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a310")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a311")); echo('<div class="brickStyle ' . $result[310] . '" id="a311" ' . 'onclick="brickClicked(' . "'a311'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a311")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a312")); echo('<div class="brickStyle ' . $result[311] . '" id="a312" ' . 'onclick="brickClicked(' . "'a312'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a312")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a313")); echo('<div class="brickStyle ' . $result[312] . '" id="a313" ' . 'onclick="brickClicked(' . "'a313'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a313")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a314")); echo('<div class="brickStyle ' . $result[313] . '" id="a314" ' . 'onclick="brickClicked(' . "'a314'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a314")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a315")); echo('<div class="brickStyle ' . $result[314] . '" id="a315" ' . 'onclick="brickClicked(' . "'a315'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a315")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a316")); echo('<div class="brickStyle ' . $result[315] . '" id="a316" ' . 'onclick="brickClicked(' . "'a316'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a316")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a317")); echo('<div class="brickStyle ' . $result[316] . '" id="a317" ' . 'onclick="brickClicked(' . "'a317'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a317")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a318")); echo('<div class="brickStyle ' . $result[317] . '" id="a318" ' . 'onclick="brickClicked(' . "'a318'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a318")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a319")); echo('<div class="brickStyle ' . $result[318] . '" id="a319" ' . 'onclick="brickClicked(' . "'a319'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a319")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a320")); echo('<div class="brickStyle ' . $result[319] . '" id="a320" ' . 'onclick="brickClicked(' . "'a320'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a320")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a321")); echo('<div class="brickStyle ' . $result[320] . '" id="a321" ' . 'onclick="brickClicked(' . "'a321'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a321")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a322")); echo('<div class="brickStyle ' . $result[321] . '" id="a322" ' . 'onclick="brickClicked(' . "'a322'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a322")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a323")); echo('<div class="brickStyle ' . $result[322] . '" id="a323" ' . 'onclick="brickClicked(' . "'a323'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a323")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a324")); echo('<div class="brickStyle ' . $result[323] . '" id="a324" ' . 'onclick="brickClicked(' . "'a324'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a324")); ?>
            <!-- Row 19 -->
            <?php toCommentOrNot(1, isItANewBrick("a325")); echo('<div class="brickStyle ' . $result[324] . '" id="a325" ' . 'onclick="brickClicked(' . "'a325'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a325")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a326")); echo('<div class="brickStyle ' . $result[325] . '" id="a326" ' . 'onclick="brickClicked(' . "'a326'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a326")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a327")); echo('<div class="brickStyle ' . $result[326] . '" id="a327" ' . 'onclick="brickClicked(' . "'a327'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a327")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a328")); echo('<div class="brickStyle ' . $result[327] . '" id="a328" ' . 'onclick="brickClicked(' . "'a328'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a328")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a329")); echo('<div class="brickStyle ' . $result[328] . '" id="a329" ' . 'onclick="brickClicked(' . "'a329'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a329")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a330")); echo('<div class="brickStyle ' . $result[329] . '" id="a330" ' . 'onclick="brickClicked(' . "'a330'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a330")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a331")); echo('<div class="brickStyle ' . $result[330] . '" id="a331" ' . 'onclick="brickClicked(' . "'a331'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a331")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a332")); echo('<div class="brickStyle ' . $result[331] . '" id="a332" ' . 'onclick="brickClicked(' . "'a332'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a332")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a333")); echo('<div class="brickStyle ' . $result[332] . '" id="a333" ' . 'onclick="brickClicked(' . "'a333'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a333")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a334")); echo('<div class="brickStyle ' . $result[333] . '" id="a334" ' . 'onclick="brickClicked(' . "'a334'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a334")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a335")); echo('<div class="brickStyle ' . $result[334] . '" id="a335" ' . 'onclick="brickClicked(' . "'a335'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a335")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a336")); echo('<div class="brickStyle ' . $result[335] . '" id="a336" ' . 'onclick="brickClicked(' . "'a336'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a336")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a337")); echo('<div class="brickStyle ' . $result[336] . '" id="a337" ' . 'onclick="brickClicked(' . "'a337'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a337")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a338")); echo('<div class="brickStyle ' . $result[337] . '" id="a338" ' . 'onclick="brickClicked(' . "'a338'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a338")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a339")); echo('<div class="brickStyle ' . $result[338] . '" id="a339" ' . 'onclick="brickClicked(' . "'a339'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a339")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a340")); echo('<div class="brickStyle ' . $result[339] . '" id="a340" ' . 'onclick="brickClicked(' . "'a340'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a340")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a341")); echo('<div class="brickStyle ' . $result[340] . '" id="a341" ' . 'onclick="brickClicked(' . "'a341'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a341")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a342")); echo('<div class="brickStyle ' . $result[341] . '" id="a342" ' . 'onclick="brickClicked(' . "'a342'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a342")); ?>
            <!-- Row 20 -->
            <?php toCommentOrNot(1, isItANewBrick("a343")); echo('<div class="brickStyle ' . $result[342] . '" id="a343" ' . 'onclick="brickClicked(' . "'a343'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a343")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a344")); echo('<div class="brickStyle ' . $result[343] . '" id="a344" ' . 'onclick="brickClicked(' . "'a344'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a344")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a345")); echo('<div class="brickStyle ' . $result[344] . '" id="a345" ' . 'onclick="brickClicked(' . "'a345'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a345")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a346")); echo('<div class="brickStyle ' . $result[345] . '" id="a346" ' . 'onclick="brickClicked(' . "'a346'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a346")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a347")); echo('<div class="brickStyle ' . $result[346] . '" id="a347" ' . 'onclick="brickClicked(' . "'a347'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a347")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a348")); echo('<div class="brickStyle ' . $result[347] . '" id="a348" ' . 'onclick="brickClicked(' . "'a348'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a348")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a349")); echo('<div class="brickStyle ' . $result[348] . '" id="a349" ' . 'onclick="brickClicked(' . "'a349'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a349")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a350")); echo('<div class="brickStyle ' . $result[349] . '" id="a350" ' . 'onclick="brickClicked(' . "'a350'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a350")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a351")); echo('<div class="brickStyle ' . $result[350] . '" id="a351" ' . 'onclick="brickClicked(' . "'a351'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a351")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a352")); echo('<div class="brickStyle ' . $result[351] . '" id="a352" ' . 'onclick="brickClicked(' . "'a352'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a352")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a353")); echo('<div class="brickStyle ' . $result[352] . '" id="a353" ' . 'onclick="brickClicked(' . "'a353'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a353")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a354")); echo('<div class="brickStyle ' . $result[353] . '" id="a354" ' . 'onclick="brickClicked(' . "'a354'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a354")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a355")); echo('<div class="brickStyle ' . $result[354] . '" id="a355" ' . 'onclick="brickClicked(' . "'a355'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a355")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a356")); echo('<div class="brickStyle ' . $result[355] . '" id="a356" ' . 'onclick="brickClicked(' . "'a356'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a356")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a357")); echo('<div class="brickStyle ' . $result[356] . '" id="a357" ' . 'onclick="brickClicked(' . "'a357'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a357")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a358")); echo('<div class="brickStyle ' . $result[357] . '" id="a358" ' . 'onclick="brickClicked(' . "'a358'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a358")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a359")); echo('<div class="brickStyle ' . $result[358] . '" id="a359" ' . 'onclick="brickClicked(' . "'a359'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a359")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a360")); echo('<div class="brickStyle ' . $result[359] . '" id="a360" ' . 'onclick="brickClicked(' . "'a360'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a360")); ?>
            <!-- Row 21 -->
            <?php toCommentOrNot(1, isItANewBrick("a361")); echo('<div class="brickStyle ' . $result[360] . '" id="a361" ' . 'onclick="brickClicked(' . "'a361'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a361")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a362")); echo('<div class="brickStyle ' . $result[361] . '" id="a362" ' . 'onclick="brickClicked(' . "'a362'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a362")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a363")); echo('<div class="brickStyle ' . $result[362] . '" id="a363" ' . 'onclick="brickClicked(' . "'a363'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a363")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a364")); echo('<div class="brickStyle ' . $result[363] . '" id="a364" ' . 'onclick="brickClicked(' . "'a364'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a364")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a365")); echo('<div class="brickStyle ' . $result[364] . '" id="a365" ' . 'onclick="brickClicked(' . "'a365'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a365")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a366")); echo('<div class="brickStyle ' . $result[365] . '" id="a366" ' . 'onclick="brickClicked(' . "'a366'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a366")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a367")); echo('<div class="brickStyle ' . $result[366] . '" id="a367" ' . 'onclick="brickClicked(' . "'a367'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a367")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a368")); echo('<div class="brickStyle ' . $result[367] . '" id="a368" ' . 'onclick="brickClicked(' . "'a368'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a368")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a369")); echo('<div class="brickStyle ' . $result[368] . '" id="a369" ' . 'onclick="brickClicked(' . "'a369'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a369")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a370")); echo('<div class="brickStyle ' . $result[369] . '" id="a370" ' . 'onclick="brickClicked(' . "'a370'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a370")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a371")); echo('<div class="brickStyle ' . $result[370] . '" id="a371" ' . 'onclick="brickClicked(' . "'a371'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a371")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a372")); echo('<div class="brickStyle ' . $result[371] . '" id="a372" ' . 'onclick="brickClicked(' . "'a372'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a372")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a373")); echo('<div class="brickStyle ' . $result[372] . '" id="a373" ' . 'onclick="brickClicked(' . "'a373'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a373")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a374")); echo('<div class="brickStyle ' . $result[373] . '" id="a374" ' . 'onclick="brickClicked(' . "'a374'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a374")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a375")); echo('<div class="brickStyle ' . $result[374] . '" id="a375" ' . 'onclick="brickClicked(' . "'a375'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a375")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a376")); echo('<div class="brickStyle ' . $result[375] . '" id="a376" ' . 'onclick="brickClicked(' . "'a376'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a376")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a377")); echo('<div class="brickStyle ' . $result[376] . '" id="a377" ' . 'onclick="brickClicked(' . "'a377'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a377")); ?>
            <?php toCommentOrNot(1, isItANewBrick("a378")); echo('<div class="brickStyle ' . $result[377] . '" id="a378" ' . 'onclick="brickClicked(' . "'a378'" . ')"></div>'); toCommentOrNot(2, isItANewBrick("a378")); ?>
          </div>
        </div>
      </div>
    </div>
    <input type="checkbox" id="modifyMode" class="doodad" > <!-- Toggle switch -->
    <label for="colorToggle">Enable Layout Modification</label>
    <!-- <button type="button" class="btn" id="styleModifier" onclick="modifierOfBricks()">Edit Brick Layout</button> -->
  </div> 
  <div class="popup" id="myPopup">
    <form action="/veterans-website-project/html-admin/updateDB.php" class="form-container" id="inputForm">
      <h1>Brick Editor</h1>
  
      <label for="firstInputBox"><b>First Name</b></label>
      <input type="text" id="firstInputBox" placeholder="Enter Veteran First Name" name="firstName" required>
      <label for="lastInputBox"><b>Last Name</b></label>
      <input type="text" id="lastInputBox" placeholder="Enter Veteran Last Name" name="lastName" required>
      <label for="brickDescription"> Brick Description (all text on the brick, including first and last name):</label>
      <textarea id="brickDescription" name="brickDescription" placeholder="Enter brick description here including first and last name... NOTE: Line breaks should be entered as they appear on the brick." rows="4" cols="35"></textarea>
      <input type="hidden" id="groupName" name="groupName" />
      <input type="hidden" id="brickID" name="brickID" />
      <button type="button" class="btn" onclick="updateBrick()">Save</button>
      <button type="button" class="btn cancel" onclick="closeEditPopup()">Cancel</button>
    </form>
  </div>
  <div class="popup" id="myCoolerPopup">
    <span class="popuptext"></span>
  </div>
</body>
</html>

<!-- try to change the color using css:hover -->