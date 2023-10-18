<?php //structureのcss読み込み 
 $structures = array('header','footer','menu_bar');
?>
<?php foreach($structures as $single_structure):?>
    <link rel="stylesheet" href="/components/common/structure/<?php echo $single_structure ?>/<?php echo $single_structure ?>.min.css" media="screen,print">
<?php endforeach?>