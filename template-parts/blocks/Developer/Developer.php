<?php


$name = get_field('Developer-name') ?: 'Developer-name...';
$image = get_field('Developer-image') ?: 'http://localhost/senpai/wp-content/uploads/2020/09/image_preview.jpeg';
$Skils = get_field('Skils') ?: 'Skils...';

?>

<div class="Developer">

<img src=" <?php echo $image  ?> ">
<p class="Developer-name"> <?php echo $name   ?> </p>
<p class="Skils"> <?php echo $Skils   ?> </p>



</div>