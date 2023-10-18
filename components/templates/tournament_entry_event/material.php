<?php 
function get_valid_event(){
    $Already_entered = get_user_entry_event($_SESSION['user_id']);
    get_tournament_event_entry_data(h($_GET['tournament_id']),$Already_entered);
}

//種目情報取得関数(エントリー済み＋満員検知)
function get_tournament_event_entry_data($tournament_id,$Already_entered) {
    $sql = "SELECT event_id FROM event_list WHERE tournament_id = ?";
    global $cms_access; 
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("i", $tournament_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $event_data = get_single_tournament_event($row['event_id']); 
            $entry_number = get_entry_number($row['event_id']);
            
            if ($Already_entered !== null) {
                if (in_array($row['event_id'], $Already_entered)) { 
                    //エントリー済みの処理 ?>
                    <div class="value">
                        <input type="radio" name="event_id" disabled>
                        <div class="event_about">
                            <div class="event_name"><?php echo $event_data['event_name'] ?></div>
                            <div class="target"><?php echo nl2br($event_data['target']) ?></div>
                        </div>
                        <div class="event_capacity">エントリー済</div>
                    </div>
            <?php
                }else{
                    if(get_event_entry_status($row['event_id'])){
                        //エントリー可能
                    ?>
                        <div class="value">
                            <input type="radio" name="event_id" value="<?php echo $row['event_id'] ?>">
                            <div class="event_about">
                                <div class="event_name"><?php echo $event_data['event_name'] ?></div>
                                <div class="target"><?php echo nl2br($event_data['target']) ?></div>
                            </div>
                            <div class="event_capacity"><?php echo $entry_number ?>枠&nbsp;/&nbsp;<?php echo $event_data['capacity'] ?>枠</div>
                        </div>
                    <?php    
                    }else{
                        //エントリー不可
                    ?>
                        <div class="value">
                            <input type="radio" name="event_id" disabled>
                            <div class="event_about">
                                <div class="event_name"><?php echo $event_data['event_name'] ?></div>
                                <div class="target"><?php echo nl2br($event_data['target']) ?></div>
                            </div>
                            <div class="event_capacity">満枠</div>
                        </div>
                    <?php
                    }
                }
            }else{
                if(get_event_entry_status($row['event_id'])){
                    //エントリー可能
                ?>
                    <div class="value">
                        <input type="radio" name="event_id" value="<?php echo $row['event_id'] ?>">
                        <div class="event_about">
                            <div class="event_name"><?php echo $event_data['event_name'] ?></div>
                            <div class="target"><?php echo nl2br($event_data['target']) ?></div>
                        </div>
                        <div class="event_capacity"><?php echo $entry_number ?>枠&nbsp;/&nbsp;<?php echo $event_data['capacity'] ?>枠</div>
                    </div>
                <?php    
                }else{
                    //エントリー不可
                ?>
                    <div class="value">
                        <input type="radio" name="event_id" disabled>
                        <div class="event_about">
                            <div class="event_name"><?php echo $event_data['event_name'] ?></div>
                            <div class="target"><?php echo nl2br($event_data['target']) ?></div>
                        </div>
                        <div class="event_capacity">満枠</div>
                    </div>
                <?php
                }
            }
        }
    }else{
        
    }

    $stmt->close();
}
