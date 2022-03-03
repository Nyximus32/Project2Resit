<?php
$min_age = 18; // Set the min age in years

if( isset( $_POST['submit'] ) )
{
    if( mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year'] ) < mktime(0, 0, 0, date('m'), date('j'), ( date('Y') - $min_age ) ) )
    {
        var_dump("over $min_age");
    }
    else
    {
        var_dump("under $min_age");
    }
}

?>

<form method="POST" >
<fieldset>
<legend>Enter your age</legend>
<label for="day" >Day:</label>
<select name="day" >
<?php
    for( $x=1; $x <= 31; $x++ )
    {
        if( $x == date("j" ) ) echo "<option selected>$x</option>"; else echo "<option>$x</option>";
    }
?>
</select>
<label for="day" >Month:</label>
<select name="month" >
<?php
    for( $x=1; $x<=12; $x++ )
    {
        if( $x == date("m" ) ) echo "<option selected>$x</option>"; else echo "<option>$x</option>";
    }
?>
</select>
<label for="day" >Year:</label>
<select name="year" >
<?php
    for( $x=date("Y"); $x>=(date("Y")-100); $x-- )
    {
        echo "<option>$x</option>";
    }
?>
</select>
<input type="submit" name="submit" />
</fieldset>
</form>