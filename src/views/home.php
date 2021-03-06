<?php


use app\components\Archive;

$timestamp = $archive->description->timestamp;


$date = date("F j, Y, g:i a", strtotime($timestamp));

if($archive->resources == []){
    Archive::noResult($date);
}



foreach ($archive->resources as $resource) {

    if($resource->contents == []){
        
        Archive::begin($resource->channel_name, $date, false);
        Archive::end(); 
    }else{
        Archive::begin($resource->channel_name, $date);
        Archive::renderScreenshot($resource->screenshot_path, $resource->channel_id);
        Archive::renderLinks($resource->contents);
        Archive::end();
        
    }

}
?>


<?php if(isset($context)) {?>

<script>
    const context = {
        date: <?php echo json_encode($context->date); ?>,
        earliestDate: <?php echo json_encode($context->earliestDate); ?>,
        timeslots: <?php echo json_encode($context->timeslots); ?>,
    }
</script>

<?php } ?>


