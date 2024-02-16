<h1><?php echo $heading; ?></h1>

<!-- to iterate through the listings array, we use a foreach loop -->
<?php foreach ($listings as $listing) : ?>
    <!-- we paste the data from our route into html elements in this view: -->
    <h2><?php echo $listing['title']; ?></h2>
    <p><?php echo $listing['description']; ?></p>
<?php endforeach; ?>
<!-- we must also close the loop -->