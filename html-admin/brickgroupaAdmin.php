<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>repl.it</title>
  <script src="js/brickclicked.js"></script>
  <script src="js/system-ctrl.js"></script>
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
    $checkBoxStatus = (isset($_REQUEST['checkBoxStatus']) ? $_REQUEST['checkBoxStatus'] : null);
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
      
      // $prep2 = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $uname, $psword);
      // $prep2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $prep2->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety
      // $test2 = null;
      // $test2 = $prep2->prepare("SELECT gridTemplateAreasId FROM a_brick_group");
      // // $stmt->bindParam(1, $brickNum, PDO::PARAM_INT, 3);
      // $test2->execute();
      // $answer2 = $test2->setFetchMode(PDO::FETCH_ASSOC);
      // $answer2 = $test2->fetchAll();
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
        if ($checkBoxStatus != true){
          return 'style="visibility: hidden;"';
        }
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
        // var_dump($result);
        // echo($result[4]);
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
    <?php
    if($checkBoxStatus == true){ 
      echo("brickR1C1 brickR1C2 brickR1C3 brickR1C4 brickR1C5 brickR1C6 brickR1C7 brickR1C8 brickR1C9 brickR1C10 brickR1C11 brickR1C12 brickR1C13 brickR1C14 brickR1C15 brickR1C16 brickR1C17 brickR1C18 \n
          brickR2C1 brickR2C2 brickR2C3 brickR2C4 brickR2C5 brickR2C6 brickR2C7 brickR2C8 brickR2C9 brickR2C10 brickR2C11 brickR2C12 brickR2C13 brickR2C14 brickR2C15 brickR2C16 brickR2C17 brickR2C18 \n
          brickR3C1 brickR3C2 brickR3C3 brickR3C4 brickR3C5 brickR3C6 brickR3C7 brickR3C8 brickR3C9 brickR3C10 brickR3C11 brickR3C12 brickR3C13 brickR3C14 brickR3C15 brickR3C16 brickR3C17 brickR3C18 \n
          brickR4C1 brickR4C2 brickR4C3 brickR4C4 brickR4C5 brickR4C6 brickR4C7 brickR4C8 brickR4C9 brickR4C10 brickR4C11 brickR4C12 brickR4C13 brickR4C14 brickR4C15 brickR4C16 brickR4C17 brickR4C18 \n
          brickR5C1 brickR5C2 brickR5C3 brickR5C4 brickR5C5 brickR5C6 brickR5C7 brickR5C8 brickR5C9 brickR5C10 brickR5C11 brickR5C12 brickR5C13 brickR5C14 brickR5C15 brickR5C16 brickR5C17 brickR5C18 \n
          brickR6C1 brickR6C2 brickR6C3 brickR6C4 brickR6C5 brickR6C6 brickR6C7 brickR6C8 brickR6C9 brickR6C10 brickR6C11 brickR6C12 brickR6C13 brickR6C14 brickR6C15 brickR6C16 brickR6C17 brickR6C18 \n
          brickR7C1 brickR7C2 brickR7C3 brickR7C4 brickR7C5 brickR7C6 brickR7C7 brickR7C8 brickR7C9 brickR7C10 brickR7C11 brickR7C12 brickR7C13 brickR7C14 brickR7C15 brickR7C16 brickR7C17 brickR7C18 \n
          brickR8C1 brickR8C2 brickR8C3 brickR8C4 brickR8C5 brickR8C6 brickR8C7 brickR8C8 brickR8C9 brickR8C10 brickR8C11 brickR8C12 brickR8C13 brickR8C14 brickR8C15 brickR8C16 brickR8C17 brickR8C18 \n
          brickR9C1 brickR9C2 brickR9C3 brickR9C4 brickR9C5 brickR9C6 brickR9C7 brickR9C8 brickR9C9 brickR9C10 brickR9C11 brickR9C12 brickR9C13 brickR9C14 brickR9C15 brickR9C16 brickR9C17 brickR9C18 \n
          brickR10C1 brickR10C2 brickR10C3 brickR10C4 brickR10C5 brickR10C6 brickR10C7 brickR10C8 brickR10C9 brickR10C10 brickR10C11 brickR10C12 brickR10C13 brickR10C14 brickR10C15 brickR10C16 brickR10C17 brickR10C18 \n
          brickR11C1 brickR11C2 brickR11C3 brickR11C4 brickR11C5 brickR11C6 brickR11C7 brickR11C8 brickR11C9 brickR11C10 brickR11C11 brickR11C12 brickR11C13 brickR11C14 brickR11C15 brickR11C16 brickR11C17 brickR11C18 \n
          brickR12C1 brickR12C2 brickR12C3 brickR12C4 brickR12C5 brickR12C6 brickR12C7 brickR12C8 brickR12C9 brickR12C10 brickR12C11 brickR12C12 brickR12C13 brickR12C14 brickR12C15 brickR12C16 brickR12C17 brickR12C18 \n
          brickR13C1 brickR13C2 brickR13C3 brickR13C4 brickR13C5 brickR13C6 brickR13C7 brickR13C8 brickR13C9 brickR13C10 brickR13C11 brickR13C12 brickR13C13 brickR13C14 brickR13C15 brickR13C16 brickR13C17 brickR13C18 \n
          brickR14C1 brickR14C2 brickR14C3 brickR14C4 brickR14C5 brickR14C6 brickR14C7 brickR14C8 brickR14C9 brickR14C10 brickR14C11 brickR14C12 brickR14C13 brickR14C14 brickR14C15 brickR14C16 brickR14C17 brickR14C18 \n
          brickR15C1 brickR15C2 brickR15C3 brickR15C4 brickR15C5 brickR15C6 brickR15C7 brickR15C8 brickR15C9 brickR15C10 brickR15C11 brickR15C12 brickR15C13 brickR15C14 brickR15C15 brickR15C16 brickR15C17 brickR15C18 \n
          brickR16C1 brickR16C2 brickR16C3 brickR16C4 brickR16C5 brickR16C6 brickR16C7 brickR16C8 brickR16C9 brickR16C10 brickR16C11 brickR16C12 brickR16C13 brickR16C14 brickR16C15 brickR16C16 brickR16C17 brickR16C18 \n
          brickR17C1 brickR17C2 brickR17C3 brickR17C4 brickR17C5 brickR17C6 brickR17C7 brickR17C8 brickR17C9 brickR17C10 brickR17C11 brickR17C12 brickR17C13 brickR17C14 brickR17C15 brickR17C16 brickR17C17 brickR17C18 \n
          brickR18C1 brickR18C2 brickR18C3 brickR18C4 brickR18C5 brickR18C6 brickR18C7 brickR18C8 brickR18C9 brickR18C10 brickR18C11 brickR18C12 brickR18C13 brickR18C14 brickR18C15 brickR18C16 brickR18C17 brickR18C18 \n
          brickR19C1 brickR19C2 brickR19C3 brickR19C4 brickR19C5 brickR19C6 brickR19C7 brickR19C8 brickR19C9 brickR19C10 brickR19C11 brickR19C12 brickR19C13 brickR19C14 brickR19C15 brickR19C16 brickR19C17 brickR19C18 \n
          brickR20C1 brickR20C2 brickR20C3 brickR20C4 brickR20C5 brickR20C6 brickR20C7 brickR20C8 brickR20C9 brickR20C10 brickR20C11 brickR20C12 brickR20C13 brickR20C14 brickR20C15 brickR20C16 brickR20C17 brickR20C18 \n
          brickR21C1 brickR21C2 brickR21C3 brickR21C4 brickR21C5 brickR21C6 brickR21C7 brickR21C8 brickR21C9 brickR21C10 brickR21C11 brickR21C12 brickR21C13 brickR21C14 brickR21C15 brickR21C16 brickR21C17 brickR21C18 \n");
    }
    else{
      echo($p . $result[0] . ' ' .$result[1] . ' ' .$result[2] . ' ' .$result[3] . ' ' .$result[4] . ' ' .$result[5] . ' ' .$result[6] . ' ' .$result[7] . ' ' .$result[8] . ' ' .$result[9] . ' ' .$result[10] . ' ' .$result[11] . ' ' .$result[12] . ' ' .$result[13] . ' ' .$result[14] . ' ' .$result[15] . ' ' .$result[16] . ' ' .$result[17] . $p);
      echo($p . $result[18] . ' ' .$result[19] . ' ' .$result[20] . ' ' .$result[21] . ' ' .$result[22] . ' ' .$result[23] . ' ' .$result[24] . ' ' .$result[25] . ' ' .$result[26] . ' ' .$result[27] . ' ' .$result[28] . ' ' .$result[29] . ' ' .$result[30] . ' ' .$result[31] . ' ' .$result[32] . ' ' .$result[33] . ' ' .$result[34] . ' ' .$result[35] . $p);
      echo($p . $result[36] . ' ' .$result[37] . ' ' .$result[38] . ' ' .$result[39] . ' ' .$result[40] . ' ' .$result[41] . ' ' .$result[42] . ' ' .$result[43] . ' ' .$result[44] . ' ' .$result[45] . ' ' .$result[46] . ' ' .$result[47] . ' ' .$result[48] . ' ' .$result[49] . ' ' .$result[50] . ' ' .$result[51] . ' ' .$result[52] . ' ' .$result[53] . $p);
      echo($p . $result[54] . ' ' .$result[55] . ' ' .$result[56] . ' ' .$result[57] . ' ' .$result[58] . ' ' .$result[59] . ' ' .$result[60] . ' ' .$result[61] . ' ' .$result[62] . ' ' .$result[63] . ' ' .$result[64] . ' ' .$result[65] . ' ' .$result[66] . ' ' .$result[67] . ' ' .$result[68] . ' ' .$result[69] . ' ' .$result[70] . ' ' .$result[71] . $p);
      echo($p . $result[72] . ' ' .$result[73] . ' ' .$result[74] . ' ' .$result[75] . ' ' .$result[76] . ' ' .$result[77] . ' ' .$result[78] . ' ' .$result[79] . ' ' .$result[80] . ' ' .$result[81] . ' ' .$result[82] . ' ' .$result[83] . ' ' .$result[84] . ' ' .$result[85] . ' ' .$result[86] . ' ' .$result[87] . ' ' .$result[88] . ' ' .$result[89] . $p);
      echo($p . $result[90] . ' ' .$result[91] . ' ' .$result[92] . ' ' .$result[93] . ' ' .$result[94] . ' ' .$result[95] . ' ' .$result[96] . ' ' .$result[97] . ' ' .$result[98] . ' ' .$result[99] . ' ' .$result[100] . ' ' .$result[101] . ' ' .$result[102] . ' ' .$result[103] . ' ' .$result[104] . ' ' .$result[105] . ' ' .$result[106] . ' ' .$result[107] . $p);
      echo($p . $result[108] . ' ' .$result[109] . ' ' .$result[110] . ' ' .$result[111] . ' ' .$result[112] . ' ' .$result[113] . ' ' .$result[114] . ' ' .$result[115] . ' ' .$result[116] . ' ' .$result[117] . ' ' .$result[118] . ' ' .$result[119] . ' ' .$result[120] . ' ' .$result[121] . ' ' .$result[122] . ' ' .$result[123] . ' ' .$result[124] . ' ' .$result[125] . $p);
      echo($p . $result[126] . ' ' .$result[127] . ' ' .$result[128] . ' ' .$result[129] . ' ' .$result[130] . ' ' .$result[131] . ' ' .$result[132] . ' ' .$result[133] . ' ' .$result[134] . ' ' .$result[135] . ' ' .$result[136] . ' ' .$result[137] . ' ' .$result[138] . ' ' .$result[139] . ' ' .$result[140] . ' ' .$result[141] . ' ' .$result[142] . ' ' .$result[143] . $p);
      echo($p . $result[144] . ' ' .$result[145] . ' ' .$result[146] . ' ' .$result[147] . ' ' .$result[148] . ' ' .$result[149] . ' ' .$result[150] . ' ' .$result[151] . ' ' .$result[152] . ' ' .$result[153] . ' ' .$result[154] . ' ' .$result[155] . ' ' .$result[156] . ' ' .$result[157] . ' ' .$result[158] . ' ' .$result[159] . ' ' .$result[160] . ' ' .$result[161] . $p);
      echo($p . $result[162] . ' ' .$result[163] . ' ' .$result[164] . ' ' .$result[165] . ' ' .$result[166] . ' ' .$result[167] . ' ' .$result[168] . ' ' .$result[169] . ' ' .$result[170] . ' ' .$result[171] . ' ' .$result[172] . ' ' .$result[173] . ' ' .$result[174] . ' ' .$result[175] . ' ' .$result[176] . ' ' .$result[177] . ' ' .$result[178] . ' ' .$result[179] . $p);
      echo($p . $result[180] . ' ' .$result[181] . ' ' .$result[182] . ' ' .$result[183] . ' ' .$result[184] . ' ' .$result[185] . ' ' .$result[186] . ' ' .$result[187] . ' ' .$result[188] . ' ' .$result[189] . ' ' .$result[190] . ' ' .$result[191] . ' ' .$result[192] . ' ' .$result[193] . ' ' .$result[194] . ' ' .$result[195] . ' ' .$result[196] . ' ' .$result[197] . $p);
      echo($p . $result[198] . ' ' .$result[199] . ' ' .$result[200] . ' ' .$result[201] . ' ' .$result[202] . ' ' .$result[203] . ' ' .$result[204] . ' ' .$result[205] . ' ' .$result[206] . ' ' .$result[207] . ' ' .$result[208] . ' ' .$result[209] . ' ' .$result[210] . ' ' .$result[211] . ' ' .$result[212] . ' ' .$result[213] . ' ' .$result[214] . ' ' .$result[215] . $p);
      echo($p . $result[216] . ' ' .$result[217] . ' ' .$result[218] . ' ' .$result[219] . ' ' .$result[220] . ' ' .$result[221] . ' ' .$result[222] . ' ' .$result[223] . ' ' .$result[224] . ' ' .$result[225] . ' ' .$result[226] . ' ' .$result[227] . ' ' .$result[228] . ' ' .$result[229] . ' ' .$result[230] . ' ' .$result[231] . ' ' .$result[232] . ' ' .$result[233] . $p);
      echo($p . $result[234] . ' ' .$result[235] . ' ' .$result[236] . ' ' .$result[237] . ' ' .$result[238] . ' ' .$result[239] . ' ' .$result[240] . ' ' .$result[241] . ' ' .$result[242] . ' ' .$result[243] . ' ' .$result[244] . ' ' .$result[245] . ' ' .$result[246] . ' ' .$result[247] . ' ' .$result[248] . ' ' .$result[249] . ' ' .$result[250] . ' ' .$result[251] . $p);
      echo($p . $result[252] . ' ' .$result[253] . ' ' .$result[254] . ' ' .$result[255] . ' ' .$result[256] . ' ' .$result[257] . ' ' .$result[258] . ' ' .$result[259] . ' ' .$result[260] . ' ' .$result[261] . ' ' .$result[262] . ' ' .$result[263] . ' ' .$result[264] . ' ' .$result[265] . ' ' .$result[266] . ' ' .$result[267] . ' ' .$result[268] . ' ' .$result[269] . $p);
      echo($p . $result[270] . ' ' .$result[271] . ' ' .$result[272] . ' ' .$result[273] . ' ' .$result[274] . ' ' .$result[275] . ' ' .$result[276] . ' ' .$result[277] . ' ' .$result[278] . ' ' .$result[279] . ' ' .$result[280] . ' ' .$result[281] . ' ' .$result[282] . ' ' .$result[283] . ' ' .$result[284] . ' ' .$result[285] . ' ' .$result[286] . ' ' .$result[287] . $p);
      echo($p . $result[288] . ' ' .$result[289] . ' ' .$result[290] . ' ' .$result[291] . ' ' .$result[292] . ' ' .$result[293] . ' ' .$result[294] . ' ' .$result[295] . ' ' .$result[296] . ' ' .$result[297] . ' ' .$result[298] . ' ' .$result[299] . ' ' .$result[300] . ' ' .$result[301] . ' ' .$result[302] . ' ' .$result[303] . ' ' .$result[304] . ' ' .$result[305] . $p);
      echo($p . $result[306] . ' ' .$result[307] . ' ' .$result[308] . ' ' .$result[309] . ' ' .$result[310] . ' ' .$result[311] . ' ' .$result[312] . ' ' .$result[313] . ' ' .$result[314] . ' ' .$result[315] . ' ' .$result[316] . ' ' .$result[317] . ' ' .$result[318] . ' ' .$result[319] . ' ' .$result[320] . ' ' .$result[321] . ' ' .$result[322] . ' ' .$result[323] . $p);
      echo($p . $result[324] . ' ' .$result[325] . ' ' .$result[326] . ' ' .$result[327] . ' ' .$result[328] . ' ' .$result[329] . ' ' .$result[330] . ' ' .$result[331] . ' ' .$result[332] . ' ' .$result[333] . ' ' .$result[334] . ' ' .$result[335] . ' ' .$result[336] . ' ' .$result[337] . ' ' .$result[338] . ' ' .$result[339] . ' ' .$result[340] . ' ' .$result[341] . $p);
      echo($p . $result[342] . ' ' .$result[343] . ' ' .$result[344] . ' ' .$result[345] . ' ' .$result[346] . ' ' .$result[347] . ' ' .$result[348] . ' ' .$result[349] . ' ' .$result[350] . ' ' .$result[351] . ' ' .$result[352] . ' ' .$result[353] . ' ' .$result[354] . ' ' .$result[355] . ' ' .$result[356] . ' ' .$result[357] . ' ' .$result[358] . ' ' .$result[359] . $p);
      echo($p . $result[360] . ' ' .$result[361] . ' ' .$result[362] . ' ' .$result[363] . ' ' .$result[364] . ' ' .$result[365] . ' ' .$result[366] . ' ' .$result[367] . ' ' .$result[368] . ' ' .$result[369] . ' ' .$result[370] . ' ' .$result[371] . ' ' .$result[372] . ' ' .$result[373] . ' ' .$result[374] . ' ' .$result[375] . ' ' .$result[376] . ' ' .$result[377] . $p);
    }
    ?>

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

    <?php 
    if($checkBoxStatus == true){
      echo(".brickR1C1 { grid-area: brickR1C1; } \n
      .brickR1C2 { grid-area: brickR1C2; } \n
      .brickR1C3 { grid-area: brickR1C3; } \n
      .brickR1C4 { grid-area: brickR1C4; } \n
      .brickR1C5 { grid-area: brickR1C5; } \n
      .brickR1C6 { grid-area: brickR1C6; } \n 
      .brickR1C7 { grid-area: brickR1C7; } \n
      .brickR1C8 { grid-area: brickR1C8; } \n
      .brickR1C9 { grid-area: brickR1C9; } \n
      .brickR1C10 { grid-area: brickR1C10; } \n
      .brickR1C11 { grid-area: brickR1C11; } \n
      .brickR1C12 { grid-area: brickR1C12; } \n
      .brickR1C13 { grid-area: brickR1C13; } \n
      .brickR1C14 { grid-area: brickR1C14; } \n
      .brickR1C15 { grid-area: brickR1C15; } \n
      .brickR1C16 { grid-area: brickR1C16; } \n
      .brickR1C17 { grid-area: brickR1C17; } \n
      .brickR1C18 { grid-area: brickR1C18; } \n
      .brickR2C1 { grid-area: brickR2C1; } \n
      .brickR2C2 { grid-area: brickR2C2; } \n
      .brickR2C3 { grid-area: brickR2C3; } \n
      .brickR2C4 { grid-area: brickR2C4; } \n
      .brickR2C5 { grid-area: brickR2C5; } \n
      .brickR2C6 { grid-area: brickR2C6; } \n
      .brickR2C7 { grid-area: brickR2C7; } \n
      .brickR2C8 { grid-area: brickR2C8; } \n
      .brickR2C9 { grid-area: brickR2C9; } \n
      .brickR2C10 { grid-area: brickR2C10; } \n
      .brickR2C11 { grid-area: brickR2C11; } \n
      .brickR2C12 { grid-area: brickR2C12; } \n
      .brickR2C13 { grid-area: brickR2C13; } \n
      .brickR2C14 { grid-area: brickR2C14; } \n
      .brickR2C15 { grid-area: brickR2C15; } \n
      .brickR2C16 { grid-area: brickR2C16; } \n
      .brickR2C17 { grid-area: brickR2C17; } \n
      .brickR2C18 { grid-area: brickR2C18; } \n
      .brickR3C1 { grid-area: brickR3C1; } \n
      .brickR3C2 { grid-area: brickR3C2; } \n
      .brickR3C3 { grid-area: brickR3C3; } \n
      .brickR3C4 { grid-area: brickR3C4; } \n
      .brickR3C5 { grid-area: brickR3C5; } \n
      .brickR3C6 { grid-area: brickR3C6; } \n
      .brickR3C7 { grid-area: brickR3C7; } \n
      .brickR3C8 { grid-area: brickR3C8; } \n
      .brickR3C9 { grid-area: brickR3C9; } \n
      .brickR3C10 { grid-area: brickR3C10; } \n
      .brickR3C11 { grid-area: brickR3C11; } \n
      .brickR3C12 { grid-area: brickR3C12; } \n
      .brickR3C13 { grid-area: brickR3C13; } \n
      .brickR3C14 { grid-area: brickR3C14; } \n
      .brickR3C15 { grid-area: brickR3C15; } \n
      .brickR3C16 { grid-area: brickR3C16; } \n
      .brickR3C17 { grid-area: brickR3C17; } \n
      .brickR3C18 { grid-area: brickR3C18; } \n
      .brickR4C1 { grid-area: brickR4C1; } \n
      .brickR4C2 { grid-area: brickR4C2; } \n
      .brickR4C3 { grid-area: brickR4C3; } \n
      .brickR4C4 { grid-area: brickR4C4; } \n
      .brickR4C5 { grid-area: brickR4C5; } \n
      .brickR4C6 { grid-area: brickR4C6; } \n
      .brickR4C7 { grid-area: brickR4C7; } \n
      .brickR4C8 { grid-area: brickR4C8; } \n
      .brickR4C9 { grid-area: brickR4C9; } \n
      .brickR4C10 { grid-area: brickR4C10; } \n
      .brickR4C11 { grid-area: brickR4C11; } \n
      .brickR4C12 { grid-area: brickR4C12; } \n
      .brickR4C13 { grid-area: brickR4C13; } \n
      .brickR4C14 { grid-area: brickR4C14; } \n
      .brickR4C15 { grid-area: brickR4C15; } \n
      .brickR4C16 { grid-area: brickR4C16; } \n
      .brickR4C17 { grid-area: brickR4C17; } \n
      .brickR4C18 { grid-area: brickR4C18; } \n
      .brickR5C1 { grid-area: brickR5C1; } \n
      .brickR5C2 { grid-area: brickR5C2; } \n
      .brickR5C3 { grid-area: brickR5C3; } \n
      .brickR5C4 { grid-area: brickR5C4; } \n
      .brickR5C5 { grid-area: brickR5C5; } \n
      .brickR5C6 { grid-area: brickR5C6; } \n
      .brickR5C7 { grid-area: brickR5C7; } \n
      .brickR5C8 { grid-area: brickR5C8; } \n
      .brickR5C9 { grid-area: brickR5C9; } \n
      .brickR5C10 { grid-area: brickR5C10; } \n
      .brickR5C11 { grid-area: brickR5C11; } \n
      .brickR5C12 { grid-area: brickR5C12; } \n
      .brickR5C13 { grid-area: brickR5C13; } \n
      .brickR5C14 { grid-area: brickR5C14; } \n
      .brickR5C15 { grid-area: brickR5C15; } \n
      .brickR5C16 { grid-area: brickR5C16; } \n
      .brickR5C17 { grid-area: brickR5C17; } \n
      .brickR5C18 { grid-area: brickR5C18; } \n
      .brickR6C1 { grid-area: brickR6C1; } \n
      .brickR6C2 { grid-area: brickR6C2; } \n
      .brickR6C3 { grid-area: brickR6C3; } \n
      .brickR6C4 { grid-area: brickR6C4; } \n
      .brickR6C5 { grid-area: brickR6C5; } \n
      .brickR6C6 { grid-area: brickR6C6; } \n
      .brickR6C7 { grid-area: brickR6C7; } \n
      .brickR6C8 { grid-area: brickR6C8; } \n
      .brickR6C9 { grid-area: brickR6C9; } \n
      .brickR6C10 { grid-area: brickR6C10; } \n
      .brickR6C11 { grid-area: brickR6C11; } \n
      .brickR6C12 { grid-area: brickR6C12; } \n
      .brickR6C13 { grid-area: brickR6C13; } \n
      .brickR6C14 { grid-area: brickR6C14; } \n
      .brickR6C15 { grid-area: brickR6C15; } \n
      .brickR6C16 { grid-area: brickR6C16; } \n
      .brickR6C17 { grid-area: brickR6C17; } \n
      .brickR6C18 { grid-area: brickR6C18; } \n
      .brickR7C1 { grid-area: brickR7C1; } \n
      .brickR7C2 { grid-area: brickR7C2; } \n
      .brickR7C3 { grid-area: brickR7C3; } \n
      .brickR7C4 { grid-area: brickR7C4; } \n
      .brickR7C5 { grid-area: brickR7C5; } \n
      .brickR7C6 { grid-area: brickR7C6; } \n
      .brickR7C7 { grid-area: brickR7C7; } \n
      .brickR7C8 { grid-area: brickR7C8; } \n
      .brickR7C9 { grid-area: brickR7C9; } \n
      .brickR7C10 { grid-area: brickR7C10; } \n
      .brickR7C11 { grid-area: brickR7C11; } \n
      .brickR7C12 { grid-area: brickR7C12; } \n
      .brickR7C13 { grid-area: brickR7C13; } \n
      .brickR7C14 { grid-area: brickR7C14; } \n
      .brickR7C15 { grid-area: brickR7C15; } \n
      .brickR7C16 { grid-area: brickR7C16; } \n
      .brickR7C17 { grid-area: brickR7C17; } \n
      .brickR7C18 { grid-area: brickR7C18; } \n
      .brickR8C1 { grid-area: brickR8C1; } \n
      .brickR8C2 { grid-area: brickR8C2; } \n
      .brickR8C3 { grid-area: brickR8C3; } \n
      .brickR8C4 { grid-area: brickR8C4; } \n
      .brickR8C5 { grid-area: brickR8C5; } \n
      .brickR8C6 { grid-area: brickR8C6; } \n
      .brickR8C7 { grid-area: brickR8C7; } \n
      .brickR8C8 { grid-area: brickR8C8; } \n
      .brickR8C9 { grid-area: brickR8C9; } \n
      .brickR8C10 { grid-area: brickR8C10; } \n
      .brickR8C11 { grid-area: brickR8C11; } \n
      .brickR8C12 { grid-area: brickR8C12; } \n
      .brickR8C13 { grid-area: brickR8C13; } \n
      .brickR8C14 { grid-area: brickR8C14; } \n
      .brickR8C15 { grid-area: brickR8C15; } \n
      .brickR8C16 { grid-area: brickR8C16; } \n
      .brickR8C17 { grid-area: brickR8C17; } \n
      .brickR8C18 { grid-area: brickR8C18; } \n
      .brickR9C1 { grid-area: brickR9C1; } \n
      .brickR9C2 { grid-area: brickR9C2; } \n
      .brickR9C3 { grid-area: brickR9C3; } \n
      .brickR9C4 { grid-area: brickR9C4; } \n
      .brickR9C5 { grid-area: brickR9C5; } \n
      .brickR9C6 { grid-area: brickR9C6; } \n
      .brickR9C7 { grid-area: brickR9C7; } \n
      .brickR9C8 { grid-area: brickR9C8; } \n
      .brickR9C9 { grid-area: brickR9C9; } \n
      .brickR9C10 { grid-area: brickR9C10; } \n
      .brickR9C11 { grid-area: brickR9C11; } \n
      .brickR9C12 { grid-area: brickR9C12; } \n
      .brickR9C13 { grid-area: brickR9C13; } \n
      .brickR9C14 { grid-area: brickR9C14; } \n
      .brickR9C15 { grid-area: brickR9C15; } \n
      .brickR9C16 { grid-area: brickR9C16; } \n
      .brickR9C17 { grid-area: brickR9C17; } \n
      .brickR9C18 { grid-area: brickR9C18; } \n
      .brickR10C1 { grid-area: brickR10C1; } \n
      .brickR10C2 { grid-area: brickR10C2; } \n
      .brickR10C3 { grid-area: brickR10C3; } \n
      .brickR10C4 { grid-area: brickR10C4; } \n
      .brickR10C5 { grid-area: brickR10C5; } \n
      .brickR10C6 { grid-area: brickR10C6; } \n
      .brickR10C7 { grid-area: brickR10C7; } \n
      .brickR10C8 { grid-area: brickR10C8; } \n
      .brickR10C9 { grid-area: brickR10C9; } \n
      .brickR10C10 { grid-area: brickR10C10; } \n
      .brickR10C11 { grid-area: brickR10C11; } \n
      .brickR10C12 { grid-area: brickR10C12; } \n
      .brickR10C13 { grid-area: brickR10C13; } \n
      .brickR10C14 { grid-area: brickR10C14; } \n
      .brickR10C15 { grid-area: brickR10C15; } \n
      .brickR10C16 { grid-area: brickR10C16; } \n
      .brickR10C17 { grid-area: brickR10C17; } \n
      .brickR10C18 { grid-area: brickR10C18; } \n
      .brickR11C1 { grid-area: brickR11C1; } \n
      .brickR11C2 { grid-area: brickR11C2; } \n
      .brickR11C3 { grid-area: brickR11C3; } \n
      .brickR11C4 { grid-area: brickR11C4; } \n
      .brickR11C5 { grid-area: brickR11C5; } \n
      .brickR11C6 { grid-area: brickR11C6; } \n
      .brickR11C7 { grid-area: brickR11C7; } \n
      .brickR11C8 { grid-area: brickR11C8; } \n
      .brickR11C9 { grid-area: brickR11C9; } \n
      .brickR11C10 { grid-area: brickR11C10; } \n
      .brickR11C11 { grid-area: brickR11C11; } \n
      .brickR11C12 { grid-area: brickR11C12; } \n
      .brickR11C13 { grid-area: brickR11C13; } \n
      .brickR11C14 { grid-area: brickR11C14; } \n
      .brickR11C15 { grid-area: brickR11C15; } \n
      .brickR11C16 { grid-area: brickR11C16; } \n
      .brickR11C17 { grid-area: brickR11C17; } \n
      .brickR11C18 { grid-area: brickR11C18; } \n
      .brickR12C1 { grid-area: brickR12C1; } \n
      .brickR12C2 { grid-area: brickR12C2; } \n
      .brickR12C3 { grid-area: brickR12C3; } \n
      .brickR12C4 { grid-area: brickR12C4; } \n
      .brickR12C5 { grid-area: brickR12C5; } \n
      .brickR12C6 { grid-area: brickR12C6; } \n
      .brickR12C7 { grid-area: brickR12C7; } \n
      .brickR12C8 { grid-area: brickR12C8; } \n
      .brickR12C9 { grid-area: brickR12C9; } \n
      .brickR12C10 { grid-area: brickR12C10; } \n
      .brickR12C11 { grid-area: brickR12C11; } \n
      .brickR12C12 { grid-area: brickR12C12; } \n
      .brickR12C13 { grid-area: brickR12C13; } \n
      .brickR12C14 { grid-area: brickR12C14; } \n
      .brickR12C15 { grid-area: brickR12C15; } \n
      .brickR12C16 { grid-area: brickR12C16; } \n
      .brickR12C17 { grid-area: brickR12C17; } \n
      .brickR12C18 { grid-area: brickR12C18; } \n
      .brickR13C1 { grid-area: brickR13C1; } \n
      .brickR13C2 { grid-area: brickR13C2; } \n
      .brickR13C3 { grid-area: brickR13C3; } \n
      .brickR13C4 { grid-area: brickR13C4; } \n
      .brickR13C5 { grid-area: brickR13C5; } \n
      .brickR13C6 { grid-area: brickR13C6; } \n
      .brickR13C7 { grid-area: brickR13C7; } \n
      .brickR13C8 { grid-area: brickR13C8; } \n
      .brickR13C9 { grid-area: brickR13C9; } \n
      .brickR13C10 { grid-area: brickR13C10; } \n
      .brickR13C11 { grid-area: brickR13C11; } \n
      .brickR13C12 { grid-area: brickR13C12; } \n
      .brickR13C13 { grid-area: brickR13C13; } \n
      .brickR13C14 { grid-area: brickR13C14; } \n
      .brickR13C15 { grid-area: brickR13C15; } \n
      .brickR13C16 { grid-area: brickR13C16; } \n
      .brickR13C17 { grid-area: brickR13C17; } \n
      .brickR13C18 { grid-area: brickR13C18; } \n
      .brickR14C1 { grid-area: brickR14C1; } \n
      .brickR14C2 { grid-area: brickR14C2; } \n
      .brickR14C3 { grid-area: brickR14C3; } \n
      .brickR14C4 { grid-area: brickR14C4; } \n
      .brickR14C5 { grid-area: brickR14C5; } \n
      .brickR14C6 { grid-area: brickR14C6; } \n
      .brickR14C7 { grid-area: brickR14C7; } \n
      .brickR14C8 { grid-area: brickR14C8; } \n
      .brickR14C9 { grid-area: brickR14C9; } \n
      .brickR14C10 { grid-area: brickR14C10; } \n
      .brickR14C11 { grid-area: brickR14C11; } \n
      .brickR14C12 { grid-area: brickR14C12; } \n
      .brickR14C13 { grid-area: brickR14C13; } \n
      .brickR14C14 { grid-area: brickR14C14; } \n
      .brickR14C15 { grid-area: brickR14C15; } \n
      .brickR14C16 { grid-area: brickR14C16; } \n
      .brickR14C17 { grid-area: brickR14C17; } \n
      .brickR14C18 { grid-area: brickR14C18; } \n
      .brickR15C1 { grid-area: brickR15C1; } \n
      .brickR15C2 { grid-area: brickR15C2; } \n
      .brickR15C3 { grid-area: brickR15C3; } \n
      .brickR15C4 { grid-area: brickR15C4; } \n
      .brickR15C5 { grid-area: brickR15C5; } \n
      .brickR15C6 { grid-area: brickR15C6; } \n
      .brickR15C7 { grid-area: brickR15C7; } \n
      .brickR15C8 { grid-area: brickR15C8; } \n
      .brickR15C9 { grid-area: brickR15C9; } \n
      .brickR15C10 { grid-area: brickR15C10; } \n
      .brickR15C11 { grid-area: brickR15C11; } \n
      .brickR15C12 { grid-area: brickR15C12; } \n
      .brickR15C13 { grid-area: brickR15C13; } \n
      .brickR15C14 { grid-area: brickR15C14; } \n
      .brickR15C15 { grid-area: brickR15C15; } \n
      .brickR15C16 { grid-area: brickR15C16; } \n
      .brickR15C17 { grid-area: brickR15C17; } \n
      .brickR15C18 { grid-area: brickR15C18; } \n
      .brickR16C1 { grid-area: brickR16C1; } \n
      .brickR16C2 { grid-area: brickR16C2; } \n
      .brickR16C3 { grid-area: brickR16C3; } \n
      .brickR16C4 { grid-area: brickR16C4; } \n
      .brickR16C5 { grid-area: brickR16C5; } \n
      .brickR16C6 { grid-area: brickR16C6; } \n
      .brickR16C7 { grid-area: brickR16C7; } \n
      .brickR16C8 { grid-area: brickR16C8; } \n
      .brickR16C9 { grid-area: brickR16C9; } \n
      .brickR16C10 { grid-area: brickR16C10; } \n
      .brickR16C11 { grid-area: brickR16C11; } \n
      .brickR16C12 { grid-area: brickR16C12; } \n
      .brickR16C13 { grid-area: brickR16C13; } \n
      .brickR16C14 { grid-area: brickR16C14; } \n
      .brickR16C15 { grid-area: brickR16C15; } \n
      .brickR16C16 { grid-area: brickR16C16; } \n
      .brickR16C17 { grid-area: brickR16C17; } \n
      .brickR16C18 { grid-area: brickR16C18; } \n
      .brickR17C1 { grid-area: brickR17C1; } \n
      .brickR17C2 { grid-area: brickR17C2; } \n
      .brickR17C3 { grid-area: brickR17C3; } \n
      .brickR17C4 { grid-area: brickR17C4; } \n
      .brickR17C5 { grid-area: brickR17C5; } \n
      .brickR17C6 { grid-area: brickR17C6; } \n
      .brickR17C7 { grid-area: brickR17C7; } \n
      .brickR17C8 { grid-area: brickR17C8; } \n
      .brickR17C9 { grid-area: brickR17C9; } \n
      .brickR17C10 { grid-area: brickR17C10; } \n
      .brickR17C11 { grid-area: brickR17C11; } \n
      .brickR17C12 { grid-area: brickR17C12; } \n
      .brickR17C13 { grid-area: brickR17C13; } \n
      .brickR17C14 { grid-area: brickR17C14; } \n
      .brickR17C15 { grid-area: brickR17C15; } \n
      .brickR17C16 { grid-area: brickR17C16; } \n
      .brickR17C17 { grid-area: brickR17C17; } \n
      .brickR17C18 { grid-area: brickR17C18; } \n
      .brickR18C1 { grid-area: brickR18C1; } \n
      .brickR18C2 { grid-area: brickR18C2; } \n
      .brickR18C3 { grid-area: brickR18C3; } \n
      .brickR18C4 { grid-area: brickR18C4; } \n
      .brickR18C5 { grid-area: brickR18C5; } \n
      .brickR18C6 { grid-area: brickR18C6; } \n
      .brickR18C7 { grid-area: brickR18C7; } \n
      .brickR18C8 { grid-area: brickR18C8; } \n
      .brickR18C9 { grid-area: brickR18C9; } \n
      .brickR18C10 { grid-area: brickR18C10; } \n
      .brickR18C11 { grid-area: brickR18C11; } \n
      .brickR18C12 { grid-area: brickR18C12; } \n
      .brickR18C13 { grid-area: brickR18C13; } \n
      .brickR18C14 { grid-area: brickR18C14; } \n
      .brickR18C15 { grid-area: brickR18C15; } \n
      .brickR18C16 { grid-area: brickR18C16; } \n
      .brickR18C17 { grid-area: brickR18C17; } \n
      .brickR18C18 { grid-area: brickR18C18; } \n
      .brickR19C1 { grid-area: brickR19C1; } \n
      .brickR19C2 { grid-area: brickR19C2; } \n
      .brickR19C3 { grid-area: brickR19C3; } \n
      .brickR19C4 { grid-area: brickR19C4; } \n
      .brickR19C5 { grid-area: brickR19C5; } \n
      .brickR19C6 { grid-area: brickR19C6; } \n
      .brickR19C7 { grid-area: brickR19C7; } \n
      .brickR19C8 { grid-area: brickR19C8; } \n
      .brickR19C9 { grid-area: brickR19C9; } \n
      .brickR19C10 { grid-area: brickR19C10; } \n
      .brickR19C11 { grid-area: brickR19C11; } \n
      .brickR19C12 { grid-area: brickR19C12; } \n
      .brickR19C13 { grid-area: brickR19C13; } \n
      .brickR19C14 { grid-area: brickR19C14; } \n
      .brickR19C15 { grid-area: brickR19C15; } \n
      .brickR19C16 { grid-area: brickR19C16; } \n
      .brickR19C17 { grid-area: brickR19C17; } \n
      .brickR19C18 { grid-area: brickR19C18; } \n
      .brickR20C1 { grid-area: brickR20C1; } \n
      .brickR20C2 { grid-area: brickR20C2; } \n
      .brickR20C3 { grid-area: brickR20C3; } \n
      .brickR20C4 { grid-area: brickR20C4; } \n
      .brickR20C5 { grid-area: brickR20C5; } \n
      .brickR20C6 { grid-area: brickR20C6; } \n
      .brickR20C7 { grid-area: brickR20C7; } \n
      .brickR20C8 { grid-area: brickR20C8; } \n
      .brickR20C9 { grid-area: brickR20C9; } \n
      .brickR20C10 { grid-area: brickR20C10; } \n
      .brickR20C11 { grid-area: brickR20C11; } \n
      .brickR20C12 { grid-area: brickR20C12; } \n
      .brickR20C13 { grid-area: brickR20C13; } \n
      .brickR20C14 { grid-area: brickR20C14; } \n
      .brickR20C15 { grid-area: brickR20C15; } \n
      .brickR20C16 { grid-area: brickR20C16; } \n
      .brickR20C17 { grid-area: brickR20C17; } \n
      .brickR20C18 { grid-area: brickR20C18; } \n
      .brickR21C1 { grid-area: brickR21C1; } \n
      .brickR21C2 { grid-area: brickR21C2; } \n
      .brickR21C3 { grid-area: brickR21C3; } \n
      .brickR21C4 { grid-area: brickR21C4; } \n
      .brickR21C5 { grid-area: brickR21C5; } \n
      .brickR21C6 { grid-area: brickR21C6; } \n
      .brickR21C7 { grid-area: brickR21C7; } \n
      .brickR21C8 { grid-area: brickR21C8; } \n
      .brickR21C9 { grid-area: brickR21C9; } \n
      .brickR21C10 { grid-area: brickR21C10; } \n
      .brickR21C11 { grid-area: brickR21C11; } \n
      .brickR21C12 { grid-area: brickR21C12; } \n
      .brickR21C13 { grid-area: brickR21C13; } \n
      .brickR21C14 { grid-area: brickR21C14; } \n
      .brickR21C15 { grid-area: brickR21C15; } \n
      .brickR21C16 { grid-area: brickR21C16; } \n
      .brickR21C17 { grid-area: brickR21C17; } \n
      .brickR21C18 { grid-area: brickR21C18; } \n");
    }
    else{
     echo("." . $result[0] . " { grid-area: " . $result[0] . "; }");
     echo("." . $result[1] . " { grid-area: " . $result[1] . "; }");
     echo("." . $result[2] . " { grid-area: " . $result[2] . "; }");
     echo("." . $result[3] . " { grid-area: " . $result[3] . "; }");
     echo("." . $result[4] . " { grid-area: " . $result[4] . "; }");
     echo("." . $result[5] . " { grid-area: " . $result[5] . "; }");
     echo("." . $result[6] . " { grid-area: " . $result[6] . "; }");
     echo("." . $result[7] . " { grid-area: " . $result[7] . "; }");
     echo("." . $result[8] . " { grid-area: " . $result[8] . "; }");
     echo("." . $result[9] . " { grid-area: " . $result[9] . "; }");
     echo("." . $result[10] . " { grid-area: " . $result[10] . "; }");
     echo("." . $result[11] . " { grid-area: " . $result[11] . "; }");
     echo("." . $result[12] . " { grid-area: " . $result[12] . "; }");
     echo("." . $result[13] . " { grid-area: " . $result[13] . "; }");
     echo("." . $result[14] . " { grid-area: " . $result[14] . "; }");
     echo("." . $result[15] . " { grid-area: " . $result[15] . "; }");
     echo("." . $result[16] . " { grid-area: " . $result[16] . "; }");
     echo("." . $result[17] . " { grid-area: " . $result[17] . "; }");
     echo("." . $result[18] . " { grid-area: " . $result[18] . "; }");
     echo("." . $result[19] . " { grid-area: " . $result[19] . "; }");
     echo("." . $result[20] . " { grid-area: " . $result[20] . "; }");
     echo("." . $result[21] . " { grid-area: " . $result[21] . "; }");
     echo("." . $result[22] . " { grid-area: " . $result[22] . "; }");
     echo("." . $result[23] . " { grid-area: " . $result[23] . "; }");
     echo("." . $result[24] . " { grid-area: " . $result[24] . "; }");
     echo("." . $result[25] . " { grid-area: " . $result[25] . "; }");
     echo("." . $result[26] . " { grid-area: " . $result[26] . "; }");
     echo("." . $result[27] . " { grid-area: " . $result[27] . "; }");
     echo("." . $result[28] . " { grid-area: " . $result[28] . "; }");
     echo("." . $result[29] . " { grid-area: " . $result[29] . "; }");
     echo("." . $result[30] . " { grid-area: " . $result[30] . "; }");
     echo("." . $result[31] . " { grid-area: " . $result[31] . "; }");
     echo("." . $result[32] . " { grid-area: " . $result[32] . "; }");
     echo("." . $result[33] . " { grid-area: " . $result[33] . "; }");
     echo("." . $result[34] . " { grid-area: " . $result[34] . "; }");
     echo("." . $result[35] . " { grid-area: " . $result[35] . "; }");
     echo("." . $result[36] . " { grid-area: " . $result[36] . "; }");
     echo("." . $result[37] . " { grid-area: " . $result[37] . "; }");
     echo("." . $result[38] . " { grid-area: " . $result[38] . "; }");
     echo("." . $result[39] . " { grid-area: " . $result[39] . "; }");
     echo("." . $result[40] . " { grid-area: " . $result[40] . "; }");
     echo("." . $result[41] . " { grid-area: " . $result[41] . "; }");
     echo("." . $result[42] . " { grid-area: " . $result[42] . "; }");
     echo("." . $result[43] . " { grid-area: " . $result[43] . "; }");
     echo("." . $result[44] . " { grid-area: " . $result[44] . "; }");
     echo("." . $result[45] . " { grid-area: " . $result[45] . "; }");
     echo("." . $result[46] . " { grid-area: " . $result[46] . "; }");
     echo("." . $result[47] . " { grid-area: " . $result[47] . "; }");
     echo("." . $result[48] . " { grid-area: " . $result[48] . "; }");
     echo("." . $result[49] . " { grid-area: " . $result[49] . "; }");
     echo("." . $result[50] . " { grid-area: " . $result[50] . "; }");
     echo("." . $result[51] . " { grid-area: " . $result[51] . "; }");
     echo("." . $result[52] . " { grid-area: " . $result[52] . "; }");
     echo("." . $result[53] . " { grid-area: " . $result[53] . "; }");
     echo("." . $result[54] . " { grid-area: " . $result[54] . "; }");
     echo("." . $result[55] . " { grid-area: " . $result[55] . "; }");
     echo("." . $result[56] . " { grid-area: " . $result[56] . "; }");
     echo("." . $result[57] . " { grid-area: " . $result[57] . "; }");
     echo("." . $result[58] . " { grid-area: " . $result[58] . "; }");
     echo("." . $result[59] . " { grid-area: " . $result[59] . "; }");
     echo("." . $result[60] . " { grid-area: " . $result[60] . "; }");
     echo("." . $result[61] . " { grid-area: " . $result[61] . "; }");
     echo("." . $result[62] . " { grid-area: " . $result[62] . "; }");
     echo("." . $result[63] . " { grid-area: " . $result[63] . "; }");
     echo("." . $result[64] . " { grid-area: " . $result[64] . "; }");
     echo("." . $result[65] . " { grid-area: " . $result[65] . "; }");
     echo("." . $result[66] . " { grid-area: " . $result[66] . "; }");
     echo("." . $result[67] . " { grid-area: " . $result[67] . "; }");
     echo("." . $result[68] . " { grid-area: " . $result[68] . "; }");
     echo("." . $result[69] . " { grid-area: " . $result[69] . "; }");
     echo("." . $result[70] . " { grid-area: " . $result[70] . "; }");
     echo("." . $result[71] . " { grid-area: " . $result[71] . "; }");
     echo("." . $result[72] . " { grid-area: " . $result[72] . "; }");
     echo("." . $result[73] . " { grid-area: " . $result[73] . "; }");
     echo("." . $result[74] . " { grid-area: " . $result[74] . "; }");
     echo("." . $result[75] . " { grid-area: " . $result[75] . "; }");
     echo("." . $result[76] . " { grid-area: " . $result[76] . "; }");
     echo("." . $result[77] . " { grid-area: " . $result[77] . "; }");
     echo("." . $result[78] . " { grid-area: " . $result[78] . "; }");
     echo("." . $result[79] . " { grid-area: " . $result[79] . "; }");
     echo("." . $result[80] . " { grid-area: " . $result[80] . "; }");
     echo("." . $result[81] . " { grid-area: " . $result[81] . "; }");
     echo("." . $result[82] . " { grid-area: " . $result[82] . "; }");
     echo("." . $result[83] . " { grid-area: " . $result[83] . "; }");
     echo("." . $result[84] . " { grid-area: " . $result[84] . "; }");
     echo("." . $result[85] . " { grid-area: " . $result[85] . "; }");
     echo("." . $result[86] . " { grid-area: " . $result[86] . "; }");
     echo("." . $result[87] . " { grid-area: " . $result[87] . "; }");
     echo("." . $result[88] . " { grid-area: " . $result[88] . "; }");
     echo("." . $result[89] . " { grid-area: " . $result[89] . "; }");
     echo("." . $result[90] . " { grid-area: " . $result[90] . "; }");
     echo("." . $result[91] . " { grid-area: " . $result[91] . "; }");
     echo("." . $result[92] . " { grid-area: " . $result[92] . "; }");
     echo("." . $result[93] . " { grid-area: " . $result[93] . "; }");
     echo("." . $result[94] . " { grid-area: " . $result[94] . "; }");
     echo("." . $result[95] . " { grid-area: " . $result[95] . "; }");
     echo("." . $result[96] . " { grid-area: " . $result[96] . "; }");
     echo("." . $result[97] . " { grid-area: " . $result[97] . "; }");
     echo("." . $result[98] . " { grid-area: " . $result[98] . "; }");
     echo("." . $result[99] . " { grid-area: " . $result[99] . "; }");
     echo("." . $result[100] . " { grid-area: " . $result[100] . "; }");
     echo("." . $result[101] . " { grid-area: " . $result[101] . "; }");
     echo("." . $result[102] . " { grid-area: " . $result[102] . "; }");
     echo("." . $result[103] . " { grid-area: " . $result[103] . "; }");
     echo("." . $result[104] . " { grid-area: " . $result[104] . "; }");
     echo("." . $result[105] . " { grid-area: " . $result[105] . "; }");
     echo("." . $result[106] . " { grid-area: " . $result[106] . "; }");
     echo("." . $result[107] . " { grid-area: " . $result[107] . "; }");
     echo("." . $result[108] . " { grid-area: " . $result[108] . "; }");
     echo("." . $result[109] . " { grid-area: " . $result[109] . "; }");
     echo("." . $result[110] . " { grid-area: " . $result[110] . "; }");
     echo("." . $result[111] . " { grid-area: " . $result[111] . "; }");
     echo("." . $result[112] . " { grid-area: " . $result[112] . "; }");
     echo("." . $result[113] . " { grid-area: " . $result[113] . "; }");
     echo("." . $result[114] . " { grid-area: " . $result[114] . "; }");
     echo("." . $result[115] . " { grid-area: " . $result[115] . "; }");
     echo("." . $result[116] . " { grid-area: " . $result[116] . "; }");
     echo("." . $result[117] . " { grid-area: " . $result[117] . "; }");
     echo("." . $result[118] . " { grid-area: " . $result[118] . "; }");
     echo("." . $result[119] . " { grid-area: " . $result[119] . "; }");
     echo("." . $result[120] . " { grid-area: " . $result[120] . "; }");
     echo("." . $result[121] . " { grid-area: " . $result[121] . "; }");
     echo("." . $result[122] . " { grid-area: " . $result[122] . "; }");
     echo("." . $result[123] . " { grid-area: " . $result[123] . "; }");
     echo("." . $result[124] . " { grid-area: " . $result[124] . "; }");
     echo("." . $result[125] . " { grid-area: " . $result[125] . "; }");
     echo("." . $result[126] . " { grid-area: " . $result[126] . "; }");
     echo("." . $result[127] . " { grid-area: " . $result[127] . "; }");
     echo("." . $result[128] . " { grid-area: " . $result[128] . "; }");
     echo("." . $result[129] . " { grid-area: " . $result[129] . "; }");
     echo("." . $result[130] . " { grid-area: " . $result[130] . "; }");
     echo("." . $result[131] . " { grid-area: " . $result[131] . "; }");
     echo("." . $result[132] . " { grid-area: " . $result[132] . "; }");
     echo("." . $result[133] . " { grid-area: " . $result[133] . "; }");
     echo("." . $result[134] . " { grid-area: " . $result[134] . "; }");
     echo("." . $result[135] . " { grid-area: " . $result[135] . "; }");
     echo("." . $result[136] . " { grid-area: " . $result[136] . "; }");
     echo("." . $result[137] . " { grid-area: " . $result[137] . "; }");
     echo("." . $result[138] . " { grid-area: " . $result[138] . "; }");
     echo("." . $result[139] . " { grid-area: " . $result[139] . "; }");
     echo("." . $result[140] . " { grid-area: " . $result[140] . "; }");
     echo("." . $result[141] . " { grid-area: " . $result[141] . "; }");
     echo("." . $result[142] . " { grid-area: " . $result[142] . "; }");
     echo("." . $result[143] . " { grid-area: " . $result[143] . "; }");
     echo("." . $result[144] . " { grid-area: " . $result[144] . "; }");
     echo("." . $result[145] . " { grid-area: " . $result[145] . "; }");
     echo("." . $result[146] . " { grid-area: " . $result[146] . "; }");
     echo("." . $result[147] . " { grid-area: " . $result[147] . "; }");
     echo("." . $result[148] . " { grid-area: " . $result[148] . "; }");
     echo("." . $result[149] . " { grid-area: " . $result[149] . "; }");
     echo("." . $result[150] . " { grid-area: " . $result[150] . "; }");
     echo("." . $result[151] . " { grid-area: " . $result[151] . "; }");
     echo("." . $result[152] . " { grid-area: " . $result[152] . "; }");
     echo("." . $result[153] . " { grid-area: " . $result[153] . "; }");
     echo("." . $result[154] . " { grid-area: " . $result[154] . "; }");
     echo("." . $result[155] . " { grid-area: " . $result[155] . "; }");
     echo("." . $result[156] . " { grid-area: " . $result[156] . "; }");
     echo("." . $result[157] . " { grid-area: " . $result[157] . "; }");
     echo("." . $result[158] . " { grid-area: " . $result[158] . "; }");
     echo("." . $result[159] . " { grid-area: " . $result[159] . "; }");
     echo("." . $result[160] . " { grid-area: " . $result[160] . "; }");
     echo("." . $result[161] . " { grid-area: " . $result[161] . "; }");
     echo("." . $result[162] . " { grid-area: " . $result[162] . "; }");
     echo("." . $result[163] . " { grid-area: " . $result[163] . "; }");
     echo("." . $result[164] . " { grid-area: " . $result[164] . "; }");
     echo("." . $result[165] . " { grid-area: " . $result[165] . "; }");
     echo("." . $result[166] . " { grid-area: " . $result[166] . "; }");
     echo("." . $result[167] . " { grid-area: " . $result[167] . "; }");
     echo("." . $result[168] . " { grid-area: " . $result[168] . "; }");
     echo("." . $result[169] . " { grid-area: " . $result[169] . "; }");
     echo("." . $result[170] . " { grid-area: " . $result[170] . "; }");
     echo("." . $result[171] . " { grid-area: " . $result[171] . "; }");
     echo("." . $result[172] . " { grid-area: " . $result[172] . "; }");
     echo("." . $result[173] . " { grid-area: " . $result[173] . "; }");
     echo("." . $result[174] . " { grid-area: " . $result[174] . "; }");
     echo("." . $result[175] . " { grid-area: " . $result[175] . "; }");
     echo("." . $result[176] . " { grid-area: " . $result[176] . "; }");
     echo("." . $result[177] . " { grid-area: " . $result[177] . "; }");
     echo("." . $result[178] . " { grid-area: " . $result[178] . "; }");
     echo("." . $result[179] . " { grid-area: " . $result[179] . "; }");
     echo("." . $result[180] . " { grid-area: " . $result[180] . "; }");
     echo("." . $result[181] . " { grid-area: " . $result[181] . "; }");
     echo("." . $result[182] . " { grid-area: " . $result[182] . "; }");
     echo("." . $result[183] . " { grid-area: " . $result[183] . "; }");
     echo("." . $result[184] . " { grid-area: " . $result[184] . "; }");
     echo("." . $result[185] . " { grid-area: " . $result[185] . "; }");
     echo("." . $result[186] . " { grid-area: " . $result[186] . "; }");
     echo("." . $result[187] . " { grid-area: " . $result[187] . "; }");
     echo("." . $result[188] . " { grid-area: " . $result[188] . "; }");
     echo("." . $result[189] . " { grid-area: " . $result[189] . "; }");
     echo("." . $result[190] . " { grid-area: " . $result[190] . "; }");
     echo("." . $result[191] . " { grid-area: " . $result[191] . "; }");
     echo("." . $result[192] . " { grid-area: " . $result[192] . "; }");
     echo("." . $result[193] . " { grid-area: " . $result[193] . "; }");
     echo("." . $result[194] . " { grid-area: " . $result[194] . "; }");
     echo("." . $result[195] . " { grid-area: " . $result[195] . "; }");
     echo("." . $result[196] . " { grid-area: " . $result[196] . "; }");
     echo("." . $result[197] . " { grid-area: " . $result[197] . "; }");
     echo("." . $result[198] . " { grid-area: " . $result[198] . "; }");
     echo("." . $result[199] . " { grid-area: " . $result[199] . "; }");
     echo("." . $result[200] . " { grid-area: " . $result[200] . "; }");
     echo("." . $result[201] . " { grid-area: " . $result[201] . "; }");
     echo("." . $result[202] . " { grid-area: " . $result[202] . "; }");
     echo("." . $result[203] . " { grid-area: " . $result[203] . "; }");
     echo("." . $result[204] . " { grid-area: " . $result[204] . "; }");
     echo("." . $result[205] . " { grid-area: " . $result[205] . "; }");
     echo("." . $result[206] . " { grid-area: " . $result[206] . "; }");
     echo("." . $result[207] . " { grid-area: " . $result[207] . "; }");
     echo("." . $result[208] . " { grid-area: " . $result[208] . "; }");
     echo("." . $result[209] . " { grid-area: " . $result[209] . "; }");
     echo("." . $result[210] . " { grid-area: " . $result[210] . "; }");
     echo("." . $result[211] . " { grid-area: " . $result[211] . "; }");
     echo("." . $result[212] . " { grid-area: " . $result[212] . "; }");
     echo("." . $result[213] . " { grid-area: " . $result[213] . "; }");
     echo("." . $result[214] . " { grid-area: " . $result[214] . "; }");
     echo("." . $result[215] . " { grid-area: " . $result[215] . "; }");
     echo("." . $result[216] . " { grid-area: " . $result[216] . "; }");
     echo("." . $result[217] . " { grid-area: " . $result[217] . "; }");
     echo("." . $result[218] . " { grid-area: " . $result[218] . "; }");
     echo("." . $result[219] . " { grid-area: " . $result[219] . "; }");
     echo("." . $result[220] . " { grid-area: " . $result[220] . "; }");
     echo("." . $result[221] . " { grid-area: " . $result[221] . "; }");
     echo("." . $result[222] . " { grid-area: " . $result[222] . "; }");
     echo("." . $result[223] . " { grid-area: " . $result[223] . "; }");
     echo("." . $result[224] . " { grid-area: " . $result[224] . "; }");
     echo("." . $result[225] . " { grid-area: " . $result[225] . "; }");
     echo("." . $result[226] . " { grid-area: " . $result[226] . "; }");
     echo("." . $result[227] . " { grid-area: " . $result[227] . "; }");
     echo("." . $result[228] . " { grid-area: " . $result[228] . "; }");
     echo("." . $result[229] . " { grid-area: " . $result[229] . "; }");
     echo("." . $result[230] . " { grid-area: " . $result[230] . "; }");
     echo("." . $result[231] . " { grid-area: " . $result[231] . "; }");
     echo("." . $result[232] . " { grid-area: " . $result[232] . "; }");
     echo("." . $result[233] . " { grid-area: " . $result[233] . "; }");
     echo("." . $result[234] . " { grid-area: " . $result[234] . "; }");
     echo("." . $result[235] . " { grid-area: " . $result[235] . "; }");
     echo("." . $result[236] . " { grid-area: " . $result[236] . "; }");
     echo("." . $result[237] . " { grid-area: " . $result[237] . "; }");
     echo("." . $result[238] . " { grid-area: " . $result[238] . "; }");
     echo("." . $result[239] . " { grid-area: " . $result[239] . "; }");
     echo("." . $result[240] . " { grid-area: " . $result[240] . "; }");
     echo("." . $result[241] . " { grid-area: " . $result[241] . "; }");
     echo("." . $result[242] . " { grid-area: " . $result[242] . "; }");
     echo("." . $result[243] . " { grid-area: " . $result[243] . "; }");
     echo("." . $result[244] . " { grid-area: " . $result[244] . "; }");
     echo("." . $result[245] . " { grid-area: " . $result[245] . "; }");
     echo("." . $result[246] . " { grid-area: " . $result[246] . "; }");
     echo("." . $result[247] . " { grid-area: " . $result[247] . "; }");
     echo("." . $result[248] . " { grid-area: " . $result[248] . "; }");
     echo("." . $result[249] . " { grid-area: " . $result[249] . "; }");
     echo("." . $result[250] . " { grid-area: " . $result[250] . "; }");
     echo("." . $result[251] . " { grid-area: " . $result[251] . "; }");
     echo("." . $result[252] . " { grid-area: " . $result[252] . "; }");
     echo("." . $result[253] . " { grid-area: " . $result[253] . "; }");
     echo("." . $result[254] . " { grid-area: " . $result[254] . "; }");
     echo("." . $result[255] . " { grid-area: " . $result[255] . "; }");
     echo("." . $result[256] . " { grid-area: " . $result[256] . "; }");
     echo("." . $result[257] . " { grid-area: " . $result[257] . "; }");
     echo("." . $result[258] . " { grid-area: " . $result[258] . "; }");
     echo("." . $result[259] . " { grid-area: " . $result[259] . "; }");
     echo("." . $result[260] . " { grid-area: " . $result[260] . "; }");
     echo("." . $result[261] . " { grid-area: " . $result[261] . "; }");
     echo("." . $result[262] . " { grid-area: " . $result[262] . "; }");
     echo("." . $result[263] . " { grid-area: " . $result[263] . "; }");
     echo("." . $result[264] . " { grid-area: " . $result[264] . "; }");
     echo("." . $result[265] . " { grid-area: " . $result[265] . "; }");
     echo("." . $result[266] . " { grid-area: " . $result[266] . "; }");
     echo("." . $result[267] . " { grid-area: " . $result[267] . "; }");
     echo("." . $result[268] . " { grid-area: " . $result[268] . "; }");
     echo("." . $result[269] . " { grid-area: " . $result[269] . "; }");
     echo("." . $result[270] . " { grid-area: " . $result[270] . "; }");
     echo("." . $result[271] . " { grid-area: " . $result[271] . "; }");
     echo("." . $result[272] . " { grid-area: " . $result[272] . "; }");
     echo("." . $result[273] . " { grid-area: " . $result[273] . "; }");
     echo("." . $result[274] . " { grid-area: " . $result[274] . "; }");
     echo("." . $result[275] . " { grid-area: " . $result[275] . "; }");
     echo("." . $result[276] . " { grid-area: " . $result[276] . "; }");
     echo("." . $result[277] . " { grid-area: " . $result[277] . "; }");
     echo("." . $result[278] . " { grid-area: " . $result[278] . "; }");
     echo("." . $result[279] . " { grid-area: " . $result[279] . "; }");
     echo("." . $result[280] . " { grid-area: " . $result[280] . "; }");
     echo("." . $result[281] . " { grid-area: " . $result[281] . "; }");
     echo("." . $result[282] . " { grid-area: " . $result[282] . "; }");
     echo("." . $result[283] . " { grid-area: " . $result[283] . "; }");
     echo("." . $result[284] . " { grid-area: " . $result[284] . "; }");
     echo("." . $result[285] . " { grid-area: " . $result[285] . "; }");
     echo("." . $result[286] . " { grid-area: " . $result[286] . "; }");
     echo("." . $result[287] . " { grid-area: " . $result[287] . "; }");
     echo("." . $result[288] . " { grid-area: " . $result[288] . "; }");
     echo("." . $result[289] . " { grid-area: " . $result[289] . "; }");
     echo("." . $result[290] . " { grid-area: " . $result[290] . "; }");
     echo("." . $result[291] . " { grid-area: " . $result[291] . "; }");
     echo("." . $result[292] . " { grid-area: " . $result[292] . "; }");
     echo("." . $result[293] . " { grid-area: " . $result[293] . "; }");
     echo("." . $result[294] . " { grid-area: " . $result[294] . "; }");
     echo("." . $result[295] . " { grid-area: " . $result[295] . "; }");
     echo("." . $result[296] . " { grid-area: " . $result[296] . "; }");
     echo("." . $result[297] . " { grid-area: " . $result[297] . "; }");
     echo("." . $result[298] . " { grid-area: " . $result[298] . "; }");
     echo("." . $result[299] . " { grid-area: " . $result[299] . "; }");
     echo("." . $result[300] . " { grid-area: " . $result[300] . "; }");
     echo("." . $result[301] . " { grid-area: " . $result[301] . "; }");
     echo("." . $result[302] . " { grid-area: " . $result[302] . "; }");
     echo("." . $result[303] . " { grid-area: " . $result[303] . "; }");
     echo("." . $result[304] . " { grid-area: " . $result[304] . "; }");
     echo("." . $result[305] . " { grid-area: " . $result[305] . "; }");
     echo("." . $result[306] . " { grid-area: " . $result[306] . "; }");
     echo("." . $result[307] . " { grid-area: " . $result[307] . "; }");
     echo("." . $result[308] . " { grid-area: " . $result[308] . "; }");
     echo("." . $result[309] . " { grid-area: " . $result[309] . "; }");
     echo("." . $result[310] . " { grid-area: " . $result[310] . "; }");
     echo("." . $result[311] . " { grid-area: " . $result[311] . "; }");
     echo("." . $result[312] . " { grid-area: " . $result[312] . "; }");
     echo("." . $result[313] . " { grid-area: " . $result[313] . "; }");
     echo("." . $result[314] . " { grid-area: " . $result[314] . "; }");
     echo("." . $result[315] . " { grid-area: " . $result[315] . "; }");
     echo("." . $result[316] . " { grid-area: " . $result[316] . "; }");
     echo("." . $result[317] . " { grid-area: " . $result[317] . "; }");
     echo("." . $result[318] . " { grid-area: " . $result[318] . "; }");
     echo("." . $result[319] . " { grid-area: " . $result[319] . "; }");
     echo("." . $result[320] . " { grid-area: " . $result[320] . "; }");
     echo("." . $result[321] . " { grid-area: " . $result[321] . "; }");
     echo("." . $result[322] . " { grid-area: " . $result[322] . "; }");
     echo("." . $result[323] . " { grid-area: " . $result[323] . "; }");
     echo("." . $result[324] . " { grid-area: " . $result[324] . "; }");
     echo("." . $result[325] . " { grid-area: " . $result[325] . "; }");
     echo("." . $result[326] . " { grid-area: " . $result[326] . "; }");
     echo("." . $result[327] . " { grid-area: " . $result[327] . "; }");
     echo("." . $result[328] . " { grid-area: " . $result[328] . "; }");
     echo("." . $result[329] . " { grid-area: " . $result[329] . "; }");
     echo("." . $result[330] . " { grid-area: " . $result[330] . "; }");
     echo("." . $result[331] . " { grid-area: " . $result[331] . "; }");
     echo("." . $result[332] . " { grid-area: " . $result[332] . "; }");
     echo("." . $result[333] . " { grid-area: " . $result[333] . "; }");
     echo("." . $result[334] . " { grid-area: " . $result[334] . "; }");
     echo("." . $result[335] . " { grid-area: " . $result[335] . "; }");
     echo("." . $result[336] . " { grid-area: " . $result[336] . "; }");
     echo("." . $result[337] . " { grid-area: " . $result[337] . "; }");
     echo("." . $result[338] . " { grid-area: " . $result[338] . "; }");
     echo("." . $result[339] . " { grid-area: " . $result[339] . "; }");
     echo("." . $result[340] . " { grid-area: " . $result[340] . "; }");
     echo("." . $result[341] . " { grid-area: " . $result[341] . "; }");
     echo("." . $result[342] . " { grid-area: " . $result[342] . "; }");
     echo("." . $result[343] . " { grid-area: " . $result[343] . "; }");
     echo("." . $result[344] . " { grid-area: " . $result[344] . "; }");
     echo("." . $result[345] . " { grid-area: " . $result[345] . "; }");
     echo("." . $result[346] . " { grid-area: " . $result[346] . "; }");
     echo("." . $result[347] . " { grid-area: " . $result[347] . "; }");
     echo("." . $result[348] . " { grid-area: " . $result[348] . "; }");
     echo("." . $result[349] . " { grid-area: " . $result[349] . "; }");
     echo("." . $result[350] . " { grid-area: " . $result[350] . "; }");
     echo("." . $result[351] . " { grid-area: " . $result[351] . "; }");
     echo("." . $result[352] . " { grid-area: " . $result[352] . "; }");
     echo("." . $result[353] . " { grid-area: " . $result[353] . "; }");
     echo("." . $result[354] . " { grid-area: " . $result[354] . "; }");
     echo("." . $result[355] . " { grid-area: " . $result[355] . "; }");
     echo("." . $result[356] . " { grid-area: " . $result[356] . "; }");
     echo("." . $result[357] . " { grid-area: " . $result[357] . "; }");
     echo("." . $result[358] . " { grid-area: " . $result[358] . "; }");
     echo("." . $result[359] . " { grid-area: " . $result[359] . "; }");
     echo("." . $result[360] . " { grid-area: " . $result[360] . "; }");
     echo("." . $result[361] . " { grid-area: " . $result[361] . "; }");
     echo("." . $result[362] . " { grid-area: " . $result[362] . "; }");
     echo("." . $result[363] . " { grid-area: " . $result[363] . "; }");
     echo("." . $result[364] . " { grid-area: " . $result[364] . "; }");
     echo("." . $result[365] . " { grid-area: " . $result[365] . "; }");
     echo("." . $result[366] . " { grid-area: " . $result[366] . "; }");
     echo("." . $result[367] . " { grid-area: " . $result[367] . "; }");
     echo("." . $result[368] . " { grid-area: " . $result[368] . "; }");
     echo("." . $result[369] . " { grid-area: " . $result[369] . "; }");
     echo("." . $result[370] . " { grid-area: " . $result[370] . "; }");
     echo("." . $result[371] . " { grid-area: " . $result[371] . "; }");
     echo("." . $result[372] . " { grid-area: " . $result[372] . "; }");
     echo("." . $result[373] . " { grid-area: " . $result[373] . "; }");
     echo("." . $result[374] . " { grid-area: " . $result[374] . "; }");
     echo("." . $result[375] . " { grid-area: " . $result[375] . "; }");
     echo("." . $result[376] . " { grid-area: " . $result[376] . "; }");
     echo("." . $result[377] . " { grid-area: " . $result[377] . "; }");
    }
    ?>
    
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
           <?php if($checkBoxStatus == true){
             echo('<!-- Row 1 -->
             <div class="brickStyle brickR1C1" id="a001" onclick="brickClicked(\'a001\')"></div>
             <div class="brickStyle brickR1C2" id="a002" onclick="brickClicked(\'a002\')"></div>
             <div class="brickStyle brickR1C3" id="a003" onclick="brickClicked(\'a003\')"></div>
             <div class="brickStyle brickR1C4" id="a004" onclick="brickClicked(\'a004\')"></div>
             <div class="brickStyle brickR1C5" id="a005" onclick="brickClicked(\'a005\')"></div>
             <div class="brickStyle brickR1C6" id="a006" onclick="brickClicked(\'a006\')"></div>
             <div class="brickStyle brickR1C7" id="a007" onclick="brickClicked(\'a007\')"></div>
             <div class="brickStyle brickR1C8" id="a008" onclick="brickClicked(\'a008\')"></div>
             <div class="brickStyle brickR1C9" id="a009" onclick="brickClicked(\'a009\')"></div>
             <div class="brickStyle brickR1C10" id="a010" onclick="brickClicked(\'a010\')"></div>
             <div class="brickStyle brickR1C11" id="a011" onclick="brickClicked(\'a011\')"></div>
             <div class="brickStyle brickR1C12" id="a012" onclick="brickClicked(\'a012\')"></div>
             <div class="brickStyle brickR1C13" id="a013" onclick="brickClicked(\'a013\')"></div>
             <div class="brickStyle brickR1C14" id="a014" onclick="brickClicked(\'a014\')"></div>
             <div class="brickStyle brickR1C15" id="a015" onclick="brickClicked(\'a015\')"></div>
             <div class="brickStyle brickR1C16" id="a016" onclick="brickClicked(\'a016\')"></div>
             <div class="brickStyle brickR1C17" id="a017" onclick="brickClicked(\'a017\')"></div>
             <div class="brickStyle brickR1C18" id="a018" onclick="brickClicked(\'a018\')"></div>
             <!-- Row 2 -->
             <div class="brickStyle brickR2C1" id="a019" onclick="brickClicked(\'a019\')"></div>
             <div class="brickStyle brickR2C2" id="a020" onclick="brickClicked(\'a020\')"></div>
             <div class="brickStyle brickR2C3" id="a021" onclick="brickClicked(\'a021\')"></div>
             <div class="brickStyle brickR2C4" id="a022" onclick="brickClicked(\'a022\')"></div>
             <div class="brickStyle brickR2C5" id="a023" onclick="brickClicked(\'a023\')"></div>
             <div class="brickStyle brickR2C6" id="a024" onclick="brickClicked(\'a024\')"></div>
             <div class="brickStyle brickR2C7" id="a025" onclick="brickClicked(\'a025\')"></div>
             <div class="brickStyle brickR2C8" id="a026" onclick="brickClicked(\'a026\')"></div>
             <div class="brickStyle brickR2C9" id="a027" onclick="brickClicked(\'a027\')"></div>
             <div class="brickStyle brickR2C10" id="a028" onclick="brickClicked(\'a028\')"></div>
             <div class="brickStyle brickR2C11" id="a029" onclick="brickClicked(\'a029\')"></div>
             <div class="brickStyle brickR2C12" id="a030" onclick="brickClicked(\'a030\')"></div>
             <div class="brickStyle brickR2C13" id="a031" onclick="brickClicked(\'a031\')"></div>
             <div class="brickStyle brickR2C14" id="a032" onclick="brickClicked(\'a032\')"></div>
             <div class="brickStyle brickR2C15" id="a033" onclick="brickClicked(\'a033\')"></div>
             <div class="brickStyle brickR2C16" id="a034" onclick="brickClicked(\'a034\')"></div>
             <div class="brickStyle brickR2C17" id="a035" onclick="brickClicked(\'a035\')"></div>
             <div class="brickStyle brickR2C18" id="a036" onclick="brickClicked(\'a036\')"></div>
             <!-- Row 3 -->
             <div class="brickStyle brickR3C1" id="a037" onclick="brickClicked(\'a037\')"></div>
             <div class="brickStyle brickR3C2" id="a038" onclick="brickClicked(\'a038\')"></div>
             <div class="brickStyle brickR3C3" id="a039" onclick="brickClicked(\'a039\')"></div>
             <div class="brickStyle brickR3C4" id="a040" onclick="brickClicked(\'a040\')"></div>
             <div class="brickStyle brickR3C5" id="a041" onclick="brickClicked(\'a041\')"></div>
             <div class="brickStyle brickR3C6" id="a042" onclick="brickClicked(\'a042\')"></div>
             <div class="brickStyle brickR3C7" id="a043" onclick="brickClicked(\'a043\')"></div>
             <div class="brickStyle brickR3C8" id="a044" onclick="brickClicked(\'a044\')"></div>
             <div class="brickStyle brickR3C9" id="a045" onclick="brickClicked(\'a045\')"></div>
             <div class="brickStyle brickR3C10" id="a046" onclick="brickClicked(\'a046\')"></div>
             <div class="brickStyle brickR3C11" id="a047" onclick="brickClicked(\'a047\')"></div>
             <div class="brickStyle brickR3C12" id="a048" onclick="brickClicked(\'a048\')"></div>
             <div class="brickStyle brickR3C13" id="a049" onclick="brickClicked(\'a049\')"></div>
             <div class="brickStyle brickR3C14" id="a050" onclick="brickClicked(\'a050\')"></div>
             <div class="brickStyle brickR3C15" id="a051" onclick="brickClicked(\'a051\')"></div>
             <div class="brickStyle brickR3C16" id="a052" onclick="brickClicked(\'a052\')"></div>
             <div class="brickStyle brickR3C17" id="a053" onclick="brickClicked(\'a053\')"></div>
             <div class="brickStyle brickR3C18" id="a054" onclick="brickClicked(\'a054\')"></div>
             <!-- Row 4 -->
             <div class="brickStyle brickR4C1" id="a055" onclick="brickClicked(\'a055\')"></div>
             <div class="brickStyle brickR4C2" id="a056" onclick="brickClicked(\'a056\')"></div>
             <div class="brickStyle brickR4C3" id="a057" onclick="brickClicked(\'a057\')"></div>
             <div class="brickStyle brickR4C4" id="a058" onclick="brickClicked(\'a058\')"></div>
             <div class="brickStyle brickR4C5" id="a059" onclick="brickClicked(\'a059\')"></div>
             <div class="brickStyle brickR4C6" id="a060" onclick="brickClicked(\'a060\')"></div>
             <div class="brickStyle brickR4C7" id="a061" onclick="brickClicked(\'a061\')"></div>
             <div class="brickStyle brickR4C8" id="a062" onclick="brickClicked(\'a062\')"></div>
             <div class="brickStyle brickR4C9" id="a063" onclick="brickClicked(\'a063\')"></div>
             <div class="brickStyle brickR4C10" id="a064" onclick="brickClicked(\'a064\')"></div>
             <div class="brickStyle brickR4C11" id="a065" onclick="brickClicked(\'a065\')"></div>
             <div class="brickStyle brickR4C12" id="a066" onclick="brickClicked(\'a066\')"></div>
             <div class="brickStyle brickR4C13" id="a067" onclick="brickClicked(\'a067\')"></div>
             <div class="brickStyle brickR4C14" id="a068" onclick="brickClicked(\'a068\')"></div>
             <div class="brickStyle brickR4C15" id="a069" onclick="brickClicked(\'a069\')"></div>
             <div class="brickStyle brickR4C16" id="a070" onclick="brickClicked(\'a070\')"></div>
             <div class="brickStyle brickR4C17" id="a071" onclick="brickClicked(\'a071\')"></div>
             <div class="brickStyle brickR4C18" id="a072" onclick="brickClicked(\'a072\')"></div>
             <!-- Row 5 -->
             <div class="brickStyle brickR5C1" id="a073" onclick="brickClicked(\'a073\')"></div>
             <div class="brickStyle brickR5C2" id="a074" onclick="brickClicked(\'a074\')"></div>
             <div class="brickStyle brickR5C3" id="a075" onclick="brickClicked(\'a075\')"></div>
             <div class="brickStyle brickR5C4" id="a076" onclick="brickClicked(\'a076\')"></div>
             <div class="brickStyle brickR5C5" id="a077" onclick="brickClicked(\'a077\')"></div>
             <div class="brickStyle brickR5C6" id="a078" onclick="brickClicked(\'a078\')"></div>
             <div class="brickStyle brickR5C7" id="a079" onclick="brickClicked(\'a079\')"></div>
             <div class="brickStyle brickR5C8" id="a080" onclick="brickClicked(\'a080\')"></div>
             <div class="brickStyle brickR5C9" id="a081" onclick="brickClicked(\'a081\')"></div>
             <div class="brickStyle brickR5C10" id="a082" onclick="brickClicked(\'a082\')"></div>
             <div class="brickStyle brickR5C11" id="a083" onclick="brickClicked(\'a083\')"></div>
             <div class="brickStyle brickR5C12" id="a084" onclick="brickClicked(\'a084\')"></div>
             <div class="brickStyle brickR5C13" id="a085" onclick="brickClicked(\'a085\')"></div>
             <div class="brickStyle brickR5C14" id="a086" onclick="brickClicked(\'a086\')"></div>
             <div class="brickStyle brickR5C15" id="a087" onclick="brickClicked(\'a087\')"></div>
             <div class="brickStyle brickR5C16" id="a088" onclick="brickClicked(\'a088\')"></div>
             <div class="brickStyle brickR5C17" id="a089" onclick="brickClicked(\'a089\')"></div>
             <div class="brickStyle brickR5C18" id="a090" onclick="brickClicked(\'a090\')"></div>
             <!-- Row 6 -->
             <div class="brickStyle brickR6C1" id="a091" onclick="brickClicked(\'a091\')"></div>
             <div class="brickStyle brickR6C2" id="a092" onclick="brickClicked(\'a092\')"></div>
             <div class="brickStyle brickR6C3" id="a093" onclick="brickClicked(\'a093\')"></div>
             <div class="brickStyle brickR6C4" id="a094" onclick="brickClicked(\'a094\')"></div>
             <div class="brickStyle brickR6C5" id="a095" onclick="brickClicked(\'a095\')"></div>
             <div class="brickStyle brickR6C6" id="a096" onclick="brickClicked(\'a096\')"></div>
             <div class="brickStyle brickR6C7" id="a097" onclick="brickClicked(\'a097\')"></div>
             <div class="brickStyle brickR6C8" id="a098" onclick="brickClicked(\'a098\')"></div>
             <div class="brickStyle brickR6C9" id="a099" onclick="brickClicked(\'a099\')"></div>
             <div class="brickStyle brickR6C10" id="a100" onclick="brickClicked(\'a100\')"></div>
             <div class="brickStyle brickR6C11" id="a101" onclick="brickClicked(\'a101\')"></div>
             <div class="brickStyle brickR6C12" id="a102" onclick="brickClicked(\'a102\')"></div>
             <div class="brickStyle brickR6C13" id="a103" onclick="brickClicked(\'a103\')"></div>
             <div class="brickStyle brickR6C14" id="a104" onclick="brickClicked(\'a104\')"></div>
             <div class="brickStyle brickR6C15" id="a105" onclick="brickClicked(\'a105\')"></div>
             <div class="brickStyle brickR6C16" id="a106" onclick="brickClicked(\'a106\')"></div>
             <div class="brickStyle brickR6C17" id="a107" onclick="brickClicked(\'a107\')"></div>
             <div class="brickStyle brickR6C18" id="a108" onclick="brickClicked(\'a108\')"></div>
             <!-- Row 7 -->
             <div class="brickStyle brickR7C1" id="a109" onclick="brickClicked(\'a109\')"></div>
             <div class="brickStyle brickR7C2" id="a110" onclick="brickClicked(\'a110\')"></div>
             <div class="brickStyle brickR7C3" id="a111" onclick="brickClicked(\'a111\')"></div>
             <div class="brickStyle brickR7C4" id="a112" onclick="brickClicked(\'a112\')"></div>
             <div class="brickStyle brickR7C5" id="a113" onclick="brickClicked(\'a113\')"></div>
             <div class="brickStyle brickR7C6" id="a114" onclick="brickClicked(\'a114\')"></div>
             <div class="brickStyle brickR7C7" id="a115" onclick="brickClicked(\'a115\')"></div>
             <div class="brickStyle brickR7C8" id="a116" onclick="brickClicked(\'a116\')"></div>
             <div class="brickStyle brickR7C9" id="a117" onclick="brickClicked(\'a117\')"></div>
             <div class="brickStyle brickR7C10" id="a118" onclick="brickClicked(\'a118\')"></div>
             <div class="brickStyle brickR7C11" id="a119" onclick="brickClicked(\'a119\')"></div>
             <div class="brickStyle brickR7C12" id="a120" onclick="brickClicked(\'a120\')"></div>
             <div class="brickStyle brickR7C13" id="a121" onclick="brickClicked(\'a121\')"></div>
             <div class="brickStyle brickR7C14" id="a122" onclick="brickClicked(\'a122\')"></div>
             <div class="brickStyle brickR7C15" id="a123" onclick="brickClicked(\'a123\')"></div>
             <div class="brickStyle brickR7C16" id="a124" onclick="brickClicked(\'a124\')"></div>
             <div class="brickStyle brickR7C17" id="a125" onclick="brickClicked(\'a125\')"></div>
             <div class="brickStyle brickR7C18" id="a126" onclick="brickClicked(\'a126\')"></div>
             <!-- Row 8 -->
             <div class="brickStyle brickR8C1" id="a127" onclick="brickClicked(\'a127\')"></div>
             <div class="brickStyle brickR8C2" id="a128" onclick="brickClicked(\'a128\')"></div>
             <div class="brickStyle brickR8C3" id="a129" onclick="brickClicked(\'a129\')"></div>
             <div class="brickStyle brickR8C4" id="a130" onclick="brickClicked(\'a130\')"></div>
             <div class="brickStyle brickR8C5" id="a131" onclick="brickClicked(\'a131\')"></div>
             <div class="brickStyle brickR8C6" id="a132" onclick="brickClicked(\'a132\')"></div>
             <div class="brickStyle brickR8C7" id="a133" onclick="brickClicked(\'a133\')"></div>
             <div class="brickStyle brickR8C8" id="a134" onclick="brickClicked(\'a134\')"></div>
             <div class="brickStyle brickR8C9" id="a135" onclick="brickClicked(\'a135\')"></div>
             <div class="brickStyle brickR8C10" id="a136" onclick="brickClicked(\'a136\')"></div>
             <div class="brickStyle brickR8C11" id="a137" onclick="brickClicked(\'a137\')"></div>
             <div class="brickStyle brickR8C12" id="a138" onclick="brickClicked(\'a138\')"></div>
             <div class="brickStyle brickR8C13" id="a139" onclick="brickClicked(\'a139\')"></div>
             <div class="brickStyle brickR8C14" id="a140" onclick="brickClicked(\'a140\')"></div>
             <div class="brickStyle brickR8C15" id="a141" onclick="brickClicked(\'a141\')"></div>
             <div class="brickStyle brickR8C16" id="a142" onclick="brickClicked(\'a142\')"></div>
             <div class="brickStyle brickR8C17" id="a143" onclick="brickClicked(\'a143\')"></div>
             <div class="brickStyle brickR8C18" id="a144" onclick="brickClicked(\'a144\')"></div>
             <!-- Row 9 -->
             <div class="brickStyle brickR9C1" id="a145" onclick="brickClicked(\'a145\')"></div>
             <div class="brickStyle brickR9C2" id="a146" onclick="brickClicked(\'a146\')"></div>
             <div class="brickStyle brickR9C3" id="a147" onclick="brickClicked(\'a147\')"></div>
             <div class="brickStyle brickR9C4" id="a148" onclick="brickClicked(\'a148\')"></div>
             <div class="brickStyle brickR9C5" id="a149" onclick="brickClicked(\'a149\')"></div>
             <div class="brickStyle brickR9C6" id="a150" onclick="brickClicked(\'a150\')"></div>
             <div class="brickStyle brickR9C7" id="a151" onclick="brickClicked(\'a151\')"></div>
             <div class="brickStyle brickR9C8" id="a152" onclick="brickClicked(\'a152\')"></div>
             <div class="brickStyle brickR9C9" id="a153" onclick="brickClicked(\'a153\')"></div>
             <div class="brickStyle brickR9C10" id="a154" onclick="brickClicked(\'a154\')"></div>
             <div class="brickStyle brickR9C11" id="a155" onclick="brickClicked(\'a155\')"></div>
             <div class="brickStyle brickR9C12" id="a156" onclick="brickClicked(\'a156\')"></div>
             <div class="brickStyle brickR9C13" id="a157" onclick="brickClicked(\'a157\')"></div>
             <div class="brickStyle brickR9C14" id="a158" onclick="brickClicked(\'a158\')"></div>
             <div class="brickStyle brickR9C15" id="a159" onclick="brickClicked(\'a159\')"></div>
             <div class="brickStyle brickR9C16" id="a160" onclick="brickClicked(\'a160\')"></div>
             <div class="brickStyle brickR9C17" id="a161" onclick="brickClicked(\'a161\')"></div>
             <div class="brickStyle brickR9C18" id="a162" onclick="brickClicked(\'a162\')"></div>
             <!-- Row 10 -->
             <div class="brickStyle brickR10C1" id="a163" onclick="brickClicked(\'a163\')"></div>
             <div class="brickStyle brickR10C2" id="a164" onclick="brickClicked(\'a164\')"></div>
             <div class="brickStyle brickR10C3" id="a165" onclick="brickClicked(\'a165\')"></div>
             <div class="brickStyle brickR10C4" id="a166" onclick="brickClicked(\'a166\')"></div>
             <div class="brickStyle brickR10C5" id="a167" onclick="brickClicked(\'a167\')"></div>
             <div class="brickStyle brickR10C6" id="a168" onclick="brickClicked(\'a168\')"></div>
             <div class="brickStyle brickR10C7" id="a169" onclick="brickClicked(\'a169\')"></div>
             <div class="brickStyle brickR10C8" id="a170" onclick="brickClicked(\'a170\')"></div>
             <div class="brickStyle brickR10C9" id="a171" onclick="brickClicked(\'a171\')"></div>
             <div class="brickStyle brickR10C10" id="a172" onclick="brickClicked(\'a172\')"></div>
             <div class="brickStyle brickR10C11" id="a173" onclick="brickClicked(\'a173\')"></div>
             <div class="brickStyle brickR10C12" id="a174" onclick="brickClicked(\'a174\')"></div>
             <div class="brickStyle brickR10C13" id="a175" onclick="brickClicked(\'a175\')"></div>
             <div class="brickStyle brickR10C14" id="a176" onclick="brickClicked(\'a176\')"></div>
             <div class="brickStyle brickR10C15" id="a177" onclick="brickClicked(\'a177\')"></div>
             <div class="brickStyle brickR10C16" id="a178" onclick="brickClicked(\'a178\')"></div>
             <div class="brickStyle brickR10C17" id="a179" onclick="brickClicked(\'a179\')"></div>
             <div class="brickStyle brickR10C18" id="a180" onclick="brickClicked(\'a180\')"></div>
             <!-- Row 11 -->
             <div class="brickStyle brickR11C1" id="a181" onclick="brickClicked(\'a181\')"></div>
             <div class="brickStyle brickR11C2" id="a182" onclick="brickClicked(\'a182\')"></div>
             <div class="brickStyle brickR11C3" id="a183" onclick="brickClicked(\'a183\')"></div>
             <div class="brickStyle brickR11C4" id="a184" onclick="brickClicked(\'a184\')"></div>
             <div class="brickStyle brickR11C5" id="a185" onclick="brickClicked(\'a185\')"></div>
             <div class="brickStyle brickR11C6" id="a186" onclick="brickClicked(\'a186\')"></div>
             <div class="brickStyle brickR11C7" id="a187" onclick="brickClicked(\'a187\')"></div>
             <div class="brickStyle brickR11C8" id="a188" onclick="brickClicked(\'a188\')"></div>
             <div class="brickStyle brickR11C9" id="a189" onclick="brickClicked(\'a189\')"></div>
             <div class="brickStyle brickR11C10" id="a190" onclick="brickClicked(\'a190\')"></div>
             <div class="brickStyle brickR11C11" id="a191" onclick="brickClicked(\'a191\')"></div>
             <div class="brickStyle brickR11C12" id="a192" onclick="brickClicked(\'a192\')"></div>
             <div class="brickStyle brickR11C13" id="a193" onclick="brickClicked(\'a193\')"></div>
             <div class="brickStyle brickR11C14" id="a194" onclick="brickClicked(\'a194\')"></div>
             <div class="brickStyle brickR11C15" id="a195" onclick="brickClicked(\'a195\')"></div>
             <div class="brickStyle brickR11C16" id="a196" onclick="brickClicked(\'a196\')"></div>
             <div class="brickStyle brickR11C17" id="a197" onclick="brickClicked(\'a197\')"></div>
             <div class="brickStyle brickR11C18" id="a198" onclick="brickClicked(\'a198\')"></div>
             <!-- Row 12 -->
             <div class="brickStyle brickR12C1" id="a199" onclick="brickClicked(\'a199\')"></div>
             <div class="brickStyle brickR12C2" id="a200" onclick="brickClicked(\'a200\')"></div>
             <div class="brickStyle brickR12C3" id="a201" onclick="brickClicked(\'a201\')"></div>
             <div class="brickStyle brickR12C4" id="a202" onclick="brickClicked(\'a202\')"></div>
             <div class="brickStyle brickR12C5" id="a203" onclick="brickClicked(\'a203\')"></div>
             <div class="brickStyle brickR12C6" id="a204" onclick="brickClicked(\'a204\')"></div>
             <div class="brickStyle brickR12C7" id="a205" onclick="brickClicked(\'a205\')"></div>
             <div class="brickStyle brickR12C8" id="a206" onclick="brickClicked(\'a206\')"></div>
             <div class="brickStyle brickR12C9" id="a207" onclick="brickClicked(\'a207\')"></div>
             <div class="brickStyle brickR12C10" id="a208" onclick="brickClicked(\'a208\')"></div>
             <div class="brickStyle brickR12C11" id="a209" onclick="brickClicked(\'a209\')"></div>
             <div class="brickStyle brickR12C12" id="a210" onclick="brickClicked(\'a210\')"></div>
             <div class="brickStyle brickR12C13" id="a211" onclick="brickClicked(\'a211\')"></div>
             <div class="brickStyle brickR12C14" id="a212" onclick="brickClicked(\'a212\')"></div>
             <div class="brickStyle brickR12C15" id="a213" onclick="brickClicked(\'a213\')"></div>
             <div class="brickStyle brickR12C16" id="a214" onclick="brickClicked(\'a214\')"></div>
             <div class="brickStyle brickR12C17" id="a215" onclick="brickClicked(\'a215\')"></div>
             <div class="brickStyle brickR12C18" id="a216" onclick="brickClicked(\'a216\')"></div>
             <!-- Row 13 -->
             <div class="brickStyle brickR13C1" id="a217" onclick="brickClicked(\'a217\')"></div>
             <div class="brickStyle brickR13C2" id="a218" onclick="brickClicked(\'a218\')"></div>
             <div class="brickStyle brickR13C3" id="a219" onclick="brickClicked(\'a219\')"></div>
             <div class="brickStyle brickR13C4" id="a220" onclick="brickClicked(\'a220\')"></div>
             <div class="brickStyle brickR13C5" id="a221" onclick="brickClicked(\'a221\')"></div>
             <div class="brickStyle brickR13C6" id="a222" onclick="brickClicked(\'a222\')"></div>
             <div class="brickStyle brickR13C7" id="a223" onclick="brickClicked(\'a223\')"></div>
             <div class="brickStyle brickR13C8" id="a224" onclick="brickClicked(\'a224\')"></div>
             <div class="brickStyle brickR13C9" id="a225" onclick="brickClicked(\'a225\')"></div>
             <div class="brickStyle brickR13C10" id="a226" onclick="brickClicked(\'a226\')"></div>
             <div class="brickStyle brickR13C11" id="a227" onclick="brickClicked(\'a227\')"></div>
             <div class="brickStyle brickR13C12" id="a228" onclick="brickClicked(\'a228\')"></div>
             <div class="brickStyle brickR13C13" id="a229" onclick="brickClicked(\'a229\')"></div>
             <div class="brickStyle brickR13C14" id="a230" onclick="brickClicked(\'a230\')"></div>
             <div class="brickStyle brickR13C15" id="a231" onclick="brickClicked(\'a231\')"></div>
             <div class="brickStyle brickR13C16" id="a232" onclick="brickClicked(\'a232\')"></div>
             <div class="brickStyle brickR13C17" id="a233" onclick="brickClicked(\'a233\')"></div>
             <div class="brickStyle brickR13C18" id="a234" onclick="brickClicked(\'a234\')"></div>
             <!-- Row 14 -->
             <div class="brickStyle brickR14C1" id="a235" onclick="brickClicked(\'a235\')"></div>
             <div class="brickStyle brickR14C2" id="a236" onclick="brickClicked(\'a236\')"></div>
             <div class="brickStyle brickR14C3" id="a237" onclick="brickClicked(\'a237\')"></div>
             <div class="brickStyle brickR14C4" id="a238" onclick="brickClicked(\'a238\')"></div>
             <div class="brickStyle brickR14C5" id="a239" onclick="brickClicked(\'a239\')"></div>
             <div class="brickStyle brickR14C6" id="a240" onclick="brickClicked(\'a240\')"></div>
             <div class="brickStyle brickR14C7" id="a241" onclick="brickClicked(\'a241\')"></div>
             <div class="brickStyle brickR14C8" id="a242" onclick="brickClicked(\'a242\')"></div>
             <div class="brickStyle brickR14C9" id="a243" onclick="brickClicked(\'a243\')"></div>
             <div class="brickStyle brickR14C10" id="a244" onclick="brickClicked(\'a244\')"></div>
             <div class="brickStyle brickR14C11" id="a245" onclick="brickClicked(\'a245\')"></div>
             <div class="brickStyle brickR14C12" id="a246" onclick="brickClicked(\'a246\')"></div>
             <div class="brickStyle brickR14C13" id="a247" onclick="brickClicked(\'a247\')"></div>
             <div class="brickStyle brickR14C14" id="a248" onclick="brickClicked(\'a248\')"></div>
             <div class="brickStyle brickR14C15" id="a249" onclick="brickClicked(\'a249\')"></div>
             <div class="brickStyle brickR14C16" id="a250" onclick="brickClicked(\'a250\')"></div>
             <div class="brickStyle brickR14C17" id="a251" onclick="brickClicked(\'a251\')"></div>
             <div class="brickStyle brickR14C18" id="a252" onclick="brickClicked(\'a252\')"></div>
             <!-- Row 15 -->
             <div class="brickStyle brickR15C1" id="a253" onclick="brickClicked(\'a253\')"></div>
             <div class="brickStyle brickR15C2" id="a254" onclick="brickClicked(\'a254\')"></div>
             <div class="brickStyle brickR15C3" id="a255" onclick="brickClicked(\'a255\')"></div>
             <div class="brickStyle brickR15C4" id="a256" onclick="brickClicked(\'a256\')"></div>
             <div class="brickStyle brickR15C5" id="a257" onclick="brickClicked(\'a257\')"></div>
             <div class="brickStyle brickR15C6" id="a258" onclick="brickClicked(\'a258\')"></div>
             <div class="brickStyle brickR15C7" id="a259" onclick="brickClicked(\'a259\')"></div>
             <div class="brickStyle brickR15C8" id="a260" onclick="brickClicked(\'a260\')"></div>
             <div class="brickStyle brickR15C9" id="a261" onclick="brickClicked(\'a261\')"></div>
             <div class="brickStyle brickR15C10" id="a262" onclick="brickClicked(\'a262\')"></div>
             <div class="brickStyle brickR15C11" id="a263" onclick="brickClicked(\'a263\')"></div>
             <div class="brickStyle brickR15C12" id="a264" onclick="brickClicked(\'a264\')"></div>
             <div class="brickStyle brickR15C13" id="a265" onclick="brickClicked(\'a265\')"></div>
             <div class="brickStyle brickR15C14" id="a266" onclick="brickClicked(\'a266\')"></div>
             <div class="brickStyle brickR15C15" id="a267" onclick="brickClicked(\'a267\')"></div>
             <div class="brickStyle brickR15C16" id="a268" onclick="brickClicked(\'a268\')"></div>
             <div class="brickStyle brickR15C17" id="a269" onclick="brickClicked(\'a269\')"></div>
             <div class="brickStyle brickR15C18" id="a270" onclick="brickClicked(\'a270\')"></div>
             <!-- Row 16 -->
             <div class="brickStyle brickR16C1" id="a271" onclick="brickClicked(\'a271\')"></div>
             <div class="brickStyle brickR16C2" id="a272" onclick="brickClicked(\'a272\')"></div>
             <div class="brickStyle brickR16C3" id="a273" onclick="brickClicked(\'a273\')"></div>
             <div class="brickStyle brickR16C4" id="a274" onclick="brickClicked(\'a274\')"></div>
             <div class="brickStyle brickR16C5" id="a275" onclick="brickClicked(\'a275\')"></div>
             <div class="brickStyle brickR16C6" id="a276" onclick="brickClicked(\'a276\')"></div>
             <div class="brickStyle brickR16C7" id="a277" onclick="brickClicked(\'a277\')"></div>
             <div class="brickStyle brickR16C8" id="a278" onclick="brickClicked(\'a278\')"></div>
             <div class="brickStyle brickR16C9" id="a279" onclick="brickClicked(\'a279\')"></div>
             <div class="brickStyle brickR16C10" id="a280" onclick="brickClicked(\'a280\')"></div>
             <div class="brickStyle brickR16C11" id="a281" onclick="brickClicked(\'a281\')"></div>
             <div class="brickStyle brickR16C12" id="a282" onclick="brickClicked(\'a282\')"></div>
             <div class="brickStyle brickR16C13" id="a283" onclick="brickClicked(\'a283\')"></div>
             <div class="brickStyle brickR16C14" id="a284" onclick="brickClicked(\'a284\')"></div>
             <div class="brickStyle brickR16C15" id="a285" onclick="brickClicked(\'a285\')"></div>
             <div class="brickStyle brickR16C16" id="a286" onclick="brickClicked(\'a286\')"></div>
             <div class="brickStyle brickR16C17" id="a287" onclick="brickClicked(\'a287\')"></div>
             <div class="brickStyle brickR16C18" id="a288" onclick="brickClicked(\'a288\')"></div>
             <!-- Row 17 -->
             <div class="brickStyle brickR17C1" id="a289" onclick="brickClicked(\'a289\')"></div>
             <div class="brickStyle brickR17C2" id="a290" onclick="brickClicked(\'a290\')"></div>
             <div class="brickStyle brickR17C3" id="a291" onclick="brickClicked(\'a291\')"></div>
             <div class="brickStyle brickR17C4" id="a292" onclick="brickClicked(\'a292\')"></div>
             <div class="brickStyle brickR17C5" id="a293" onclick="brickClicked(\'a293\')"></div>
             <div class="brickStyle brickR17C6" id="a294" onclick="brickClicked(\'a294\')"></div>
             <div class="brickStyle brickR17C7" id="a295" onclick="brickClicked(\'a295\')"></div>
             <div class="brickStyle brickR17C8" id="a296" onclick="brickClicked(\'a296\')"></div>
             <div class="brickStyle brickR17C9" id="a297" onclick="brickClicked(\'a297\')"></div>
             <div class="brickStyle brickR17C10" id="a298" onclick="brickClicked(\'a298\')"></div>
             <div class="brickStyle brickR17C11" id="a299" onclick="brickClicked(\'a299\')"></div>
             <div class="brickStyle brickR17C12" id="a300" onclick="brickClicked(\'a300\')"></div>
             <div class="brickStyle brickR17C13" id="a301" onclick="brickClicked(\'a301\')"></div>
             <div class="brickStyle brickR17C14" id="a302" onclick="brickClicked(\'a302\')"></div>
             <div class="brickStyle brickR17C15" id="a303" onclick="brickClicked(\'a303\')"></div>
             <div class="brickStyle brickR17C16" id="a304" onclick="brickClicked(\'a304\')"></div>
             <div class="brickStyle brickR17C17" id="a305" onclick="brickClicked(\'a305\')"></div>
             <div class="brickStyle brickR17C18" id="a306" onclick="brickClicked(\'a306\')"></div>
             <!-- Row 18 -->
             <div class="brickStyle brickR18C1" id="a307" onclick="brickClicked(\'a307\')"></div>
             <div class="brickStyle brickR18C2" id="a308" onclick="brickClicked(\'a308\')"></div>
             <div class="brickStyle brickR18C3" id="a309" onclick="brickClicked(\'a309\')"></div>
             <div class="brickStyle brickR18C4" id="a310" onclick="brickClicked(\'a310\')"></div>
             <div class="brickStyle brickR18C5" id="a311" onclick="brickClicked(\'a311\')"></div>
             <div class="brickStyle brickR18C6" id="a312" onclick="brickClicked(\'a312\')"></div>
             <div class="brickStyle brickR18C7" id="a313" onclick="brickClicked(\'a313\')"></div>
             <div class="brickStyle brickR18C8" id="a314" onclick="brickClicked(\'a314\')"></div>
             <div class="brickStyle brickR18C9" id="a315" onclick="brickClicked(\'a315\')"></div>
             <div class="brickStyle brickR18C10" id="a316" onclick="brickClicked(\'a316\')"></div>
             <div class="brickStyle brickR18C11" id="a317" onclick="brickClicked(\'a317\')"></div>
             <div class="brickStyle brickR18C12" id="a318" onclick="brickClicked(\'a318\')"></div>
             <div class="brickStyle brickR18C13" id="a319" onclick="brickClicked(\'a319\')"></div>
             <div class="brickStyle brickR18C14" id="a320" onclick="brickClicked(\'a320\')"></div>
             <div class="brickStyle brickR18C15" id="a321" onclick="brickClicked(\'a321\')"></div>
             <div class="brickStyle brickR18C16" id="a322" onclick="brickClicked(\'a322\')"></div>
             <div class="brickStyle brickR18C17" id="a323" onclick="brickClicked(\'a323\')"></div>
             <div class="brickStyle brickR18C18" id="a324" onclick="brickClicked(\'a324\')"></div>
             <!-- Row 19 -->
             <div class="brickStyle brickR19C1" id="a325" onclick="brickClicked(\'a325\')"></div>
             <div class="brickStyle brickR19C2" id="a326" onclick="brickClicked(\'a326\')"></div>
             <div class="brickStyle brickR19C3" id="a327" onclick="brickClicked(\'a327\')"></div>
             <div class="brickStyle brickR19C4" id="a328" onclick="brickClicked(\'a328\')"></div>
             <div class="brickStyle brickR19C5" id="a329" onclick="brickClicked(\'a329\')"></div>
             <div class="brickStyle brickR19C6" id="a330" onclick="brickClicked(\'a330\')"></div>
             <div class="brickStyle brickR19C7" id="a331" onclick="brickClicked(\'a331\')"></div>
             <div class="brickStyle brickR19C8" id="a332" onclick="brickClicked(\'a332\')"></div>
             <div class="brickStyle brickR19C9" id="a333" onclick="brickClicked(\'a333\')"></div>
             <div class="brickStyle brickR19C10" id="a334" onclick="brickClicked(\'a334\')"></div>
             <div class="brickStyle brickR19C11" id="a335" onclick="brickClicked(\'a335\')"></div>
             <div class="brickStyle brickR19C12" id="a336" onclick="brickClicked(\'a336\')"></div>
             <div class="brickStyle brickR19C13" id="a337" onclick="brickClicked(\'a337\')"></div>
             <div class="brickStyle brickR19C14" id="a338" onclick="brickClicked(\'a338\')"></div>
             <div class="brickStyle brickR19C15" id="a339" onclick="brickClicked(\'a339\')"></div>
             <div class="brickStyle brickR19C16" id="a340" onclick="brickClicked(\'a340\')"></div>
             <div class="brickStyle brickR19C17" id="a341" onclick="brickClicked(\'a341\')"></div>
             <div class="brickStyle brickR19C18" id="a342" onclick="brickClicked(\'a342\')"></div>
             <!-- Row 20 -->
             <div class="brickStyle brickR20C1" id="a343" onclick="brickClicked(\'a343\')"></div>
             <div class="brickStyle brickR20C2" id="a344" onclick="brickClicked(\'a344\')"></div>
             <div class="brickStyle brickR20C3" id="a345" onclick="brickClicked(\'a345\')"></div>
             <div class="brickStyle brickR20C4" id="a346" onclick="brickClicked(\'a346\')"></div>
             <div class="brickStyle brickR20C5" id="a347" onclick="brickClicked(\'a347\')"></div>
             <div class="brickStyle brickR20C6" id="a348" onclick="brickClicked(\'a348\')"></div>
             <div class="brickStyle brickR20C7" id="a349" onclick="brickClicked(\'a349\')"></div>
             <div class="brickStyle brickR20C8" id="a350" onclick="brickClicked(\'a350\')"></div>
             <div class="brickStyle brickR20C9" id="a351" onclick="brickClicked(\'a351\')"></div>
             <div class="brickStyle brickR20C10" id="a352" onclick="brickClicked(\'a352\')"></div>
             <div class="brickStyle brickR20C11" id="a353" onclick="brickClicked(\'a353\')"></div>
             <div class="brickStyle brickR20C12" id="a354" onclick="brickClicked(\'a354\')"></div>
             <div class="brickStyle brickR20C13" id="a355" onclick="brickClicked(\'a355\')"></div>
             <div class="brickStyle brickR20C14" id="a356" onclick="brickClicked(\'a356\')"></div>
             <div class="brickStyle brickR20C15" id="a357" onclick="brickClicked(\'a357\')"></div>
             <div class="brickStyle brickR20C16" id="a358" onclick="brickClicked(\'a358\')"></div>
             <div class="brickStyle brickR20C17" id="a359" onclick="brickClicked(\'a359\')"></div>
             <div class="brickStyle brickR20C18" id="a360" onclick="brickClicked(\'a360\')"></div>
             <!-- Row 21 -->
             <div class="brickStyle brickR21C1" id="a361" onclick="brickClicked(\'a361\')"></div>
             <div class="brickStyle brickR21C2" id="a362" onclick="brickClicked(\'a362\')"></div>
             <div class="brickStyle brickR21C3" id="a363" onclick="brickClicked(\'a363\')"></div>
             <div class="brickStyle brickR21C4" id="a364" onclick="brickClicked(\'a364\')"></div>
             <div class="brickStyle brickR21C5" id="a365" onclick="brickClicked(\'a365\')"></div>
             <div class="brickStyle brickR21C6" id="a366" onclick="brickClicked(\'a366\')"></div>
             <div class="brickStyle brickR21C7" id="a367" onclick="brickClicked(\'a367\')"></div>
             <div class="brickStyle brickR21C8" id="a368" onclick="brickClicked(\'a368\')"></div>
             <div class="brickStyle brickR21C9" id="a369" onclick="brickClicked(\'a369\')"></div>
             <div class="brickStyle brickR21C10" id="a370" onclick="brickClicked(\'a370\')"></div>
             <div class="brickStyle brickR21C11" id="a371" onclick="brickClicked(\'a371\')"></div>
             <div class="brickStyle brickR21C12" id="a372" onclick="brickClicked(\'a372\')"></div>
             <div class="brickStyle brickR21C13" id="a373" onclick="brickClicked(\'a373\')"></div>
             <div class="brickStyle brickR21C14" id="a374" onclick="brickClicked(\'a374\')"></div>
             <div class="brickStyle brickR21C15" id="a375" onclick="brickClicked(\'a375\')"></div>
             <div class="brickStyle brickR21C16" id="a376" onclick="brickClicked(\'a376\')"></div>
             <div class="brickStyle brickR21C17" id="a377" onclick="brickClicked(\'a377\')"></div>
             <div class="brickStyle brickR21C18" id="a378" onclick="brickClicked(\'a378\')"></div>');
           }
           else{
             echo('<div class="brickStyle ' . $result[0] . ' "id="a001" ' . 'onclick="brickClicked(' . "'a001')".'"' . toCommentOrNot(isItANewBrick("a001")) . '></div>');
             echo('<div class="brickStyle ' . $result[1] . ' "id="a002" ' . 'onclick="brickClicked(' . "'a002')".'"' . toCommentOrNot(isItANewBrick("a002")) . '></div>');
             echo('<div class="brickStyle ' . $result[2] . ' "id="a003" ' . 'onclick="brickClicked(' . "'a003')".'"' . toCommentOrNot(isItANewBrick("a003")) . '></div>');
             echo('<div class="brickStyle ' . $result[3] . ' "id="a004" ' . 'onclick="brickClicked(' . "'a004')".'"' . toCommentOrNot(isItANewBrick("a004")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[4] . ' "id="a005" ' . 'onclick="brickClicked(' . "'a005')".'"' . toCommentOrNot(isItANewBrick("a005")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[5] . ' "id="a006" ' . 'onclick="brickClicked(' . "'a006')".'"' . toCommentOrNot(isItANewBrick("a006")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[6] . ' "id="a007" ' . 'onclick="brickClicked(' . "'a007')".'"' . toCommentOrNot(isItANewBrick("a007")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[7] . ' "id="a008" ' . 'onclick="brickClicked(' . "'a008')".'"' . toCommentOrNot(isItANewBrick("a008")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[8] . ' "id="a009" ' . 'onclick="brickClicked(' . "'a009')".'"' . toCommentOrNot(isItANewBrick("a009")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[9] . ' "id="a010" ' . 'onclick="brickClicked(' . "'a010')".'"' . toCommentOrNot(isItANewBrick("a010")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[10] . ' "id="a011" ' . 'onclick="brickClicked(' . "'a011')".'"' . toCommentOrNot(isItANewBrick("a011")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[11] . ' "id="a012" ' . 'onclick="brickClicked(' . "'a012')".'"' . toCommentOrNot(isItANewBrick("a012")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[12] . ' "id="a013" ' . 'onclick="brickClicked(' . "'a013')".'"' . toCommentOrNot(isItANewBrick("a013")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[13] . ' "id="a014" ' . 'onclick="brickClicked(' . "'a014')".'"' . toCommentOrNot(isItANewBrick("a014")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[14] . ' "id="a015" ' . 'onclick="brickClicked(' . "'a015')".'"' . toCommentOrNot(isItANewBrick("a015")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[15] . ' "id="a016" ' . 'onclick="brickClicked(' . "'a016')".'"' . toCommentOrNot(isItANewBrick("a016")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[16] . ' "id="a017" ' . 'onclick="brickClicked(' . "'a017')".'"' . toCommentOrNot(isItANewBrick("a017")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[17] . ' "id="a018" ' . 'onclick="brickClicked(' . "'a018')".'"' . toCommentOrNot(isItANewBrick("a018")) . '></div>'); 
          //  <!-- Row 2 -->
             echo('<div class="brickStyle ' . $result[18] . ' "id="a019" ' . 'onclick="brickClicked(' . "'a019')".'"' . toCommentOrNot(isItANewBrick("a019")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[19] . ' "id="a020" ' . 'onclick="brickClicked(' . "'a020')".'"' . toCommentOrNot(isItANewBrick("a020")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[20] . ' "id="a021" ' . 'onclick="brickClicked(' . "'a021')".'"' . toCommentOrNot(isItANewBrick("a021")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[21] . ' "id="a022" ' . 'onclick="brickClicked(' . "'a022')".'"' . toCommentOrNot(isItANewBrick("a022")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[22] . ' "id="a023" ' . 'onclick="brickClicked(' . "'a023')".'"' . toCommentOrNot(isItANewBrick("a023")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[23] . ' "id="a024" ' . 'onclick="brickClicked(' . "'a024')".'"' . toCommentOrNot(isItANewBrick("a024")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[24] . ' "id="a025" ' . 'onclick="brickClicked(' . "'a025')".'"' . toCommentOrNot(isItANewBrick("a025")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[25] . ' "id="a026" ' . 'onclick="brickClicked(' . "'a026')".'"' . toCommentOrNot(isItANewBrick("a026")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[26] . ' "id="a027" ' . 'onclick="brickClicked(' . "'a027')".'"' . toCommentOrNot(isItANewBrick("a027")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[27] . ' "id="a028" ' . 'onclick="brickClicked(' . "'a028')".'"' . toCommentOrNot(isItANewBrick("a028")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[28] . ' "id="a029" ' . 'onclick="brickClicked(' . "'a029')".'"' . toCommentOrNot(isItANewBrick("a029")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[29] . ' "id="a030" ' . 'onclick="brickClicked(' . "'a030')".'"' . toCommentOrNot(isItANewBrick("a030")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[30] . ' "id="a031" ' . 'onclick="brickClicked(' . "'a031')".'"' . toCommentOrNot(isItANewBrick("a031")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[31] . ' "id="a032" ' . 'onclick="brickClicked(' . "'a032')".'"' . toCommentOrNot(isItANewBrick("a032")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[32] . ' "id="a033" ' . 'onclick="brickClicked(' . "'a033')".'"' . toCommentOrNot(isItANewBrick("a033")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[33] . ' "id="a034" ' . 'onclick="brickClicked(' . "'a034')".'"' . toCommentOrNot(isItANewBrick("a034")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[34] . ' "id="a035" ' . 'onclick="brickClicked(' . "'a035')".'"' . toCommentOrNot(isItANewBrick("a035")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[35] . ' "id="a036" ' . 'onclick="brickClicked(' . "'a036')".'"' . toCommentOrNot(isItANewBrick("a036")) . '></div>'); 
          //  <!-- Row 3 -->
             echo('<div class="brickStyle ' . $result[36] . ' "id="a037" ' . 'onclick="brickClicked(' . "'a037')".'"' . toCommentOrNot(isItANewBrick("a037")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[37] . ' "id="a038" ' . 'onclick="brickClicked(' . "'a038')".'"' . toCommentOrNot(isItANewBrick("a038")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[38] . ' "id="a039" ' . 'onclick="brickClicked(' . "'a039')".'"' . toCommentOrNot(isItANewBrick("a039")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[39] . ' "id="a040" ' . 'onclick="brickClicked(' . "'a040')".'"' . toCommentOrNot(isItANewBrick("a040")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[40] . ' "id="a041" ' . 'onclick="brickClicked(' . "'a041')".'"' . toCommentOrNot(isItANewBrick("a041")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[41] . ' "id="a042" ' . 'onclick="brickClicked(' . "'a042')".'"' . toCommentOrNot(isItANewBrick("a042")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[42] . ' "id="a043" ' . 'onclick="brickClicked(' . "'a043')".'"' . toCommentOrNot(isItANewBrick("a043")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[43] . ' "id="a044" ' . 'onclick="brickClicked(' . "'a044')".'"' . toCommentOrNot(isItANewBrick("a044")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[44] . ' "id="a045" ' . 'onclick="brickClicked(' . "'a045')".'"' . toCommentOrNot(isItANewBrick("a045")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[45] . ' "id="a046" ' . 'onclick="brickClicked(' . "'a046')".'"' . toCommentOrNot(isItANewBrick("a046")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[46] . ' "id="a047" ' . 'onclick="brickClicked(' . "'a047')".'"' . toCommentOrNot(isItANewBrick("a047")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[47] . ' "id="a048" ' . 'onclick="brickClicked(' . "'a048')".'"' . toCommentOrNot(isItANewBrick("a048")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[48] . ' "id="a049" ' . 'onclick="brickClicked(' . "'a049')".'"' . toCommentOrNot(isItANewBrick("a049")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[49] . ' "id="a050" ' . 'onclick="brickClicked(' . "'a050')".'"' . toCommentOrNot(isItANewBrick("a050")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[50] . ' "id="a051" ' . 'onclick="brickClicked(' . "'a051')".'"' . toCommentOrNot(isItANewBrick("a051")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[51] . ' "id="a052" ' . 'onclick="brickClicked(' . "'a052')".'"' . toCommentOrNot(isItANewBrick("a052")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[52] . ' "id="a053" ' . 'onclick="brickClicked(' . "'a053')".'"' . toCommentOrNot(isItANewBrick("a053")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[53] . ' "id="a054" ' . 'onclick="brickClicked(' . "'a054')".'"' . toCommentOrNot(isItANewBrick("a054")) . '></div>'); 
          //  <!-- Row 4 -->
             echo('<div class="brickStyle ' . $result[54] . ' "id="a055" ' . 'onclick="brickClicked(' . "'a055')".'"' . toCommentOrNot(isItANewBrick("a055")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[55] . ' "id="a056" ' . 'onclick="brickClicked(' . "'a056')".'"' . toCommentOrNot(isItANewBrick("a056")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[56] . ' "id="a057" ' . 'onclick="brickClicked(' . "'a057')".'"' . toCommentOrNot(isItANewBrick("a057")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[57] . ' "id="a058" ' . 'onclick="brickClicked(' . "'a058')".'"' . toCommentOrNot(isItANewBrick("a058")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[58] . ' "id="a059" ' . 'onclick="brickClicked(' . "'a059')".'"' . toCommentOrNot(isItANewBrick("a059")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[59] . ' "id="a060" ' . 'onclick="brickClicked(' . "'a060')".'"' . toCommentOrNot(isItANewBrick("a060")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[60] . ' "id="a061" ' . 'onclick="brickClicked(' . "'a061')".'"' . toCommentOrNot(isItANewBrick("a061")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[61] . ' "id="a062" ' . 'onclick="brickClicked(' . "'a062')".'"' . toCommentOrNot(isItANewBrick("a062")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[62] . ' "id="a063" ' . 'onclick="brickClicked(' . "'a063')".'"' . toCommentOrNot(isItANewBrick("a063")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[63] . ' "id="a064" ' . 'onclick="brickClicked(' . "'a064')".'"' . toCommentOrNot(isItANewBrick("a064")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[64] . ' "id="a065" ' . 'onclick="brickClicked(' . "'a065')".'"' . toCommentOrNot(isItANewBrick("a065")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[65] . ' "id="a066" ' . 'onclick="brickClicked(' . "'a066')".'"' . toCommentOrNot(isItANewBrick("a066")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[66] . ' "id="a067" ' . 'onclick="brickClicked(' . "'a067')".'"' . toCommentOrNot(isItANewBrick("a067")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[67] . ' "id="a068" ' . 'onclick="brickClicked(' . "'a068')".'"' . toCommentOrNot(isItANewBrick("a068")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[68] . ' "id="a069" ' . 'onclick="brickClicked(' . "'a069')".'"' . toCommentOrNot(isItANewBrick("a069")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[69] . ' "id="a070" ' . 'onclick="brickClicked(' . "'a070')".'"' . toCommentOrNot(isItANewBrick("a070")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[70] . ' "id="a071" ' . 'onclick="brickClicked(' . "'a071')".'"' . toCommentOrNot(isItANewBrick("a071")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[71] . ' "id="a072" ' . 'onclick="brickClicked(' . "'a072')".'"' . toCommentOrNot(isItANewBrick("a072")) . '></div>'); 
          //  <!-- Row 5 -->
             echo('<div class="brickStyle ' . $result[72] . ' "id="a073" ' . 'onclick="brickClicked(' . "'a073')".'"' . toCommentOrNot(isItANewBrick("a073")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[73] . ' "id="a074" ' . 'onclick="brickClicked(' . "'a074')".'"' . toCommentOrNot(isItANewBrick("a074")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[74] . ' "id="a075" ' . 'onclick="brickClicked(' . "'a075')".'"' . toCommentOrNot(isItANewBrick("a075")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[75] . ' "id="a076" ' . 'onclick="brickClicked(' . "'a076')".'"' . toCommentOrNot(isItANewBrick("a076")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[76] . ' "id="a077" ' . 'onclick="brickClicked(' . "'a077')".'"' . toCommentOrNot(isItANewBrick("a077")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[77] . ' "id="a078" ' . 'onclick="brickClicked(' . "'a078')".'"' . toCommentOrNot(isItANewBrick("a078")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[78] . ' "id="a079" ' . 'onclick="brickClicked(' . "'a079')".'"' . toCommentOrNot(isItANewBrick("a079")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[79] . ' "id="a080" ' . 'onclick="brickClicked(' . "'a080')".'"' . toCommentOrNot(isItANewBrick("a080")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[80] . ' "id="a081" ' . 'onclick="brickClicked(' . "'a081')".'"' . toCommentOrNot(isItANewBrick("a081")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[81] . ' "id="a082" ' . 'onclick="brickClicked(' . "'a082')".'"' . toCommentOrNot(isItANewBrick("a082")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[82] . ' "id="a083" ' . 'onclick="brickClicked(' . "'a083')".'"' . toCommentOrNot(isItANewBrick("a083")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[83] . ' "id="a084" ' . 'onclick="brickClicked(' . "'a084')".'"' . toCommentOrNot(isItANewBrick("a084")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[84] . ' "id="a085" ' . 'onclick="brickClicked(' . "'a085')".'"' . toCommentOrNot(isItANewBrick("a085")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[85] . ' "id="a086" ' . 'onclick="brickClicked(' . "'a086')".'"' . toCommentOrNot(isItANewBrick("a086")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[86] . ' "id="a087" ' . 'onclick="brickClicked(' . "'a087')".'"' . toCommentOrNot(isItANewBrick("a087")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[87] . ' "id="a088" ' . 'onclick="brickClicked(' . "'a088')".'"' . toCommentOrNot(isItANewBrick("a088")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[88] . ' "id="a089" ' . 'onclick="brickClicked(' . "'a089')".'"' . toCommentOrNot(isItANewBrick("a089")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[89] . ' "id="a090" ' . 'onclick="brickClicked(' . "'a090')".'"' . toCommentOrNot(isItANewBrick("a090")) . '></div>'); 
          //  <!-- Row 6 -->
             echo('<div class="brickStyle ' . $result[90] . ' "id="a091" ' . 'onclick="brickClicked(' . "'a091')".'"' . toCommentOrNot(isItANewBrick("a091")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[91] . ' "id="a092" ' . 'onclick="brickClicked(' . "'a092')".'"' . toCommentOrNot(isItANewBrick("a092")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[92] . ' "id="a093" ' . 'onclick="brickClicked(' . "'a093')".'"' . toCommentOrNot(isItANewBrick("a093")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[93] . ' "id="a094" ' . 'onclick="brickClicked(' . "'a094')".'"' . toCommentOrNot(isItANewBrick("a094")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[94] . ' "id="a095" ' . 'onclick="brickClicked(' . "'a095')".'"' . toCommentOrNot(isItANewBrick("a095")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[95] . ' "id="a096" ' . 'onclick="brickClicked(' . "'a096')".'"' . toCommentOrNot(isItANewBrick("a096")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[96] . ' "id="a097" ' . 'onclick="brickClicked(' . "'a097')".'"' . toCommentOrNot(isItANewBrick("a097")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[97] . ' "id="a098" ' . 'onclick="brickClicked(' . "'a098')".'"' . toCommentOrNot(isItANewBrick("a098")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[98] . ' "id="a099" ' . 'onclick="brickClicked(' . "'a099')".'"' . toCommentOrNot(isItANewBrick("a099")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[99] . ' "id="a100" ' . 'onclick="brickClicked(' . "'a100')".'"' . toCommentOrNot(isItANewBrick("a100")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[100] . ' "id="a101" ' . 'onclick="brickClicked(' . "'a101')".'"' . toCommentOrNot(isItANewBrick("a101")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[101] . ' "id="a102" ' . 'onclick="brickClicked(' . "'a102')".'"' . toCommentOrNot(isItANewBrick("a102")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[102] . ' "id="a103" ' . 'onclick="brickClicked(' . "'a103')".'"' . toCommentOrNot(isItANewBrick("a103")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[103] . ' "id="a104" ' . 'onclick="brickClicked(' . "'a104')".'"' . toCommentOrNot(isItANewBrick("a104")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[104] . ' "id="a105" ' . 'onclick="brickClicked(' . "'a105')".'"' . toCommentOrNot(isItANewBrick("a105")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[105] . ' "id="a106" ' . 'onclick="brickClicked(' . "'a106')".'"' . toCommentOrNot(isItANewBrick("a106")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[106] . ' "id="a107" ' . 'onclick="brickClicked(' . "'a107')".'"' . toCommentOrNot(isItANewBrick("a107")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[107] . ' "id="a108" ' . 'onclick="brickClicked(' . "'a108')".'"' . toCommentOrNot(isItANewBrick("a108")) . '></div>'); 
          //  <!-- Row 7 -->
             echo('<div class="brickStyle ' . $result[108] . ' "id="a109" ' . 'onclick="brickClicked(' . "'a109')".'"' . toCommentOrNot(isItANewBrick("a109")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[109] . ' "id="a110" ' . 'onclick="brickClicked(' . "'a110')".'"' . toCommentOrNot(isItANewBrick("a110")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[110] . ' "id="a111" ' . 'onclick="brickClicked(' . "'a111')".'"' . toCommentOrNot(isItANewBrick("a111")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[111] . ' "id="a112" ' . 'onclick="brickClicked(' . "'a112')".'"' . toCommentOrNot(isItANewBrick("a112")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[112] . ' "id="a113" ' . 'onclick="brickClicked(' . "'a113')".'"' . toCommentOrNot(isItANewBrick("a113")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[113] . ' "id="a114" ' . 'onclick="brickClicked(' . "'a114')".'"' . toCommentOrNot(isItANewBrick("a114")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[114] . ' "id="a115" ' . 'onclick="brickClicked(' . "'a115')".'"' . toCommentOrNot(isItANewBrick("a115")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[115] . ' "id="a116" ' . 'onclick="brickClicked(' . "'a116')".'"' . toCommentOrNot(isItANewBrick("a116")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[116] . ' "id="a117" ' . 'onclick="brickClicked(' . "'a117')".'"' . toCommentOrNot(isItANewBrick("a117")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[117] . ' "id="a118" ' . 'onclick="brickClicked(' . "'a118')".'"' . toCommentOrNot(isItANewBrick("a118")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[118] . ' "id="a119" ' . 'onclick="brickClicked(' . "'a119')".'"' . toCommentOrNot(isItANewBrick("a119")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[119] . ' "id="a120" ' . 'onclick="brickClicked(' . "'a120')".'"' . toCommentOrNot(isItANewBrick("a120")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[120] . ' "id="a121" ' . 'onclick="brickClicked(' . "'a121')".'"' . toCommentOrNot(isItANewBrick("a121")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[121] . ' "id="a122" ' . 'onclick="brickClicked(' . "'a122')".'"' . toCommentOrNot(isItANewBrick("a122")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[122] . ' "id="a123" ' . 'onclick="brickClicked(' . "'a123')".'"' . toCommentOrNot(isItANewBrick("a123")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[123] . ' "id="a124" ' . 'onclick="brickClicked(' . "'a124')".'"' . toCommentOrNot(isItANewBrick("a124")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[124] . ' "id="a125" ' . 'onclick="brickClicked(' . "'a125')".'"' . toCommentOrNot(isItANewBrick("a125")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[125] . ' "id="a126" ' . 'onclick="brickClicked(' . "'a126')".'"' . toCommentOrNot(isItANewBrick("a126")) . '></div>'); 
          //  <!-- Row 8 -->
             echo('<div class="brickStyle ' . $result[126] . ' "id="a127" ' . 'onclick="brickClicked(' . "'a127')".'"' . toCommentOrNot(isItANewBrick("a127")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[127] . ' "id="a128" ' . 'onclick="brickClicked(' . "'a128')".'"' . toCommentOrNot(isItANewBrick("a128")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[128] . ' "id="a129" ' . 'onclick="brickClicked(' . "'a129')".'"' . toCommentOrNot(isItANewBrick("a129")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[129] . ' "id="a130" ' . 'onclick="brickClicked(' . "'a130')".'"' . toCommentOrNot(isItANewBrick("a130")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[130] . ' "id="a131" ' . 'onclick="brickClicked(' . "'a131')".'"' . toCommentOrNot(isItANewBrick("a131")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[131] . ' "id="a132" ' . 'onclick="brickClicked(' . "'a132')".'"' . toCommentOrNot(isItANewBrick("a132")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[132] . ' "id="a133" ' . 'onclick="brickClicked(' . "'a133')".'"' . toCommentOrNot(isItANewBrick("a133")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[133] . ' "id="a134" ' . 'onclick="brickClicked(' . "'a134')".'"' . toCommentOrNot(isItANewBrick("a134")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[134] . ' "id="a135" ' . 'onclick="brickClicked(' . "'a135')".'"' . toCommentOrNot(isItANewBrick("a135")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[135] . ' "id="a136" ' . 'onclick="brickClicked(' . "'a136')".'"' . toCommentOrNot(isItANewBrick("a136")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[136] . ' "id="a137" ' . 'onclick="brickClicked(' . "'a137')".'"' . toCommentOrNot(isItANewBrick("a137")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[137] . ' "id="a138" ' . 'onclick="brickClicked(' . "'a138')".'"' . toCommentOrNot(isItANewBrick("a138")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[138] . ' "id="a139" ' . 'onclick="brickClicked(' . "'a139')".'"' . toCommentOrNot(isItANewBrick("a139")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[139] . ' "id="a140" ' . 'onclick="brickClicked(' . "'a140')".'"' . toCommentOrNot(isItANewBrick("a140")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[140] . ' "id="a141" ' . 'onclick="brickClicked(' . "'a141')".'"' . toCommentOrNot(isItANewBrick("a141")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[141] . ' "id="a142" ' . 'onclick="brickClicked(' . "'a142')".'"' . toCommentOrNot(isItANewBrick("a142")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[142] . ' "id="a143" ' . 'onclick="brickClicked(' . "'a143')".'"' . toCommentOrNot(isItANewBrick("a143")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[143] . ' "id="a144" ' . 'onclick="brickClicked(' . "'a144')".'"' . toCommentOrNot(isItANewBrick("a144")) . '></div>'); 
          //  <!-- Row 9 -->
             echo('<div class="brickStyle ' . $result[144] . ' "id="a145" ' . 'onclick="brickClicked(' . "'a145')".'"' . toCommentOrNot(isItANewBrick("a145")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[145] . ' "id="a146" ' . 'onclick="brickClicked(' . "'a146')".'"' . toCommentOrNot(isItANewBrick("a146")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[146] . ' "id="a147" ' . 'onclick="brickClicked(' . "'a147')".'"' . toCommentOrNot(isItANewBrick("a147")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[147] . ' "id="a148" ' . 'onclick="brickClicked(' . "'a148')".'"' . toCommentOrNot(isItANewBrick("a148")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[148] . ' "id="a149" ' . 'onclick="brickClicked(' . "'a149')".'"' . toCommentOrNot(isItANewBrick("a149")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[149] . ' "id="a150" ' . 'onclick="brickClicked(' . "'a150')".'"' . toCommentOrNot(isItANewBrick("a150")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[150] . ' "id="a151" ' . 'onclick="brickClicked(' . "'a151')".'"' . toCommentOrNot(isItANewBrick("a151")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[151] . ' "id="a152" ' . 'onclick="brickClicked(' . "'a152')".'"' . toCommentOrNot(isItANewBrick("a152")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[152] . ' "id="a153" ' . 'onclick="brickClicked(' . "'a153')".'"' . toCommentOrNot(isItANewBrick("a153")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[153] . ' "id="a154" ' . 'onclick="brickClicked(' . "'a154')".'"' . toCommentOrNot(isItANewBrick("a154")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[154] . ' "id="a155" ' . 'onclick="brickClicked(' . "'a155')".'"' . toCommentOrNot(isItANewBrick("a155")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[155] . ' "id="a156" ' . 'onclick="brickClicked(' . "'a156')".'"' . toCommentOrNot(isItANewBrick("a156")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[156] . ' "id="a157" ' . 'onclick="brickClicked(' . "'a157')".'"' . toCommentOrNot(isItANewBrick("a157")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[157] . ' "id="a158" ' . 'onclick="brickClicked(' . "'a158')".'"' . toCommentOrNot(isItANewBrick("a158")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[158] . ' "id="a159" ' . 'onclick="brickClicked(' . "'a159')".'"' . toCommentOrNot(isItANewBrick("a159")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[159] . ' "id="a160" ' . 'onclick="brickClicked(' . "'a160')".'"' . toCommentOrNot(isItANewBrick("a160")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[160] . ' "id="a161" ' . 'onclick="brickClicked(' . "'a161')".'"' . toCommentOrNot(isItANewBrick("a161")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[161] . ' "id="a162" ' . 'onclick="brickClicked(' . "'a162')".'"' . toCommentOrNot(isItANewBrick("a162")) . '></div>'); 
          //  <!-- Row 10 -->
             echo('<div class="brickStyle ' . $result[162] . ' "id="a163" ' . 'onclick="brickClicked(' . "'a163')".'"' . toCommentOrNot(isItANewBrick("a163")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[163] . ' "id="a164" ' . 'onclick="brickClicked(' . "'a164')".'"' . toCommentOrNot(isItANewBrick("a164")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[164] . ' "id="a165" ' . 'onclick="brickClicked(' . "'a165')".'"' . toCommentOrNot(isItANewBrick("a165")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[165] . ' "id="a166" ' . 'onclick="brickClicked(' . "'a166')".'"' . toCommentOrNot(isItANewBrick("a166")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[166] . ' "id="a167" ' . 'onclick="brickClicked(' . "'a167')".'"' . toCommentOrNot(isItANewBrick("a167")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[167] . ' "id="a168" ' . 'onclick="brickClicked(' . "'a168')".'"' . toCommentOrNot(isItANewBrick("a168")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[168] . ' "id="a169" ' . 'onclick="brickClicked(' . "'a169')".'"' . toCommentOrNot(isItANewBrick("a169")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[169] . ' "id="a170" ' . 'onclick="brickClicked(' . "'a170')".'"' . toCommentOrNot(isItANewBrick("a170")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[170] . ' "id="a171" ' . 'onclick="brickClicked(' . "'a171')".'"' . toCommentOrNot(isItANewBrick("a171")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[171] . ' "id="a172" ' . 'onclick="brickClicked(' . "'a172')".'"' . toCommentOrNot(isItANewBrick("a172")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[172] . ' "id="a173" ' . 'onclick="brickClicked(' . "'a173')".'"' . toCommentOrNot(isItANewBrick("a173")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[173] . ' "id="a174" ' . 'onclick="brickClicked(' . "'a174')".'"' . toCommentOrNot(isItANewBrick("a174")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[174] . ' "id="a175" ' . 'onclick="brickClicked(' . "'a175')".'"' . toCommentOrNot(isItANewBrick("a175")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[175] . ' "id="a176" ' . 'onclick="brickClicked(' . "'a176')".'"' . toCommentOrNot(isItANewBrick("a176")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[176] . ' "id="a177" ' . 'onclick="brickClicked(' . "'a177')".'"' . toCommentOrNot(isItANewBrick("a177")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[177] . ' "id="a178" ' . 'onclick="brickClicked(' . "'a178')".'"' . toCommentOrNot(isItANewBrick("a178")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[178] . ' "id="a179" ' . 'onclick="brickClicked(' . "'a179')".'"' . toCommentOrNot(isItANewBrick("a179")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[179] . ' "id="a180" ' . 'onclick="brickClicked(' . "'a180')".'"' . toCommentOrNot(isItANewBrick("a180")) . '></div>'); 
          //  <!-- Row 11 -->
             echo('<div class="brickStyle ' . $result[180] . ' "id="a181" ' . 'onclick="brickClicked(' . "'a181')".'"' . toCommentOrNot(isItANewBrick("a181")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[181] . ' "id="a182" ' . 'onclick="brickClicked(' . "'a182')".'"' . toCommentOrNot(isItANewBrick("a182")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[182] . ' "id="a183" ' . 'onclick="brickClicked(' . "'a183')".'"' . toCommentOrNot(isItANewBrick("a183")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[183] . ' "id="a184" ' . 'onclick="brickClicked(' . "'a184')".'"' . toCommentOrNot(isItANewBrick("a184")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[184] . ' "id="a185" ' . 'onclick="brickClicked(' . "'a185')".'"' . toCommentOrNot(isItANewBrick("a185")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[185] . ' "id="a186" ' . 'onclick="brickClicked(' . "'a186')".'"' . toCommentOrNot(isItANewBrick("a186")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[186] . ' "id="a187" ' . 'onclick="brickClicked(' . "'a187')".'"' . toCommentOrNot(isItANewBrick("a187")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[187] . ' "id="a188" ' . 'onclick="brickClicked(' . "'a188')".'"' . toCommentOrNot(isItANewBrick("a188")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[188] . ' "id="a189" ' . 'onclick="brickClicked(' . "'a189')".'"' . toCommentOrNot(isItANewBrick("a189")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[189] . ' "id="a190" ' . 'onclick="brickClicked(' . "'a190')".'"' . toCommentOrNot(isItANewBrick("a190")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[190] . ' "id="a191" ' . 'onclick="brickClicked(' . "'a191')".'"' . toCommentOrNot(isItANewBrick("a191")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[191] . ' "id="a192" ' . 'onclick="brickClicked(' . "'a192')".'"' . toCommentOrNot(isItANewBrick("a192")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[192] . ' "id="a193" ' . 'onclick="brickClicked(' . "'a193')".'"' . toCommentOrNot(isItANewBrick("a193")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[193] . ' "id="a194" ' . 'onclick="brickClicked(' . "'a194')".'"' . toCommentOrNot(isItANewBrick("a194")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[194] . ' "id="a195" ' . 'onclick="brickClicked(' . "'a195')".'"' . toCommentOrNot(isItANewBrick("a195")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[195] . ' "id="a196" ' . 'onclick="brickClicked(' . "'a196')".'"' . toCommentOrNot(isItANewBrick("a196")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[196] . ' "id="a197" ' . 'onclick="brickClicked(' . "'a197')".'"' . toCommentOrNot(isItANewBrick("a197")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[197] . ' "id="a198" ' . 'onclick="brickClicked(' . "'a198')".'"' . toCommentOrNot(isItANewBrick("a198")) . '></div>'); 
          //  <!-- Row 12 -->
             echo('<div class="brickStyle ' . $result[198] . ' "id="a199" ' . 'onclick="brickClicked(' . "'a199')".'"' . toCommentOrNot(isItANewBrick("a199")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[199] . ' "id="a200" ' . 'onclick="brickClicked(' . "'a200')".'"' . toCommentOrNot(isItANewBrick("a200")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[200] . ' "id="a201" ' . 'onclick="brickClicked(' . "'a201')".'"' . toCommentOrNot(isItANewBrick("a201")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[201] . ' "id="a202" ' . 'onclick="brickClicked(' . "'a202')".'"' . toCommentOrNot(isItANewBrick("a202")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[202] . ' "id="a203" ' . 'onclick="brickClicked(' . "'a203')".'"' . toCommentOrNot(isItANewBrick("a203")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[203] . ' "id="a204" ' . 'onclick="brickClicked(' . "'a204')".'"' . toCommentOrNot(isItANewBrick("a204")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[204] . ' "id="a205" ' . 'onclick="brickClicked(' . "'a205')".'"' . toCommentOrNot(isItANewBrick("a205")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[205] . ' "id="a206" ' . 'onclick="brickClicked(' . "'a206')".'"' . toCommentOrNot(isItANewBrick("a206")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[206] . ' "id="a207" ' . 'onclick="brickClicked(' . "'a207')".'"' . toCommentOrNot(isItANewBrick("a207")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[207] . ' "id="a208" ' . 'onclick="brickClicked(' . "'a208')".'"' . toCommentOrNot(isItANewBrick("a208")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[208] . ' "id="a209" ' . 'onclick="brickClicked(' . "'a209')".'"' . toCommentOrNot(isItANewBrick("a209")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[209] . ' "id="a210" ' . 'onclick="brickClicked(' . "'a210')".'"' . toCommentOrNot(isItANewBrick("a210")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[210] . ' "id="a211" ' . 'onclick="brickClicked(' . "'a211')".'"' . toCommentOrNot(isItANewBrick("a211")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[211] . ' "id="a212" ' . 'onclick="brickClicked(' . "'a212')".'"' . toCommentOrNot(isItANewBrick("a212")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[212] . ' "id="a213" ' . 'onclick="brickClicked(' . "'a213')".'"' . toCommentOrNot(isItANewBrick("a213")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[213] . ' "id="a214" ' . 'onclick="brickClicked(' . "'a214')".'"' . toCommentOrNot(isItANewBrick("a214")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[214] . ' "id="a215" ' . 'onclick="brickClicked(' . "'a215')".'"' . toCommentOrNot(isItANewBrick("a215")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[215] . ' "id="a216" ' . 'onclick="brickClicked(' . "'a216')".'"' . toCommentOrNot(isItANewBrick("a216")) . '></div>'); 
          //  <!-- Row 13 -->
             echo('<div class="brickStyle ' . $result[216] . ' "id="a217" ' . 'onclick="brickClicked(' . "'a217')".'"' . toCommentOrNot(isItANewBrick("a217")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[217] . ' "id="a218" ' . 'onclick="brickClicked(' . "'a218')".'"' . toCommentOrNot(isItANewBrick("a218")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[218] . ' "id="a219" ' . 'onclick="brickClicked(' . "'a219')".'"' . toCommentOrNot(isItANewBrick("a219")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[219] . ' "id="a220" ' . 'onclick="brickClicked(' . "'a220')".'"' . toCommentOrNot(isItANewBrick("a220")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[220] . ' "id="a221" ' . 'onclick="brickClicked(' . "'a221')".'"' . toCommentOrNot(isItANewBrick("a221")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[221] . ' "id="a222" ' . 'onclick="brickClicked(' . "'a222')".'"' . toCommentOrNot(isItANewBrick("a222")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[222] . ' "id="a223" ' . 'onclick="brickClicked(' . "'a223')".'"' . toCommentOrNot(isItANewBrick("a223")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[223] . ' "id="a224" ' . 'onclick="brickClicked(' . "'a224')".'"' . toCommentOrNot(isItANewBrick("a224")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[224] . ' "id="a225" ' . 'onclick="brickClicked(' . "'a225')".'"' . toCommentOrNot(isItANewBrick("a225")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[225] . ' "id="a226" ' . 'onclick="brickClicked(' . "'a226')".'"' . toCommentOrNot(isItANewBrick("a226")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[226] . ' "id="a227" ' . 'onclick="brickClicked(' . "'a227')".'"' . toCommentOrNot(isItANewBrick("a227")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[227] . ' "id="a228" ' . 'onclick="brickClicked(' . "'a228')".'"' . toCommentOrNot(isItANewBrick("a228")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[228] . ' "id="a229" ' . 'onclick="brickClicked(' . "'a229')".'"' . toCommentOrNot(isItANewBrick("a229")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[229] . ' "id="a230" ' . 'onclick="brickClicked(' . "'a230')".'"' . toCommentOrNot(isItANewBrick("a230")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[230] . ' "id="a231" ' . 'onclick="brickClicked(' . "'a231')".'"' . toCommentOrNot(isItANewBrick("a231")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[231] . ' "id="a232" ' . 'onclick="brickClicked(' . "'a232')".'"' . toCommentOrNot(isItANewBrick("a232")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[232] . ' "id="a233" ' . 'onclick="brickClicked(' . "'a233')".'"' . toCommentOrNot(isItANewBrick("a233")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[233] . ' "id="a234" ' . 'onclick="brickClicked(' . "'a234')".'"' . toCommentOrNot(isItANewBrick("a234")) . '></div>'); 
          //  <!-- Row 14 -->
             echo('<div class="brickStyle ' . $result[234] . ' "id="a235" ' . 'onclick="brickClicked(' . "'a235')".'"' . toCommentOrNot(isItANewBrick("a235")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[235] . ' "id="a236" ' . 'onclick="brickClicked(' . "'a236')".'"' . toCommentOrNot(isItANewBrick("a236")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[236] . ' "id="a237" ' . 'onclick="brickClicked(' . "'a237')".'"' . toCommentOrNot(isItANewBrick("a237")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[237] . ' "id="a238" ' . 'onclick="brickClicked(' . "'a238')".'"' . toCommentOrNot(isItANewBrick("a238")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[238] . ' "id="a239" ' . 'onclick="brickClicked(' . "'a239')".'"' . toCommentOrNot(isItANewBrick("a239")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[239] . ' "id="a240" ' . 'onclick="brickClicked(' . "'a240')".'"' . toCommentOrNot(isItANewBrick("a240")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[240] . ' "id="a241" ' . 'onclick="brickClicked(' . "'a241')".'"' . toCommentOrNot(isItANewBrick("a241")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[241] . ' "id="a242" ' . 'onclick="brickClicked(' . "'a242')".'"' . toCommentOrNot(isItANewBrick("a242")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[242] . ' "id="a243" ' . 'onclick="brickClicked(' . "'a243')".'"' . toCommentOrNot(isItANewBrick("a243")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[243] . ' "id="a244" ' . 'onclick="brickClicked(' . "'a244')".'"' . toCommentOrNot(isItANewBrick("a244")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[244] . ' "id="a245" ' . 'onclick="brickClicked(' . "'a245')".'"' . toCommentOrNot(isItANewBrick("a245")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[245] . ' "id="a246" ' . 'onclick="brickClicked(' . "'a246')".'"' . toCommentOrNot(isItANewBrick("a246")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[246] . ' "id="a247" ' . 'onclick="brickClicked(' . "'a247')".'"' . toCommentOrNot(isItANewBrick("a247")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[247] . ' "id="a248" ' . 'onclick="brickClicked(' . "'a248')".'"' . toCommentOrNot(isItANewBrick("a248")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[248] . ' "id="a249" ' . 'onclick="brickClicked(' . "'a249')".'"' . toCommentOrNot(isItANewBrick("a249")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[249] . ' "id="a250" ' . 'onclick="brickClicked(' . "'a250')".'"' . toCommentOrNot(isItANewBrick("a250")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[250] . ' "id="a251" ' . 'onclick="brickClicked(' . "'a251')".'"' . toCommentOrNot(isItANewBrick("a251")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[251] . ' "id="a252" ' . 'onclick="brickClicked(' . "'a252')".'"' . toCommentOrNot(isItANewBrick("a252")) . '></div>'); 
          //  <!-- Row 15 -->
             echo('<div class="brickStyle ' . $result[252] . ' "id="a253" ' . 'onclick="brickClicked(' . "'a253')".'"' . toCommentOrNot(isItANewBrick("a253")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[253] . ' "id="a254" ' . 'onclick="brickClicked(' . "'a254')".'"' . toCommentOrNot(isItANewBrick("a254")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[254] . ' "id="a255" ' . 'onclick="brickClicked(' . "'a255')".'"' . toCommentOrNot(isItANewBrick("a255")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[255] . ' "id="a256" ' . 'onclick="brickClicked(' . "'a256')".'"' . toCommentOrNot(isItANewBrick("a256")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[256] . ' "id="a257" ' . 'onclick="brickClicked(' . "'a257')".'"' . toCommentOrNot(isItANewBrick("a257")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[257] . ' "id="a258" ' . 'onclick="brickClicked(' . "'a258')".'"' . toCommentOrNot(isItANewBrick("a258")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[258] . ' "id="a259" ' . 'onclick="brickClicked(' . "'a259')".'"' . toCommentOrNot(isItANewBrick("a259")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[259] . ' "id="a260" ' . 'onclick="brickClicked(' . "'a260')".'"' . toCommentOrNot(isItANewBrick("a260")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[260] . ' "id="a261" ' . 'onclick="brickClicked(' . "'a261')".'"' . toCommentOrNot(isItANewBrick("a261")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[261] . ' "id="a262" ' . 'onclick="brickClicked(' . "'a262')".'"' . toCommentOrNot(isItANewBrick("a262")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[262] . ' "id="a263" ' . 'onclick="brickClicked(' . "'a263')".'"' . toCommentOrNot(isItANewBrick("a263")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[263] . ' "id="a264" ' . 'onclick="brickClicked(' . "'a264')".'"' . toCommentOrNot(isItANewBrick("a264")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[264] . ' "id="a265" ' . 'onclick="brickClicked(' . "'a265')".'"' . toCommentOrNot(isItANewBrick("a265")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[265] . ' "id="a266" ' . 'onclick="brickClicked(' . "'a266')".'"' . toCommentOrNot(isItANewBrick("a266")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[266] . ' "id="a267" ' . 'onclick="brickClicked(' . "'a267')".'"' . toCommentOrNot(isItANewBrick("a267")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[267] . ' "id="a268" ' . 'onclick="brickClicked(' . "'a268')".'"' . toCommentOrNot(isItANewBrick("a268")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[268] . ' "id="a269" ' . 'onclick="brickClicked(' . "'a269')".'"' . toCommentOrNot(isItANewBrick("a269")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[269] . ' "id="a270" ' . 'onclick="brickClicked(' . "'a270')".'"' . toCommentOrNot(isItANewBrick("a270")) . '></div>'); 
          //  <!-- Row 16 -->
             echo('<div class="brickStyle ' . $result[270] . ' "id="a271" ' . 'onclick="brickClicked(' . "'a271')".'"' . toCommentOrNot(isItANewBrick("a271")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[271] . ' "id="a272" ' . 'onclick="brickClicked(' . "'a272')".'"' . toCommentOrNot(isItANewBrick("a272")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[272] . ' "id="a273" ' . 'onclick="brickClicked(' . "'a273')".'"' . toCommentOrNot(isItANewBrick("a273")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[273] . ' "id="a274" ' . 'onclick="brickClicked(' . "'a274')".'"' . toCommentOrNot(isItANewBrick("a274")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[274] . ' "id="a275" ' . 'onclick="brickClicked(' . "'a275')".'"' . toCommentOrNot(isItANewBrick("a275")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[275] . ' "id="a276" ' . 'onclick="brickClicked(' . "'a276')".'"' . toCommentOrNot(isItANewBrick("a276")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[276] . ' "id="a277" ' . 'onclick="brickClicked(' . "'a277')".'"' . toCommentOrNot(isItANewBrick("a277")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[277] . ' "id="a278" ' . 'onclick="brickClicked(' . "'a278')".'"' . toCommentOrNot(isItANewBrick("a278")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[278] . ' "id="a279" ' . 'onclick="brickClicked(' . "'a279')".'"' . toCommentOrNot(isItANewBrick("a279")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[279] . ' "id="a280" ' . 'onclick="brickClicked(' . "'a280')".'"' . toCommentOrNot(isItANewBrick("a280")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[280] . ' "id="a281" ' . 'onclick="brickClicked(' . "'a281')".'"' . toCommentOrNot(isItANewBrick("a281")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[281] . ' "id="a282" ' . 'onclick="brickClicked(' . "'a282')".'"' . toCommentOrNot(isItANewBrick("a282")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[282] . ' "id="a283" ' . 'onclick="brickClicked(' . "'a283')".'"' . toCommentOrNot(isItANewBrick("a283")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[283] . ' "id="a284" ' . 'onclick="brickClicked(' . "'a284')".'"' . toCommentOrNot(isItANewBrick("a284")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[284] . ' "id="a285" ' . 'onclick="brickClicked(' . "'a285')".'"' . toCommentOrNot(isItANewBrick("a285")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[285] . ' "id="a286" ' . 'onclick="brickClicked(' . "'a286')".'"' . toCommentOrNot(isItANewBrick("a286")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[286] . ' "id="a287" ' . 'onclick="brickClicked(' . "'a287')".'"' . toCommentOrNot(isItANewBrick("a287")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[287] . ' "id="a288" ' . 'onclick="brickClicked(' . "'a288')".'"' . toCommentOrNot(isItANewBrick("a288")) . '></div>'); 
          //  <!-- Row 17 -->
             echo('<div class="brickStyle ' . $result[288] . ' "id="a289" ' . 'onclick="brickClicked(' . "'a289')".'"' . toCommentOrNot(isItANewBrick("a289")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[289] . ' "id="a290" ' . 'onclick="brickClicked(' . "'a290')".'"' . toCommentOrNot(isItANewBrick("a290")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[290] . ' "id="a291" ' . 'onclick="brickClicked(' . "'a291')".'"' . toCommentOrNot(isItANewBrick("a291")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[291] . ' "id="a292" ' . 'onclick="brickClicked(' . "'a292')".'"' . toCommentOrNot(isItANewBrick("a292")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[292] . ' "id="a293" ' . 'onclick="brickClicked(' . "'a293')".'"' . toCommentOrNot(isItANewBrick("a293")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[293] . ' "id="a294" ' . 'onclick="brickClicked(' . "'a294')".'"' . toCommentOrNot(isItANewBrick("a294")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[294] . ' "id="a295" ' . 'onclick="brickClicked(' . "'a295')".'"' . toCommentOrNot(isItANewBrick("a295")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[295] . ' "id="a296" ' . 'onclick="brickClicked(' . "'a296')".'"' . toCommentOrNot(isItANewBrick("a296")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[296] . ' "id="a297" ' . 'onclick="brickClicked(' . "'a297')".'"' . toCommentOrNot(isItANewBrick("a297")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[297] . ' "id="a298" ' . 'onclick="brickClicked(' . "'a298')".'"' . toCommentOrNot(isItANewBrick("a298")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[298] . ' "id="a299" ' . 'onclick="brickClicked(' . "'a299')".'"' . toCommentOrNot(isItANewBrick("a299")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[299] . ' "id="a300" ' . 'onclick="brickClicked(' . "'a300')".'"' . toCommentOrNot(isItANewBrick("a300")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[300] . ' "id="a301" ' . 'onclick="brickClicked(' . "'a301')".'"' . toCommentOrNot(isItANewBrick("a301")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[301] . ' "id="a302" ' . 'onclick="brickClicked(' . "'a302')".'"' . toCommentOrNot(isItANewBrick("a302")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[302] . ' "id="a303" ' . 'onclick="brickClicked(' . "'a303')".'"' . toCommentOrNot(isItANewBrick("a303")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[303] . ' "id="a304" ' . 'onclick="brickClicked(' . "'a304')".'"' . toCommentOrNot(isItANewBrick("a304")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[304] . ' "id="a305" ' . 'onclick="brickClicked(' . "'a305')".'"' . toCommentOrNot(isItANewBrick("a305")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[305] . ' "id="a306" ' . 'onclick="brickClicked(' . "'a306')".'"' . toCommentOrNot(isItANewBrick("a306")) . '></div>'); 
          //  <!-- Row 18 -->
             echo('<div class="brickStyle ' . $result[306] . ' "id="a307" ' . 'onclick="brickClicked(' . "'a307')".'"' . toCommentOrNot(isItANewBrick("a307")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[307] . ' "id="a308" ' . 'onclick="brickClicked(' . "'a308')".'"' . toCommentOrNot(isItANewBrick("a308")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[308] . ' "id="a309" ' . 'onclick="brickClicked(' . "'a309')".'"' . toCommentOrNot(isItANewBrick("a309")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[309] . ' "id="a310" ' . 'onclick="brickClicked(' . "'a310')".'"' . toCommentOrNot(isItANewBrick("a310")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[310] . ' "id="a311" ' . 'onclick="brickClicked(' . "'a311')".'"' . toCommentOrNot(isItANewBrick("a311")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[311] . ' "id="a312" ' . 'onclick="brickClicked(' . "'a312')".'"' . toCommentOrNot(isItANewBrick("a312")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[312] . ' "id="a313" ' . 'onclick="brickClicked(' . "'a313')".'"' . toCommentOrNot(isItANewBrick("a313")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[313] . ' "id="a314" ' . 'onclick="brickClicked(' . "'a314')".'"' . toCommentOrNot(isItANewBrick("a314")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[314] . ' "id="a315" ' . 'onclick="brickClicked(' . "'a315')".'"' . toCommentOrNot(isItANewBrick("a315")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[315] . ' "id="a316" ' . 'onclick="brickClicked(' . "'a316')".'"' . toCommentOrNot(isItANewBrick("a316")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[316] . ' "id="a317" ' . 'onclick="brickClicked(' . "'a317')".'"' . toCommentOrNot(isItANewBrick("a317")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[317] . ' "id="a318" ' . 'onclick="brickClicked(' . "'a318')".'"' . toCommentOrNot(isItANewBrick("a318")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[318] . ' "id="a319" ' . 'onclick="brickClicked(' . "'a319')".'"' . toCommentOrNot(isItANewBrick("a319")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[319] . ' "id="a320" ' . 'onclick="brickClicked(' . "'a320')".'"' . toCommentOrNot(isItANewBrick("a320")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[320] . ' "id="a321" ' . 'onclick="brickClicked(' . "'a321')".'"' . toCommentOrNot(isItANewBrick("a321")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[321] . ' "id="a322" ' . 'onclick="brickClicked(' . "'a322')".'"' . toCommentOrNot(isItANewBrick("a322")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[322] . ' "id="a323" ' . 'onclick="brickClicked(' . "'a323')".'"' . toCommentOrNot(isItANewBrick("a323")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[323] . ' "id="a324" ' . 'onclick="brickClicked(' . "'a324')".'"' . toCommentOrNot(isItANewBrick("a324")) . '></div>'); 
          //  <!-- Row 19 -->
             echo('<div class="brickStyle ' . $result[324] . ' "id="a325" ' . 'onclick="brickClicked(' . "'a325')".'"' . toCommentOrNot(isItANewBrick("a325")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[325] . ' "id="a326" ' . 'onclick="brickClicked(' . "'a326')".'"' . toCommentOrNot(isItANewBrick("a326")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[326] . ' "id="a327" ' . 'onclick="brickClicked(' . "'a327')".'"' . toCommentOrNot(isItANewBrick("a327")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[327] . ' "id="a328" ' . 'onclick="brickClicked(' . "'a328')".'"' . toCommentOrNot(isItANewBrick("a328")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[328] . ' "id="a329" ' . 'onclick="brickClicked(' . "'a329')".'"' . toCommentOrNot(isItANewBrick("a329")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[329] . ' "id="a330" ' . 'onclick="brickClicked(' . "'a330')".'"' . toCommentOrNot(isItANewBrick("a330")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[330] . ' "id="a331" ' . 'onclick="brickClicked(' . "'a331')".'"' . toCommentOrNot(isItANewBrick("a331")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[331] . ' "id="a332" ' . 'onclick="brickClicked(' . "'a332')".'"' . toCommentOrNot(isItANewBrick("a332")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[332] . ' "id="a333" ' . 'onclick="brickClicked(' . "'a333')".'"' . toCommentOrNot(isItANewBrick("a333")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[333] . ' "id="a334" ' . 'onclick="brickClicked(' . "'a334')".'"' . toCommentOrNot(isItANewBrick("a334")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[334] . ' "id="a335" ' . 'onclick="brickClicked(' . "'a335')".'"' . toCommentOrNot(isItANewBrick("a335")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[335] . ' "id="a336" ' . 'onclick="brickClicked(' . "'a336')".'"' . toCommentOrNot(isItANewBrick("a336")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[336] . ' "id="a337" ' . 'onclick="brickClicked(' . "'a337')".'"' . toCommentOrNot(isItANewBrick("a337")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[337] . ' "id="a338" ' . 'onclick="brickClicked(' . "'a338')".'"' . toCommentOrNot(isItANewBrick("a338")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[338] . ' "id="a339" ' . 'onclick="brickClicked(' . "'a339')".'"' . toCommentOrNot(isItANewBrick("a339")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[339] . ' "id="a340" ' . 'onclick="brickClicked(' . "'a340')".'"' . toCommentOrNot(isItANewBrick("a340")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[340] . ' "id="a341" ' . 'onclick="brickClicked(' . "'a341')".'"' . toCommentOrNot(isItANewBrick("a341")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[341] . ' "id="a342" ' . 'onclick="brickClicked(' . "'a342')".'"' . toCommentOrNot(isItANewBrick("a342")) . '></div>'); 
          //  <!-- Row 20 -->
             echo('<div class="brickStyle ' . $result[342] . ' "id="a343" ' . 'onclick="brickClicked(' . "'a343')".'"' . toCommentOrNot(isItANewBrick("a343")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[343] . ' "id="a344" ' . 'onclick="brickClicked(' . "'a344')".'"' . toCommentOrNot(isItANewBrick("a344")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[344] . ' "id="a345" ' . 'onclick="brickClicked(' . "'a345')".'"' . toCommentOrNot(isItANewBrick("a345")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[345] . ' "id="a346" ' . 'onclick="brickClicked(' . "'a346')".'"' . toCommentOrNot(isItANewBrick("a346")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[346] . ' "id="a347" ' . 'onclick="brickClicked(' . "'a347')".'"' . toCommentOrNot(isItANewBrick("a347")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[347] . ' "id="a348" ' . 'onclick="brickClicked(' . "'a348')".'"' . toCommentOrNot(isItANewBrick("a348")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[348] . ' "id="a349" ' . 'onclick="brickClicked(' . "'a349')".'"' . toCommentOrNot(isItANewBrick("a349")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[349] . ' "id="a350" ' . 'onclick="brickClicked(' . "'a350')".'"' . toCommentOrNot(isItANewBrick("a350")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[350] . ' "id="a351" ' . 'onclick="brickClicked(' . "'a351')".'"' . toCommentOrNot(isItANewBrick("a351")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[351] . ' "id="a352" ' . 'onclick="brickClicked(' . "'a352')".'"' . toCommentOrNot(isItANewBrick("a352")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[352] . ' "id="a353" ' . 'onclick="brickClicked(' . "'a353')".'"' . toCommentOrNot(isItANewBrick("a353")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[353] . ' "id="a354" ' . 'onclick="brickClicked(' . "'a354')".'"' . toCommentOrNot(isItANewBrick("a354")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[354] . ' "id="a355" ' . 'onclick="brickClicked(' . "'a355')".'"' . toCommentOrNot(isItANewBrick("a355")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[355] . ' "id="a356" ' . 'onclick="brickClicked(' . "'a356')".'"' . toCommentOrNot(isItANewBrick("a356")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[356] . ' "id="a357" ' . 'onclick="brickClicked(' . "'a357')".'"' . toCommentOrNot(isItANewBrick("a357")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[357] . ' "id="a358" ' . 'onclick="brickClicked(' . "'a358')".'"' . toCommentOrNot(isItANewBrick("a358")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[358] . ' "id="a359" ' . 'onclick="brickClicked(' . "'a359')".'"' . toCommentOrNot(isItANewBrick("a359")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[359] . ' "id="a360" ' . 'onclick="brickClicked(' . "'a360')".'"' . toCommentOrNot(isItANewBrick("a360")) . '></div>'); 
          //  <!-- Row 21 -->
             echo('<div class="brickStyle ' . $result[360] . ' "id="a361" ' . 'onclick="brickClicked(' . "'a361')".'"' . toCommentOrNot(isItANewBrick("a361")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[361] . ' "id="a362" ' . 'onclick="brickClicked(' . "'a362')".'"' . toCommentOrNot(isItANewBrick("a362")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[362] . ' "id="a363" ' . 'onclick="brickClicked(' . "'a363')".'"' . toCommentOrNot(isItANewBrick("a363")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[363] . ' "id="a364" ' . 'onclick="brickClicked(' . "'a364')".'"' . toCommentOrNot(isItANewBrick("a364")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[364] . ' "id="a365" ' . 'onclick="brickClicked(' . "'a365')".'"' . toCommentOrNot(isItANewBrick("a365")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[365] . ' "id="a366" ' . 'onclick="brickClicked(' . "'a366')".'"' . toCommentOrNot(isItANewBrick("a366")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[366] . ' "id="a367" ' . 'onclick="brickClicked(' . "'a367')".'"' . toCommentOrNot(isItANewBrick("a367")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[367] . ' "id="a368" ' . 'onclick="brickClicked(' . "'a368')".'"' . toCommentOrNot(isItANewBrick("a368")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[368] . ' "id="a369" ' . 'onclick="brickClicked(' . "'a369')".'"' . toCommentOrNot(isItANewBrick("a369")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[369] . ' "id="a370" ' . 'onclick="brickClicked(' . "'a370')".'"' . toCommentOrNot(isItANewBrick("a370")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[370] . ' "id="a371" ' . 'onclick="brickClicked(' . "'a371')".'"' . toCommentOrNot(isItANewBrick("a371")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[371] . ' "id="a372" ' . 'onclick="brickClicked(' . "'a372')".'"' . toCommentOrNot(isItANewBrick("a372")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[372] . ' "id="a373" ' . 'onclick="brickClicked(' . "'a373')".'"' . toCommentOrNot(isItANewBrick("a373")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[373] . ' "id="a374" ' . 'onclick="brickClicked(' . "'a374')".'"' . toCommentOrNot(isItANewBrick("a374")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[374] . ' "id="a375" ' . 'onclick="brickClicked(' . "'a375')".'"' . toCommentOrNot(isItANewBrick("a375")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[375] . ' "id="a376" ' . 'onclick="brickClicked(' . "'a376')".'"' . toCommentOrNot(isItANewBrick("a376")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[376] . ' "id="a377" ' . 'onclick="brickClicked(' . "'a377')".'"' . toCommentOrNot(isItANewBrick("a377")) . '></div>'); 
             echo('<div class="brickStyle ' . $result[377] . ' "id="a378" ' . 'onclick="brickClicked(' . "'a378')".'"' . toCommentOrNot(isItANewBrick("a378")) . '></div>'); 
          }
          ?>
          </div>
        </div>
      </div>
    </div>
    <input type="checkbox" id="modifyMode" class="doodad" onclick="makeTheWholeArrayShowUp()" > <!-- Toggle switch -->
    <label for="colorToggle">Enable Layout Modification</label>
    <button type="button" class="finalize button" onclick="updateLayout()"> Finalize Layout Changes </button>
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
