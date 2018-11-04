<?php
if(isset($_POST['submit'])){
$selected_val = $_POST['Fleur'];  // Storing Selected Value In Variable
echo "You have selected :" .$selected_val;  // Displaying Selected Value
}
else{
    ?>
    <form action="#" method="post">
    <label for="Biome">Biome : </label>
    <select name="Biome">
        <option value="Prairie">Prairie</option>
        <option value="Desert">Desert</option>
        <option value="Montage">Montage</option>
        <option value="Taiga">Taiga</option>
        <option value="Tropical">Tropical</option>
    </select>
    <label for="Fleur">Fleur : </label>
    <select name="Fleur">
        <option value="Tuplie">Tuplie</option>
        <option value="Rose">Rose</option>

    </select>
    <label for="AI">AI : </label>
    <select name="ai">
        <option value="Facile">Facile</option>
        <option value="Difficile">Difficile</option>
    </select>
    <label for="nbTours">nb de tours : </label>
    <input type="number" name="nbTours" />
<input type="submit" name="submit" value="lancer partie" />
</form>
<?php
}
?>