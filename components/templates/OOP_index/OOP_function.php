<?php
    function initialProcessing(){
        if(isset($_GET['tournament_id'])){
            $tournament_id = $_GET['tournament_id'];
            $table_name = $tournament_id."_game_index";
            $query = "SHOW TABLES LIKE '$table_name'";
            global $tournament_access;
            $stmt = $tournament_access -> prepare($query);
            if($stmt ===  false){
                die("プリペアードステートメントの準備に失敗しました。");
            }
            if($stmt->execute() === false){
                die("クエリの実行に失敗しました。");
            }
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                global $is_start_tournament;
                $is_start_tournament = true;
                if(isset($_GET['venue'])){
                    //venueが定義されている場合
                    global $venue;
                    $venue = $_GET['venue'];
                }else{
                    //venueが定義されていない場合
                    $query2 = "SELECT DISTINCT venue_id FROM ".$tournament_id."_venues WHERE event_date = '".date('Y-m-d')."'";
                    global $tournament_access;
                    $stmt2 = $tournament_access -> prepare($query2);
                    if($stmt2 ===  false){
                        die("プリペアードステートメントの準備に失敗しました。");
                    }
                    if($stmt2->execute() === false){
                        die("クエリの実行に失敗しました。");
                    }
                    $result2 = $stmt2->get_result();
                    if($result2->num_rows > 1){
                        //複数の会場が存在する場合
                        echo '<script>window.location.href = "'.home_url('OOP/venue').'?'.http_build_query($_GET).'";</script>';
                    }elseif($result2->num_rows == 1){
                        //1つの会場が存在する場合
                        $row2 = $result2->fetch_assoc();

                        $venue = $row2['venue_id'];
                        echo '<script>window.location.href = "'.home_url('OOP').'?'.http_build_query($_GET).'&venue='.$venue.'";</script>';
                    }else{
                        //会場が存在しない場合
                        echo '<script>window.location.href = "'.home_url('OOP').'?'.http_build_query($_GET).'&venue=noexist";</script>';
                        $venue = 'noexist';
                    }
                }
            }else{
                $is_start_tournament = false;
            }
        }else{
            //もし$_GET['tournament_id']が存在しない場合は、不正アクセスとして不正アクセスページにリダイレクト
            echo '<script>window.location.href = "'.home_url('OOP/Incorrect_access').'";</script>';
        }
    }
?>