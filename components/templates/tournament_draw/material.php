<?php 
function event_warp($tournament_id){
    $sql = "SELECT * FROM event_list WHERE tournament_id = ?";
    global $cms_access;
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("i", $tournament_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()):?>
        <div class="Event">
            <div class="Name"><?php echo $row['event_name']; ?></div>
            <div class="List">
                <ul>
                    <?php get_draw( $row['event_id'] ); ?>
                </ul>
            </div>
        </div>
<?php endwhile;
    $stmt->close();
}

function get_draw($event_id) {
    $sql = "SELECT * FROM child_event_list WHERE event_id = ? AND status = ?";
    $status = 1;
    global $cms_access;
    $stmt = $cms_access->prepare($sql);
    $stmt->bind_param("ii", $event_id, $status);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()):?>
            <li><a href="<?=home_url('Tournament/Draw/View?tournament_id=').$_GET['tournament_id'].'&child_event_id='.$row['id'];?>"><?php echo $row['child_event_name']; ?>( Web版 )</a></li>
        <?php endwhile;
    } else {
        echo "<li>まだドローが公開されていません。</li>";
    }

    $stmt->close();
}
