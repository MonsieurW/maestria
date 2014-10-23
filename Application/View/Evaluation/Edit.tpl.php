<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('stylesheet');
?>
<link href="/css/app.css" rel="stylesheet">
<?php
$this->endBlock();
$this->block('container');
?>
<form class="form-horizontal" role="form" style="margin-top: 10px" method="post" action="/professor/<?php echo $pid; ?>/evaluation/<?php echo $eid; ?>/update">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Titre</label>
    <div class="col-sm-5">
      <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="Titre" value="<?php echo $evaluation['label'];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-5">
      <textarea name="description" class="form-control"><?php echo $evaluation['description']; ?> </textarea>
    </div>
  </div>

  <h3 id="quest" data-max="30">Questions</h3>
    <?php foreach ($questions as $question) { ?>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">#<?php echo $question['idQuestion']; ?></label>
      <div class="col-sm-8 questions">

        <div class="form-group">
          <label for="firstname" class="col-md-3 control-label">Titre</label>
          <div class="col-md-8">
            <input type="text" name="q<?php echo $question['idQuestion']; ?>_title" class="form-control" id="inputEmail3" placeholder="Titre" value="<?php echo $question['title']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="firstname" class="col-md-3 control-label">Niveau Taxonomique</label>
          <div class="col-md-8">
            <select name="q<?php echo $question['idQuestion']; ?>_taxo" class="form-control">
              <option value="1" <?php echo ($question['taxoPrincipal'] === '1') ? 'selected="true"' : '' ?> >Connaissance</option>
              <option value="2" <?php echo ($question['taxoPrincipal'] === '2') ? 'selected="true"' : '' ?> >Compréhension</option>
              <option value="3" <?php echo ($question['taxoPrincipal'] === '3') ? 'selected="true"' : '' ?> >Application</option>
              <option value="4" <?php echo ($question['taxoPrincipal'] === '4') ? 'selected="true"' : '' ?> >Analyse</option>
            </select>
          </div>
        </div> 
        <div class="form-group">
          <label for="firstname" class="col-md-3 control-label">Note</label>
          <div class="col-md-8">
            <input type="text" name="q<?php echo $question['idQuestion']; ?>_note" class="form-control" id="inputEmail3" placeholder="Note"  value="<?php echo $question['note']; ?>"/>
          </div>
        </div>
      
        <div class="form-group">
          <label for="firstname" class="col-md-3 control-label">Item 1</label>
          <div class="col-md-8">
            <div class="input-group">
              <input value="<?php echo $question['refItem1']; ?>" name="q<?php echo $question['idQuestion']; ?>_item1" class="form-control" type="hidden">
              <input value="<?php echo $question['item1Label']; ?>" placeholder="Item 1" class="form-control" type="text">
              <span class="input-group-btn">
                <button class="button btn btn-default choose"><i class="fa fa-briefcase"></i></button>
              </span>
            </div>
          </div>
        </div> 

        <div class="form-group">
          <label for="firstname" class="col-md-3 control-label">Item 2</label>
            <div class="col-md-8">
              <div class="input-group">
                <input value="<?php echo $question['refItem2']; ?>" name="q<?php echo $question['idQuestion']; ?>_item2" class="form-control" type="hidden">
                <input value="<?php echo $question['item2Label']; ?>" placeholder="Item 2" class="form-control" type="text">
                <span class="input-group-btn">
                  <button class="button btn btn-default choose"><i class="fa fa-briefcase"></i></button>
                </span>
              </div>
            </div>
        </div>

      </div>
    </div>
    <?php } ?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Choissiez une compétence</h4>
      </div>
      <div class="modal-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <?php foreach ($domain as $key => $value) { ?>
            <li>
              <a href="#<?php echo strtolower($value['domainValue']); ?>" role="tab" data-toggle="tab">
                <?php echo ucfirst($value['domainValue']); ?>
              </a>
            </li>  
          <?php } ?>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
        <?php foreach ($domain as $key => $value) { ?>
            <div class="tab-pane" id="<?php echo strtolower($value['domainValue']); ?>"></div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

    <div class="btn-on-bottom">
      <button type="submit" class="btn btn-success">Create</button>
    </div>

</form>
<?php
$this->endBlock();
$this->block('script');
?>
  <script src="https://raw.githubusercontent.com/twitter/typeahead.js/master/dist/bloodhound.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
  <script src="/js/handlebars.js"></script>
  <script src="/js/app.form.js"></script>
<?php
$this->endBlock();
?>
