<?php 
//加盟団体の地域区分で連想配列を作成
$regions = array(
    array('region' => '関東', 'img' => '/files/material/organizations/kanto.png'),
    array('region' => '東北', 'img' => '/files/material/organizations/tohoku.png'),
    array('region' => '北海道', 'img' => '/files/material/organizations/hokkaido.png'),
    array('region' => '関西', 'img' => '/files/material/organizations/kansai.png'),
    array('region' => '中部', 'img' => '/files/material/organizations/chubu.png'),
    array('region' => '北陸', 'img' => '/files/material/organizations/hokuriku.png'),
    array('region' => '九州', 'img' => '/files/material/organizations/kyushu.png'),
    array('region' => '四国', 'img' => '/files/material/organizations/shikoku.png'),
    array('region' => '中国', 'img' => '/files/material/organizations/chugoku.png'),
);

//地域ごとの団体一覧を取得する関数
function get_group_by_regions( $region ){
    $sql = "SELECT organization_id, organization_name, permalink FROM organizations WHERE region = ?";
    global $organizations_access;
    $stmt = $organizations_access->prepare($sql);
    $stmt->bind_param("s", $region);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $organizations_data = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $organization_id = $row['organization_id'];
            $organization_name = $row['organization_name'];
            $permalink = $row['permalink'];
    
            $organization_entry = array(
                'organization_id' => $organization_id,
                'organization_name' => $organization_name,
                'permalink' => $permalink
            );
    
            $organizations_data[] = $organization_entry;
        }
    } else {
        $organizations_data[] = '';
    }
    
    return $organizations_data;

}

//検索アルゴリズム
function result_group_search( $query ){
    $query = '%' . $query . '%';
    $sql = "SELECT organization_name, permalink FROM organizations WHERE organization_name LIKE ?";
    global $organizations_access;
    $stmt = $organizations_access->prepare($sql);
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo '<ul>';
        while ($row = $result->fetch_assoc()): ?>
            <li><a href="<?php echo $row['permalink']; ?>"><?php echo $row['organization_name']; ?></a></li>
        <?php endwhile;
        echo '</ul>';
    } else {
        echo '該当する団体がありませんでした。';
    }
}
?>