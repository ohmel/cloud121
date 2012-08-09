<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->breadcrumbs=array(
	'Search Website',
);

?>
<style>
    .search-div{
        /*        border: 1px solid #C9E0ED;*/
        padding: 10px;
        margin: 10px;
    }
    #search-numrecs{
        /*        border: 1px solid #C9E0ED;*/
        padding: 10px;
    }
</style>
<div id="search-numrecs">
    Displaying <?php echo count($results);?> records matching your search keywords.
</div>

<?php if(count($results) != 0) { ?>
    <?php for ($i = 0; $i < count($results); $i++) { ?>
        <div class="search-div">
            <div class="search-title"><?php echo CHtml::link(strtoupper($results[$i]['search_title']), 'index.php?r=' . $results[$i]['search_link'], array('class' => 'search-title-lnk')); ?></a></div>
            <div class="search-desc"><?php echo $results[$i]['search_desc'] ?></div>

        </div>
    <?php } ?>
<?php }else{ ?>
<div class="search-div">
    No Results Found!
</div>
    
<?php }?>
