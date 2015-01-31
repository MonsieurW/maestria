 <?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');
?>
<table>
  <thead>
    <tr>
      <th>Eleves</th>
      <?php foreach ($data_d as $id) {
        echo '<th>'.ucfirst($domain[$id]).'</th>';
      }
      ?>
    </tr>
  </thead>
  <tbody>
      <?php
      foreach ($x as $uid => $e) {
        echo '<tr>';
        echo '<td>'.((isset($data_e[$uid])) ? $data_e[$uid] : $uid).'</td>';

        foreach ($data_d as $id) {

          if(isset($e[$id])){
            $eval       = $e[$id];
            $evaluation = [];

            foreach ($eval as $key => $value) {
              $ec           = (array_sum($value) / count($value)) * 100 ;
              $ec           = ($ec * 20) / 100;
              $evaluation[] = $ec; 
            }
            
            echo '<td class="raphy" data-value="'.json_encode($evaluation).'"><p class="foo">'.((round(array_sum($evaluation) / count($evaluation)) * 2) / 2).'</p></td>';
          }
          else {
            echo '<td>Empty</td>';
          }

        }
        echo '</tr>'."\n";
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
 ?>