</p><div class="d-flex justify-content-center align-self-center" style="margin-top: 100px;">
    <h5 class="text-center">Current PDF Projects</h5>
</div>
<div class="d-flex justify-content-center align-self-center" style="margin-top: 55px;">
    <ul>
        <?php foreach ($records as $row):?>
            <li><a href="display.php?ID=<?=$row['ID']?>" target="_blank"><?=$row['project_name']?></a></li>
        <?php endforeach;?>
    </ul>
</div>