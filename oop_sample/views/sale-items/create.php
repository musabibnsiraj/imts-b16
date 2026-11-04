<?php
require_once '../../models/Item.php';
$i = new Item();
$items = $i->getAll();
?>

<a href="index.php?sale_id=<?php echo $_GET['sale_id'];?>">Done</a>

<form action="save_and_update.php" method="post">
    <input type="hidden" name="sale_id" value="<?php echo $_GET['sale_id'] ?? '';?>" />
    <span>Item: </span>
    <select name="item_id">
        <option></option>
        <?php
        foreach($items as $i)
        {
            ?>
            <option value="<?php echo $i['id']?>"><?php echo $i['name'] . " - LKR " . $i['price']."";?></option>
            <?php
        }
        ?>
    </select>
    <span>Qty: </span>
    <input type="text" name="qty">
    <button>Save</button>
</form>

<a href="index.php?sale_id=<?php echo $_GET['sale_id'];?>">Done</a>