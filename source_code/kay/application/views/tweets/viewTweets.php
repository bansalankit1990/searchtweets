
<?php if (isset($error)) {  echo $error."<br/>" ;} ?>
<?php if (isset($status)) { ?>

<table>
    <th>Status</th>
  <?php  
foreach ($status as $status_text): ?>

    <tr>
        <td><?php echo $status_text ?></td>
    </tr>

<?php endforeach ?>
    
    
    

</table>
<?php } ?>
<style>
  table {border: 1px solid black}
  th {border: 1px solid black}
  tr   {border: 1px solid black}
  td    {border: 1px solid black}
</style>