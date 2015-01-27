<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');

$eleve = [
  1  => 'Patrick',
  8  => 'Suzanne',
  12 => 'Mélanie'
];

$data = [
  'Physique' => [1 => [1,2,3,4,5,6,7,20],           8 => [1,2,3,4,5,6,7], 12 => [1,2,3,4,5,6,7]],
  'Chimie'   => [1 => [8,9,10,11,12,13],            8 => [1,2,3,4,5,6,7], 12 => [1,2,3,4,5,6,7]],
  'Optique'  => [1 => [14,15,16,17,18,19,20,0,1,2], 8 => [1,2,3,4,5,6,7], 12 => [1,2,3,4,5,6,7]],
];

$domain = array_keys($data);
?>
<div id="holder"></div>
<table>
  <thead>
    <tr>
      <th>Eleves</th>
      <?php foreach ($domain as $value) {
        echo '<th>'.$value.'</th>';
      }
      ?>
    </tr>
  </thead>
  <tbody>
      <?php
      foreach ($eleve as $uid => $name) {
        echo '<tr>';
        echo '<td>'.$name.'</td>';
        foreach ($domain as $value) {
          $note = $data[$value][$uid];
          echo '<td class="raphy" data-value="'.json_encode($note).'"><p>'.(array_sum($note)/count($note)).'</p></td>';
        }
        echo '</tr>';

      }
      ?>
  </tbody>
</table>
<?php
$this->endBlock();
$this->block('script');
?>
<script src="/js/dashboard.js"></script>
<?php
$this->endBlock();
