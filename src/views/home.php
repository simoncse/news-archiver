<?php


use app\components\Archive;

foreach ($archive->resources as $resource) {

    Archive::begin($resource->channel_name);
    Archive::renderScreenshot($resource->screenshot_path, $resource->channel_id);
    Archive::renderLinks($resource->contents);
    Archive::end();
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


