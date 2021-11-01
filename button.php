<?php

class Button_modify{
    private $modify;
    private $before_modify;

public function __construct($modify, $before_modify){
        $this ->modify = $modify;
        $this ->before_modify = $before_modify;
        }

public function modify_button(){
        $modify = $this->modify;  
        $before_modify = $this ->before_modify ;
        global $num, $filtered;
        
        if(isset($_POST[$modify])){
          if($_POST[$modify]==$num){ ?>

            <form action="#" method="POST">
                <input type ="text" name="<?=$modify?>_go" value="<?=$filtered[$before_modify]?>">
                <input type = "hidden" name="<?=$modify?>_go_id" value="<?=$filtered['id']?>">
                
                <button type="submit">修正開始</button>
              </form> 
          <?php }
              else{
                  echo $filtered[$before_modify]; 
                  ?>
                <form action="#" method="post" >
                    <input type = "hidden" name="<?=$modify?>" value="<?=$num?>">
                    <button type="submit" >修正</button>                
              </form>           
              <?php } }
          else{
              echo $filtered[$before_modify];   
              ?>
            <form action="#" method="post" >
                <input type = "hidden" name="<?=$modify?>" value="<?=$num?>">
                <button type="submit" >修正</button>                
          </form>           
          <?php }}

 public function count_modify_button(){
        $modify = $this->modify;  
        global $search, $search_category, $filtered;
        
        ?>
        <form action="process_click.php" method="post" >
        <input type = "hidden" name="plus" value="<?=$filtered['id']?>">               
            <input type = "hidden" name="search" value="<?=$search?>"> 
            <input type = "hidden" name="search_category" value="<?=$search_category?>">
        <input type="submit" value ="<?=$modify?>">
      　　　　 </form>

      <?php
      }

public function delete_button(){
        global $search, $search_category, $filtered;
        ?>
          <form action="process_delete.php" method="post" 
                        onsubmit="if(!confirm('sure?')){return false;}">
                            <input type = "hidden" name="id" value="<?=$filtered['id']?>">
                          <?php if(isset($_GET['search'])){ 
                            ?>  
                            <input type = "hidden" name="search" value="<?=$search?>">
                            <input type = "hidden" name="search_category" value="<?=$search_category?>">
                            <?php }?>
                            <input type="submit" value ="delete">
              　　　　 </form>
        <?php
        }}?>
    
