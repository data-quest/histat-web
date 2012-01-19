<div id="timeline">
  
  
    <?php 
    $options = array();
    foreach($names as $name):
    $options[$name->ID_HS] = $name->Name;
     endforeach;
    ?>
     <?= Form::select('table',$options,NULL,array('type'=>'checkbox','style'=>'width:500px')) ?>
    
    
     
</div>