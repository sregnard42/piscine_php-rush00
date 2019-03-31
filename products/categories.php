<?php
$query = mysqli_query($link, "SELECT * FROM categories ");
?>
<section class="categorie">
<?php
while (($array = mysqli_fetch_assoc($query)) !== null) {
    echo "<a href='/index.php?id=".$array['id']."'><button class=\"myButton\">".$array['name']."</button></a>";
}
?>
</section>
