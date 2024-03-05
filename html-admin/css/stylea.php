<?php
    //potentially not needed? copying and pasting all css to be within the <style> tags in the html doc seems to have worked ok
    //furthermore, it prevents me from having to figure out how to write css within a php file
    header("Content-type: text/css; charset: UTF-8");
    //connection variables
    $servername = "localhost";
 	$dbname = "manchester_veterans_memorial_database";
 	$uname = "phpmyadmin";
 	$psword = "Y4VnqfDCz2vvMkv";
    //variables actually needed for the css
    $brickNum = (isset($_REQUEST['brickNum']) ? $_REQUEST['brickNum'] : null);
    $gridTemplateAreasId = (isset($_REQUEST['gridTemplateAreasId']) ? $_REQUEST['gridTemplateAreasId'] : null);

    try {
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $uname, $psword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety
        $stmt = null;

        $stmt = $conn->prepare("SELECT gridTemplateAreasId FROM a_brick_group WHERE brickNum = ?");
        $stmt->bindParam(1, $brickNum, PDO::PARAM_INT, 3);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt->fetchAll();
        for($i=0; $i < 378; $i++){
            echo $result[$i];
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    <<<CSS
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
            * passed in (using --frame-max-height). This effectively clamps the height.
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
        
        grid-template-areas: 
        "brickR1C1 brickR1C1 brickR1C3 brickR1C3 brickR1C5 brickR1C5 brickR1C7 brickR1C7 brickR1C9 brickR1C9 brickR1C11 brickR1C11 brickR1C13 brickR1C13 brickR1C15 brickR1C15 brickR1C17 brickR1C17"
        "brickR2C1 brickR2C2 brickR2C2 brickR2C4 brickR2C4 brickR2C6 brickR2C6 brickR2C8 brickR2C8 brickR2C10 brickR2C10 brickR2C12 brickR2C12 brickR2C14 brickR2C14 brickR2C16 brickR2C16 brickR2C18"
        "brickR3C1 brickR3C1 brickR3C3 brickR3C3 brickR3C5 brickR3C6 brickR3C6 brickR3C8 brickR3C9 brickR3C9 brickR3C11 brickR3C11 brickR3C13 brickR3C13 brickR3C15 brickR3C16 brickR3C16 brickR3C18"
        "brickR4C1 brickR4C2 brickR4C2 brickR4C4 brickR4C4 brickR3C6 brickR3C6 brickR4C8 brickR4C8 brickR4C10 brickR4C10 brickR4C12 brickR4C12 brickR4C14 brickR4C14 brickR3C16 brickR3C16 brickR4C18"
        "brickR5C1 brickR5C1 brickR5C3 brickR5C3 brickR5C5 brickR5C5 brickR5C7 brickR5C7 brickR5C9 brickR5C9 brickR5C11 brickR5C11 brickR5C13 brickR5C13 brickR5C15 brickR5C15 brickR5C17 brickR5C17"
        "brickR6C1 brickR6C2 brickR6C2 brickR6C4 brickR6C5 brickR6C5 brickR6C7 brickR6C8 brickR6C8 brickR6C10 brickR6C10 brickR6C12 brickR6C12 brickR6C14 brickR6C14 brickR6C16 brickR6C16 brickR6C18"
        "brickR7C1 brickR7C1 brickR7C3 brickR7C3 brickR6C5 brickR6C5 brickR7C7 brickR7C7 brickR7C9 brickR7C9 brickR7C11 brickR7C11 brickR7C13 brickR7C14 brickR7C14 brickR7C16 brickR7C17 brickR7C17"
        "brickR8C1 brickR8C2 brickR8C2 brickR8C4 brickR8C4 brickR8C6 brickR8C6 brickR8C8 brickR8C8 brickR8C10 brickR8C10 brickR8C12 brickR8C12 brickR7C14 brickR7C14 brickR8C16 brickR8C16 brickR8C18"
        "brickR9C1 brickR9C1 brickR9C3 brickR9C3 brickR9C5 brickR9C5 brickR9C7 brickR9C7 brickR9C9 brickR9C9 brickR9C11 brickR9C11 brickR9C13 brickR9C13 brickR9C15 brickR9C15 brickR9C17 brickR9C17"
        "brickR10C1 brickR10C2 brickR10C2 brickR10C4 brickR10C4 brickR10C6 brickR10C6 brickR10C8 brickR10C8 brickR10C10 brickR10C10 brickR10C12 brickR10C12 brickR10C14 brickR10C14 brickR10C16 brickR10C16 brickR10C18"
        "brickR11C1 brickR11C1 brickR11C3 brickR11C3 brickR11C5 brickR11C5 brickR11C7 brickR11C7 brickR11C9 brickR11C9 brickR11C11 brickR11C11 brickR11C13 brickR11C13 brickR11C15 brickR11C16 brickR11C16 brickR11C18"
        "brickR12C1 brickR12C2 brickR12C3 brickR12C3 brickR12C5 brickR12C6 brickR12C6 brickR12C8 brickR12C8 brickR12C10 brickR12C10 brickR12C12 brickR12C12 brickR12C14 brickR12C14 brickR12C16 brickR12C16 brickR12C18"
        "brickR13C1 brickR13C1 brickR12C3 brickR12C3 brickR13C5 brickR13C5 brickR13C7 brickR13C7 brickR13C9 brickR13C9 brickR13C11 brickR13C11 brickR13C13 brickR13C13 brickR13C15 brickR13C15 brickR13C17 brickR13C17"
        "brickR14C1 brickR14C2 brickR14C2 brickR14C4 brickR14C4 brickR14C6 brickR14C6 brickR14C8 brickR14C8 brickR14C10 brickR14C10 brickR14C12 brickR14C12 brickR14C14 brickR14C14 brickR14C16 brickR14C16 brickR14C18"
        "brickR15C1 brickR15C1 brickR15C3 brickR15C3 brickR15C5 brickR15C5 brickR15C7 brickR15C8 brickR15C8 brickR15C10 brickR15C11 brickR15C11 brickR15C13 brickR15C13 brickR15C15 brickR15C15 brickR15C17 brickR15C17"
        "brickR16C1 brickR16C2 brickR16C2 brickR16C4 brickR16C4 brickR16C6 brickR16C6 brickR15C8 brickR15C8 brickR16C10 brickR16C10 brickR16C12 brickR16C12 brickR16C14 brickR16C14 brickR16C16 brickR16C16 brickR16C18"
        "brickR17C1 brickR17C1 brickR17C3 brickR17C3 brickR17C5 brickR17C5 brickR17C7 brickR17C7 brickR17C9 brickR17C9 brickR17C11 brickR17C11 brickR17C13 brickR17C13 brickR17C15 brickR17C15 brickR17C17 brickR17C17"
        "brickR18C1 brickR18C2 brickR18C2 brickR18C4 brickR18C4 brickR18C6 brickR18C6 brickR18C8 brickR18C8 brickR18C10 brickR18C10 brickR18C12 brickR18C12 brickR18C14 brickR18C14 brickR18C16 brickR18C16 brickR18C18"
        "brickR19C1 brickR19C1 brickR19C3 brickR19C3 brickR19C5 brickR19C5 brickR19C7 brickR19C7 brickR19C9 brickR19C9 brickR19C11 brickR19C12 brickR19C12 brickR19C14 brickR19C15 brickR19C15 brickR19C17 brickR19C17"
        "brickR20C1 brickR20C2 brickR20C2 brickR20C4 brickR20C4 brickR20C6 brickR20C6 brickR20C8 brickR20C8 brickR20C10 brickR20C10 brickR19C12 brickR19C12 brickR20C14 brickR20C14 brickR20C16 brickR20C16 brickR20C18"
        "brickR21C1 brickR21C1 brickR21C3 brickR21C3 brickR21C5 brickR21C5 brickR21C7 brickR21C7 brickR21C9 brickR21C9 brickR21C11 brickR21C11 brickR21C13 brickR21C13 brickR21C15 brickR21C15 brickR21C17 brickR21C17";
        }
        /* r20c16 was r20c15 */

        .brickStyle{
        border-color: blue;
        border-style: solid;
        border-width: 1px;
        font-size: 10px;
        }

        .brickR1C1 { grid-area: brickR1C1; }
        .brickR1C3 { grid-area: brickR1C3; }
        .brickR1C5 { grid-area: brickR1C5; }
        .brickR1C7 { grid-area: brickR1C7; }
        .brickR1C9 { grid-area: brickR1C9; }
        .brickR1C11 { grid-area: brickR1C11; }
        .brickR1C13 { grid-area: brickR1C13; }
        .brickR1C15 { grid-area: brickR1C15; }
        .brickR1C17 { grid-area: brickR1C17; }
        .brickR2C1 { grid-area: brickR2C1; }
        .brickR2C2 { grid-area: brickR2C2; }
        .brickR2C4 { grid-area: brickR2C4; }
        .brickR2C6 { grid-area: brickR2C6; }
        .brickR2C8 { grid-area: brickR2C8; }
        .brickR2C10 { grid-area: brickR2C10; }
        .brickR2C12 { grid-area: brickR2C12; }
        .brickR2C14 { grid-area: brickR2C14; }
        .brickR2C16 { grid-area: brickR2C16; }
        .brickR2C18 { grid-area: brickR2C18; }
        .brickR3C1 { grid-area: brickR3C1; }
        .brickR3C3 { grid-area: brickR3C3; }
        .brickR3C5 { grid-area: brickR3C5; }
        .brickR3C6 { grid-area: brickR3C6; }
        .brickR3C8 { grid-area: brickR3C8; }
        .brickR3C9 { grid-area: brickR3C9; }
        .brickR3C11 { grid-area: brickR3C11; }
        .brickR3C13 { grid-area: brickR3C13; }
        .brickR3C15 { grid-area: brickR3C15; }
        .brickR3C16 { grid-area: brickR3C16; }
        .brickR3C18 { grid-area: brickR3C18; }
        .brickR4C1 { grid-area: brickR4C1; }
        .brickR4C2 { grid-area: brickR4C2; }
        .brickR4C4 { grid-area: brickR4C4; }
        .brickR4C8 { grid-area: brickR4C8; }
        .brickR4C10 { grid-area: brickR4C10; }
        .brickR4C12 { grid-area: brickR4C12; }
        .brickR4C14 { grid-area: brickR4C14; }
        .brickR4C16 { grid-area: brickR4C16; }
        .brickR4C18 { grid-area: brickR4C18; }
        .brickR5C1 { grid-area: brickR5C1; }
        .brickR5C3 { grid-area: brickR5C3; }
        .brickR5C5 { grid-area: brickR5C5; }
        .brickR5C7 { grid-area: brickR5C7; }
        .brickR5C9 { grid-area: brickR5C9; }
        .brickR5C11 { grid-area: brickR5C11; }
        .brickR5C13 { grid-area: brickR5C13; }
        .brickR5C15 { grid-area: brickR5C15; }
        .brickR5C17 { grid-area: brickR5C17; }
        .brickR6C1 { grid-area: brickR6C1; }
        .brickR6C2 { grid-area: brickR6C2; }
        .brickR6C4 { grid-area: brickR6C4; }
        .brickR6C5 { grid-area: bri<<<CSSckR6C5; }
        .brickR6C7 { grid-area: brickR6C7; }
        .brickR6C8 { grid-area: brickR6C8; }
        .brickR6C10 { grid-area: brickR6C10; }
        .brickR6C12 { grid-area: brickR6C12; }
        .brickR6C14 { grid-area: brickR6C14; }
        .brickR6C16 { grid-area: brickR6C16; }
        .brickR6C18 { grid-area: brickR6C18; }
        .brickR7C1 { grid-area: brickR7C1; }
        .brickR7C3 { grid-area: brickR7C3; }
        .brickR7C5 { grid-area: brickR7C5; }
        .brickR7C7 { grid-area: brickR7C7; }
        .brickR7C9 { grid-area: brickR7C9; }
        .brickR7C11 { grid-area: brickR7C11; }
        .brickR7C13 { grid-area: brickR7C13; }
        .brickR7C14 { grid-area: brickR7C14; }
        .brickR7C16 { grid-area: brickR7C16; }
        .brickR7C17 { grid-area: brickR7C17; }
        .brickR8C1 { grid-area: brickR8C1; }
        .brickR8C2 { grid-area: brickR8C2; }
        .brickR8C4 { grid-area: brickR8C4; }
        .brickR8C6 { grid-area: brickR8C6; }
        .brickR8C8 { grid-area: brickR8C8; }
        .brickR8C10 { grid-area: brickR8C10; }
        .brickR8C12 { grid-area: brickR8C12; }
        .brickR8C14 { grid-area: brickR8C14; }
        .brickR8C16 { grid-area: brickR8C16; }
        .brickR8C18 { grid-area: brickR8C18; }
        .brickR9C1 { grid-area: brickR9C1; }
        .brickR9C3 { grid-area: brickR9C3; }
        .brickR9C5 { grid-area: brickR9C5; }
        .brickR9C7 { grid-area: brickR9C7; }
        .brickR9C9 { grid-area: brickR9C9; }
        .brickR9C11 { grid-area: brickR9C11; }
        .brickR9C13 { grid-area: brickR9C13; }
        .brickR9C15 { grid-area: brickR9C15; }
        .brickR9C17 { grid-area: brickR9C17; }
        .brickR10C1 { grid-area: brickR10C1; }
        .brickR10C2 { grid-area: brickR10C2; }
        .brickR10C4 { grid-area: brickR10C4; }
        .brickR10C6 { grid-area: brickR10C6; }
        .brickR10C8 { grid-area: brickR10C8; }
        .brickR10C10 { grid-area: brickR10C10; }
        .brickR10C12 { grid-area: brickR10C12; }
        .brickR10C14 { grid-area: brickR10C14; }
        .brickR10C16 { grid-area: brickR10C16; }
        .brickR10C18 { grid-area: brickR10C18; }
        .brickR11C1 { grid-area: brickR11C1; }
        .brickR11C3 { grid-area: brickR11C3; }
        .brickR11C5 { grid-area: brickR11C5; }
        .brickR11C7 { grid-area: brickR11C7; }
        .brickR11C9 { grid-area: brickR11C9; }
        .brickR11C11 { grid-area: brickR11C11; }
        .brickR11C13 { grid-area: brickR11C13; }
        .brickR11C15 { grid-area: brickR11C15; }
        .brickR11C16 { grid-area: brickR11C16; }
        .brickR11C18 { grid-area: brickR11C18; }
        .brickR12C1 { grid-area: brickR12C1; }
        .brickR12C2 { grid-area: brickR12C2; }
        .brickR12C3 { grid-area: brickR12C3; }
        .brickR12C5 { grid-area: brickR12C5; }
        .brickR12C6 { grid-area: brickR12C6; }
        .brickR12C8 { grid-area: brickR12C8; }
        .brickR12C10 { grid-area: brickR12C10; }
        .brickR12C12 { grid-area: brickR12C12; }
        .brickR12C14 { grid-area: brickR12C14; }
        .brickR12C16 { grid-area: brickR12C16; }
        .brickR12C18 { grid-area: brickR12C18; }
        .brickR13C1 { grid-area: brickR13C1; }
        .brickR13C3 { grid-area: brickR13C3; }
        .brickR13C5 { grid-area: brickR13C5; }
        .brickR13C7 { grid-area: brickR13C7; }
        .brickR13C9 { grid-area: brickR13C9; }
        .brickR13C11 { grid-area: brickR13C11; }
        .brickR13C13 { grid-area: brickR13C13; }
        .brickR13C15 { grid-area: brickR13C15; }
        .brickR13C17 { grid-area: brickR13C17; }
        .brickR14C1 { grid-area: brickR14C1; }
        .brickR14C2 { grid-area: brickR14C2; }
        .brickR14C4 { grid-area: brickR14C4; }
        .brickR14C6 { grid-area: brickR14C6; }
        .brickR14C8 { grid-area: brickR14C8; }
        .brickR14C10 { grid-area: brickR14C10; }
        .brickR14C12 { grid-area: brickR14C12; }
        .brickR14C14 { grid-area: brickR14C14; }
        .brickR14C16 { grid-area: brickR14C16; }
        .brickR14C18 { grid-area: brickR14C18; }
        .brickR15C1 { grid-area: brickR15C1; }
        .brickR15C3 { grid-area: brickR15C3; }
        .brickR15C5 { grid-area: brickR15C5; }
        .brickR15C7 { grid-area: brickR15C7; }
        .brickR15C8 { grid-area: brickR15C8; }
        .brickR15C10 { grid-area: brickR15C10; }
        .brickR15C11 { grid-area: brickR15C11; }
        .brickR15C13 { grid-area: brickR15C13; }
        .brickR15C15 { grid-area: brickR15C15; }
        .brickR15C17 { grid-area: brickR15C17; }
        .brickR16C1 { grid-area: brickR16C1; }
        .brickR16C2 { grid-area: brickR16C2; }
        .brickR16C4 { grid-area: brickR16C4; }
        .brickR16C6 { grid-area: brickR16C6; }
        .brickR16C8 { grid-area: brickR16C8; }
        .brickR16C10 { grid-area: brickR16C10; }
        .brickR16C12 { grid-area: brickR16C12; }
        .brickR16C14 { grid-area: brickR16C14; }
        .brickR16C16 { grid-area: brickR16C16; }
        .brickR16C18 { grid-area: brickR16C18; }
        .brickR17C1 { grid-area: brickR17C1; }
        .brickR17C3 { grid-area: brickR17C3; }
        .brickR17C5 { grid-area: brickR17C5; }
        .brickR17C7 { grid-area: brickR17C7; }
        .brickR17C9 { grid-area: brickR17C9; }
        .brickR17C11 { grid-area: brickR17C11; }
        .brickR17C13 { grid-area: brickR17C13; }
        .brickR17C15 { grid-area: brickR17C15; }
        .brickR17C17 { grid-area: brickR17C17; }
        .brickR18C1 { grid-area: brickR18C1; }
        .brickR18C2 { grid-area: brickR18C2; }
        .brickR18C4 { grid-area: brickR18C4; }
        .brickR18C6 { grid-area: brickR18C6; }
        .brickR18C8 { grid-area: brickR18C8; }
        .brickR18C10 { grid-area: brickR18C10; }
        .brickR18C12 { grid-area: brickR18C12; }
        .brickR18C14 { grid-area: brickR18C14; }
        .brickR18C16 { grid-area: brickR18C16; }
        .brickR18C18 { grid-area: brickR18C18; }
        .brickR19C1 { grid-area: brickR19C1; }
        .brickR19C3 { grid-area: brickR19C3; }
        .brickR19C5 { grid-area: brickR19C5; }
        .brickR19C7 { grid-area: brickR19C7; }
        .brickR19C9 { grid-area: brickR19C9; }
        .brickR19C11 { grid-area: brickR19C11; }
        .brickR19C12 { grid-area: brickR19C12; }
        .brickR19C14 { grid-area: brickR19C14; }
        .brickR19C15 { grid-area: brickR19C15; }
        .brickR19C17 { grid-area: brickR19C17; }
        .brickR20C1 { grid-area: brickR20C1; }
        .brickR20C2 { grid-area: brickR20C2; }
        .brickR20C4 { grid-area: brickR20C4; }
        .brickR20C6 { grid-area: brickR20C6; }
        .brickR20C8 { grid-area: brickR20C8; }
        .brickR20C10 { grid-area: brickR20C10; }
        .brickR20C14 { grid-area: brickR20C14; }
        .brickR20C16 { grid-area: brickR20C16; }
        .brickR20C18 { grid-area: brickR20C18; }
        .brickR21C1 { grid-area: brickR21C1; }
        .brickR21C3 { grid-area: brickR21C3; }
        .brickR21C5 { grid-area: brickR21C5; }
        .brickR21C7 { grid-area: brickR21C7; }
        .brickR21C9 { grid-area: brickR21C9; }
        .brickR21C11 { grid-area: brickR21C11; }
        .brickR21C13 { grid-area: brickR21C13; }
        .brickR21C15 { grid-area: brickR21C15; }
        .brickR21C17 { grid-area: brickR21C17; }

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
        CSS;
?>