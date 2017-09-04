<?php foreach($activities as $activity) { ?>
<div class="vertical-timeline-block">
    <div class="vertical-timeline-icon">
        <!-- <i class="fa fa-calendar c-accent"></i> -->
        <img class="img-responsive" src="<?php echo $activity->photo_path; ?>" style="border-radius: 50%; min-height: 40px;" onError="this.onerror=null;this.src='assets/img/default-user-image.png';">
    </div>
    <div class="vertical-timeline-content">
        <div class="p-sm">
            <span class="vertical-date pull-right"><?php echo $activity->time_description; ?></small></span>
            <span style="color: #067cb2;"><?php echo $activity->username; ?></span><br><i><?php echo $activity->message; ?></i><br> on <?php echo $activity->date; ?>
        </div>
    </div>
</div>
<?php } ?>