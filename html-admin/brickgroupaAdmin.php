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

    try{
      $servernameagain = "localhost";
      $dbnameagain = "manchester_veterans_memorial_database";
      $unameagain = "phpmyadmin";
      $pswordagain = "Y4VnqfDCz2vvMkv";
      $prep = new PDO("mysql:host=$servernameagain;port=3306;dbname=$dbnameagain", $unameagain, $pswordagain);
      $prep->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $prep->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety
      $test = null;
      //sql statement is known good
      $test = $prep->prepare("select main.id, 
      main.gridTemplateAreasId, 
      main.brickID,
      temp2.firstName,
      temp2.lastName,
      temp2.brickDescription,
      temp2.width,
      temp2.height 
      from a_brick_group main 
      left join a_brick_group temp 
      on temp.gridTemplateAreasId = main.gridTemplateAreasId 
      and temp.id < main.id 
      left join allNames temp2
      on temp2.brickID = main.brickID
      where temp.id is null;");
      $test->execute();
      $answer = $test->setFetchMode(PDO::FETCH_ASSOC);
      $answer = $test->fetchAll();
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    function isItANewBrick($brickID){ 
      global $answer;
        // echo json_encode($answer);
        // $answer = json_encode($answer);

        // echo($answer[3]['brickID']);

        for($i = 0; $i < 378; $i++){
          $value = $answer[$i]['brickID'];
          if($value == $brickID){
            return true;
          }
        }
        return false;
        //andrew was here
    }
    function toCommentOrNot($brickStatus){
      if ($brickStatus == 0){
        return "<style=display: none;></style";
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
    /* background-color: orange; */
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
        /* background-color: orange; */
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
<?php echo('<div class="brickStyle ' . $result[0] . ' id="a001" ' . 'onclick="brickClicked(' . "'a001')".'"' . toCommentOrNot(isItANewBrick("a001")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[1] . ' id="a002" ' . 'onclick="brickClicked(' . "'a002')".'"' . toCommentOrNot(isItANewBrick("a002")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[2] . ' id="a003" ' . 'onclick="brickClicked(' . "'a003')".'"' . toCommentOrNot(isItANewBrick("a003")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[3] . ' id="a004" ' . 'onclick="brickClicked(' . "'a004')".'"' . toCommentOrNot(isItANewBrick("a004")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[4] . ' id="a005" ' . 'onclick="brickClicked(' . "'a005')".'"' . toCommentOrNot(isItANewBrick("a005")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[5] . ' id="a006" ' . 'onclick="brickClicked(' . "'a006')".'"' . toCommentOrNot(isItANewBrick("a006")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[6] . ' id="a007" ' . 'onclick="brickClicked(' . "'a007')".'"' . toCommentOrNot(isItANewBrick("a007")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[7] . ' id="a008" ' . 'onclick="brickClicked(' . "'a008')".'"' . toCommentOrNot(isItANewBrick("a008")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[8] . ' id="a009" ' . 'onclick="brickClicked(' . "'a009')".'"' . toCommentOrNot(isItANewBrick("a009")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[9] . ' id="a010" ' . 'onclick="brickClicked(' . "'a010')".'"' . toCommentOrNot(isItANewBrick("a010")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[10] . ' id="a011" ' . 'onclick="brickClicked(' . "'a011')".'"' . toCommentOrNot(isItANewBrick("a011")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[11] . ' id="a012" ' . 'onclick="brickClicked(' . "'a012')".'"' . toCommentOrNot(isItANewBrick("a012")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[12] . ' id="a013" ' . 'onclick="brickClicked(' . "'a013')".'"' . toCommentOrNot(isItANewBrick("a013")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[13] . ' id="a014" ' . 'onclick="brickClicked(' . "'a014')".'"' . toCommentOrNot(isItANewBrick("a014")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[14] . ' id="a015" ' . 'onclick="brickClicked(' . "'a015')".'"' . toCommentOrNot(isItANewBrick("a015")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[15] . ' id="a016" ' . 'onclick="brickClicked(' . "'a016')".'"' . toCommentOrNot(isItANewBrick("a016")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[16] . ' id="a017" ' . 'onclick="brickClicked(' . "'a017')".'"' . toCommentOrNot(isItANewBrick("a017")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[17] . ' id="a018" ' . 'onclick="brickClicked(' . "'a018')".'"' . toCommentOrNot(isItANewBrick("a018")) . '></div>'); ?>
<!-- Row 2 -->
<?php echo('<div class="brickStyle ' . $result[18] . ' id="a019" ' . 'onclick="brickClicked(' . "'a019')".'"' . toCommentOrNot(isItANewBrick("a019")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[19] . ' id="a020" ' . 'onclick="brickClicked(' . "'a020')".'"' . toCommentOrNot(isItANewBrick("a020")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[20] . ' id="a021" ' . 'onclick="brickClicked(' . "'a021')".'"' . toCommentOrNot(isItANewBrick("a021")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[21] . ' id="a022" ' . 'onclick="brickClicked(' . "'a022')".'"' . toCommentOrNot(isItANewBrick("a022")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[22] . ' id="a023" ' . 'onclick="brickClicked(' . "'a023')".'"' . toCommentOrNot(isItANewBrick("a023")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[23] . ' id="a024" ' . 'onclick="brickClicked(' . "'a024')".'"' . toCommentOrNot(isItANewBrick("a024")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[24] . ' id="a025" ' . 'onclick="brickClicked(' . "'a025')".'"' . toCommentOrNot(isItANewBrick("a025")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[25] . ' id="a026" ' . 'onclick="brickClicked(' . "'a026')".'"' . toCommentOrNot(isItANewBrick("a026")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[26] . ' id="a027" ' . 'onclick="brickClicked(' . "'a027')".'"' . toCommentOrNot(isItANewBrick("a027")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[27] . ' id="a028" ' . 'onclick="brickClicked(' . "'a028')".'"' . toCommentOrNot(isItANewBrick("a028")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[28] . ' id="a029" ' . 'onclick="brickClicked(' . "'a029')".'"' . toCommentOrNot(isItANewBrick("a029")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[29] . ' id="a030" ' . 'onclick="brickClicked(' . "'a030')".'"' . toCommentOrNot(isItANewBrick("a030")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[30] . ' id="a031" ' . 'onclick="brickClicked(' . "'a031')".'"' . toCommentOrNot(isItANewBrick("a031")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[31] . ' id="a032" ' . 'onclick="brickClicked(' . "'a032')".'"' . toCommentOrNot(isItANewBrick("a032")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[32] . ' id="a033" ' . 'onclick="brickClicked(' . "'a033')".'"' . toCommentOrNot(isItANewBrick("a033")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[33] . ' id="a034" ' . 'onclick="brickClicked(' . "'a034')".'"' . toCommentOrNot(isItANewBrick("a034")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[34] . ' id="a035" ' . 'onclick="brickClicked(' . "'a035')".'"' . toCommentOrNot(isItANewBrick("a035")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[35] . ' id="a036" ' . 'onclick="brickClicked(' . "'a036')".'"' . toCommentOrNot(isItANewBrick("a036")) . '></div>'); ?>
<!-- Row 3 -->
<?php echo('<div class="brickStyle ' . $result[36] . ' id="a037" ' . 'onclick="brickClicked(' . "'a037')".'"' . toCommentOrNot(isItANewBrick("a037")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[37] . ' id="a038" ' . 'onclick="brickClicked(' . "'a038')".'"' . toCommentOrNot(isItANewBrick("a038")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[38] . ' id="a039" ' . 'onclick="brickClicked(' . "'a039')".'"' . toCommentOrNot(isItANewBrick("a039")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[39] . ' id="a040" ' . 'onclick="brickClicked(' . "'a040')".'"' . toCommentOrNot(isItANewBrick("a040")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[40] . ' id="a041" ' . 'onclick="brickClicked(' . "'a041')".'"' . toCommentOrNot(isItANewBrick("a041")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[41] . ' id="a042" ' . 'onclick="brickClicked(' . "'a042')".'"' . toCommentOrNot(isItANewBrick("a042")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[42] . ' id="a043" ' . 'onclick="brickClicked(' . "'a043')".'"' . toCommentOrNot(isItANewBrick("a043")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[43] . ' id="a044" ' . 'onclick="brickClicked(' . "'a044')".'"' . toCommentOrNot(isItANewBrick("a044")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[44] . ' id="a045" ' . 'onclick="brickClicked(' . "'a045')".'"' . toCommentOrNot(isItANewBrick("a045")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[45] . ' id="a046" ' . 'onclick="brickClicked(' . "'a046')".'"' . toCommentOrNot(isItANewBrick("a046")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[46] . ' id="a047" ' . 'onclick="brickClicked(' . "'a047')".'"' . toCommentOrNot(isItANewBrick("a047")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[47] . ' id="a048" ' . 'onclick="brickClicked(' . "'a048')".'"' . toCommentOrNot(isItANewBrick("a048")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[48] . ' id="a049" ' . 'onclick="brickClicked(' . "'a049')".'"' . toCommentOrNot(isItANewBrick("a049")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[49] . ' id="a050" ' . 'onclick="brickClicked(' . "'a050')".'"' . toCommentOrNot(isItANewBrick("a050")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[50] . ' id="a051" ' . 'onclick="brickClicked(' . "'a051')".'"' . toCommentOrNot(isItANewBrick("a051")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[51] . ' id="a052" ' . 'onclick="brickClicked(' . "'a052')".'"' . toCommentOrNot(isItANewBrick("a052")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[52] . ' id="a053" ' . 'onclick="brickClicked(' . "'a053')".'"' . toCommentOrNot(isItANewBrick("a053")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[53] . ' id="a054" ' . 'onclick="brickClicked(' . "'a054')".'"' . toCommentOrNot(isItANewBrick("a054")) . '></div>'); ?>
<!-- Row 4 -->
<?php echo('<div class="brickStyle ' . $result[54] . ' id="a055" ' . 'onclick="brickClicked(' . "'a055')".'"' . toCommentOrNot(isItANewBrick("a055")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[55] . ' id="a056" ' . 'onclick="brickClicked(' . "'a056')".'"' . toCommentOrNot(isItANewBrick("a056")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[56] . ' id="a057" ' . 'onclick="brickClicked(' . "'a057')".'"' . toCommentOrNot(isItANewBrick("a057")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[57] . ' id="a058" ' . 'onclick="brickClicked(' . "'a058')".'"' . toCommentOrNot(isItANewBrick("a058")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[58] . ' id="a059" ' . 'onclick="brickClicked(' . "'a059')".'"' . toCommentOrNot(isItANewBrick("a059")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[59] . ' id="a060" ' . 'onclick="brickClicked(' . "'a060')".'"' . toCommentOrNot(isItANewBrick("a060")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[60] . ' id="a061" ' . 'onclick="brickClicked(' . "'a061')".'"' . toCommentOrNot(isItANewBrick("a061")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[61] . ' id="a062" ' . 'onclick="brickClicked(' . "'a062')".'"' . toCommentOrNot(isItANewBrick("a062")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[62] . ' id="a063" ' . 'onclick="brickClicked(' . "'a063')".'"' . toCommentOrNot(isItANewBrick("a063")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[63] . ' id="a064" ' . 'onclick="brickClicked(' . "'a064')".'"' . toCommentOrNot(isItANewBrick("a064")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[64] . ' id="a065" ' . 'onclick="brickClicked(' . "'a065')".'"' . toCommentOrNot(isItANewBrick("a065")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[65] . ' id="a066" ' . 'onclick="brickClicked(' . "'a066')".'"' . toCommentOrNot(isItANewBrick("a066")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[66] . ' id="a067" ' . 'onclick="brickClicked(' . "'a067')".'"' . toCommentOrNot(isItANewBrick("a067")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[67] . ' id="a068" ' . 'onclick="brickClicked(' . "'a068')".'"' . toCommentOrNot(isItANewBrick("a068")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[68] . ' id="a069" ' . 'onclick="brickClicked(' . "'a069')".'"' . toCommentOrNot(isItANewBrick("a069")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[69] . ' id="a070" ' . 'onclick="brickClicked(' . "'a070')".'"' . toCommentOrNot(isItANewBrick("a070")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[70] . ' id="a071" ' . 'onclick="brickClicked(' . "'a071')".'"' . toCommentOrNot(isItANewBrick("a071")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[71] . ' id="a072" ' . 'onclick="brickClicked(' . "'a072')".'"' . toCommentOrNot(isItANewBrick("a072")) . '></div>'); ?>
<!-- Row 5 -->
<?php echo('<div class="brickStyle ' . $result[72] . ' id="a073" ' . 'onclick="brickClicked(' . "'a073')".'"' . toCommentOrNot(isItANewBrick("a073")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[73] . ' id="a074" ' . 'onclick="brickClicked(' . "'a074')".'"' . toCommentOrNot(isItANewBrick("a074")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[74] . ' id="a075" ' . 'onclick="brickClicked(' . "'a075')".'"' . toCommentOrNot(isItANewBrick("a075")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[75] . ' id="a076" ' . 'onclick="brickClicked(' . "'a076')".'"' . toCommentOrNot(isItANewBrick("a076")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[76] . ' id="a077" ' . 'onclick="brickClicked(' . "'a077')".'"' . toCommentOrNot(isItANewBrick("a077")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[77] . ' id="a078" ' . 'onclick="brickClicked(' . "'a078')".'"' . toCommentOrNot(isItANewBrick("a078")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[78] . ' id="a079" ' . 'onclick="brickClicked(' . "'a079')".'"' . toCommentOrNot(isItANewBrick("a079")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[79] . ' id="a080" ' . 'onclick="brickClicked(' . "'a080')".'"' . toCommentOrNot(isItANewBrick("a080")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[80] . ' id="a081" ' . 'onclick="brickClicked(' . "'a081')".'"' . toCommentOrNot(isItANewBrick("a081")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[81] . ' id="a082" ' . 'onclick="brickClicked(' . "'a082')".'"' . toCommentOrNot(isItANewBrick("a082")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[82] . ' id="a083" ' . 'onclick="brickClicked(' . "'a083')".'"' . toCommentOrNot(isItANewBrick("a083")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[83] . ' id="a084" ' . 'onclick="brickClicked(' . "'a084')".'"' . toCommentOrNot(isItANewBrick("a084")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[84] . ' id="a085" ' . 'onclick="brickClicked(' . "'a085')".'"' . toCommentOrNot(isItANewBrick("a085")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[85] . ' id="a086" ' . 'onclick="brickClicked(' . "'a086')".'"' . toCommentOrNot(isItANewBrick("a086")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[86] . ' id="a087" ' . 'onclick="brickClicked(' . "'a087')".'"' . toCommentOrNot(isItANewBrick("a087")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[87] . ' id="a088" ' . 'onclick="brickClicked(' . "'a088')".'"' . toCommentOrNot(isItANewBrick("a088")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[88] . ' id="a089" ' . 'onclick="brickClicked(' . "'a089')".'"' . toCommentOrNot(isItANewBrick("a089")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[89] . ' id="a090" ' . 'onclick="brickClicked(' . "'a090')".'"' . toCommentOrNot(isItANewBrick("a090")) . '></div>'); ?>
<!-- Row 6 -->
<?php echo('<div class="brickStyle ' . $result[90] . ' id="a091" ' . 'onclick="brickClicked(' . "'a091')".'"' . toCommentOrNot(isItANewBrick("a091")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[91] . ' id="a092" ' . 'onclick="brickClicked(' . "'a092')".'"' . toCommentOrNot(isItANewBrick("a092")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[92] . ' id="a093" ' . 'onclick="brickClicked(' . "'a093')".'"' . toCommentOrNot(isItANewBrick("a093")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[93] . ' id="a094" ' . 'onclick="brickClicked(' . "'a094')".'"' . toCommentOrNot(isItANewBrick("a094")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[94] . ' id="a095" ' . 'onclick="brickClicked(' . "'a095')".'"' . toCommentOrNot(isItANewBrick("a095")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[95] . ' id="a096" ' . 'onclick="brickClicked(' . "'a096')".'"' . toCommentOrNot(isItANewBrick("a096")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[96] . ' id="a097" ' . 'onclick="brickClicked(' . "'a097')".'"' . toCommentOrNot(isItANewBrick("a097")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[97] . ' id="a098" ' . 'onclick="brickClicked(' . "'a098')".'"' . toCommentOrNot(isItANewBrick("a098")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[98] . ' id="a099" ' . 'onclick="brickClicked(' . "'a099')".'"' . toCommentOrNot(isItANewBrick("a099")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[99] . ' id="a100" ' . 'onclick="brickClicked(' . "'a100')".'"' . toCommentOrNot(isItANewBrick("a100")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[100] . ' id="a101" ' . 'onclick="brickClicked(' . "'a101')".'"' . toCommentOrNot(isItANewBrick("a101")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[101] . ' id="a102" ' . 'onclick="brickClicked(' . "'a102')".'"' . toCommentOrNot(isItANewBrick("a102")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[102] . ' id="a103" ' . 'onclick="brickClicked(' . "'a103')".'"' . toCommentOrNot(isItANewBrick("a103")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[103] . ' id="a104" ' . 'onclick="brickClicked(' . "'a104')".'"' . toCommentOrNot(isItANewBrick("a104")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[104] . ' id="a105" ' . 'onclick="brickClicked(' . "'a105')".'"' . toCommentOrNot(isItANewBrick("a105")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[105] . ' id="a106" ' . 'onclick="brickClicked(' . "'a106')".'"' . toCommentOrNot(isItANewBrick("a106")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[106] . ' id="a107" ' . 'onclick="brickClicked(' . "'a107')".'"' . toCommentOrNot(isItANewBrick("a107")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[107] . ' id="a108" ' . 'onclick="brickClicked(' . "'a108')".'"' . toCommentOrNot(isItANewBrick("a108")) . '></div>'); ?>
<!-- Row 7 -->
<?php echo('<div class="brickStyle ' . $result[108] . ' id="a109" ' . 'onclick="brickClicked(' . "'a109')".'"' . toCommentOrNot(isItANewBrick("a109")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[109] . ' id="a110" ' . 'onclick="brickClicked(' . "'a110')".'"' . toCommentOrNot(isItANewBrick("a110")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[110] . ' id="a111" ' . 'onclick="brickClicked(' . "'a111')".'"' . toCommentOrNot(isItANewBrick("a111")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[111] . ' id="a112" ' . 'onclick="brickClicked(' . "'a112')".'"' . toCommentOrNot(isItANewBrick("a112")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[112] . ' id="a113" ' . 'onclick="brickClicked(' . "'a113')".'"' . toCommentOrNot(isItANewBrick("a113")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[113] . ' id="a114" ' . 'onclick="brickClicked(' . "'a114')".'"' . toCommentOrNot(isItANewBrick("a114")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[114] . ' id="a115" ' . 'onclick="brickClicked(' . "'a115')".'"' . toCommentOrNot(isItANewBrick("a115")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[115] . ' id="a116" ' . 'onclick="brickClicked(' . "'a116')".'"' . toCommentOrNot(isItANewBrick("a116")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[116] . ' id="a117" ' . 'onclick="brickClicked(' . "'a117')".'"' . toCommentOrNot(isItANewBrick("a117")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[117] . ' id="a118" ' . 'onclick="brickClicked(' . "'a118')".'"' . toCommentOrNot(isItANewBrick("a118")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[118] . ' id="a119" ' . 'onclick="brickClicked(' . "'a119')".'"' . toCommentOrNot(isItANewBrick("a119")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[119] . ' id="a120" ' . 'onclick="brickClicked(' . "'a120')".'"' . toCommentOrNot(isItANewBrick("a120")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[120] . ' id="a121" ' . 'onclick="brickClicked(' . "'a121')".'"' . toCommentOrNot(isItANewBrick("a121")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[121] . ' id="a122" ' . 'onclick="brickClicked(' . "'a122')".'"' . toCommentOrNot(isItANewBrick("a122")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[122] . ' id="a123" ' . 'onclick="brickClicked(' . "'a123')".'"' . toCommentOrNot(isItANewBrick("a123")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[123] . ' id="a124" ' . 'onclick="brickClicked(' . "'a124')".'"' . toCommentOrNot(isItANewBrick("a124")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[124] . ' id="a125" ' . 'onclick="brickClicked(' . "'a125')".'"' . toCommentOrNot(isItANewBrick("a125")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[125] . ' id="a126" ' . 'onclick="brickClicked(' . "'a126')".'"' . toCommentOrNot(isItANewBrick("a126")) . '></div>'); ?>
<!-- Row 8 -->
<?php echo('<div class="brickStyle ' . $result[126] . ' id="a127" ' . 'onclick="brickClicked(' . "'a127')".'"' . toCommentOrNot(isItANewBrick("a127")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[127] . ' id="a128" ' . 'onclick="brickClicked(' . "'a128')".'"' . toCommentOrNot(isItANewBrick("a128")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[128] . ' id="a129" ' . 'onclick="brickClicked(' . "'a129')".'"' . toCommentOrNot(isItANewBrick("a129")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[129] . ' id="a130" ' . 'onclick="brickClicked(' . "'a130')".'"' . toCommentOrNot(isItANewBrick("a130")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[130] . ' id="a131" ' . 'onclick="brickClicked(' . "'a131')".'"' . toCommentOrNot(isItANewBrick("a131")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[131] . ' id="a132" ' . 'onclick="brickClicked(' . "'a132')".'"' . toCommentOrNot(isItANewBrick("a132")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[132] . ' id="a133" ' . 'onclick="brickClicked(' . "'a133')".'"' . toCommentOrNot(isItANewBrick("a133")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[133] . ' id="a134" ' . 'onclick="brickClicked(' . "'a134')".'"' . toCommentOrNot(isItANewBrick("a134")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[134] . ' id="a135" ' . 'onclick="brickClicked(' . "'a135')".'"' . toCommentOrNot(isItANewBrick("a135")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[135] . ' id="a136" ' . 'onclick="brickClicked(' . "'a136')".'"' . toCommentOrNot(isItANewBrick("a136")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[136] . ' id="a137" ' . 'onclick="brickClicked(' . "'a137')".'"' . toCommentOrNot(isItANewBrick("a137")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[137] . ' id="a138" ' . 'onclick="brickClicked(' . "'a138')".'"' . toCommentOrNot(isItANewBrick("a138")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[138] . ' id="a139" ' . 'onclick="brickClicked(' . "'a139')".'"' . toCommentOrNot(isItANewBrick("a139")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[139] . ' id="a140" ' . 'onclick="brickClicked(' . "'a140')".'"' . toCommentOrNot(isItANewBrick("a140")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[140] . ' id="a141" ' . 'onclick="brickClicked(' . "'a141')".'"' . toCommentOrNot(isItANewBrick("a141")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[141] . ' id="a142" ' . 'onclick="brickClicked(' . "'a142')".'"' . toCommentOrNot(isItANewBrick("a142")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[142] . ' id="a143" ' . 'onclick="brickClicked(' . "'a143')".'"' . toCommentOrNot(isItANewBrick("a143")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[143] . ' id="a144" ' . 'onclick="brickClicked(' . "'a144')".'"' . toCommentOrNot(isItANewBrick("a144")) . '></div>'); ?>
<!-- Row 9 -->
<?php echo('<div class="brickStyle ' . $result[144] . ' id="a145" ' . 'onclick="brickClicked(' . "'a145')".'"' . toCommentOrNot(isItANewBrick("a145")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[145] . ' id="a146" ' . 'onclick="brickClicked(' . "'a146')".'"' . toCommentOrNot(isItANewBrick("a146")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[146] . ' id="a147" ' . 'onclick="brickClicked(' . "'a147')".'"' . toCommentOrNot(isItANewBrick("a147")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[147] . ' id="a148" ' . 'onclick="brickClicked(' . "'a148')".'"' . toCommentOrNot(isItANewBrick("a148")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[148] . ' id="a149" ' . 'onclick="brickClicked(' . "'a149')".'"' . toCommentOrNot(isItANewBrick("a149")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[149] . ' id="a150" ' . 'onclick="brickClicked(' . "'a150')".'"' . toCommentOrNot(isItANewBrick("a150")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[150] . ' id="a151" ' . 'onclick="brickClicked(' . "'a151')".'"' . toCommentOrNot(isItANewBrick("a151")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[151] . ' id="a152" ' . 'onclick="brickClicked(' . "'a152')".'"' . toCommentOrNot(isItANewBrick("a152")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[152] . ' id="a153" ' . 'onclick="brickClicked(' . "'a153')".'"' . toCommentOrNot(isItANewBrick("a153")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[153] . ' id="a154" ' . 'onclick="brickClicked(' . "'a154')".'"' . toCommentOrNot(isItANewBrick("a154")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[154] . ' id="a155" ' . 'onclick="brickClicked(' . "'a155')".'"' . toCommentOrNot(isItANewBrick("a155")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[155] . ' id="a156" ' . 'onclick="brickClicked(' . "'a156')".'"' . toCommentOrNot(isItANewBrick("a156")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[156] . ' id="a157" ' . 'onclick="brickClicked(' . "'a157')".'"' . toCommentOrNot(isItANewBrick("a157")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[157] . ' id="a158" ' . 'onclick="brickClicked(' . "'a158')".'"' . toCommentOrNot(isItANewBrick("a158")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[158] . ' id="a159" ' . 'onclick="brickClicked(' . "'a159')".'"' . toCommentOrNot(isItANewBrick("a159")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[159] . ' id="a160" ' . 'onclick="brickClicked(' . "'a160')".'"' . toCommentOrNot(isItANewBrick("a160")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[160] . ' id="a161" ' . 'onclick="brickClicked(' . "'a161')".'"' . toCommentOrNot(isItANewBrick("a161")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[161] . ' id="a162" ' . 'onclick="brickClicked(' . "'a162')".'"' . toCommentOrNot(isItANewBrick("a162")) . '></div>'); ?>
<!-- Row 10 -->
<?php echo('<div class="brickStyle ' . $result[162] . ' id="a163" ' . 'onclick="brickClicked(' . "'a163')".'"' . toCommentOrNot(isItANewBrick("a163")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[163] . ' id="a164" ' . 'onclick="brickClicked(' . "'a164')".'"' . toCommentOrNot(isItANewBrick("a164")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[164] . ' id="a165" ' . 'onclick="brickClicked(' . "'a165')".'"' . toCommentOrNot(isItANewBrick("a165")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[165] . ' id="a166" ' . 'onclick="brickClicked(' . "'a166')".'"' . toCommentOrNot(isItANewBrick("a166")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[166] . ' id="a167" ' . 'onclick="brickClicked(' . "'a167')".'"' . toCommentOrNot(isItANewBrick("a167")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[167] . ' id="a168" ' . 'onclick="brickClicked(' . "'a168')".'"' . toCommentOrNot(isItANewBrick("a168")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[168] . ' id="a169" ' . 'onclick="brickClicked(' . "'a169')".'"' . toCommentOrNot(isItANewBrick("a169")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[169] . ' id="a170" ' . 'onclick="brickClicked(' . "'a170')".'"' . toCommentOrNot(isItANewBrick("a170")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[170] . ' id="a171" ' . 'onclick="brickClicked(' . "'a171')".'"' . toCommentOrNot(isItANewBrick("a171")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[171] . ' id="a172" ' . 'onclick="brickClicked(' . "'a172')".'"' . toCommentOrNot(isItANewBrick("a172")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[172] . ' id="a173" ' . 'onclick="brickClicked(' . "'a173')".'"' . toCommentOrNot(isItANewBrick("a173")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[173] . ' id="a174" ' . 'onclick="brickClicked(' . "'a174')".'"' . toCommentOrNot(isItANewBrick("a174")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[174] . ' id="a175" ' . 'onclick="brickClicked(' . "'a175')".'"' . toCommentOrNot(isItANewBrick("a175")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[175] . ' id="a176" ' . 'onclick="brickClicked(' . "'a176')".'"' . toCommentOrNot(isItANewBrick("a176")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[176] . ' id="a177" ' . 'onclick="brickClicked(' . "'a177')".'"' . toCommentOrNot(isItANewBrick("a177")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[177] . ' id="a178" ' . 'onclick="brickClicked(' . "'a178')".'"' . toCommentOrNot(isItANewBrick("a178")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[178] . ' id="a179" ' . 'onclick="brickClicked(' . "'a179')".'"' . toCommentOrNot(isItANewBrick("a179")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[179] . ' id="a180" ' . 'onclick="brickClicked(' . "'a180')".'"' . toCommentOrNot(isItANewBrick("a180")) . '></div>'); ?>
<!-- Row 11 -->
<?php echo('<div class="brickStyle ' . $result[180] . ' id="a181" ' . 'onclick="brickClicked(' . "'a181')".'"' . toCommentOrNot(isItANewBrick("a181")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[181] . ' id="a182" ' . 'onclick="brickClicked(' . "'a182')".'"' . toCommentOrNot(isItANewBrick("a182")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[182] . ' id="a183" ' . 'onclick="brickClicked(' . "'a183')".'"' . toCommentOrNot(isItANewBrick("a183")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[183] . ' id="a184" ' . 'onclick="brickClicked(' . "'a184')".'"' . toCommentOrNot(isItANewBrick("a184")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[184] . ' id="a185" ' . 'onclick="brickClicked(' . "'a185')".'"' . toCommentOrNot(isItANewBrick("a185")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[185] . ' id="a186" ' . 'onclick="brickClicked(' . "'a186')".'"' . toCommentOrNot(isItANewBrick("a186")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[186] . ' id="a187" ' . 'onclick="brickClicked(' . "'a187')".'"' . toCommentOrNot(isItANewBrick("a187")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[187] . ' id="a188" ' . 'onclick="brickClicked(' . "'a188')".'"' . toCommentOrNot(isItANewBrick("a188")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[188] . ' id="a189" ' . 'onclick="brickClicked(' . "'a189')".'"' . toCommentOrNot(isItANewBrick("a189")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[189] . ' id="a190" ' . 'onclick="brickClicked(' . "'a190')".'"' . toCommentOrNot(isItANewBrick("a190")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[190] . ' id="a191" ' . 'onclick="brickClicked(' . "'a191')".'"' . toCommentOrNot(isItANewBrick("a191")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[191] . ' id="a192" ' . 'onclick="brickClicked(' . "'a192')".'"' . toCommentOrNot(isItANewBrick("a192")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[192] . ' id="a193" ' . 'onclick="brickClicked(' . "'a193')".'"' . toCommentOrNot(isItANewBrick("a193")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[193] . ' id="a194" ' . 'onclick="brickClicked(' . "'a194')".'"' . toCommentOrNot(isItANewBrick("a194")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[194] . ' id="a195" ' . 'onclick="brickClicked(' . "'a195')".'"' . toCommentOrNot(isItANewBrick("a195")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[195] . ' id="a196" ' . 'onclick="brickClicked(' . "'a196')".'"' . toCommentOrNot(isItANewBrick("a196")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[196] . ' id="a197" ' . 'onclick="brickClicked(' . "'a197')".'"' . toCommentOrNot(isItANewBrick("a197")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[197] . ' id="a198" ' . 'onclick="brickClicked(' . "'a198')".'"' . toCommentOrNot(isItANewBrick("a198")) . '></div>'); ?>
<!-- Row 12 -->
<?php echo('<div class="brickStyle ' . $result[198] . ' id="a199" ' . 'onclick="brickClicked(' . "'a199')".'"' . toCommentOrNot(isItANewBrick("a199")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[199] . ' id="a200" ' . 'onclick="brickClicked(' . "'a200')".'"' . toCommentOrNot(isItANewBrick("a200")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[200] . ' id="a201" ' . 'onclick="brickClicked(' . "'a201')".'"' . toCommentOrNot(isItANewBrick("a201")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[201] . ' id="a202" ' . 'onclick="brickClicked(' . "'a202')".'"' . toCommentOrNot(isItANewBrick("a202")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[202] . ' id="a203" ' . 'onclick="brickClicked(' . "'a203')".'"' . toCommentOrNot(isItANewBrick("a203")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[203] . ' id="a204" ' . 'onclick="brickClicked(' . "'a204')".'"' . toCommentOrNot(isItANewBrick("a204")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[204] . ' id="a205" ' . 'onclick="brickClicked(' . "'a205')".'"' . toCommentOrNot(isItANewBrick("a205")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[205] . ' id="a206" ' . 'onclick="brickClicked(' . "'a206')".'"' . toCommentOrNot(isItANewBrick("a206")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[206] . ' id="a207" ' . 'onclick="brickClicked(' . "'a207')".'"' . toCommentOrNot(isItANewBrick("a207")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[207] . ' id="a208" ' . 'onclick="brickClicked(' . "'a208')".'"' . toCommentOrNot(isItANewBrick("a208")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[208] . ' id="a209" ' . 'onclick="brickClicked(' . "'a209')".'"' . toCommentOrNot(isItANewBrick("a209")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[209] . ' id="a210" ' . 'onclick="brickClicked(' . "'a210')".'"' . toCommentOrNot(isItANewBrick("a210")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[210] . ' id="a211" ' . 'onclick="brickClicked(' . "'a211')".'"' . toCommentOrNot(isItANewBrick("a211")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[211] . ' id="a212" ' . 'onclick="brickClicked(' . "'a212')".'"' . toCommentOrNot(isItANewBrick("a212")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[212] . ' id="a213" ' . 'onclick="brickClicked(' . "'a213')".'"' . toCommentOrNot(isItANewBrick("a213")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[213] . ' id="a214" ' . 'onclick="brickClicked(' . "'a214')".'"' . toCommentOrNot(isItANewBrick("a214")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[214] . ' id="a215" ' . 'onclick="brickClicked(' . "'a215')".'"' . toCommentOrNot(isItANewBrick("a215")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[215] . ' id="a216" ' . 'onclick="brickClicked(' . "'a216')".'"' . toCommentOrNot(isItANewBrick("a216")) . '></div>'); ?>
<!-- Row 13 -->
<?php echo('<div class="brickStyle ' . $result[216] . ' id="a217" ' . 'onclick="brickClicked(' . "'a217')".'"' . toCommentOrNot(isItANewBrick("a217")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[217] . ' id="a218" ' . 'onclick="brickClicked(' . "'a218')".'"' . toCommentOrNot(isItANewBrick("a218")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[218] . ' id="a219" ' . 'onclick="brickClicked(' . "'a219')".'"' . toCommentOrNot(isItANewBrick("a219")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[219] . ' id="a220" ' . 'onclick="brickClicked(' . "'a220')".'"' . toCommentOrNot(isItANewBrick("a220")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[220] . ' id="a221" ' . 'onclick="brickClicked(' . "'a221')".'"' . toCommentOrNot(isItANewBrick("a221")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[221] . ' id="a222" ' . 'onclick="brickClicked(' . "'a222')".'"' . toCommentOrNot(isItANewBrick("a222")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[222] . ' id="a223" ' . 'onclick="brickClicked(' . "'a223')".'"' . toCommentOrNot(isItANewBrick("a223")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[223] . ' id="a224" ' . 'onclick="brickClicked(' . "'a224')".'"' . toCommentOrNot(isItANewBrick("a224")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[224] . ' id="a225" ' . 'onclick="brickClicked(' . "'a225')".'"' . toCommentOrNot(isItANewBrick("a225")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[225] . ' id="a226" ' . 'onclick="brickClicked(' . "'a226')".'"' . toCommentOrNot(isItANewBrick("a226")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[226] . ' id="a227" ' . 'onclick="brickClicked(' . "'a227')".'"' . toCommentOrNot(isItANewBrick("a227")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[227] . ' id="a228" ' . 'onclick="brickClicked(' . "'a228')".'"' . toCommentOrNot(isItANewBrick("a228")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[228] . ' id="a229" ' . 'onclick="brickClicked(' . "'a229')".'"' . toCommentOrNot(isItANewBrick("a229")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[229] . ' id="a230" ' . 'onclick="brickClicked(' . "'a230')".'"' . toCommentOrNot(isItANewBrick("a230")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[230] . ' id="a231" ' . 'onclick="brickClicked(' . "'a231')".'"' . toCommentOrNot(isItANewBrick("a231")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[231] . ' id="a232" ' . 'onclick="brickClicked(' . "'a232')".'"' . toCommentOrNot(isItANewBrick("a232")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[232] . ' id="a233" ' . 'onclick="brickClicked(' . "'a233')".'"' . toCommentOrNot(isItANewBrick("a233")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[233] . ' id="a234" ' . 'onclick="brickClicked(' . "'a234')".'"' . toCommentOrNot(isItANewBrick("a234")) . '></div>'); ?>
<!-- Row 14 -->
<?php echo('<div class="brickStyle ' . $result[234] . ' id="a235" ' . 'onclick="brickClicked(' . "'a235')".'"' . toCommentOrNot(isItANewBrick("a235")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[235] . ' id="a236" ' . 'onclick="brickClicked(' . "'a236')".'"' . toCommentOrNot(isItANewBrick("a236")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[236] . ' id="a237" ' . 'onclick="brickClicked(' . "'a237')".'"' . toCommentOrNot(isItANewBrick("a237")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[237] . ' id="a238" ' . 'onclick="brickClicked(' . "'a238')".'"' . toCommentOrNot(isItANewBrick("a238")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[238] . ' id="a239" ' . 'onclick="brickClicked(' . "'a239')".'"' . toCommentOrNot(isItANewBrick("a239")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[239] . ' id="a240" ' . 'onclick="brickClicked(' . "'a240')".'"' . toCommentOrNot(isItANewBrick("a240")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[240] . ' id="a241" ' . 'onclick="brickClicked(' . "'a241')".'"' . toCommentOrNot(isItANewBrick("a241")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[241] . ' id="a242" ' . 'onclick="brickClicked(' . "'a242')".'"' . toCommentOrNot(isItANewBrick("a242")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[242] . ' id="a243" ' . 'onclick="brickClicked(' . "'a243')".'"' . toCommentOrNot(isItANewBrick("a243")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[243] . ' id="a244" ' . 'onclick="brickClicked(' . "'a244')".'"' . toCommentOrNot(isItANewBrick("a244")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[244] . ' id="a245" ' . 'onclick="brickClicked(' . "'a245')".'"' . toCommentOrNot(isItANewBrick("a245")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[245] . ' id="a246" ' . 'onclick="brickClicked(' . "'a246')".'"' . toCommentOrNot(isItANewBrick("a246")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[246] . ' id="a247" ' . 'onclick="brickClicked(' . "'a247')".'"' . toCommentOrNot(isItANewBrick("a247")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[247] . ' id="a248" ' . 'onclick="brickClicked(' . "'a248')".'"' . toCommentOrNot(isItANewBrick("a248")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[248] . ' id="a249" ' . 'onclick="brickClicked(' . "'a249')".'"' . toCommentOrNot(isItANewBrick("a249")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[249] . ' id="a250" ' . 'onclick="brickClicked(' . "'a250')".'"' . toCommentOrNot(isItANewBrick("a250")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[250] . ' id="a251" ' . 'onclick="brickClicked(' . "'a251')".'"' . toCommentOrNot(isItANewBrick("a251")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[251] . ' id="a252" ' . 'onclick="brickClicked(' . "'a252')".'"' . toCommentOrNot(isItANewBrick("a252")) . '></div>'); ?>
<!-- Row 15 -->
<?php echo('<div class="brickStyle ' . $result[252] . ' id="a253" ' . 'onclick="brickClicked(' . "'a253')".'"' . toCommentOrNot(isItANewBrick("a253")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[253] . ' id="a254" ' . 'onclick="brickClicked(' . "'a254')".'"' . toCommentOrNot(isItANewBrick("a254")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[254] . ' id="a255" ' . 'onclick="brickClicked(' . "'a255')".'"' . toCommentOrNot(isItANewBrick("a255")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[255] . ' id="a256" ' . 'onclick="brickClicked(' . "'a256')".'"' . toCommentOrNot(isItANewBrick("a256")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[256] . ' id="a257" ' . 'onclick="brickClicked(' . "'a257')".'"' . toCommentOrNot(isItANewBrick("a257")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[257] . ' id="a258" ' . 'onclick="brickClicked(' . "'a258')".'"' . toCommentOrNot(isItANewBrick("a258")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[258] . ' id="a259" ' . 'onclick="brickClicked(' . "'a259')".'"' . toCommentOrNot(isItANewBrick("a259")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[259] . ' id="a260" ' . 'onclick="brickClicked(' . "'a260')".'"' . toCommentOrNot(isItANewBrick("a260")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[260] . ' id="a261" ' . 'onclick="brickClicked(' . "'a261')".'"' . toCommentOrNot(isItANewBrick("a261")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[261] . ' id="a262" ' . 'onclick="brickClicked(' . "'a262')".'"' . toCommentOrNot(isItANewBrick("a262")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[262] . ' id="a263" ' . 'onclick="brickClicked(' . "'a263')".'"' . toCommentOrNot(isItANewBrick("a263")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[263] . ' id="a264" ' . 'onclick="brickClicked(' . "'a264')".'"' . toCommentOrNot(isItANewBrick("a264")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[264] . ' id="a265" ' . 'onclick="brickClicked(' . "'a265')".'"' . toCommentOrNot(isItANewBrick("a265")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[265] . ' id="a266" ' . 'onclick="brickClicked(' . "'a266')".'"' . toCommentOrNot(isItANewBrick("a266")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[266] . ' id="a267" ' . 'onclick="brickClicked(' . "'a267')".'"' . toCommentOrNot(isItANewBrick("a267")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[267] . ' id="a268" ' . 'onclick="brickClicked(' . "'a268')".'"' . toCommentOrNot(isItANewBrick("a268")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[268] . ' id="a269" ' . 'onclick="brickClicked(' . "'a269')".'"' . toCommentOrNot(isItANewBrick("a269")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[269] . ' id="a270" ' . 'onclick="brickClicked(' . "'a270')".'"' . toCommentOrNot(isItANewBrick("a270")) . '></div>'); ?>
<!-- Row 16 -->
<?php echo('<div class="brickStyle ' . $result[270] . ' id="a271" ' . 'onclick="brickClicked(' . "'a271')".'"' . toCommentOrNot(isItANewBrick("a271")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[271] . ' id="a272" ' . 'onclick="brickClicked(' . "'a272')".'"' . toCommentOrNot(isItANewBrick("a272")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[272] . ' id="a273" ' . 'onclick="brickClicked(' . "'a273')".'"' . toCommentOrNot(isItANewBrick("a273")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[273] . ' id="a274" ' . 'onclick="brickClicked(' . "'a274')".'"' . toCommentOrNot(isItANewBrick("a274")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[274] . ' id="a275" ' . 'onclick="brickClicked(' . "'a275')".'"' . toCommentOrNot(isItANewBrick("a275")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[275] . ' id="a276" ' . 'onclick="brickClicked(' . "'a276')".'"' . toCommentOrNot(isItANewBrick("a276")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[276] . ' id="a277" ' . 'onclick="brickClicked(' . "'a277')".'"' . toCommentOrNot(isItANewBrick("a277")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[277] . ' id="a278" ' . 'onclick="brickClicked(' . "'a278')".'"' . toCommentOrNot(isItANewBrick("a278")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[278] . ' id="a279" ' . 'onclick="brickClicked(' . "'a279')".'"' . toCommentOrNot(isItANewBrick("a279")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[279] . ' id="a280" ' . 'onclick="brickClicked(' . "'a280')".'"' . toCommentOrNot(isItANewBrick("a280")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[280] . ' id="a281" ' . 'onclick="brickClicked(' . "'a281')".'"' . toCommentOrNot(isItANewBrick("a281")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[281] . ' id="a282" ' . 'onclick="brickClicked(' . "'a282')".'"' . toCommentOrNot(isItANewBrick("a282")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[282] . ' id="a283" ' . 'onclick="brickClicked(' . "'a283')".'"' . toCommentOrNot(isItANewBrick("a283")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[283] . ' id="a284" ' . 'onclick="brickClicked(' . "'a284')".'"' . toCommentOrNot(isItANewBrick("a284")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[284] . ' id="a285" ' . 'onclick="brickClicked(' . "'a285')".'"' . toCommentOrNot(isItANewBrick("a285")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[285] . ' id="a286" ' . 'onclick="brickClicked(' . "'a286')".'"' . toCommentOrNot(isItANewBrick("a286")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[286] . ' id="a287" ' . 'onclick="brickClicked(' . "'a287')".'"' . toCommentOrNot(isItANewBrick("a287")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[287] . ' id="a288" ' . 'onclick="brickClicked(' . "'a288')".'"' . toCommentOrNot(isItANewBrick("a288")) . '></div>'); ?>
<!-- Row 17 -->
<?php echo('<div class="brickStyle ' . $result[288] . ' id="a289" ' . 'onclick="brickClicked(' . "'a289')".'"' . toCommentOrNot(isItANewBrick("a289")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[289] . ' id="a290" ' . 'onclick="brickClicked(' . "'a290')".'"' . toCommentOrNot(isItANewBrick("a290")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[290] . ' id="a291" ' . 'onclick="brickClicked(' . "'a291')".'"' . toCommentOrNot(isItANewBrick("a291")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[291] . ' id="a292" ' . 'onclick="brickClicked(' . "'a292')".'"' . toCommentOrNot(isItANewBrick("a292")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[292] . ' id="a293" ' . 'onclick="brickClicked(' . "'a293')".'"' . toCommentOrNot(isItANewBrick("a293")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[293] . ' id="a294" ' . 'onclick="brickClicked(' . "'a294')".'"' . toCommentOrNot(isItANewBrick("a294")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[294] . ' id="a295" ' . 'onclick="brickClicked(' . "'a295')".'"' . toCommentOrNot(isItANewBrick("a295")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[295] . ' id="a296" ' . 'onclick="brickClicked(' . "'a296')".'"' . toCommentOrNot(isItANewBrick("a296")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[296] . ' id="a297" ' . 'onclick="brickClicked(' . "'a297')".'"' . toCommentOrNot(isItANewBrick("a297")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[297] . ' id="a298" ' . 'onclick="brickClicked(' . "'a298')".'"' . toCommentOrNot(isItANewBrick("a298")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[298] . ' id="a299" ' . 'onclick="brickClicked(' . "'a299')".'"' . toCommentOrNot(isItANewBrick("a299")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[299] . ' id="a300" ' . 'onclick="brickClicked(' . "'a300')".'"' . toCommentOrNot(isItANewBrick("a300")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[300] . ' id="a301" ' . 'onclick="brickClicked(' . "'a301')".'"' . toCommentOrNot(isItANewBrick("a301")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[301] . ' id="a302" ' . 'onclick="brickClicked(' . "'a302')".'"' . toCommentOrNot(isItANewBrick("a302")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[302] . ' id="a303" ' . 'onclick="brickClicked(' . "'a303')".'"' . toCommentOrNot(isItANewBrick("a303")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[303] . ' id="a304" ' . 'onclick="brickClicked(' . "'a304')".'"' . toCommentOrNot(isItANewBrick("a304")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[304] . ' id="a305" ' . 'onclick="brickClicked(' . "'a305')".'"' . toCommentOrNot(isItANewBrick("a305")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[305] . ' id="a306" ' . 'onclick="brickClicked(' . "'a306')".'"' . toCommentOrNot(isItANewBrick("a306")) . '></div>'); ?>
<!-- Row 18 -->
<?php echo('<div class="brickStyle ' . $result[306] . ' id="a307" ' . 'onclick="brickClicked(' . "'a307')".'"' . toCommentOrNot(isItANewBrick("a307")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[307] . ' id="a308" ' . 'onclick="brickClicked(' . "'a308')".'"' . toCommentOrNot(isItANewBrick("a308")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[308] . ' id="a309" ' . 'onclick="brickClicked(' . "'a309')".'"' . toCommentOrNot(isItANewBrick("a309")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[309] . ' id="a310" ' . 'onclick="brickClicked(' . "'a310')".'"' . toCommentOrNot(isItANewBrick("a310")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[310] . ' id="a311" ' . 'onclick="brickClicked(' . "'a311')".'"' . toCommentOrNot(isItANewBrick("a311")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[311] . ' id="a312" ' . 'onclick="brickClicked(' . "'a312')".'"' . toCommentOrNot(isItANewBrick("a312")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[312] . ' id="a313" ' . 'onclick="brickClicked(' . "'a313')".'"' . toCommentOrNot(isItANewBrick("a313")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[313] . ' id="a314" ' . 'onclick="brickClicked(' . "'a314')".'"' . toCommentOrNot(isItANewBrick("a314")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[314] . ' id="a315" ' . 'onclick="brickClicked(' . "'a315')".'"' . toCommentOrNot(isItANewBrick("a315")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[315] . ' id="a316" ' . 'onclick="brickClicked(' . "'a316')".'"' . toCommentOrNot(isItANewBrick("a316")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[316] . ' id="a317" ' . 'onclick="brickClicked(' . "'a317')".'"' . toCommentOrNot(isItANewBrick("a317")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[317] . ' id="a318" ' . 'onclick="brickClicked(' . "'a318')".'"' . toCommentOrNot(isItANewBrick("a318")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[318] . ' id="a319" ' . 'onclick="brickClicked(' . "'a319')".'"' . toCommentOrNot(isItANewBrick("a319")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[319] . ' id="a320" ' . 'onclick="brickClicked(' . "'a320')".'"' . toCommentOrNot(isItANewBrick("a320")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[320] . ' id="a321" ' . 'onclick="brickClicked(' . "'a321')".'"' . toCommentOrNot(isItANewBrick("a321")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[321] . ' id="a322" ' . 'onclick="brickClicked(' . "'a322')".'"' . toCommentOrNot(isItANewBrick("a322")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[322] . ' id="a323" ' . 'onclick="brickClicked(' . "'a323')".'"' . toCommentOrNot(isItANewBrick("a323")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[323] . ' id="a324" ' . 'onclick="brickClicked(' . "'a324')".'"' . toCommentOrNot(isItANewBrick("a324")) . '></div>'); ?>
<!-- Row 19 -->
<?php echo('<div class="brickStyle ' . $result[324] . ' id="a325" ' . 'onclick="brickClicked(' . "'a325')".'"' . toCommentOrNot(isItANewBrick("a325")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[325] . ' id="a326" ' . 'onclick="brickClicked(' . "'a326')".'"' . toCommentOrNot(isItANewBrick("a326")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[326] . ' id="a327" ' . 'onclick="brickClicked(' . "'a327')".'"' . toCommentOrNot(isItANewBrick("a327")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[327] . ' id="a328" ' . 'onclick="brickClicked(' . "'a328')".'"' . toCommentOrNot(isItANewBrick("a328")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[328] . ' id="a329" ' . 'onclick="brickClicked(' . "'a329')".'"' . toCommentOrNot(isItANewBrick("a329")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[329] . ' id="a330" ' . 'onclick="brickClicked(' . "'a330')".'"' . toCommentOrNot(isItANewBrick("a330")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[330] . ' id="a331" ' . 'onclick="brickClicked(' . "'a331')".'"' . toCommentOrNot(isItANewBrick("a331")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[331] . ' id="a332" ' . 'onclick="brickClicked(' . "'a332')".'"' . toCommentOrNot(isItANewBrick("a332")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[332] . ' id="a333" ' . 'onclick="brickClicked(' . "'a333')".'"' . toCommentOrNot(isItANewBrick("a333")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[333] . ' id="a334" ' . 'onclick="brickClicked(' . "'a334')".'"' . toCommentOrNot(isItANewBrick("a334")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[334] . ' id="a335" ' . 'onclick="brickClicked(' . "'a335')".'"' . toCommentOrNot(isItANewBrick("a335")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[335] . ' id="a336" ' . 'onclick="brickClicked(' . "'a336')".'"' . toCommentOrNot(isItANewBrick("a336")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[336] . ' id="a337" ' . 'onclick="brickClicked(' . "'a337')".'"' . toCommentOrNot(isItANewBrick("a337")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[337] . ' id="a338" ' . 'onclick="brickClicked(' . "'a338')".'"' . toCommentOrNot(isItANewBrick("a338")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[338] . ' id="a339" ' . 'onclick="brickClicked(' . "'a339')".'"' . toCommentOrNot(isItANewBrick("a339")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[339] . ' id="a340" ' . 'onclick="brickClicked(' . "'a340')".'"' . toCommentOrNot(isItANewBrick("a340")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[340] . ' id="a341" ' . 'onclick="brickClicked(' . "'a341')".'"' . toCommentOrNot(isItANewBrick("a341")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[341] . ' id="a342" ' . 'onclick="brickClicked(' . "'a342')".'"' . toCommentOrNot(isItANewBrick("a342")) . '></div>'); ?>
<!-- Row 20 -->
<?php echo('<div class="brickStyle ' . $result[342] . ' id="a343" ' . 'onclick="brickClicked(' . "'a343')".'"' . toCommentOrNot(isItANewBrick("a343")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[343] . ' id="a344" ' . 'onclick="brickClicked(' . "'a344')".'"' . toCommentOrNot(isItANewBrick("a344")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[344] . ' id="a345" ' . 'onclick="brickClicked(' . "'a345')".'"' . toCommentOrNot(isItANewBrick("a345")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[345] . ' id="a346" ' . 'onclick="brickClicked(' . "'a346')".'"' . toCommentOrNot(isItANewBrick("a346")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[346] . ' id="a347" ' . 'onclick="brickClicked(' . "'a347')".'"' . toCommentOrNot(isItANewBrick("a347")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[347] . ' id="a348" ' . 'onclick="brickClicked(' . "'a348')".'"' . toCommentOrNot(isItANewBrick("a348")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[348] . ' id="a349" ' . 'onclick="brickClicked(' . "'a349')".'"' . toCommentOrNot(isItANewBrick("a349")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[349] . ' id="a350" ' . 'onclick="brickClicked(' . "'a350')".'"' . toCommentOrNot(isItANewBrick("a350")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[350] . ' id="a351" ' . 'onclick="brickClicked(' . "'a351')".'"' . toCommentOrNot(isItANewBrick("a351")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[351] . ' id="a352" ' . 'onclick="brickClicked(' . "'a352')".'"' . toCommentOrNot(isItANewBrick("a352")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[352] . ' id="a353" ' . 'onclick="brickClicked(' . "'a353')".'"' . toCommentOrNot(isItANewBrick("a353")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[353] . ' id="a354" ' . 'onclick="brickClicked(' . "'a354')".'"' . toCommentOrNot(isItANewBrick("a354")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[354] . ' id="a355" ' . 'onclick="brickClicked(' . "'a355')".'"' . toCommentOrNot(isItANewBrick("a355")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[355] . ' id="a356" ' . 'onclick="brickClicked(' . "'a356')".'"' . toCommentOrNot(isItANewBrick("a356")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[356] . ' id="a357" ' . 'onclick="brickClicked(' . "'a357')".'"' . toCommentOrNot(isItANewBrick("a357")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[357] . ' id="a358" ' . 'onclick="brickClicked(' . "'a358')".'"' . toCommentOrNot(isItANewBrick("a358")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[358] . ' id="a359" ' . 'onclick="brickClicked(' . "'a359')".'"' . toCommentOrNot(isItANewBrick("a359")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[359] . ' id="a360" ' . 'onclick="brickClicked(' . "'a360')".'"' . toCommentOrNot(isItANewBrick("a360")) . '></div>'); ?>
<!-- Row 21 -->
<?php echo('<div class="brickStyle ' . $result[360] . ' id="a361" ' . 'onclick="brickClicked(' . "'a361')".'"' . toCommentOrNot(isItANewBrick("a361")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[361] . ' id="a362" ' . 'onclick="brickClicked(' . "'a362')".'"' . toCommentOrNot(isItANewBrick("a362")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[362] . ' id="a363" ' . 'onclick="brickClicked(' . "'a363')".'"' . toCommentOrNot(isItANewBrick("a363")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[363] . ' id="a364" ' . 'onclick="brickClicked(' . "'a364')".'"' . toCommentOrNot(isItANewBrick("a364")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[364] . ' id="a365" ' . 'onclick="brickClicked(' . "'a365')".'"' . toCommentOrNot(isItANewBrick("a365")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[365] . ' id="a366" ' . 'onclick="brickClicked(' . "'a366')".'"' . toCommentOrNot(isItANewBrick("a366")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[366] . ' id="a367" ' . 'onclick="brickClicked(' . "'a367')".'"' . toCommentOrNot(isItANewBrick("a367")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[367] . ' id="a368" ' . 'onclick="brickClicked(' . "'a368')".'"' . toCommentOrNot(isItANewBrick("a368")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[368] . ' id="a369" ' . 'onclick="brickClicked(' . "'a369')".'"' . toCommentOrNot(isItANewBrick("a369")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[369] . ' id="a370" ' . 'onclick="brickClicked(' . "'a370')".'"' . toCommentOrNot(isItANewBrick("a370")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[370] . ' id="a371" ' . 'onclick="brickClicked(' . "'a371')".'"' . toCommentOrNot(isItANewBrick("a371")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[371] . ' id="a372" ' . 'onclick="brickClicked(' . "'a372')".'"' . toCommentOrNot(isItANewBrick("a372")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[372] . ' id="a373" ' . 'onclick="brickClicked(' . "'a373')".'"' . toCommentOrNot(isItANewBrick("a373")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[373] . ' id="a374" ' . 'onclick="brickClicked(' . "'a374')".'"' . toCommentOrNot(isItANewBrick("a374")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[374] . ' id="a375" ' . 'onclick="brickClicked(' . "'a375')".'"' . toCommentOrNot(isItANewBrick("a375")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[375] . ' id="a376" ' . 'onclick="brickClicked(' . "'a376')".'"' . toCommentOrNot(isItANewBrick("a376")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[376] . ' id="a377" ' . 'onclick="brickClicked(' . "'a377')".'"' . toCommentOrNot(isItANewBrick("a377")) . '></div>'); ?>
<?php echo('<div class="brickStyle ' . $result[377] . ' id="a378" ' . 'onclick="brickClicked(' . "'a378')".'"' . toCommentOrNot(isItANewBrick("a378")) . '></div>'); ?>
          </div>
        </div>
      </div>
    </div>
    <input type="checkbox" id="modifyMode" class="doodad" > <!-- Toggle switch -->
    <label for="colorToggle">Enable Layout Modification</label>
    <button type="button" class="finalize button"> Finalize Layout Changes </button>
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
      <input type="hidden" id="groupName" name="groupName"/>
      <input type="hidden" id="brickID" name="brickID"/>
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

<!--NEXT TIME - FIX WHAT YOU HAVE BUTCHERED - THE HTML TAGS ARE NOT COMING THROUGH PROPERLY.-->
<!--IF YOU CANNOT FIX IT, DO NOT PANIC AND REVERT THE CHANGES. GO TO THE GITHUB PAGE AND COPY-->
<!--ONLY THE FOLLOWING: THE toCommentOrNot FUNCTION AND THE BRICK HTML/PHP CODE NEAR THE BOTTOM.-->
